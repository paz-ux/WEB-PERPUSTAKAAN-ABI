# 📋 Dokumentasi Sistem CRUD - Aplikasi Perpustakaan

**Status Database:** ✅ Sudah dimigrasi dan diseed  
**Framework:** Laravel 11  
**Styling:** Bootstrap 5 + Custom CSS (Gradien Biru-Hijau)  
**Database:** MySQL

---

## 📊 Analisis Database & Seeders

### Tabel 1: SISWAS
| Field | Type | Constraints | Keterangan |
|-------|------|-------------|-----------|
| id | BIGINT | Primary Key | Auto Increment |
| nama | STRING | Required | Nama lengkap siswa |
| nis | STRING | Unique, Required | Nomor Induk Siswa |
| kelas | STRING | Required | Kelas siswa (XI PPLG 1, XI PPLG 2) |
| jurusan | STRING | Required | Jurusan siswa |
| created_at | TIMESTAMP | - | Waktu pembuatan |
| updated_at | TIMESTAMP | - | Waktu update terakhir |

**Seeder Data:** 5 siswa (Ahmad Raihan, Siti Nurhaliza, Ahmad Santoso, Putri, Doni Hermawan)

---

### Tabel 2: KATEGORIS
| Field | Type | Constraints | Keterangan |
|-------|------|-------------|-----------|
| id | BIGINT | Primary Key | Auto Increment |
| nama_kategori | STRING | Required | Nama kategori buku |
| keterangan | TEXT | Required | Deskripsi kategori |
| created_at | TIMESTAMP | - | Waktu pembuatan |
| updated_at | TIMESTAMP | - | Waktu update terakhir |

**Seeder Data:** 3 kategori (Fiksi, Non-Fiksi, Referensi)

---

### Tabel 3: BUKUS
| Field | Type | Constraints | Keterangan |
|-------|------|-------------|-----------|
| id | BIGINT | Primary Key | Auto Increment |
| judul | STRING | Required | Judul buku |
| penulis | STRING | Required | Nama penulis |
| tahun_terbit | YEAR | Required | Tahun terbit |
| kategori_id | BIGINT | FK to kategoris | Referensi kategori |
| stok | INTEGER | Required | Jumlah stok buku |
| created_at | TIMESTAMP | - | Waktu pembuatan |
| updated_at | TIMESTAMP | - | Waktu update terakhir |

**Seeder Data:** 5 buku dengan kategori terkait

---

### Tabel 4: PEMINJAMANS
| Field | Type | Constraints | Keterangan |
|-------|------|-------------|-----------|
| id | BIGINT | Primary Key | Auto Increment |
| siswa_id | BIGINT | FK to siswas | Siswa yang meminjam |
| buku_id | BIGINT | FK to bukus | Buku yang dipinjam |
| user_id | BIGINT | FK to users | Admin yang mencatat |
| tanggal_pinjam | DATE | Required | Tanggal peminjaman |
| tanggal_kembali | DATE | Nullable | Tanggal pengembalian |
| status | ENUM | dipinjam/dikembalikan | Status peminjaman |
| created_at | TIMESTAMP | - | Waktu pembuatan |
| updated_at | TIMESTAMP | - | Waktu update terakhir |

**Seeder Data:** 5 record peminjaman (3 sudah dikembalikan, 2 masih dipinjam)

---

### Tabel 5: USERS
| Field | Type | Constraints | Keterangan |
|-------|------|-------------|-----------|
| id | BIGINT | Primary Key | Auto Increment |
| name | STRING | Required | Nama user/admin |
| email | STRING | Unique, Required | Email untuk login |
| password | STRING | Required | Password terenkripsi |
| created_at | TIMESTAMP | - | Waktu pembuatan |
| updated_at | TIMESTAMP | - | Waktu update terakhir |

**Default Laravel Users Table**

---

## 🔄 CRUD Operations Summary

