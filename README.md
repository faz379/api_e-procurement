# api_e-procurement

RESTful API e-Procurement berbasis Laravel.

## 🚀 Setup Project
1. Clone repository:
```bash
git clone https://github.com/username/api_e-procurement.git
cd api_e-procurement
```

2. Install dependency Laravel:
```bash
composer install
```

3. Copy file .env dan atur konfigurasi database:
```bash
cp .env.example .env
nano .env
```

4. Generate app key:
```bash
php artisan key:generate
```

5. Jalankan migrasi dan seeder:
```bash
php artisan migrate --seed
```

6. Jalankan server:
```bash
php artisan serve
```

## 🔐 Authentication
Gunakan token dari kolom `token` user di header Authorization:
```http
Authorization: <token>
```

## 📡 API Endpoints

### 🔸 Auth
- **POST /api/users** – Register user
- **POST /api/users/login** – Login user
- **GET /api/users/current** – Get data user saat ini (butuh token)
- **DELETE /api/users/logout** – Logout (butuh token)

### 🔸 Vendor
- **POST /api/vendor** – Register vendor

### 🔸 Product
- **POST /api/vendor/{idVendor}/products** – Tambah produk
- **GET /api/vendor/{idVendor}/products/{idProduct}** – Ambil produk
- **PUT /api/vendor/{idVendor}/products/{idProduct}** – Ubah produk
- **DELETE /api/vendor/{idVendor}/products/{idProduct}** – Hapus produk

## ✅ Testing
- Jalankan seluruh test:
```bash
php artisan test
```
- Jalankan test tertentu:
```bash
php artisan test --filter NamaMethodTest
```
