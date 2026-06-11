<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    public function run(): void
    {
        $sellerId = 2; // ID seller dari UserSeeder

        $components = [
            // ===== CPU (9) =====
            ['name' => 'Intel Core i5-12400F', 'brand' => 'Intel',  'category' => 'CPU',         'price' => 2100000,  'stock' => 15, 'desc' => '6-core, 12-thread, 12th Gen, LGA1700', 'image' => 'IntelCPU.jpg', 'socket' => 'LGA1700', 'cores' => 6, 'threads' => 12, 'generation' => '12th Gen Alder Lake', 'tdp' => 65],
            ['name' => 'Intel Core i5-13600K', 'brand' => 'Intel',  'category' => 'CPU',         'price' => 3200000,  'stock' => 12, 'desc' => '14-core, 20-thread, 13th Gen, LGA1700', 'image' => 'IntelCPU.jpg', 'socket' => 'LGA1700', 'cores' => 14, 'threads' => 20, 'generation' => '13th Gen Raptor Lake', 'tdp' => 125],
            ['name' => 'Intel Core i7-12700K', 'brand' => 'Intel',  'category' => 'CPU',         'price' => 3800000,  'stock' => 10, 'desc' => '12-core, 20-thread, 12th Gen, LGA1700', 'image' => 'IntelCPU.jpg', 'socket' => 'LGA1700', 'cores' => 12, 'threads' => 20, 'generation' => '12th Gen Alder Lake', 'tdp' => 125],
            ['name' => 'Intel Core i7-13700K', 'brand' => 'Intel',  'category' => 'CPU',         'price' => 4500000,  'stock' => 8,  'desc' => '16-core, 24-thread, 13th Gen, LGA1700', 'image' => 'IntelCPU.jpg', 'socket' => 'LGA1700', 'cores' => 16, 'threads' => 24, 'generation' => '13th Gen Raptor Lake', 'tdp' => 125],
            ['name' => 'Intel Core i9-12900K', 'brand' => 'Intel',  'category' => 'CPU',         'price' => 5200000,  'stock' => 6,  'desc' => '16-core, 24-thread, 12th Gen, LGA1700', 'image' => 'IntelCPU.jpg', 'socket' => 'LGA1700', 'cores' => 16, 'threads' => 24, 'generation' => '12th Gen Alder Lake', 'tdp' => 125],
            ['name' => 'Intel Core i9-13900K', 'brand' => 'Intel',  'category' => 'CPU',         'price' => 6200000,  'stock' => 5,  'desc' => '24-core, 32-thread, 13th Gen, LGA1700', 'image' => 'IntelCPU.jpg', 'socket' => 'LGA1700', 'cores' => 24, 'threads' => 32, 'generation' => '13th Gen Raptor Lake', 'tdp' => 125],
            ['name' => 'AMD Ryzen 5 5600X',    'brand' => 'AMD',    'category' => 'CPU',         'price' => 2500000,  'stock' => 12, 'desc' => '6-core, 12-thread, Zen 3, AM4', 'image' => 'AMDCPU.png', 'socket' => 'AM4', 'cores' => 6, 'threads' => 12, 'generation' => 'Zen 3', 'tdp' => 65],
            ['name' => 'AMD Ryzen 7 7700X',    'brand' => 'AMD',    'category' => 'CPU',         'price' => 4200000,  'stock' => 8,  'desc' => '8-core, 16-thread, Zen 4, AM5', 'image' => 'AMDCPU.png', 'socket' => 'AM5', 'cores' => 8, 'threads' => 16, 'generation' => 'Zen 4', 'tdp' => 105],
            ['name' => 'AMD Ryzen 9 7950X',    'brand' => 'AMD',    'category' => 'CPU',         'price' => 7200000,  'stock' => 4,  'desc' => '16-core, 32-thread, Zen 4, AM5', 'image' => 'AMDCPU.png', 'socket' => 'AM5', 'cores' => 16, 'threads' => 32, 'generation' => 'Zen 4', 'tdp' => 170],

            // ===== GPU (10) =====
            ['name' => 'NVIDIA RTX 3060',      'brand' => 'NVIDIA', 'category' => 'GPU',         'price' => 4500000,  'stock' => 8,  'desc' => '12GB GDDR6, 3584 CUDA Cores', 'image' => 'RTXGPU.jpeg', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 12, 'cuda_cores' => 3584, 'architecture' => 'Ampere', 'tdp' => 170],
            ['name' => 'NVIDIA RTX 3070',      'brand' => 'NVIDIA', 'category' => 'GPU',         'price' => 6200000,  'stock' => 6,  'desc' => '8GB GDDR6, 5888 CUDA Cores', 'image' => 'RTXGPU.jpeg', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 8, 'cuda_cores' => 5888, 'architecture' => 'Ampere', 'tdp' => 220],
            ['name' => 'NVIDIA RTX 3080',      'brand' => 'NVIDIA', 'category' => 'GPU',         'price' => 7500000,  'stock' => 4,  'desc' => '10GB GDDR6X, 8704 CUDA Cores', 'image' => 'RTXGPU.jpeg', 'vram_type' => 'GDDR6X', 'vram_capacity_gb' => 10, 'cuda_cores' => 8704, 'architecture' => 'Ampere', 'tdp' => 320],
            ['name' => 'NVIDIA RTX 4060',      'brand' => 'NVIDIA', 'category' => 'GPU',         'price' => 3800000,  'stock' => 10, 'desc' => '8GB GDDR6, 3072 CUDA Cores, Ada', 'image' => 'RTXGPU.jpeg', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 8, 'cuda_cores' => 3072, 'architecture' => 'Ada', 'tdp' => 115],
            ['name' => 'NVIDIA RTX 4070',      'brand' => 'NVIDIA', 'category' => 'GPU',         'price' => 8500000,  'stock' => 5,  'desc' => '12GB GDDR6X, 5888 CUDA Cores, Ada', 'image' => 'RTXGPU.jpeg', 'vram_type' => 'GDDR6X', 'vram_capacity_gb' => 12, 'cuda_cores' => 5888, 'architecture' => 'Ada', 'tdp' => 200],
            ['name' => 'NVIDIA RTX 4080',      'brand' => 'NVIDIA', 'category' => 'GPU',         'price' => 13500000, 'stock' => 3,  'desc' => '16GB GDDR6X, 9728 CUDA Cores, Ada', 'image' => 'RTXGPU.jpeg', 'vram_type' => 'GDDR6X', 'vram_capacity_gb' => 16, 'cuda_cores' => 9728, 'architecture' => 'Ada', 'tdp' => 320],
            ['name' => 'AMD RX 6700 XT',       'brand' => 'AMD',    'category' => 'GPU',         'price' => 4200000,  'stock' => 7,  'desc' => '12GB GDDR6, RDNA 2', 'image' => 'AMDGPU.png', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 12, 'architecture' => 'RDNA 2', 'tdp' => 230],
            ['name' => 'AMD RX 6800 XT',       'brand' => 'AMD',    'category' => 'GPU',         'price' => 5500000,  'stock' => 5,  'desc' => '16GB GDDR6, RDNA 2', 'image' => 'AMDGPU.png', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 16, 'architecture' => 'RDNA 2', 'tdp' => 300],
            ['name' => 'AMD RX 7800 XT',       'brand' => 'AMD',    'category' => 'GPU',         'price' => 6800000,  'stock' => 6,  'desc' => '16GB GDDR6, RDNA 3', 'image' => 'AMDGPU.png', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 16, 'architecture' => 'RDNA 3', 'tdp' => 263],
            ['name' => 'AMD RX 7900 XT',       'brand' => 'AMD',    'category' => 'GPU',         'price' => 8500000,  'stock' => 4,  'desc' => '20GB GDDR6, RDNA 3', 'image' => 'AMDGPU.png', 'vram_type' => 'GDDR6', 'vram_capacity_gb' => 20, 'architecture' => 'RDNA 3', 'tdp' => 420],

            // ===== RAM (9) =====
            ['name' => 'Corsair Vengeance 16GB DDR4', 'brand' => 'Corsair', 'category' => 'RAM', 'price' => 750000,   'stock' => 25, 'desc' => 'DDR4-3200, CL16, 1x16GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR4', 'capacity_gb' => 16, 'speed_mhz' => 3200],
            ['name' => 'Corsair Vengeance 32GB DDR4', 'brand' => 'Corsair', 'category' => 'RAM', 'price' => 1500000,  'stock' => 18, 'desc' => 'DDR4-3200, CL16, 2x16GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR4', 'capacity_gb' => 32, 'speed_mhz' => 3200],
            ['name' => 'Kingston Fury 32GB DDR4',     'brand' => 'Kingston', 'category' => 'RAM', 'price' => 1300000,  'stock' => 18, 'desc' => 'DDR4-3600, CL17, 2x16GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR4', 'capacity_gb' => 32, 'speed_mhz' => 3600],
            ['name' => 'Kingston Fury 64GB DDR5',     'brand' => 'Kingston', 'category' => 'RAM', 'price' => 2800000,  'stock' => 8,  'desc' => 'DDR5-6000, CL30, 2x32GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR5', 'capacity_gb' => 64, 'speed_mhz' => 6000],
            ['name' => 'G.Skill Trident Z 32GB DDR4', 'brand' => 'G.Skill', 'category' => 'RAM', 'price' => 1600000,  'stock' => 12, 'desc' => 'DDR4-3600, CL18, 2x16GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR4', 'capacity_gb' => 32, 'speed_mhz' => 3600],
            ['name' => 'G.Skill Trident Z 32GB DDR5', 'brand' => 'G.Skill', 'category' => 'RAM', 'price' => 1800000,  'stock' => 15, 'desc' => 'DDR5-6000, CL30, 2x16GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR5', 'capacity_gb' => 32, 'speed_mhz' => 6000],
            ['name' => 'Crucial Ballistix 16GB DDR4',  'brand' => 'Crucial',  'category' => 'RAM', 'price' => 850000,   'stock' => 20, 'desc' => 'DDR4-3200, CL16, 2x8GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR4', 'capacity_gb' => 16, 'speed_mhz' => 3200],
            ['name' => 'Crucial Ballistix 32GB DDR5',  'brand' => 'Crucial',  'category' => 'RAM', 'price' => 1400000,  'stock' => 14, 'desc' => 'DDR5-5600, CL28, 2x16GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR5', 'capacity_gb' => 32, 'speed_mhz' => 5600],
            ['name' => 'TEAMGROUP T-Force 64GB DDR5', 'brand' => 'TEAMGROUP', 'category' => 'RAM', 'price' => 3200000,  'stock' => 3,  'desc' => 'DDR5-5600, CL28, 2x32GB', 'image' => 'RAM.jpg', 'ram_standard' => 'DDR5', 'capacity_gb' => 64, 'speed_mhz' => 5600],

            // ===== Motherboard (10) =====
            ['name' => 'ASUS TUF B660M',       'brand' => 'ASUS',   'category' => 'Motherboard', 'price' => 1600000,  'stock' => 12, 'desc' => 'Micro-ATX, LGA1700, DDR4', 'image' => 'Motherboard.webp', 'socket' => 'LGA1700', 'form_factor' => 'Micro-ATX', 'memory_type' => 'DDR4', 'pcie_version' => 'PCIe 4.0'],
            ['name' => 'ASUS ROG B660M',       'brand' => 'ASUS',   'category' => 'Motherboard', 'price' => 1900000,  'stock' => 10, 'desc' => 'Mini-ITX, LGA1700, PCIe 5.0', 'image' => 'Motherboard.webp', 'socket' => 'LGA1700', 'form_factor' => 'Mini-ITX', 'memory_type' => 'DDR4', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'MSI MAG B660',         'brand' => 'MSI',    'category' => 'Motherboard', 'price' => 2100000,  'stock' => 12, 'desc' => 'ATX, LGA1700, DDR5', 'image' => 'Motherboard.webp', 'socket' => 'LGA1700', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'Gigabyte Z790 AORUS',  'brand' => 'Gigabyte', 'category' => 'Motherboard', 'price' => 2800000, 'stock' => 8,  'desc' => 'ATX, LGA1700, DDR5, PCIe 5.0', 'image' => 'Motherboard.webp', 'socket' => 'LGA1700', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'MSI MAG X570',         'brand' => 'MSI',    'category' => 'Motherboard', 'price' => 2300000,  'stock' => 8,  'desc' => 'ATX, AM4, PCIe 4.0', 'image' => 'Motherboard.webp', 'socket' => 'AM4', 'form_factor' => 'ATX', 'memory_type' => 'DDR4', 'pcie_version' => 'PCIe 4.0'],
            ['name' => 'ASUS ROG X870',        'brand' => 'ASUS',   'category' => 'Motherboard', 'price' => 3500000,  'stock' => 5,  'desc' => 'E-ATX, AM5, PCIe 5.0', 'image' => 'Motherboard.webp', 'socket' => 'AM5', 'form_factor' => 'E-ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'MSI MAG X870',         'brand' => 'MSI',    'category' => 'Motherboard', 'price' => 3200000,  'stock' => 7,  'desc' => 'ATX, AM5, PCIe 5.0', 'image' => 'Motherboard.webp', 'socket' => 'AM5', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'Gigabyte B850 AORUS',  'brand' => 'Gigabyte', 'category' => 'Motherboard', 'price' => 3200000, 'stock' => 6,  'desc' => 'ATX, AM5, DDR5', 'image' => 'Motherboard.webp', 'socket' => 'AM5', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'ASRock B850M Steel Legend', 'brand' => 'ASRock', 'category' => 'Motherboard', 'price' => 2600000, 'stock' => 9, 'desc' => 'Micro-ATX, AM5, DDR5', 'image' => 'Motherboard.webp', 'socket' => 'AM5', 'form_factor' => 'Micro-ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],
            ['name' => 'ASUS TUF X870',        'brand' => 'ASUS',   'category' => 'Motherboard', 'price' => 3800000,  'stock' => 4,  'desc' => 'ATX, AM5, DDR5, PCIe 5.0', 'image' => 'Motherboard.webp', 'socket' => 'AM5', 'form_factor' => 'ATX', 'memory_type' => 'DDR5', 'pcie_version' => 'PCIe 5.0'],

            // ===== PSU (9) =====
            ['name' => 'Corsair CV550',        'brand' => 'Corsair','category' => 'PSU',         'price' => 600000,   'stock' => 30, 'desc' => '550W, 80+ Bronze, Non-Modular', 'image' => 'PSU.png', 'wattage' => 550, 'efficiency_rating' => '80+ Bronze', 'psu_type' => 'Non-Modular'],
            ['name' => 'Corsair RM650x',       'brand' => 'Corsair','category' => 'PSU',         'price' => 1200000,  'stock' => 25, 'desc' => '650W, 80+ Gold, Modular', 'image' => 'PSU.png', 'wattage' => 650, 'efficiency_rating' => '80+ Gold', 'psu_type' => 'Modular'],
            ['name' => 'Corsair RM750x',       'brand' => 'Corsair','category' => 'PSU',         'price' => 1350000,  'stock' => 20, 'desc' => '750W, 80+ Gold, Modular', 'image' => 'PSU.png', 'wattage' => 750, 'efficiency_rating' => '80+ Gold', 'psu_type' => 'Modular'],
            ['name' => 'Corsair HX1000',       'brand' => 'Corsair','category' => 'PSU',         'price' => 2500000,  'stock' => 5,  'desc' => '1000W, 80+ Platinum, Fully Modular', 'image' => 'PSU.png', 'wattage' => 1000, 'efficiency_rating' => '80+ Platinum', 'psu_type' => 'Fully Modular'],
            ['name' => 'Seasonic Focus 750W',   'brand' => 'Seasonic','category' => 'PSU',        'price' => 1500000,  'stock' => 12, 'desc' => '750W, 80+ Gold, Modular', 'image' => 'PSU.png', 'wattage' => 750, 'efficiency_rating' => '80+ Gold', 'psu_type' => 'Modular'],
            ['name' => 'Seasonic Focus 850W',   'brand' => 'Seasonic','category' => 'PSU',        'price' => 1700000,  'stock' => 10, 'desc' => '850W, 80+ Gold, Modular', 'image' => 'PSU.png', 'wattage' => 850, 'efficiency_rating' => '80+ Gold', 'psu_type' => 'Modular'],
            ['name' => 'EVGA SuperNOVA 850W', 'brand' => 'EVGA',   'category' => 'PSU',         'price' => 1800000,  'stock' => 9,  'desc' => '850W, 80+ Gold, Fully Modular', 'image' => 'PSU.png', 'wattage' => 850, 'efficiency_rating' => '80+ Gold', 'psu_type' => 'Fully Modular'],
            ['name' => 'EVGA SuperNOVA 1000W', 'brand' => 'EVGA',   'category' => 'PSU',         'price' => 2100000,  'stock' => 8,  'desc' => '1000W, 80+ Platinum, Modular', 'image' => 'PSU.png', 'wattage' => 1000, 'efficiency_rating' => '80+ Platinum', 'psu_type' => 'Modular'],
            ['name' => 'MSI MPG A850GF',       'brand' => 'MSI',    'category' => 'PSU',         'price' => 1600000,  'stock' => 12, 'desc' => '850W, 80+ Gold, Fully Modular', 'image' => 'PSU.png', 'wattage' => 850, 'efficiency_rating' => '80+ Gold', 'psu_type' => 'Fully Modular'],

            // ===== Storage (10) =====
            ['name' => 'Kingston A2000 512GB', 'brand' => 'Kingston','category' => 'Storage',     'price' => 450000,   'stock' => 40, 'desc' => 'NVMe SSD, PCIe 3.0, Budget', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 3.0', 'storage_capacity_gb' => 512, 'read_speed_mbps' => '2200'],
            ['name' => 'WD Blue SN570 1TB',    'brand' => 'WD',     'category' => 'Storage',     'price' => 700000,   'stock' => 35, 'desc' => 'NVMe SSD, PCIe 3.0, 4100 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 3.0', 'storage_capacity_gb' => 1024, 'read_speed_mbps' => '4100'],
            ['name' => 'Crucial P3 1TB',       'brand' => 'Crucial','category' => 'Storage',     'price' => 650000,   'stock' => 30, 'desc' => 'NVMe SSD, PCIe 3.0, 5100 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 3.0', 'storage_capacity_gb' => 1024, 'read_speed_mbps' => '5100'],
            ['name' => 'Samsung 970 EVO Plus 1TB', 'brand' => 'Samsung','category' => 'Storage', 'price' => 900000,   'stock' => 25, 'desc' => 'NVMe SSD, PCIe 3.0, 5200 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 3.0', 'storage_capacity_gb' => 1024, 'read_speed_mbps' => '5200'],
            ['name' => 'Crucial P5 Plus 1TB',  'brand' => 'Crucial','category' => 'Storage',     'price' => 1200000,  'stock' => 25, 'desc' => 'NVMe SSD, PCIe 4.0, 6600 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 4.0', 'storage_capacity_gb' => 1024, 'read_speed_mbps' => '6600'],
            ['name' => 'WD Black SN850X 1TB',  'brand' => 'WD',     'category' => 'Storage',     'price' => 1400000,  'stock' => 22, 'desc' => 'NVMe SSD, PCIe 4.0, 7100 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 4.0', 'storage_capacity_gb' => 1024, 'read_speed_mbps' => '7100'],
            ['name' => 'WD Black SN850X 2TB',  'brand' => 'WD',     'category' => 'Storage',     'price' => 2800000,  'stock' => 20, 'desc' => 'NVMe SSD, PCIe 4.0, 7100 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 4.0', 'storage_capacity_gb' => 2048, 'read_speed_mbps' => '7100'],
            ['name' => 'Samsung 980 Pro 1TB',  'brand' => 'Samsung','category' => 'Storage',     'price' => 1600000,  'stock' => 30, 'desc' => 'NVMe SSD, PCIe 4.0, 7100 MB/s', 'image' => 'Storage.png', 'storage_type' => 'SSD NVMe', 'storage_interface' => 'PCIe 4.0', 'storage_capacity_gb' => 1024, 'read_speed_mbps' => '7100'],
            ['name' => 'WD Blue 2TB HDD',      'brand' => 'WD',     'category' => 'Storage',     'price' => 650000,   'stock' => 20, 'desc' => '3.5" HDD, 7200 RPM, 256MB Cache', 'image' => 'Storage.png', 'storage_type' => 'HDD', 'storage_interface' => 'SATA', 'storage_capacity_gb' => 2048, 'read_speed_mbps' => '180'],
            ['name' => 'Seagate Barracuda 4TB', 'brand' => 'Seagate', 'category' => 'Storage',     'price' => 1200000,  'stock' => 10, 'desc' => '3.5" HDD, 5400 RPM, 256MB Cache', 'image' => 'Storage.png', 'storage_type' => 'HDD', 'storage_interface' => 'SATA', 'storage_capacity_gb' => 4096, 'read_speed_mbps' => '160'],

            // ===== Case (9) =====
            ['name' => 'Lian Li LANCOOL 205',  'brand' => 'Lian Li', 'category' => 'Case',        'price' => 520000,   'stock' => 22, 'desc' => 'Mini-Tower, Budget, Micro-ATX', 'image' => 'Case.jpg', 'case_type' => 'Mini-Tower', 'supported_form_factors' => '["Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 280, 'max_cooler_height_mm' => 150],
            ['name' => 'NZXT H510',            'brand' => 'NZXT',   'category' => 'Case',        'price' => 950000,   'stock' => 12, 'desc' => 'Mid-Tower, Tempered Glass, ATX', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 330, 'max_cooler_height_mm' => 160],
            ['name' => 'NZXT H710i',           'brand' => 'NZXT',   'category' => 'Case',        'price' => 1450000,  'stock' => 8,  'desc' => 'Mid-Tower, Tempered Glass, Smart Hub', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 330, 'max_cooler_height_mm' => 160],
            ['name' => 'Corsair 4000D Airflow', 'brand' => 'Corsair','category' => 'Case',        'price' => 1100000,  'stock' => 15, 'desc' => 'Mid-Tower, Mesh Front, ATX', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 390, 'max_cooler_height_mm' => 170],
            ['name' => 'Corsair 5000T',        'brand' => 'Corsair','category' => 'Case',        'price' => 2200000,  'stock' => 6,  'desc' => 'Full-Tower, Mesh, RGB', 'image' => 'Case.jpg', 'case_type' => 'Full-Tower', 'supported_form_factors' => '["E-ATX", "ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 420, 'max_cooler_height_mm' => 200],
            ['name' => 'Phanteks Eclipse P400A', 'brand' => 'Phanteks', 'category' => 'Case',        'price' => 850000,   'stock' => 18, 'desc' => 'Mid-Tower, Mesh, ATX', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 360, 'max_cooler_height_mm' => 160],
            ['name' => 'Phanteks Eclipse P500A', 'brand' => 'Phanteks', 'category' => 'Case',        'price' => 1100000,  'stock' => 14, 'desc' => 'Mid-Tower, Mesh RGB, ATX', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 400, 'max_cooler_height_mm' => 170],
            ['name' => 'Fractal Design Meshify C', 'brand' => 'Fractal Design', 'category' => 'Case', 'price' => 1200000, 'stock' => 10, 'desc' => 'Mid-Tower, Modular, ATX', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 410, 'max_cooler_height_mm' => 180],
            ['name' => 'Fractal Design Define 7', 'brand' => 'Fractal Design', 'category' => 'Case', 'price' => 1650000, 'stock' => 7, 'desc' => 'Mid-Tower, Quiet, ATX', 'image' => 'Case.jpg', 'case_type' => 'Mid-Tower', 'supported_form_factors' => '["ATX", "Micro-ATX", "Mini-ITX"]', 'max_gpu_length_mm' => 420, 'max_cooler_height_mm' => 200],

            // ===== Cooler (10) =====
            ['name' => 'Deepcool Gammaxx 300',  'brand' => 'Deepcool','category' => 'Cooler',     'price' => 200000,   'stock' => 30, 'desc' => 'Single-Tower, 92mm, Budget', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 92, 'compatible_sockets' => '["LGA1151", "LGA1150", "AM4"]'],
            ['name' => 'Arctic Freezer 34 eSports', 'brand' => 'Arctic', 'category' => 'Cooler',     'price' => 750000,   'stock' => 14, 'desc' => 'Single-Tower, 120mm, LGA1700/AM4', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 120, 'compatible_sockets' => '["LGA1700", "AM4", "AM5"]'],
            ['name' => 'DeepCool AK620',       'brand' => 'DeepCool','category' => 'Cooler',     'price' => 650000,   'stock' => 18, 'desc' => 'Dual-Tower, 2x120mm, LGA1700/AM4', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 120, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
            ['name' => 'Thermalright Peerless Assassin 120 SE', 'brand' => 'Thermalright', 'category' => 'Cooler', 'price' => 550000, 'stock' => 16, 'desc' => 'Dual-Tower, 2x120mm, Budget', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 120, 'compatible_sockets' => '["LGA1700", "AM4", "AM5"]'],
            ['name' => 'Noctua NH-U12S Redux',  'brand' => 'Noctua', 'category' => 'Cooler',     'price' => 750000,   'stock' => 12, 'desc' => 'Single-Tower, 120mm, Premium', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 120, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
            ['name' => 'Noctua NH-D15',        'brand' => 'Noctua', 'category' => 'Cooler',     'price' => 1200000,  'stock' => 8,  'desc' => 'Dual-Tower, 2x140mm, Premium', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 140, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
            ['name' => 'be quiet! Dark Rock Pro 4', 'brand' => 'be quiet!', 'category' => 'Cooler',     'price' => 950000,   'stock' => 10, 'desc' => 'Dual-Tower, 2x135mm, Silent', 'image' => 'Cooler.jpg', 'cooler_type' => 'Air', 'fan_size_mm' => 135, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
            ['name' => 'Corsair H100i RGB Pro', 'brand' => 'Corsair','category' => 'Cooler',     'price' => 1400000,  'stock' => 7,  'desc' => 'Liquid Cooling, 240mm, RGB', 'image' => 'Cooler.jpg', 'cooler_type' => 'Liquid', 'fan_size_mm' => 120, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
            ['name' => 'Corsair H150i Elite',  'brand' => 'Corsair','category' => 'Cooler',     'price' => 1800000,  'stock' => 6,  'desc' => 'Liquid Cooling, 360mm, RGB', 'image' => 'Cooler.jpg', 'cooler_type' => 'Liquid', 'fan_size_mm' => 120, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
            ['name' => 'NZXT Kraken X63',      'brand' => 'NZXT',   'category' => 'Cooler',     'price' => 1600000,  'stock' => 8,  'desc' => 'Liquid Cooling, 280mm, Smart Hub', 'image' => 'Cooler.jpg', 'cooler_type' => 'Liquid', 'fan_size_mm' => 140, 'compatible_sockets' => '["LGA1700", "LGA1200", "AM4", "AM5"]'],
        ];

        foreach ($components as $data) {
            Component::create([
                'user_id'     => $sellerId,
                'name'        => $data['name'],
                'brand'       => $data['brand'],
                'category'    => $data['category'],
                'description' => $data['desc'],
                'price'       => $data['price'],
                'stock'       => $data['stock'],
                'image'       => 'images/components/' . $data['image'],
                'is_active'   => true,
                
                // CPU Specs
                'socket'      => $data['socket'] ?? null,
                'cores'       => $data['cores'] ?? null,
                'threads'     => $data['threads'] ?? null,
                'generation'  => $data['generation'] ?? null,
                'tdp'         => $data['tdp'] ?? null,
                
                // Motherboard Specs
                'form_factor' => $data['form_factor'] ?? null,
                'memory_type' => $data['memory_type'] ?? null,
                'pcie_version' => $data['pcie_version'] ?? null,
                
                // RAM Specs
                'ram_standard' => $data['ram_standard'] ?? null,
                'capacity_gb' => $data['capacity_gb'] ?? null,
                'speed_mhz'   => $data['speed_mhz'] ?? null,
                
                // Storage Specs
                'storage_type' => $data['storage_type'] ?? null,
                'storage_interface' => $data['storage_interface'] ?? null,
                'storage_capacity_gb' => $data['storage_capacity_gb'] ?? null,
                'read_speed_mbps' => $data['read_speed_mbps'] ?? null,
                
                // GPU Specs
                'vram_type'   => $data['vram_type'] ?? null,
                'vram_capacity_gb' => $data['vram_capacity_gb'] ?? null,
                'cuda_cores'  => $data['cuda_cores'] ?? null,
                'architecture' => $data['architecture'] ?? null,
                
                // PSU Specs
                'wattage'     => $data['wattage'] ?? null,
                'efficiency_rating' => $data['efficiency_rating'] ?? null,
                'psu_type'    => $data['psu_type'] ?? null,
                
                // Cooler Specs
                'cooler_type' => $data['cooler_type'] ?? null,
                'fan_size_mm' => $data['fan_size_mm'] ?? null,
                'compatible_sockets' => $data['compatible_sockets'] ?? null,
                
                // Case Specs
                'case_type'   => $data['case_type'] ?? null,
                'supported_form_factors' => $data['supported_form_factors'] ?? null,
                'max_gpu_length_mm' => $data['max_gpu_length_mm'] ?? null,
                'max_cooler_height_mm' => $data['max_cooler_height_mm'] ?? null,
            ]);
        }

        $this->command->info('[OK] ' . count($components) . ' komponen berhasil di-seed dengan gambar yang sesuai!');
    }
}