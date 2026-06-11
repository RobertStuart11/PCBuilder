<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\CompatibilityRule;
use App\Traits\ChecksComponentCompatibility;
use Illuminate\Http\Request;

class PCBuilderController extends Controller
{
    use ChecksComponentCompatibility;
    private array $categories = [
        'CPU', 'Motherboard', 'RAM', 'GPU', 'Storage', 'PSU', 'Case', 'Cooler'
    ];

    private array $required = ['CPU', 'Motherboard', 'RAM', 'PSU'];

    public function index()
    {
        $componentsByCategory = [];
        
        foreach ($this->categories as $cat) {
            $componentsByCategory[$cat] = Component::where('category', $cat)
                ->where('is_active', true)
                ->where('stock', '>', 0)
                ->orderBy('price')
                ->get();
        }

        $savedBuild = session('pc_build_components', []);

        return view('pcbuilder.index', compact('componentsByCategory', 'savedBuild'));
    }

    public function checkCompatibility(Request $request)
    {
        $selectedIds = array_filter($request->input('components', []));

        if (count($selectedIds) < 2) {
            return response()->json([
                'compatible' => true,
                'issues'     => [],
                'message'    => 'Pilih minimal 2 komponen untuk cek kompatibilitas.',
            ]);
        }

        $issues = [];
        $components = Component::whereIn('id', $selectedIds)->get()->keyBy('id');

        // Loop semua kombinasi komponen
        $idArray = array_values($selectedIds);
        for ($i = 0; $i < count($idArray); $i++) {
            for ($j = $i + 1; $j < count($idArray); $j++) {
                $id1 = $idArray[$i];
                $id2 = $idArray[$j];

                $comp1 = $components[$id1];
                $comp2 = $components[$id2];

                // Cek di database rules terlebih dahulu
                $rule = CompatibilityRule::where(function ($q) use ($id1, $id2) {
                    $q->where('component_id_1', $id1)->where('component_id_2', $id2);
                })->orWhere(function ($q) use ($id1, $id2) {
                    $q->where('component_id_1', $id2)->where('component_id_2', $id1);
                })->first();

                // Jika ada rule explicit, gunakan rule tersebut
                if ($rule) {
                    if (!$rule->is_compatible) {
                        $issues[] = [
                            'type'        => 'error',
                            'component_1' => $comp1->name,
                            'component_2' => $comp2->name,
                            'message'     => $rule->description ?? 'Komponen tidak kompatibel.',
                        ];
                    }
                } else {
                    // Jika tidak ada rule, lakukan pengecekan otomatis berdasarkan spesifikasi
                    $incompatibilityIssue = $this->checkSpecificationCompatibility($comp1, $comp2);
                    if ($incompatibilityIssue) {
                        $issues[] = [
                            'type'        => 'error',
                            'component_1' => $comp1->name,
                            'component_2' => $comp2->name,
                            'message'     => $incompatibilityIssue,
                        ];
                    }
                }
            }
        }

        return response()->json([
            'compatible' => empty($issues),
            'issues'     => $issues,
            'message'    => empty($issues)
                ? 'Semua komponen yang dipilih kompatibel!'
                : 'Ditemukan ' . count($issues) . ' masalah kompatibilitas.',
        ]);
    }

    public function summary(Request $request)
    {
        $componentsData = $request->input('components', []);
        $selectedIds = array_filter($componentsData, function($id) {
            return !empty($id);
        });

        \Log::info('PC Builder Summary - Components:', [
            'raw_components' => $componentsData,
            'filtered_ids' => $selectedIds,
        ]);

        if (empty($selectedIds)) {
            return redirect()->route('pcbuilder')
                            ->with('error', 'Pilih minimal 1 komponen.');
        }

        $components = Component::whereIn('id', $selectedIds)->with('seller')->get();
        
        if ($components->isEmpty()) {
            return redirect()->route('pcbuilder')
                            ->with('error', 'Komponen tidak ditemukan.');
        }

        $totalHarga = $components->sum('price');

        session([
            'pc_build_components' => $selectedIds,
            'pc_build_total'      => $totalHarga,
        ]);

        return view('pcbuilder.summary', compact('components', 'totalHarga'));
    }
}