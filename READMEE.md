# 📦 Vhiweb E-Procurement REST API

Sistem REST API berbasis Laravel untuk:

- Autentikasi User
- Registrasi Vendor
- Manajemen Produk Vendor (CRUD)

## 🚀 Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Pastikan Anda mengaktifkan Laravel Sanctum:

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

## 🔐 Autentikasi

Gunakan token dari endpoint `/login`, kemudian lampirkan pada setiap request terproteksi:

```http
Authorization: Bearer {token}
```

## 📚 Endpoint List

### ✅ Register User

`POST /api/register`

```json
{
  "name": "User A",
  "email": "usera@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### 🔑 Login User

`POST /api/login`

```json
{
  "email": "usera@example.com",
  "password": "password123"
}
```

Response:

```json
{
  "token": "..."
}
```

### 🏢 Register Vendor

`POST /api/vendor` _(auth required)_

```json
{
  "company_name": "Vendor Satu",
  "address": "Jakarta",
  "phone": "08123456789"
}
```

### 📦 Produk CRUD

#### 📄 List Product

`GET /api/products` _(auth required)_

#### ➕ Create Product

`POST /api/products`

```json
{
  "name": "Product 1",
  "description": "Deskripsi",
  "price": 1000000
}
```

#### ✏️ Update Product

`PUT /api/products/{id}`

```json
{
  "name": "Updated",
  "description": "Updated",
  "price": 1200000
}
```

#### ❌ Delete Product

`DELETE /api/products/{id}`

## 🧪 Postman Collection

File Postman tersedia dalam `postman_test.json`. Import ke Postman dan sesuaikan `{{token}}`.

## 📘 Swagger/OpenAPI

Gunakan file `openapi.yaml` untuk dokumentasi Swagger.

## 🧑 Author

Developed by Muhammad Sayyid Rifqi | Laravel + Sanctum
