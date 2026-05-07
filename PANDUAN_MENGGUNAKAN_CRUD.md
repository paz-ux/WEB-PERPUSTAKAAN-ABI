# 🚀 Panduan Menggunakan Sistem CRUD Perpustakaan

## 📌 Alur Sistem CRUD yang Telah Diimplementasikan

Sistem CRUD Perpustakaan telah dikonfigurasi dengan sepenuhnya dengan 5 modul utama:

### 1. **SISWA** 📚👨‍🎓
**Path:** `perpustakaan/siswa`  
**Fields Database:**
- `nama` - Nama lengkap siswa
- `nis` - Nomor Induk Siswa (Unik)
- `kelas` - Kelas siswa
- `jurusan` - Jurusan siswa

**Operasi CRUD:**
- **CREATE:** `/perpustakaan/siswa/create` → Tambah Siswa
- **READ:** `/perpustakaan/siswa` → List semua siswa dengan pagination
- **UPDATE:** `/perpustakaan/siswa/{id}/edit` → Edit data siswa
- **DELETE:** `/perpustakaan/siswa/{id}` → Hapus siswa

---

### 2. **KATEGORI** 📑
**Path:** `perpustakaan/kategori`  
**Fields Database:**
- `nama_kategori` - Nama kategori
- `keterangan` - Deskripsi kategori

**Operasi CRUD:**
- **CREATE:** `/perpustakaan/kategori/create` → Tambah kategori
- **READ:** `/perpustakaan/kategori` → List kategori
- **UPDATE:** `/perpustakaan/kategori/{id}/edit` → Edit kategori
- **DELETE:** `/perpustakaan/kategori/{id}` → Hapus kategori

---

### 3. **BUKU** 📖
**Path:** `perpustakaan/buku`  
**Fields Database:**
- `judul` - Judul buku
- `penulis` - Nama penulis  
- `tahun_terbit` - Tahun terbit (Year)
- `kategori_id` - Foreign Key ke tabel kategoris
- `stok` - Jumlah stok

**Operasi CRUD:**
- **CREATE:** `/perpustakaan/buku/create` → Tambah buku
- **READ:** `/perpustakaan/buku` → List buku dengan info kategori
- **UPDATE:** `/perpustakaan/buku/{id}/edit` → Edit buku
- **DELETE:** `/perpustakaan/buku/{id}` → Hapus buku

---

### 4. **PEMINJAMAN** 🔄
**Path:** `perpustakaan/peminjaman`  
**Fields Database:**
- `siswa_id` - Foreign Key ke tabel siswas
- `buku_id` - Foreign Key ke tabel bukus
- `user_id` - Foreign Key ke tabel users (admin)
- `tanggal_pinjam` - Tanggal peminjaman
- `tanggal_kembali` - Tanggal pengembalian (nullable)
- `status` - Enum: "dipinjam" atau "dikembalikan"

**Operasi CRUD:**
- **CREATE:** `/perpustakaan/peminjaman/create` → Catat peminjaman baru
- **READ:** `/perpustakaan/peminjaman` → List peminjaman
- **UPDATE:** `/perpustakaan/peminjaman/{id}/edit` → Update status/tanggal kembali
- **DELETE:** `/perpustakaan/peminjaman/{id}` → Hapus peminjaman

**Logic Khusus:**
- Membuat peminjaman → Stok buku berkurang
- Menandai dikembalikan → Stok buku bertambah
- Hapus peminjaman yang dipinjam → Stok buku bertambah kembali

---

### 5. **USER** 👤
**Path:** `perpustakaan/user`  
**Fields Database:**
- `name` - Nama user
- `email` - Email (Unik)
- `password` - Password terenkripsi

**Operasi CRUD:**
- **CREATE:** `/perpustakaan/user/create` → Tambah user/admin
- **READ:** `/perpustakaan/user` → List user
- **UPDATE:** `/perpustakaan/user/{id}/edit` → Edit user (optional password)
- **DELETE:** `/perpustakaan/user/{id}` → Hapus user

---

## 🎨 Desain & Styling

### Warna Tema:
- **Gradient:** `linear-gradient(135deg, #0072ff 0%, #00c853 100%)`
  - Biru (`#0072ff`) → Hijau (`#00c853`)
- **Primary Color:** `#0072ff` (Biru)
- **Success Color:** `#00c853` (Hijau)
- **Background:** `#f8f9fa`

### Komponen UI Standar:
- **Sidebar:** Gradient biru-hijau dengan menu navigasi
- **Cards:** Border-radius 12px, shadow effect
- **Buttons:** Hover effect, gradient background
- **Table:** Responsive, hover effect, pagination
- **Forms:** Rounded inputs, validation messages

---

## 🔧 Struktur Folder Project

