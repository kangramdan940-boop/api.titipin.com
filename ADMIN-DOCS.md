# Admin Dashboard — api.titipin.com

## Akses

- **URL:** `http://localhost:8001/admin`
- **Login:** `admin@titipin.com` / PIN: `654321`
- **Tech:** Laravel 13 + Blade + Tailwind CDN (Glassmorphism)

## Halaman

| Route | Fungsi |
|-------|--------|
| `/admin/login` | Login admin (email/phone + PIN) |
| `/admin/dashboard` | Overview: stats + recent orders |
| `/admin/orders` | List semua pesanan + filter status |
| `/admin/orders/{id}` | Detail order + update status + input resi |
| `/admin/products` | List produk |
| `/admin/products/create` | Tambah produk baru |
| `/admin/products/{id}/edit` | Edit produk |
| `/admin/users` | List semua users |
| `/` | Redirect ke `/admin/login` |

## Fitur

- **Dashboard:** Total orders, sedang diproses, revenue, total users
- **Orders:** Filter by status (semua/diproses/dibeli/packing/dikirim/selesai/batal), update status, input resi & ekspedisi
- **Products:** CRUD (tambah, edit, hapus), lihat stok, harga, kategori
- **Users:** List user dengan jumlah order

## File Structure

```
app/Http/Controllers/Admin/
├── AuthController.php       ← Login/logout
├── DashboardController.php  ← Stats overview
├── OrderController.php      ← List, detail, update status
├── ProductController.php    ← CRUD produk
└── UserController.php       ← List users

resources/views/admin/
├── layouts/app.blade.php    ← Sidebar + topbar layout
├── auth/login.blade.php     ← Login page
├── dashboard/index.blade.php
├── orders/index.blade.php
├── orders/show.blade.php    ← Detail + update status form
├── products/index.blade.php
├── products/form.blade.php  ← Create/edit form (shared)
└── users/index.blade.php

routes/web.php               ← Admin routes (15 routes)
```

## Dummy Accounts

| Nama | Phone | Email | PIN | Role |
|------|-------|-------|-----|------|
| Admin Titipin | 089999999999 | admin@titipin.com | 654321 | Admin |
| Kak Rina | 081234567890 | rina@email.com | 123456 | User |
| Kak Doni | 082345678901 | doni@email.com | 123456 | User |
| Kak Sari | 083456789012 | sari@email.com | 123456 | User |

## Commands

```bash
cd /Applications/XAMPP/xamppfiles/htdocs/api.titipin.com

# Run server
php artisan serve --port=8001

# Fresh database + seed
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear && php artisan route:clear
```
