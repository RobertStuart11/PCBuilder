<?php

namespace Database\Seeders;

use App\Models\CompatibilityRule;
use Illuminate\Database\Seeder;

class CompatibilityRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // ===== CPU + MOTHERBOARD SOCKET COMPATIBILITY (Intel LGA1700) =====
            ['component_id_1' => 1, 'component_id_2' => 29, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-12400F kompatibel dengan ASUS TUF B660M (LGA1700)'],
            ['component_id_1' => 1, 'component_id_2' => 30, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-12400F kompatibel dengan ASUS ROG B660M (LGA1700)'],
            ['component_id_1' => 1, 'component_id_2' => 31, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-12400F kompatibel dengan MSI MAG B660 (LGA1700)'],
            ['component_id_1' => 2, 'component_id_2' => 29, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-13600K kompatibel dengan ASUS TUF B660M (LGA1700)'],
            ['component_id_1' => 2, 'component_id_2' => 30, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-13600K kompatibel dengan ASUS ROG B660M (LGA1700)'],
            ['component_id_1' => 2, 'component_id_2' => 31, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-13600K kompatibel dengan MSI MAG B660 (LGA1700)'],
            ['component_id_1' => 2, 'component_id_2' => 32, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i5-13600K kompatibel dengan Gigabyte Z790 AORUS (LGA1700)'],
            ['component_id_1' => 3, 'component_id_2' => 29, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i7-12700K kompatibel dengan ASUS TUF B660M (LGA1700)'],
            ['component_id_1' => 3, 'component_id_2' => 31, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i7-12700K kompatibel dengan MSI MAG B660 (LGA1700)'],
            ['component_id_1' => 4, 'component_id_2' => 32, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i7-13700K kompatibel dengan Gigabyte Z790 AORUS (LGA1700)'],
            ['component_id_1' => 5, 'component_id_2' => 32, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i9-12900K kompatibel dengan Gigabyte Z790 AORUS (LGA1700)'],
            ['component_id_1' => 6, 'component_id_2' => 32, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Intel i9-13900K kompatibel dengan Gigabyte Z790 AORUS (LGA1700)'],

            // ===== CPU + MOTHERBOARD SOCKET COMPATIBILITY (AMD AM4) =====
            ['component_id_1' => 7, 'component_id_2' => 33, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 5 5600X kompatibel dengan MSI MAG X570 (AM4)'],

            // ===== CPU + MOTHERBOARD SOCKET COMPATIBILITY (AMD AM5) =====
            ['component_id_1' => 8, 'component_id_2' => 34, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 7 7700X kompatibel dengan ASUS ROG X870 (AM5)'],
            ['component_id_1' => 8, 'component_id_2' => 35, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 7 7700X kompatibel dengan MSI MAG X870 (AM5)'],
            ['component_id_1' => 8, 'component_id_2' => 36, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 7 7700X kompatibel dengan Gigabyte B850 AORUS (AM5)'],
            ['component_id_1' => 8, 'component_id_2' => 37, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 7 7700X kompatibel dengan ASRock B850M Steel Legend (AM5)'],
            ['component_id_1' => 8, 'component_id_2' => 38, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 7 7700X kompatibel dengan ASUS TUF X870 (AM5)'],
            ['component_id_1' => 9, 'component_id_2' => 34, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 9 7950X kompatibel dengan ASUS ROG X870 (AM5)'],
            ['component_id_1' => 9, 'component_id_2' => 35, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 9 7950X kompatibel dengan MSI MAG X870 (AM5)'],
            ['component_id_1' => 9, 'component_id_2' => 36, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 9 7950X kompatibel dengan Gigabyte B850 AORUS (AM5)'],
            ['component_id_1' => 9, 'component_id_2' => 38, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'AMD Ryzen 9 7950X kompatibel dengan ASUS TUF X870 (AM5)'],

            // ===== CPU + COOLER COMPATIBILITY (Air Coolers) =====
            // Arctic Freezer 34 eSports - LGA1700
            ['component_id_1' => 1, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan Intel i5-12400F (LGA1700)'],
            ['component_id_1' => 2, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan Intel i5-13600K (LGA1700)'],
            ['component_id_1' => 3, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan Intel i7-12700K (LGA1700)'],
            ['component_id_1' => 4, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan Intel i7-13700K (LGA1700)'],
            
            // Arctic Freezer 34 eSports - AM4/AM5
            ['component_id_1' => 7, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan AMD Ryzen 5 5600X (AM4)'],
            ['component_id_1' => 8, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan AMD Ryzen 7 7700X (AM5)'],
            ['component_id_1' => 9, 'component_id_2' => 69, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Arctic Freezer 34 eSports kompatibel dengan AMD Ryzen 9 7950X (AM5)'],

            // DeepCool AK620 - LGA1700/AM4/AM5
            ['component_id_1' => 1, 'component_id_2' => 70, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'DeepCool AK620 kompatibel dengan Intel i5-12400F (LGA1700)'],
            ['component_id_1' => 7, 'component_id_2' => 70, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'DeepCool AK620 kompatibel dengan AMD Ryzen 5 5600X (AM4)'],
            ['component_id_1' => 8, 'component_id_2' => 70, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'DeepCool AK620 kompatibel dengan AMD Ryzen 7 7700X (AM5)'],

            // Noctua NH-D15 - Premium universal
            ['component_id_1' => 3, 'component_id_2' => 72, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Noctua NH-D15 kompatibel dengan Intel i7-12700K (LGA1700)'],
            ['component_id_1' => 4, 'component_id_2' => 72, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Noctua NH-D15 kompatibel dengan Intel i7-13700K (LGA1700)'],
            ['component_id_1' => 5, 'component_id_2' => 72, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Noctua NH-D15 kompatibel dengan Intel i9-12900K (LGA1700)'],
            ['component_id_1' => 6, 'component_id_2' => 72, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Noctua NH-D15 kompatibel dengan Intel i9-13900K (LGA1700)'],
            ['component_id_1' => 8, 'component_id_2' => 72, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Noctua NH-D15 kompatibel dengan AMD Ryzen 7 7700X (AM5)'],
            ['component_id_1' => 9, 'component_id_2' => 72, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Noctua NH-D15 kompatibel dengan AMD Ryzen 9 7950X (AM5)'],

            // ===== CPU + COOLER COMPATIBILITY (Liquid Coolers) =====
            // Corsair H100i RGB Pro - 240mm
            ['component_id_1' => 5, 'component_id_2' => 75, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Corsair H100i RGB Pro kompatibel dengan Intel i9-12900K (LGA1700)'],
            ['component_id_1' => 6, 'component_id_2' => 75, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Corsair H100i RGB Pro kompatibel dengan Intel i9-13900K (LGA1700)'],
            
            // Corsair H150i Elite - 360mm
            ['component_id_1' => 5, 'component_id_2' => 76, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Corsair H150i Elite kompatibel dengan Intel i9-12900K (LGA1700)'],
            ['component_id_1' => 6, 'component_id_2' => 76, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Corsair H150i Elite kompatibel dengan Intel i9-13900K (LGA1700)'],
            ['component_id_1' => 9, 'component_id_2' => 76, 'rule_type' => 'socket', 'is_compatible' => true, 'description' => 'Corsair H150i Elite kompatibel dengan AMD Ryzen 9 7950X (AM5)'],

            // ===== RAM + MOTHERBOARD MEMORY TYPE (DDR4) =====
            ['component_id_1' => 20, 'component_id_2' => 29, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Corsair Vengeance 16GB DDR4 kompatibel dengan ASUS TUF B660M (DDR4)'],
            ['component_id_1' => 20, 'component_id_2' => 30, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Corsair Vengeance 16GB DDR4 kompatibel dengan ASUS ROG B660M (DDR4)'],
            ['component_id_1' => 21, 'component_id_2' => 29, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Corsair Vengeance 32GB DDR4 kompatibel dengan ASUS TUF B660M (DDR4)'],
            ['component_id_1' => 21, 'component_id_2' => 30, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Corsair Vengeance 32GB DDR4 kompatibel dengan ASUS ROG B660M (DDR4)'],
            ['component_id_1' => 22, 'component_id_2' => 33, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Kingston Fury 32GB DDR4 kompatibel dengan MSI MAG X570 (DDR4/AM4)'],

            // ===== RAM + MOTHERBOARD MEMORY TYPE (DDR5) =====
            ['component_id_1' => 23, 'component_id_2' => 31, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Kingston Fury 64GB DDR5 kompatibel dengan MSI MAG B660 (DDR5)'],
            ['component_id_1' => 23, 'component_id_2' => 32, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Kingston Fury 64GB DDR5 kompatibel dengan Gigabyte Z790 AORUS (DDR5)'],
            ['component_id_1' => 23, 'component_id_2' => 34, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Kingston Fury 64GB DDR5 kompatibel dengan ASUS ROG X870 (DDR5)'],
            ['component_id_1' => 24, 'component_id_2' => 31, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'G.Skill Trident Z 32GB DDR5 kompatibel dengan MSI MAG B660 (DDR5)'],
            ['component_id_1' => 24, 'component_id_2' => 32, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'G.Skill Trident Z 32GB DDR5 kompatibel dengan Gigabyte Z790 AORUS (DDR5)'],
            ['component_id_1' => 24, 'component_id_2' => 34, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'G.Skill Trident Z 32GB DDR5 kompatibel dengan ASUS ROG X870 (DDR5)'],
            ['component_id_1' => 25, 'component_id_2' => 34, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Crucial Ballistix 32GB DDR5 kompatibel dengan ASUS ROG X870 (DDR5)'],
            ['component_id_1' => 25, 'component_id_2' => 35, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'Crucial Ballistix 32GB DDR5 kompatibel dengan MSI MAG X870 (DDR5)'],
            ['component_id_1' => 26, 'component_id_2' => 36, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'TEAMGROUP T-Force 64GB DDR5 kompatibel dengan Gigabyte B850 AORUS (DDR5)'],
            ['component_id_1' => 26, 'component_id_2' => 38, 'rule_type' => 'memory_type', 'is_compatible' => true, 'description' => 'TEAMGROUP T-Force 64GB DDR5 kompatibel dengan ASUS TUF X870 (DDR5)'],

            // ===== INCOMPATIBILITY: DDR4 RAM dengan DDR5 Motherboards =====
            ['component_id_1' => 20, 'component_id_2' => 31, 'rule_type' => 'memory_type', 'is_compatible' => false, 'description' => 'Corsair Vengeance DDR4 TIDAK kompatibel dengan MSI MAG B660 (DDR5 only)'],
            ['component_id_1' => 20, 'component_id_2' => 32, 'rule_type' => 'memory_type', 'is_compatible' => false, 'description' => 'Corsair Vengeance DDR4 TIDAK kompatibel dengan Gigabyte Z790 AORUS (DDR5 only)'],
            ['component_id_1' => 20, 'component_id_2' => 34, 'rule_type' => 'memory_type', 'is_compatible' => false, 'description' => 'Corsair Vengeance DDR4 TIDAK kompatibel dengan ASUS ROG X870 (DDR5 only)'],

            // ===== STORAGE + MOTHERBOARD PCIe COMPATIBILITY =====
            // PCIe 3.0 Storage dengan semua Motherboards
            ['component_id_1' => 48, 'component_id_2' => 29, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'Kingston A2000 512GB (NVMe PCIe 3.0) kompatibel dengan ASUS TUF B660M'],
            ['component_id_1' => 48, 'component_id_2' => 31, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'Kingston A2000 512GB (NVMe PCIe 3.0) kompatibel dengan MSI MAG B660'],
            ['component_id_1' => 49, 'component_id_2' => 29, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'WD Blue SN570 1TB (NVMe PCIe 3.0) kompatibel dengan ASUS TUF B660M'],
            ['component_id_1' => 50, 'component_id_2' => 31, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'Crucial P3 1TB (NVMe PCIe 3.0) kompatibel dengan MSI MAG B660'],
            
            // PCIe 4.0 Storage (optimal dengan PCIe 4.0+ Motherboards)
            ['component_id_1' => 53, 'component_id_2' => 32, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'Crucial P5 Plus 1TB (NVMe PCIe 4.0) optimal dengan Gigabyte Z790 AORUS (PCIe 5.0)'],
            ['component_id_1' => 54, 'component_id_2' => 34, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'WD Black SN850X 1TB (NVMe PCIe 4.0) optimal dengan ASUS ROG X870 (PCIe 5.0)'],
            ['component_id_1' => 55, 'component_id_2' => 35, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'WD Black SN850X 2TB (NVMe PCIe 4.0) optimal dengan MSI MAG X870 (PCIe 5.0)'],
            ['component_id_1' => 56, 'component_id_2' => 36, 'rule_type' => 'pcie', 'is_compatible' => true, 'description' => 'Samsung 980 Pro 1TB (NVMe PCIe 4.0) optimal dengan Gigabyte B850 AORUS (PCIe 5.0)'],

            // ===== GPU + PSU POWER REQUIREMENT =====
            // Entry-level GPU
            ['component_id_1' => 10, 'component_id_2' => 39, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 3060 (170W) cocok dengan Corsair CV550 (550W)'],
            ['component_id_1' => 10, 'component_id_2' => 40, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 3060 (170W) cocok dengan Corsair RM650x (650W)'],
            ['component_id_1' => 13, 'component_id_2' => 39, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 4060 (115W) cocok dengan Corsair CV550 (550W)'],
            ['component_id_1' => 13, 'component_id_2' => 40, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 4060 (115W) cocok dengan Corsair RM650x (650W)'],

            // Mid-range GPU
            ['component_id_1' => 11, 'component_id_2' => 40, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 3070 (220W) memerlukan Corsair RM650x (650W)'],
            ['component_id_1' => 11, 'component_id_2' => 41, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 3070 (220W) optimal dengan Corsair RM750x (750W)'],
            ['component_id_1' => 14, 'component_id_2' => 41, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 4070 (200W) optimal dengan Corsair RM750x (750W)'],
            ['component_id_1' => 17, 'component_id_2' => 41, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'AMD RX 6700 XT (230W) memerlukan Corsair RM750x (750W)'],

            // High-end GPU
            ['component_id_1' => 12, 'component_id_2' => 41, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 3080 (320W) memerlukan Corsair RM750x (750W)'],
            ['component_id_1' => 12, 'component_id_2' => 42, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 3080 (320W) optimal dengan Corsair HX1000 (1000W)'],
            ['component_id_1' => 15, 'component_id_2' => 42, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'NVIDIA RTX 4080 (320W) memerlukan Corsair HX1000 (1000W)'],
            ['component_id_1' => 18, 'component_id_2' => 42, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'AMD RX 6800 XT (300W) memerlukan Corsair HX1000 (1000W)'],
            ['component_id_1' => 19, 'component_id_2' => 42, 'rule_type' => 'tdp', 'is_compatible' => true, 'description' => 'AMD RX 7900 XT (420W) memerlukan Corsair HX1000 (1000W)'],

            // ===== CASE + MOTHERBOARD FORM FACTOR =====
            // Mini-Tower (Lian Li LANCOOL 205)
            ['component_id_1' => 29, 'component_id_2' => 58, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'ASUS TUF B660M (Micro-ATX) cocok dengan Lian Li LANCOOL 205'],
            ['component_id_1' => 37, 'component_id_2' => 58, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'ASRock B850M Steel Legend (Micro-ATX) cocok dengan Lian Li LANCOOL 205'],

            // Mid-Tower (NZXT H510)
            ['component_id_1' => 31, 'component_id_2' => 60, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'MSI MAG B660 (ATX) cocok dengan NZXT H510'],
            ['component_id_1' => 32, 'component_id_2' => 60, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'Gigabyte Z790 AORUS (ATX) cocok dengan NZXT H510'],
            ['component_id_1' => 33, 'component_id_2' => 60, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'MSI MAG X570 (ATX) cocok dengan NZXT H510'],

            // Mid-Tower (Corsair 4000D Airflow)
            ['component_id_1' => 34, 'component_id_2' => 62, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'ASUS ROG X870 (E-ATX) cocok dengan Corsair 4000D Airflow'],
            ['component_id_1' => 35, 'component_id_2' => 62, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'MSI MAG X870 (ATX) cocok dengan Corsair 4000D Airflow'],
            ['component_id_1' => 36, 'component_id_2' => 62, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'Gigabyte B850 AORUS (ATX) cocok dengan Corsair 4000D Airflow'],
            ['component_id_1' => 38, 'component_id_2' => 62, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'ASUS TUF X870 (ATX) cocok dengan Corsair 4000D Airflow'],

            // Full-Tower (Corsair 5000T)
            ['component_id_1' => 34, 'component_id_2' => 63, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'ASUS ROG X870 (E-ATX) cocok dengan Corsair 5000T (Full-Tower)'],
            ['component_id_1' => 35, 'component_id_2' => 63, 'rule_type' => 'form_factor', 'is_compatible' => true, 'description' => 'MSI MAG X870 (ATX) cocok dengan Corsair 5000T (Full-Tower)'],

            // ===== INCOMPATIBILITY: DDR4 RAM dengan AM5 (DDR5) Socket =====
            ['component_id_1' => 20, 'component_id_2' => 34, 'rule_type' => 'memory_type', 'is_compatible' => false, 'description' => 'DDR4 RAM TIDAK kompatibel dengan Socket AM5 (DDR5 only)'],
            ['component_id_1' => 22, 'component_id_2' => 34, 'rule_type' => 'memory_type', 'is_compatible' => false, 'description' => 'Kingston Fury DDR4 TIDAK kompatibel dengan ASUS ROG X870 (DDR5 only)'],

            // ===== INCOMPATIBILITY: Wrong Socket CPU =====
            ['component_id_1' => 1, 'component_id_2' => 33, 'rule_type' => 'socket', 'is_compatible' => false, 'description' => 'Intel LGA1700 TIDAK kompatibel dengan motherboard AM4'],
            ['component_id_1' => 7, 'component_id_2' => 29, 'rule_type' => 'socket', 'is_compatible' => false, 'description' => 'AMD AM4 TIDAK kompatibel dengan motherboard LGA1700'],
            ['component_id_1' => 8, 'component_id_2' => 33, 'rule_type' => 'socket', 'is_compatible' => false, 'description' => 'AMD AM5 TIDAK kompatibel dengan motherboard AM4'],

            // ===== INCOMPATIBILITY: GPU vs PSU =====
            ['component_id_1' => 15, 'component_id_2' => 39, 'rule_type' => 'tdp', 'is_compatible' => false, 'description' => 'NVIDIA RTX 4080 (320W) TIDAK dapat dipasok oleh Corsair CV550 (550W)'],
            ['component_id_1' => 19, 'component_id_2' => 41, 'rule_type' => 'tdp', 'is_compatible' => false, 'description' => 'AMD RX 7900 XT (420W) TIDAK cukup dengan Corsair RM750x (750W) untuk sistem lengkap'],
        ];

        foreach ($rules as $rule) {
            CompatibilityRule::create($rule);
        }

        $this->command->info('[OK] ' . count($rules) . ' aturan kompatibilitas berhasil di-seed!');
    }
}