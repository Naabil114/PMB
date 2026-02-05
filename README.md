# Sistem Penerimaan Mahasiswa Baru Pascasarjana (PMB)

Aplikasi web untuk mengelola sistem penerimaan mahasiswa baru tingkat Pascasarjana, termasuk pendaftaran, verifikasi dokumen, dan manajemen jadwal ujian.

## Tech Stack

### Backend

- **Framework**: Laravel 12.x (PHP 8.2+)
- **Authentication**: JWT Auth (tymon/jwt-auth ^2.2)
- **Database**: MySQL 8.x
- **Task Queue**: Database-backed queue
- **PDF Generation**: DOMPDF (barryvdh/laravel-dompdf ^3.1)
- **Excel Processing**: Maatwebsite Excel (maatwebsite/excel ^3.1)

### Frontend

- **CSS Framework**: Tailwind CSS 4.x
- **Build Tool**: Vite 7.x
- **JavaScript**: Vanilla JS + Axios
- **Template Engine**: Blade (Laravel)
- **UI Components**: Bootstrap 5 (via public assets)

### Database

- **DBMS**: MySQL 8.x
- **ORM**: Eloquent
- **Migration Management**: Laravel Migrations
- **Connection String**: `mysql://root@127.0.0.1:3306/pmb`

## Cara Menjalankan Aplikasi

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+
- MySQL 8.x
- Git

### Instalasi dan Setup

1. **Clone Repository**

    ```bash
    git clone <repository-url>
    cd pmb
    ```

2. **Setup Backend**

    ```bash
    # Install dependencies
    composer install

    # Copy environment file
    cp .env.example .env

    # Generate application key
    php artisan key:generate

    # Generate JWT secret
    php artisan jwt:secret

    # Run database migrations
    php artisan migrate

    # Seed database (optional)
    php artisan db:seed
    ```

3. **Setup Frontend**

    ```bash
    # Install Node dependencies
    npm install

    # Build assets
    npm run build

    # Or run development server
    npm run dev
    ```

4. **Jalankan Aplikasi**

    ```bash
    # Start Laravel development server
    php artisan serve

    # In another terminal, start Vite dev server
    npm run dev

    # Access application at http://localhost:8000
    ```

## Fitur yang Diimplementasikan

- [✅] **Login & Authentication**
    - Autentikasi berbasis JWT
    - Role-based access control (Admin, Calon Mahasiswa, Verifikator)

- [✅] **Upload & Verifikasi Dokumen**
    - Upload dokumen (KTP, Ijazah, Transkrip, dll)
    - Validasi dokumen oleh verifikator
    - Status tracking dokumen

- [x] **WhatsApp Notifikasi (Mock)**
    - Notifikasi status pendaftaran via mock WA service
    - Notifikasi hasil verifikasi dokumen
    - Notifikasi jadwal ujian

- [ ] **Manajemen Jadwal Ujian** (In Development)
- [ ] **Hasil dan Kelulusan** (In Development)
- [ ] **Laporan & Analytics** (In Development)



### Alur Proses

1. **Pendaftaran**: Calon mahasiswa login → isi form → upload dokumen
2. **Verifikasi**: Verifikator review dokumen → approve/reject → kirim notifikasi
3. **Ujian**: Admin jadwalkan ujian → kirim notifikasi ke calon mahasiswa

### Asumsi yang Digunakan

- Database MySQL sudah tersedia dan dapat diakses
- WhatsApp notification adalah mock service (tidak terhubung ke WhatsApp Business API)



```

## License

Closed Source - Hak Cipta Institusi