```
app/
├── Http/Controllers/
│   ├── SiswaController.php
│   ├── KategoriController.php
│   ├── BukuController.php
│   ├── PeminjamanController.php
│   └── UserController.php
└── Models/
    ├── Siswa.php
    ├── Kategori.php
    ├── Buku.php
    ├── Peminjaman.php
    └── User.php (extended)

resources/views/
├── layouts/
│   └── master.blade.php
├── siswas/
│   ├── index.blade.php
│   ├── add.blade.php
│   └── edit.blade.php
├── kategoris/
│   ├── index.blade.php
│   ├── add.blade.php
│   └── edit.blade.php
├── bukus/
│   ├── index.blade.php
│   ├── add.blade.php
│   └── edit.blade.php
├── peminjamans/
│   ├── index.blade.php
│   ├── add.blade.php
│   └── edit.blade.php
└── users/
    ├── index.blade.php
    ├── add.blade.php
    └── edit.blade.php

routes/
└── web.php (Resource routes untuk semua CRUD)
```

---

## 📝 Fitur-Fitur CRUD

### ✅ Index Page (List)
- Menampilkan data dalam table responsive
- Pagination 10 per halaman
- Button "Tambah" di top-right
- Button Edit & Delete di setiap row
- Alert success/error message
- Empty state jika tidak ada data

### ✅ Create Page
- Form lengkap dengan validation
- Sidebar panduan untuk setiap field
- Back button ke list
- Form field dengan icon FontAwesome
- Error message untuk validation fails

### ✅ Edit Page
- Pre-fill data dari database
- Same form structure as create
- Update dengan method PUT
- Display informasi terkait (created_at, dsb)

### ✅ Delete
- Confirm dialog sebelum delete
- Tidak ada dedicated delete page
- Direct delete dari list page

---

## 🚀 Cara Menjalankan

### Step 1: Migrasi Database
```bash
php artisan migrate
```

### Step 2: Seed Data
```bash
php artisan db:seed
```

Data seeder yang tersedia:
- 5 siswa
- 3 kategori buku
- 5 buku
- 5 peminjaman records

### Step 3: Jalankan Server
```bash
php artisan serve
```

### Step 4: Akses Aplikasi
- **URL:** `http://localhost:8000`
- **Dashboard:** `http://localhost:8000/dashboard`
- **Menu Navigasi:** Via sidebar (terlihat di master.blade.php)

---

## 🔐 Validation Rules

### Siswa
- `nama` - Required, string, max 255
- `nis` - Required, string, unique, max 20
- `kelas` - Required, string, max 50
- `jurusan` - Required, string, max 100

### Kategori
- `nama_kategori` - Required, string, max 100
- `keterangan` - Required, string/text

### Buku
- `judul` - Required, string, max 255
- `penulis` - Required, string, max 255
- `tahun_terbit` - Required, integer, min 1900, max 2100
- `kategori_id` - Required, exists in kategoris table
- `stok` - Required, integer, min 0

### Peminjaman
- `siswa_id` - Required, exists in siswas table
- `buku_id` - Required, exists in bukus table
- `user_id` - Required, exists in users table
- `tanggal_pinjam` - Required, date
- `tanggal_kembali` - Nullable, date
- `status` - Required, enum (dipinjam/dikembalikan)

### User
- `name` - Required, string, max 255
- `email` - Required, email, unique
- `password` - Required (create), optional (update), min 6, confirmed

---

## 📊 Database Relationships

```
Siswa
├── has-many → Peminjaman

Kategori
├── has-many → Buku

Buku
├── belongs-to → Kategori
└── has-many → Peminjaman

Peminjaman
├── belongs-to → Siswa
├── belongs-to → Buku
└── belongs-to → User

User
└── has-many → Peminjaman
```

---

## ⚡ Fitur Khusus

### Manajemen Stok Otomatis
- **Saat dipinjam:** Stok berkurang 1
- **Saat dikembalikan:** Stok bertambah 1
- **Saat dihapus:** Stok dikembalikan jika status "dipinjam"

### Pagination
- Semua list page menggunakan pagination 10 items per page
- Bootstrap 5 pagination style

### Responsive Design
- Mobile-friendly layout
- Tablet & desktop optimized

---

## 🎯 Kustomisasi Lebih Lanjut

### Mengubah Warna Tema:
Edit di `master.blade.php`:
```css
/* Ubah gradient */
background: linear-gradient(135deg, #COLOR1 0%, #COLOR2 100%);
```

### Menambah Field Baru:
1. Buat migration dengan `php artisan make:migration add_field_to_table`
2. Update Model relationship jika diperlukan
3. Update Controller validation rules
4. Update view form fields

### Menambah Modul CRUD Baru:
1. Buat Model: `php artisan make:model NamaModel`
2. Buat Controller: `php artisan make:controller NamaController --resource`
3. Buat Migration: `php artisan make:migration create_nama_table`
4. Update routes di `web.php`
5. Buat views di `resources/views/nama_folder/`
6. Update sidebar di `master.blade.php`

---

## 📞 Support

Untuk error atau pertanyaan, lihat:
- Error details di browser console
- Laravel logs di `storage/logs/`
- Database structure di `database/migrations/`

---

**Dokumentasi Selesai! ✅ Sistem CRUD Perpustakaan siap digunakan.**
