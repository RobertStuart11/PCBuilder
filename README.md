# PCBuilder

Platform e-commerce berbasis web untuk membantu pengguna merakit PC custom dengan fitur cek kompatibilitas komponen secara real-time. Dibangun menggunakan Laravel 13 dengan sistem multi-role (Admin, Seller, Buyer).

---

## Fitur Utama

- **PC Builder** — Rakit PC custom dengan cek kompatibilitas otomatis antar komponen (CPU, GPU, RAM, Motherboard, PSU, Storage, Case, Cooler)
- **Multi-Role System** — Tiga peran pengguna: Admin, Seller, dan Buyer
- **Katalog Produk** — Browse komponen PC dari berbagai seller
- **Keranjang Belanja** — Tambah, update, dan hapus item dari cart
- **Checkout & Pembayaran** — Integrasi dengan Midtrans payment gateway
- **Manajemen Order** — Tracking status order dari pending hingga delivered
- **Dashboard Admin** — Kelola produk, user, seller, dan semua order
- **Dashboard Seller** — Kelola komponen yang dijual
- **Aturan Kompatibilitas** — Sistem rule berbasis kategori (socket, DDR, PCIe, dll)

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 13 (PHP 8.3) |
| Frontend | Blade Templates + Tailwind CSS |
| Database | MySQL |
| Payment | Midtrans |
| Auth | Laravel Breeze |

---

## Role Pengguna

| Role | Akses |
|------|-------|
| **Admin** | Kelola semua produk, user, seller, dan order |
| **Seller** | Tambah & kelola komponen yang dijual |
| **Buyer** | Browse katalog, PC Builder, cart, dan checkout |

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/RobertStuart11/PCBuilder.git
cd PCBuilder
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database dan Midtrans:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pcbuilder
DB_USERNAME=root
DB_PASSWORD=

MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

### 4. Migrasi Database

```bash
php artisan migrate --seed
```

### 5. Build Assets & Jalankan

```bash
npm run build
php artisan serve
```

Akses aplikasi di `http://127.0.0.1:8000`

---

## Struktur Database

| Tabel | Keterangan |
|-------|------------|
| `users` | Data pengguna dengan role (admin/seller/buyer) |
| `components` | Komponen PC yang dijual oleh seller |
| `compatibility_rules` | Aturan kompatibilitas antar komponen |
| `orders` | Data transaksi pembelian |
| `order_details` | Detail item dalam setiap order |

---

## Alur Penggunaan

```
Browse Katalog -> Tambah ke Cart -> PC Builder (cek kompatibilitas)
    -> Checkout -> Pembayaran (Midtrans) -> Order Tracking
```

---

## Struktur Direktori Penting

```
app/
├── Http/Controllers/
│   ├── Admin/          # Controller untuk admin
│   ├── Seller/         # Controller untuk seller
│   ├── Buyer/          # Controller untuk buyer
│   ├── CartController.php
│   ├── CheckoutController.php
│   └── PCBuilderController.php
├── Models/
│   ├── Component.php
│   ├── Order.php
│   ├── OrderDetail.php
│   └── CompatibilityRule.php
└── Traits/
    └── ChecksComponentCompatibility.php
```

---

## Developer

- **Robert Stuart** — [GitHub](https://github.com/RobertStuart11)

---

## Lisensi

Project ini dibuat untuk keperluan akademik.
