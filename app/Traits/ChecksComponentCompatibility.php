<?php

namespace App\Traits;

use App\Models\Component;

trait ChecksComponentCompatibility
{
    /**
     * Cek kompatibilitas berdasarkan spesifikasi komponen
     */
    protected function checkSpecificationCompatibility(Component $comp1, Component $comp2): ?string
    {
        // CPU + Motherboard Socket Check
        if (($comp1->category === 'CPU' && $comp2->category === 'Motherboard') ||
            ($comp1->category === 'Motherboard' && $comp2->category === 'CPU')) {
            
            $cpu = $comp1->category === 'CPU' ? $comp1 : $comp2;
            $mobo = $comp1->category === 'Motherboard' ? $comp1 : $comp2;
            
            return $this->checkSocketCompatibility($cpu, $mobo);
        }

        
        if (($comp1->category === 'RAM' && $comp2->category === 'Motherboard') ||
            ($comp1->category === 'Motherboard' && $comp2->category === 'RAM')) {
            
            $ram = $comp1->category === 'RAM' ? $comp1 : $comp2;
            $mobo = $comp1->category === 'Motherboard' ? $comp1 : $comp2;
            
            return $this->checkMemoryTypeCompatibility($ram, $mobo);
        }

        // CPU + Cooler Socket Check
        if (($comp1->category === 'CPU' && $comp2->category === 'Cooler') ||
            ($comp1->category === 'Cooler' && $comp2->category === 'CPU')) {
            
            $cpu = $comp1->category === 'CPU' ? $comp1 : $comp2;
            $cooler = $comp1->category === 'Cooler' ? $comp1 : $comp2;
            
            return $this->checkCoolerSocketCompatibility($cpu, $cooler);
        }

        return null;
    }

    /**
     * Cek Socket CPU vs Motherboard
     */
    protected function checkSocketCompatibility(Component $cpu, Component $mobo): ?string
    {
        // Extract socket info dari brand/name
        $cpuSocket = $this->extractSocketFromComponent($cpu);
        $moboSocket = $this->extractSocketFromComponent($mobo);

        if ($cpuSocket && $moboSocket && $cpuSocket !== $moboSocket) {
            return "Socket {$cpuSocket} (CPU) tidak kompatibel dengan Socket {$moboSocket} (Motherboard)";
        }

        return null;
    }

    /**
     * Cek Memory Type RAM vs Motherboard
     */
    protected function checkMemoryTypeCompatibility(Component $ram, Component $mobo): ?string
    {
        $ramType = $this->extractMemoryTypeFromComponent($ram);
        $moboType = $this->extractMemoryTypeFromComponent($mobo);

        if ($ramType && $moboType && $ramType !== $moboType) {
            return "RAM tipe {$ramType} tidak kompatibel dengan Motherboard {$moboType}";
        }

        return null;
    }

    /**
     * Cek Socket CPU vs Cooler
     */
    protected function checkCoolerSocketCompatibility(Component $cpu, Component $cooler): ?string
    {
        // Cooler tertentu bersifat universal (Arctic Freezer, Noctua NH-D15, etc)
        $universalCoolers = ['Arctic Freezer', 'Noctua NH-D15', 'DeepCool AK620', 'Corsair H'];
        
        foreach ($universalCoolers as $universal) {
            if (str_contains($cooler->name, $universal)) {
                return null; // Universal cooler, selalu kompatibel
            }
        }

        $cpuSocket = $this->extractSocketFromComponent($cpu);
        $coolerSocket = $this->extractSocketFromComponent($cooler);

        if ($cpuSocket && $coolerSocket && $cpuSocket !== $coolerSocket) {
            return "Cooler untuk Socket {$coolerSocket} tidak kompatibel dengan Socket {$cpuSocket}";
        }

        return null;
    }

    /**
     * Extract socket dari database atau nama produk
     */
    protected function extractSocketFromComponent(Component $comp): ?string
    {
        // Prioritas 1: Dari kolom socket jika ada
        if (!empty($comp->socket)) {
            return $comp->socket;
        }

        $text = strtoupper($comp->brand . ' ' . $comp->name);

        // ===== INTEL SOCKETS =====
        if (str_contains($text, 'LGA1700')) return 'LGA1700';
        if (str_contains($text, 'LGA1200')) return 'LGA1200';
        if (str_contains($text, 'Z790') || str_contains($text, 'B790')) return 'LGA1700';
        if (str_contains($text, 'Z690') || str_contains($text, 'B660')) return 'LGA1700';

        // ===== AMD SOCKETS =====
        // AM5: X870, B850, X870E, B870
        if (str_contains($text, 'X870') || str_contains($text, 'B850') || str_contains($text, 'B870')) {
            return 'AM5';
        }
        // AM4: X570, B550, X370, B450
        if (str_contains($text, 'X570') || str_contains($text, 'B550') || 
            str_contains($text, 'X370') || str_contains($text, 'B450')) {
            return 'AM4';
        }
        
        // Nama CPU AMD
        if (str_contains($text, '7950X') || str_contains($text, '7900X') || 
            str_contains($text, '7700X') || str_contains($text, 'RYZEN 7')) {
            // Cek dari string, tapi ini untuk Ryzen 7000 series = AM5
            if (str_contains($text, '5600X') || str_contains($text, 'RYZEN 5 5') ||
                str_contains($text, 'RYZEN 7 5') || str_contains($text, 'RYZEN 9 5')) {
                return 'AM4'; // Ryzen 5000 series
            }
            return 'AM5'; // Ryzen 7000 series
        }
        if (str_contains($text, 'RYZEN 5 5') || str_contains($text, 'RYZEN 7 5') || 
            str_contains($text, 'RYZEN 9 5')) {
            return 'AM4'; // Ryzen 5000 series = AM4
        }

        // AM3: Lebih lama
        if (str_contains($text, 'AM3')) return 'AM3';

        return null;
    }

    /**
     * Extract memory type dari database atau nama produk
     */
    protected function extractMemoryTypeFromComponent(Component $comp): ?string
    {
        // Prioritas 1: Dari kolom memory_type jika ada
        if (!empty($comp->memory_type)) {
            return $comp->memory_type;
        }

        $text = strtoupper($comp->brand . ' ' . $comp->name);

        // Ekstrak dari nama produk
        if (str_contains($text, 'DDR5')) return 'DDR5';
        if (str_contains($text, 'DDR4')) return 'DDR4';
        if (str_contains($text, 'DDR3')) return 'DDR3';

        // Ekstrak dari nama motherboard chipset untuk mendeteksi support memory type
        // Z790, B790 = DDR5, Z690, B660 = DDR4, X870, B850 = DDR5, X570, B550 = DDR4
        if (str_contains($text, 'Z790') || str_contains($text, 'B790') ||
            str_contains($text, 'X870') || str_contains($text, 'B850')) {
            return 'DDR5';
        }
        if (str_contains($text, 'Z690') || str_contains($text, 'B660') ||
            str_contains($text, 'X570') || str_contains($text, 'B550')) {
            return 'DDR4';
        }

        return null;
    }
}
