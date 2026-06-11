<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('components', function (Blueprint $table) {
            // CPU Specifications
            $table->string('socket')->nullable()->comment('CPU Socket: LGA1700, AM4, AM5, dll');
            $table->integer('cores')->nullable()->comment('Jumlah core');
            $table->integer('threads')->nullable()->comment('Jumlah thread');
            $table->string('generation')->nullable()->comment('Generasi: 12th Gen, 13th Gen, Zen 3, Zen 4, dll');
            $table->decimal('tdp', 5, 0)->nullable()->comment('Thermal Design Power dalam Watt');

            // Motherboard Specifications
            $table->string('form_factor')->nullable()->comment('Form Factor: ATX, Micro-ATX, Mini-ITX, E-ATX');
            $table->string('memory_type')->nullable()->comment('Tipe RAM: DDR4, DDR5');
            $table->string('pcie_version')->nullable()->comment('PCIe Version: PCIe 3.0, PCIe 4.0, PCIe 5.0');

            // RAM Specifications
            $table->string('ram_standard')->nullable()->comment('Standar RAM: DDR4, DDR5');
            $table->integer('capacity_gb')->nullable()->comment('Kapasitas RAM dalam GB');
            $table->integer('speed_mhz')->nullable()->comment('Kecepatan RAM dalam MHz');

            // Storage Specifications
            $table->string('storage_type')->nullable()->comment('Tipe Storage: SSD NVMe, SATA SSD, HDD');
            $table->string('storage_interface')->nullable()->comment('Interface: PCIe 3.0, PCIe 4.0, PCIe 5.0, SATA');
            $table->integer('storage_capacity_gb')->nullable()->comment('Kapasitas storage dalam GB');
            $table->string('read_speed_mbps')->nullable()->comment('Kecepatan baca dalam MB/s');

            // GPU Specifications
            $table->string('vram_type')->nullable()->comment('Tipe VRAM: GDDR6, GDDR6X');
            $table->integer('vram_capacity_gb')->nullable()->comment('Kapasitas VRAM dalam GB');
            $table->integer('cuda_cores')->nullable()->comment('CUDA Cores (untuk NVIDIA)');
            $table->string('architecture')->nullable()->comment('Arsitektur GPU: Ampere, Ada, RDNA 2, RDNA 3');

            // PSU Specifications
            $table->integer('wattage')->nullable()->comment('Daya PSU dalam Watt');
            $table->string('efficiency_rating')->nullable()->comment('Efisiensi: 80+ Bronze, Gold, Platinum');
            $table->string('psu_type')->nullable()->comment('Tipe PSU: Non-Modular, Modular, Fully Modular');

            // Cooler Specifications
            $table->string('cooler_type')->nullable()->comment('Tipe Cooler: Air, Liquid');
            $table->integer('fan_size_mm')->nullable()->comment('Ukuran fan dalam mm');
            $table->string('compatible_sockets')->nullable()->comment('Socket yang kompatibel (JSON array)');

            // Case Specifications
            $table->string('case_type')->nullable()->comment('Tipe Case: Mini-Tower, Mid-Tower, Full-Tower');
            $table->string('supported_form_factors')->nullable()->comment('Form factor yang didukung (JSON array)');
            $table->integer('max_gpu_length_mm')->nullable()->comment('Panjang GPU maksimal dalam mm');
            $table->integer('max_cooler_height_mm')->nullable()->comment('Tinggi cooler maksimal dalam mm');

            // General specifications
            $table->text('specifications')->nullable()->comment('Spesifikasi tambahan dalam JSON');
        });
    }

    public function down(): void
    {
        Schema::table('components', function (Blueprint $table) {
            $table->dropColumn([
                'socket', 'cores', 'threads', 'generation', 'tdp',
                'form_factor', 'memory_type', 'pcie_version',
                'ram_standard', 'capacity_gb', 'speed_mhz',
                'storage_type', 'storage_interface', 'storage_capacity_gb', 'read_speed_mbps',
                'vram_type', 'vram_capacity_gb', 'cuda_cores', 'architecture',
                'wattage', 'efficiency_rating', 'psu_type',
                'cooler_type', 'fan_size_mm', 'compatible_sockets',
                'case_type', 'supported_form_factors', 'max_gpu_length_mm', 'max_cooler_height_mm',
                'specifications'
            ]);
        });
    }
};