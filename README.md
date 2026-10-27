# InventoryAPI

REST API untuk pengelolaan data inventaris barang yang dibangun menggunakan Laravel dan MySQL.

Proyek ini dibuat untuk memenuhi **Tugas Akhir Backend BTNG DNCC 2026**.

## Tautan Penting

- **Website Utama:** [https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/](https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/)
- **Dokumentasi API:** [https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/docs/api#/](https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/docs/api#/)
- **API Endpoint:** [https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/api](https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/api)
- **GitHub Repository:** [https://github.com/Kylan1940/BTNG-Backend-ValerianKevinCasendra](https://github.com/Kylan1940/BTNG-Backend-ValerianKevinCasendra)

## Tech Stack

- **Laravel** sebagai framework backend.
- **PHP** sebagai bahasa pemrograman.
- **MySQL** sebagai sistem manajemen basis data.
- **Eloquent ORM** untuk mengelola data pada database.
- **Scramble** untuk menghasilkan dokumentasi API.
- **Postman** untuk pengujian endpoint API.

## Fitur

- Mengambil seluruh data barang.
- Mengambil detail barang berdasarkan ID.
- Menambahkan barang baru.
- Memperbarui data barang.
- Menghapus barang.
- Validasi input saat menambahkan dan memperbarui data.
- Validasi keunikan SKU.
- Respons API menggunakan pesan berbahasa Indonesia.
- Dokumentasi endpoint melalui Scramble.

## Struktur Database

API menggunakan tabel `items` untuk menyimpan data inventaris.

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| `id` | Big Integer | ID unik barang |
| `name` | String | Nama barang |
| `sku` | String | Kode unik barang |
| `description` | Text | Deskripsi barang, dapat dikosongkan |
| `price` | Numeric | Harga barang |
| `stock` | Integer | Jumlah stok barang |
| `created_at` | Timestamp | Waktu data dibuat |
| `updated_at` | Timestamp | Waktu data diperbarui |

## Endpoint API

Base URL:

```text
https://btng-backend-valeriankevincasendra-production.up.railway.app/api
```

| Metode | Endpoint | Keterangan |
|---|---|---|
| `GET` | `/items` | Mengambil seluruh data barang |
| `POST` | `/items` | Menambahkan barang baru |
| `GET` | `/items/{id}` | Mengambil detail barang berdasarkan ID |
| `PUT` | `/items/{id}` | Memperbarui data barang |
| `PATCH` | `/items/{id}` | Memperbarui sebagian data barang |
| `DELETE` | `/items/{id}` | Menghapus barang berdasarkan ID |

## Contoh Penggunaan

### 1. Mengambil Seluruh Data Barang

**Request**

```http
GET /api/items
Accept: application/json
```

**Contoh respons sukses**

```json
{
  "message": "Items berhasil diambil",
  "data": [
    {
      "id": 1,
      "name": "Keyboard",
      "sku": "KB-001",
      "description": "Keyboard mekanis",
      "price": 450000,
      "stock": 20
    }
  ]
}
```

### 2. Menambahkan Barang

**Request**

```http
POST /api/items
Content-Type: application/json
Accept: application/json
```

**Body JSON**

```json
{
  "name": "Mouse",
  "sku": "MS-001",
  "description": "Mouse nirkabel",
  "price": 150000,
  "stock": 10
}
```

**Contoh respons sukses**

Status HTTP: `201 Created`

```json
{
  "message": "Item berhasil dibuat",
  "data": {
    "id": 2,
    "name": "Mouse",
    "sku": "MS-001",
    "description": "Mouse nirkabel",
    "price": 150000,
    "stock": 10
  }
}
```

### 3. Mengambil Detail Barang

**Request**

```http
GET /api/items/1
Accept: application/json
```

**Contoh respons sukses**

```json
{
  "message": "Item berhasil diambil",
  "data": {
    "id": 1,
    "name": "Keyboard",
    "sku": "KB-001",
    "description": "Keyboard mekanis",
    "price": 450000,
    "stock": 20
  }
}
```

**Contoh respons ketika barang tidak ditemukan**

Status HTTP: `404 Not Found`

```json
{
  "message": "Item tidak ditemukan"
}
```

### 4. Memperbarui Data Barang

**Request**

```http
PATCH /api/items/1
Content-Type: application/json
Accept: application/json
```

**Body JSON**

```json
{
  "price": 475000,
  "stock": 15
}
```

**Contoh respons sukses**

```json
{
  "message": "Item berhasil diperbarui",
  "data": {
    "id": 1,
    "name": "Keyboard",
    "sku": "KB-001",
    "description": "Keyboard mekanis",
    "price": 475000,
    "stock": 15
  }
}
```

### 5. Menghapus Barang

**Request**

```http
DELETE /api/items/1
Accept: application/json
```

**Contoh respons sukses**

```json
{
  "message": "Item berhasil dihapus"
}
```

**Contoh respons ketika barang tidak ditemukan**

Status HTTP: `404 Not Found`

```json
{
  "message": "Item tidak ditemukan"
}
```

## Validasi Data

Saat membuat barang, API menerapkan aturan validasi berikut:

| Field | Aturan |
|---|---|
| `name` | Wajib diisi dan harus berupa string |
| `sku` | Wajib diisi, berupa string, dan unik |
| `description` | Opsional dan harus berupa string jika diisi |
| `price` | Wajib diisi dan harus berupa angka |
| `stock` | Wajib diisi dan harus berupa bilangan bulat |

Saat memperbarui data, field dapat dikirim secara parsial. Field yang tidak dikirim tidak perlu diubah.

SKU harus unik pada saat pembuatan barang. Untuk proses pembaruan, validasi SKU juga perlu mengecualikan SKU milik barang yang sedang diperbarui agar barang dapat mempertahankan SKU-nya sendiri.

**Catatan implementasi:** aturan validasi pada controller yang digunakan saat ini belum secara eksplisit menolak harga dan stok negatif. Validasi tersebut perlu ditambahkan jika memang menjadi persyaratan tugas.

## Menjalankan Proyek Secara Lokal

### 1. Clone Repository

```bash
git clone https://github.com/Kylan1940/BTNG-Backend-ValerianKevinCasendra.git
cd BTNG-Backend-ValerianKevinCasendra
```

### 2. Instal Dependensi

```bash
composer install
```

### 3. Konfigurasi Environment

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada file `.env`:

```dotenv
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_api
DB_USERNAME=root
DB_PASSWORD=
```

Gunakan konfigurasi database lokal milikmu sendiri.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 6. Jalankan Server

```bash
php artisan serve
```

API dapat diakses melalui:

```text
http://localhost:8000/api
```

Dokumentasi API dapat dibuka melalui:

```text
http://localhost:8000/docs/api
```