| Fitur | Endpoint | Method | Controller | View |
|-------|----------|--------|-----------|------|
| **SISWA** |
| List Siswa | `/perpustakaan/siswa` | GET | SiswaController@index | siswas/index.blade.php |
| Tambah Siswa | `/perpustakaan/siswa/create` | GET | SiswaController@create | siswas/add.blade.php |
| Simpan Siswa | `/perpustakaan/siswa` | POST | SiswaController@store | - |
| Edit Siswa | `/perpustakaan/siswa/{id}/edit` | GET | SiswaController@edit | siswas/edit.blade.php |
| Update Siswa | `/perpustakaan/siswa/{id}` | PUT | SiswaController@update | - |
| Hapus Siswa | `/perpustakaan/siswa/{id}` | DELETE | SiswaController@destroy | - |
| **KATEGORI** |
| List Kategori | `/perpustakaan/kategori` | GET | KategoriController@index | kategoris/index.blade.php |
| Tambah Kategori | `/perpustakaan/kategori/create` | GET | KategoriController@create | kategoris/add.blade.php |
| Simpan Kategori | `/perpustakaan/kategori` | POST | KategoriController@store | - |
| Edit Kategori | `/perpustakaan/kategori/{id}/edit` | GET | KategoriController@edit | kategoris/edit.blade.php |
| Update Kategori | `/perpustakaan/kategori/{id}` | PUT | KategoriController@update | - |
| Hapus Kategori | `/perpustakaan/kategori/{id}` | DELETE | KategoriController@destroy | - |
| **BUKU** |
| List Buku | `/perpustakaan/buku` | GET | BukuController@index | bukus/index.blade.php |
| Tambah Buku | `/perpustakaan/buku/create` | GET | BukuController@create | bukus/add.blade.php |
| Simpan Buku | `/perpustakaan/buku` | POST | BukuController@store | - |
| Edit Buku | `/perpustakaan/buku/{id}/edit` | GET | BukuController@edit | bukus/edit.blade.php |
| Update Buku | `/perpustakaan/buku/{id}` | PUT | BukuController@update | - |
| Hapus Buku | `/perpustakaan/buku/{id}` | DELETE | BukuController@destroy | - |
| **PEMINJAMAN** |
| List Peminjaman | `/perpustakaan/peminjaman` | GET | PeminjamanController@index | peminjamans/index.blade.php |
| Tambah Peminjaman | `/perpustakaan/peminjaman/create` | GET | PeminjamanController@create | peminjamans/add.blade.php |
| Simpan Peminjaman | `/perpustakaan/peminjaman` | POST | PeminjamanController@store | - |
| Edit Peminjaman | `/perpustakaan/peminjaman/{id}/edit` | GET | PeminjamanController@edit | peminjamans/edit.blade.php |
| Update Peminjaman | `/perpustakaan/peminjaman/{id}` | PUT | PeminjamanController@update | - |
| Hapus Peminjaman | `/perpustakaan/peminjaman/{id}` | DELETE | PeminjamanController@destroy | - |
| **USER** |
| List User | `/perpustakaan/user` | GET | UserController@index | users/index.blade.php |
| Tambah User | `/perpustakaan/user/create` | GET | UserController@create | users/add.blade.php |
| Simpan User | `/perpustakaan/user` | POST | UserController@store | - |
| Edit User | `/perpustakaan/user/{id}/edit` | GET | UserController@edit | users/edit.blade.php |
| Update User | `/perpustakaan/user/{id}` | PUT | UserController@update | - |
| Hapus User | `/perpustakaan/user/{id}` | DELETE | UserController@destroy | - |

---

## 🎨 Styling Guide

- **Sidebar Gradient:** `linear-gradient(135deg, #0072ff 0%, #00c853 100%)` (Biru ke Hijau)
- **Primary Color:** `#0072ff` (Biru)
- **Success Color:** `#00c853` (Hijau)
- **Button Hover:** Translate Y -2px + shadow `rgba(0, 114, 255, 0.4)`
- **Card Transition:** `all 0.3s ease`
- **Font Family:** Segoe UI, Tahoma, Geneva, Verdana, sans-serif

---

## 📁 Struktur Folder

```
app/
  ├── Http/
  │   └── Controllers/
  │       ├── SiswaController.php
  │       ├── KategoriController.php
  │       ├── BukuController.php
  │       ├── PeminjamanController.php
  │       └── UserController.php
  └── Models/
      ├── Siswa.php
      ├── Kategori.php
      ├── Buku.php
      ├── Peminjaman.php
      └── User.php

routes/
  └── web.php (CRUD Routes)

resources/views/
  ├── siswas/ (index, add, edit)
  ├── kategoris/ (index, add, edit)
  ├── bukus/ (index, add, edit)
  ├── peminjamans/ (index, add, edit)
  └── users/ (index, add, edit)
```

---

## 🚀 Development Checklist

- [x] Database migrations
- [x] Database seeders
- [x] Layout master & sidebar design
- [ ] Models dengan Relationships
- [ ] Controllers dengan CRUD logic
- [ ] Validation Rules
- [ ] Views (Index, Create, Edit)
- [ ] Routes
- [ ] Error Handling

