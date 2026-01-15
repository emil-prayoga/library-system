# 📚 Library Management System (Sistem Perpustakaan Mini)

Aplikasi web perpustakaan mini yang dibangun dengan **Laravel 12** untuk mengelola peminjaman dan pengembalian buku dengan fitur lengkap.

## 🎯 Fitur Utama

### ✅ Authentication & Authorization
- **Dual Login System**: User regular dan Admin
- **Role-based Access Control**: User hanya akses data miliknya, Admin bisa kelola semua
- **Guest Mode**: Browse buku tanpa login
- **Password Reset**: Reset password langsung tanpa email verification

### ✅ Book Management (Admin)
- Tambah, edit, hapus buku dengan validasi lengkap
- Upload cover gambar (max 5MB)
- Kelola stok buku dengan auto-sync
- Filter dan search buku by title/category
- Real-time data update ke dashboard user

### ✅ Borrowing System (User)
- **Borrow Date**: Otomatis hari saat pinjam
- **Deadline**: Otomatis +7 hari dari borrow date
- **Return Date**: Otomatis saat user klik return
- **Limit Peminjaman**: Max 3 buku aktif per user
- **Duplicate Prevention**: Tidak bisa pinjam buku yang sama 2x
- **Stock Management**: Auto -1 saat pinjam, +1 saat kembali
- **Denda Keterlambatan**: Rp 2.000/hari jika melewati deadline

### ✅ Dashboard & Reporting
- **User Dashboard**: Lihat buku, riwayat peminjaman, status limit
- **Admin Dashboard**: Monitor semua transaksi dengan filter
- **Guest Dashboard**: Browse buku tanpa akses pinjam
- **CSV Export**: User & Admin bisa export transactions

## 📋 Prerequisites

- PHP 8.4+
- MySQL 8.0+
- Composer
- Node.js & NPM

## 🚀 Installation & Setup

### Prerequisites
- **XAMPP** (atau server Apache + MySQL)
- **PHP 8.4+** (dengan extensions: OpenSSL, PDO, Mbstring)
- **Composer** (dependency manager PHP)
- **Node.js & NPM** (untuk frontend assets)
- **MySQL 8.0+** (database)

### Step 1: Clone Repository
```bash
git clone <repository-url>
cd library-system
```

### Step 2: Install Dependencies
```bash
composer install
npm install
```

### Step 3: Setup Environment File
```bash
cp .env.example .env
```

**Edit `.env` file untuk XAMPP:**
```env
# Default XAMPP configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Create Database
```bash
# Buka phpMyAdmin atau terminal MySQL
mysql -u root -p
CREATE DATABASE library_db;
EXIT;
```

**Atau gunakan artisan (otomatis buat jika belum ada):**
```bash
php artisan migrate --seed
```

### Step 6: Run Migrations & Seeders
```bash
# Jalankan semua migrations dan seed data sample
php artisan migrate --seed

# Atau run migrations saja (tanpa seed)
php artisan migrate
```

### Step 7: Build Frontend Assets
```bash
npm run build
```

### Step 8: Start Application
```bash
php artisan serve
```

✅ Aplikasi siap di: **http://localhost:8000**

---

## 👥 Demo Accounts (4 Akun)

### 1️⃣ Regular User - Aktif
```
Email:    you@example.com
Password: your1234
Role:     User
Status:   Aktif (bisa pinjam buku)
```

### 2️⃣ Administrator
```
Email:    admin@example.com
Password: Admin1234
Role:     Admin
Status:   Bisa kelola semua (books, borrowings, users, messages, categories)
```

### 3️⃣ Guest Mode (Tanpa Login)
- Klik tombol **"Browse as Guest"** di halaman login
- Bisa melihat semua buku dan detail
- ❌ Tidak bisa pinjam buku
- ❌ Tidak perlu email/password

---

## 🔧 Quick Start (Ringkas)

Setelah clone repository:

```bash
# 1. Install dependencies
composer install && npm install

# 2. Setup environment
cp .env.example .env && php artisan key:generate

# 3. Setup database (buat & migrate + seed)
php artisan migrate --seed

# 4. Build assets
npm run build

