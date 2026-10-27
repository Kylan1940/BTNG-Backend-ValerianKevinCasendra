# InventoryAPI

REST API untuk pengelolaan data inventaris barang yang dikembangkan menggunakan Laravel 12 dan MySQL.

Proyek ini dibuat untuk **memenuhi Tugas Akhir Backend BTNG DNCC 2026**.

## Tautan Penting

- **Website Utama:** [https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/](https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/)
- **Dokumentasi API:** [https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/docs/api#/](https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/docs/api#/)
- **API Endpoint:** [https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/api](https://app-7b60d00d-4a32-40cd-a97f-e998936cd2e4.cleverapps.io/api)
- **GitHub Repository:** [https://github.com/Kylan1940/BTNG-Backend-ValerianKevinCasendra](https://github.com/Kylan1940/BTNG-Backend-ValerianKevinCasendra)

## Teknologi yang Digunakan

- **Laravel 12** sebagai framework backend.
- **PHP** sebagai bahasa pemrograman.
- **MySQL** sebagai database.
- **Laravel Eloquent ORM** untuk pengelolaan data database.
- **Scramble** untuk dokumentasi API.
- **Postman** untuk pengujian endpoint API.

## Fitur

- Mengambil seluruh data barang.
- Mengambil detail barang berdasarkan ID.
- Menambahkan data barang baru.
- Memperbarui data barang.
- Menghapus data barang.
- Validasi input untuk memastikan data yang dikirim sesuai ketentuan.
- Validasi SKU agar setiap barang memiliki SKU yang unik.
- Validasi harga dan stok agar tidak bernilai negatif.
- Dokumentasi endpoint API menggunakan Scramble.

## Struktur Database

Proyek ini menggunakan tabel `items` untuk menyimpan data inventaris barang.

| Kolom | Tipe Data | Keterangan |
|---|---|---|
| `id` | Big Integer | Primary key |
| `name` | String | Nama barang |
| `sku` | String | Kode barang yang unik |
| `description` | Text, nullable | Deskripsi barang |
| `price` | Decimal | Harga barang |
| `stock` | Integer | Jumlah stok barang |
| `created_at` | Timestamp | Waktu data dibuat |
| `updated_at` | Timestamp | Waktu data diperbarui |

### Ketentuan Data

- SKU harus unik dan tidak boleh digunakan oleh barang lain.
- Harga barang harus bernilai nol atau lebih.
- Stok barang harus berupa bilangan bulat nol atau lebih.
- Deskripsi barang bersifat opsional.
- Data yang dikirim akan divalidasi sebelum diproses oleh API.

## Endpoint API

| Metode | Endpoint | Fungsi |
|---|---|---|
| `GET` | `/api/items` | Mengambil seluruh data barang |
| `GET` | `/api/items/{id}` | Mengambil detail barang berdasarkan ID |
| `POST` | `/api/items` | Menambahkan barang baru |
| `PUT` | `/api/items/{id}` | Memperbarui data barang |
| `PATCH` | `/api/items/{id}` | Memperbarui sebagian data barang |
| `DELETE` | `/api/items/{id}` | Menghapus barang berdasarkan ID |

## Contoh Penggunaan API

### 1. Mengambil Seluruh Data Barang

**Request**

```http
GET /api/items
Accept: application/json
```

**Contoh respons**

```json
{
  "message": "Items retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Mechanical Keyboard",
      "sku": "KB-001",
      "description": "Keyboard mechanical 87 keys",
      "price": 450000,
      "stock": 20
    }
  ]
}
```

### 2. Menambahkan Barang Baru

**Request**

```http
POST /api/items
Content-Type: application/json
Accept: application/json
```

**Contoh body JSON**

```json
{
  "name": "Mechanical Keyboard",
  "sku": "KB-002",
  "description": "Keyboard mechanical dengan switch tactile",
  "price": 450000,
  "stock": 20
}
```

Contoh tersebut merupakan data yang dapat digunakan untuk menguji penambahan barang, selama SKU belum digunakan oleh barang lain.

### 3. Memperbarui Data Barang

**Request**

```http
PATCH /api/items/1
Content-Type: application/json
Accept: application/json
```

**Contoh body JSON**

```json
{
  "price": 475000,
  "stock": 15
}
```

Request tersebut digunakan untuk memperbarui sebagian data barang dengan ID `1`, sesuai aturan validasi dan implementasi endpoint.

### 4. Menghapus Data Barang

**Request**

```http
DELETE /api/items/1
Accept: application/json
```

Request tersebut digunakan untuk menghapus barang dengan ID `1`.

## Instalasi dan Menjalankan Proyek

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

Salin file konfigurasi contoh:

```bash
cp .env.example .env
```

Sesuaikan konfigurasi database pada file `.env`:

```dotenv
APP_NAME="Inventory API"
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

Sesuaikan nama database, username, dan password dengan konfigurasi MySQL lokal.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi Database

```bash
php artisan migrate
```

Jika proyek memiliki seeder yang sudah disiapkan untuk mengisi data contoh, gunakan:

```bash
php artisan db:seed
```

### 6. Jalankan Server Laravel

```bash
php artisan serve
```

API dapat diakses melalui:

```text
http://localhost:8000
```

## Dokumentasi API

Dokumentasi API dibuat menggunakan Scramble untuk membantu melihat endpoint, parameter, validasi, serta skema request dan respons.

Setelah server Laravel berjalan, dokumentasi dapat diakses melalui:

```text
http://localhost:8000/docs/api
```

## Pengujian API

Endpoint dapat diuji menggunakan Postman atau aplikasi HTTP client lainnya.

Pengujian yang dapat dilakukan meliputi:

- Mengambil daftar barang.
- Mengambil detail barang berdasarkan ID.
- Menambahkan barang dengan data valid.
- Menguji SKU yang duplikat.
- Memperbarui data barang.
- Menguji harga dan stok dengan nilai negatif.
- Mengakses barang yang tidak ditemukan.
- Menghapus barang.