# Aplikasi Manajemen Organisasi - Laravel
###### DEMO: https://testcase.tamzidan.com
[![PHP Version](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Aplikasi Laravel untuk manajemen organisasi kecil yang memfasilitasi pengelolaan proyek, pesanan, keuangan, dan pengguna dengan sistem otorisasi berbasis peran yang ketat.

## 📋 Deskripsi

Aplikasi ini dikembangkan sebagai Test Case untuk posisi Software Engineer di CV Akses Digital. Aplikasi menyediakan fitur-fitur manajemen bisnis dengan kontrol akses berbasis role menggunakan Spatie Laravel Permission.

## ✨ Fitur Utama

### Manajemen Pengguna & Role
- **4 Role Berbeda**: Super Admin, Manager, Staff, Finance
- Sistem autentikasi (Login/Logout)
- Otorisasi berbasis permission dengan Spatie Laravel Permission

### Manajemen Proyek & Tugas
- CRUD Project dengan penugasan Manager
- CRUD Task dengan penugasan ke Staff
- Relasi Many-to-Many antara Project dan Staff

### Manajemen Pesanan & Customer
- CRUD Customer
- CRUD Order dengan status tracking
- Relasi Order ke Customer

### Manajemen Keuangan
- Pencatatan Income dan Expense
- Laporan keuangan dengan filter periode waktu
- Total pendapatan dan pengeluaran

### Laporan (Reports)
- Laporan ringkasan keuangan
- Filter berdasarkan periode waktu
- Read-Only untuk Manager dan Finance

## 🔐 Role & Permission Matrix

| No. | Role | Fitur | CRUD/Aksi | Keterangan |
|-----|------|-------|-----------|------------|
| 1 | Super Admin | Semua Modul | CRUD Penuh | Akses penuh ke seluruh sistem |
| 2 | Manager | Orders | CRU | Tidak dapat menghapus Order |
| 3 | Manager | Projects, Tasks | CRUD | Akses penuh |
| 4 | Manager | Reports | R | Read-Only |
| 5 | Staff | Projects | RU | Hanya project yang di-assign |
| 6 | Staff | Tasks | CRUD | Akses penuh |
| 7 | Finance | Finance | CRUD | Akses penuh |
| 8 | Finance | Projects | R | Read-Only |
| 9 | Finance | Orders | RU | Tidak dapat menghapus |

## 🗂️ Struktur Data

### Model dan Relasi

```
User ──────────── One-to-One ────────────► Role
                                              │
                                              │ One-to-Many
                                              ▼
Customer ──────── One-to-Many ───────────► Order
                                              │
Project ─────────┬─ Many-to-Many ────────► Staff (User)
                 │
                 └─ One-to-Many ─────────► Task
                                              │
                                              │ Many-to-One
                                              ▼
                                            User

Finance ──────── (Optional: Polymorphic) ─► Order/Expense
```

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB / SQLite

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/tamzidan/test-case.git
   cd test-case
   ```

2. **Install Dependencies PHP**
   ```bash
   composer install
   ```

3. **Install Dependencies JavaScript**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Konfigurasi Database**
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=test_case
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Jalankan Migrasi dan Seeder**
   ```bash
   php artisan migrate --seed
   ```

7. **Build Assets**
   ```bash
   npm run build
   ```

8. **Jalankan Aplikasi**
   ```bash
   composer run dev
   ```

   Akses aplikasi di: `http://localhost:8000`

## 👤 Akun Default (Seeder)

Setelah menjalankan seeder, akun-akun berikut tersedia untuk testing:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | superadmin@example.com | password |
| Manager | manager@example.com | password |
| Staff | staff@example.com | password |
| Finance | finance@example.com | password |

## 📁 Struktur Direktori Utama

```
test-case/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Controller untuk setiap modul
│   │   ├── Middleware/        # Middleware custom
│   │   └── Requests/          # Form Request Validation
│   ├── Models/                # Eloquent Models
│   └── Policies/              # Authorization Policies
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Data seeders
├── resources/
│   └── views/                 # Blade templates
├── routes/
│   └── web.php                # Web routes
└── config/
    └── permission.php         # Spatie Permission config
```

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12.x
- **Frontend**: Blade Templates + Tailwind CSS
- **Build Tool**: Vite
- **Authorization**: Spatie Laravel Permission
- **Database**: MySQL

## 📱 Halaman Aplikasi

- `/login` - Halaman Login
- `/dashboard` - Dashboard dengan navigasi berdasarkan role
- `/users` - Manajemen User (Super Admin)
- `/roles` - Manajemen Role & Permission (Super Admin)
- `/customers` - Manajemen Customer
- `/projects` - Manajemen Project
- `/tasks` - Manajemen Task
- `/orders` - Manajemen Order
- `/finances` - Manajemen Keuangan
- `/reports` - Laporan Keuangan

## 🔧 Perintah Artisan Berguna

```bash
# Refresh database dengan seeder
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📝 Fitur Opsional yang Diimplementasikan

- ✅ Resource Controllers untuk setiap modul
- ✅ Form Requests untuk validasi data
- ✅ Database Transaction untuk integritas data
- ✅ Tailwind CSS untuk styling modern
- ✅ Policy/Gate untuk otorisasi

## 🤝 Kontribusi

Project ini dibuat sebagai Test Case untuk proses rekrutmen.

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

**Dibuat dengan menggunakan Laravel**