# 5. Start server
php artisan serve
```

Buka browser: **http://localhost:8000** ✨

## 🔒 Authorization & Security

### Policies Implemented
- **BorrowingPolicy**: User hanya bisa view/update borrowing miliknya
- **BookPolicy**: User bisa view, Admin bisa CRUD

### Business Rules Enforced
1. ✅ User max pinjam 3 buku aktif
2. ✅ Tidak bisa pinjam buku yang sama 2x (sebelum dikembalikan)
3. ✅ Tidak bisa pinjam jika stok = 0
4. ✅ User tidak bisa akses data borrowing orang lain
5. ✅ Denda Rp 2.000/hari jika return melewati deadline
6. ✅ Stok auto berkurang-bertambah

## 🧪 Testing

### Run All Tests
```bash
php artisan test
```

### Available Tests
- ✅ `BorrowingTest::test_user_can_borrow_book`
- ✅ `BorrowingTest::test_cannot_borrow_when_stock_is_zero`
- ✅ `BorrowingTest::test_cannot_borrow_more_than_three_books`
- ✅ `BorrowingTest::test_cannot_borrow_same_book_twice`
- ✅ `BorrowingTest::test_user_can_return_book`
- ✅ `BorrowingTest::test_fine_calculated_for_overdue_return`
- ✅ `BorrowingTest::test_user_cannot_view_other_user_borrowing`


## 🗄️ Database Schema

### Tables
- **users**: id, name, email, password, role, timestamps
- **books**: id, title, author, isbn, publisher, year, category, published_date, description, stock, cover, timestamps
- **borrowings**: id, user_id, book_id, borrow_date, return_deadline, return_date, status, fine, timestamps

### Indexes for Performance
- `borrowings(user_id, book_id, status)` - Main queries
- `borrowings(user_id, status)` - Filter active borrowings
- `books(category, title)` - Search/filter books
- `users(email)` - Auth queries

## ✨ Bonus Features (+10 poin)

### 1. Email Notifications
- Notifikasi pinjam berhasil
- Reminder deadline 3 hari
- Alert denda keterlambatan

### 2. CSV Export
- User export riwayat peminjaman
- Admin export all transactions dengan filter yang sama

### 3. Guest Mode
- Browse buku tanpa login
- View detail buku
- Tidak bisa pinjam

## 🎨 Code Quality

### Form Validation
- `StoreBorrowingRequest`: Validasi pinjam buku
- `StoreBookRequest`: Validasi tambah buku
- `UpdateBookRequest`: Validasi edit buku
- Custom error messages in Indonesian

### Authorization
- Policies untuk Borrowing & Book
- Middleware untuk admin-only routes
- Guest middleware untuk auth routes

### Error Handling
- Form validation dengan error messages
- Flash messages (success/error/warning)
- Authorization failures dengan 403

## 📊 Performance Metrics

- ✅ Pagination pada semua list views
- ✅ Eager loading relationships (with method)
- ✅ Database indexes pada frequently queried columns
- ✅ N+1 query prevention
- ✅ Efficient filtering & searching

## 🚀 API Routes

### User Routes
- `GET /books` - List books
- `GET /books/{id}` - Book detail
- `POST /borrowings` - Pinjam buku
- `GET /my-borrowings` - Riwayat peminjaman
- `GET /my-borrowings/export` - Export CSV
- `POST /borrowings/{id}/return` - Kembalikan buku

### Admin Routes
- `GET /admin/dashboard` - Dashboard transaksi
- `GET /admin/books` - Manage books
- `POST /admin/books` - Tambah buku
- `PUT /admin/books/{id}` - Edit buku
- `DELETE /admin/books/{id}` - Hapus buku
- `GET /admin/borrowings/export` - Export all transactions

### Guest Routes
- `GET /guest/dashboard` - Browse books
- `GET /guest/books/{id}` - Book detail
- `GET /guest/logout` - Exit guest mode



## Anggota Kelompok
1. Emil Prayoga Albani (ISB 24/2402510031)
2. Wardatul Hasanah (ISB 24/2402510035)
3. Dela Ayu Wulandari (ISB 24/2402510037)

**Built with ❤️ using Laravel 12 • PHP 8.4 • MySQL 8.0**

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
