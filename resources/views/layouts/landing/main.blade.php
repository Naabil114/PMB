<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem PMB - Pendaftaran Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1523050853061-8c44f4323f50?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            color: white;
            display: flex;
            align-items: center;
        }
        .login-card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
            border-color: #0d6efd;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">PMB ONLINE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Prosedur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Biaya</a></li>
                    <li class="nav-item">
                        <button class="btn btn-primary ms-lg-3" data-bs-toggle="modal" data-bs-target="#loginChoiceModal">Login</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-3">Masa Depan Cerah Dimulai di Sini</h1>
            <p class="lead mb-4">Penerimaan Mahasiswa Baru Tahun Akademik 2026/2027 telah dibuka. Bergabunglah bersama kami!</p>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary btn-lg px-5 me-md-2" data-bs-toggle="modal" data-bs-target="#loginChoiceModal">Daftar Sekarang</button>
                <button class="btn btn-outline-light btn-lg px-5">Lihat Brosur</button>
            </div>
        </div>
    </header>

    <div class="modal fade" id="loginChoiceModal" tabindex="-1" aria-labelledby="loginChoiceLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginChoiceLabel">Pilih Akses Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card h-100 text-center p-3 login-card border-2">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-building text-primary" viewBox="0 0 16 16">
                                            <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/>
                                            <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 14V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3Z"/>
                                        </svg>
                                    </div>
                                    <h6 class="fw-bold">Login Instansi</h6>
                                    <p class="small text-muted">Akses untuk admin sekolah/yayasan</p>
                                    <a href="{{ route('admin.login.form') }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card h-100 text-center p-3 login-card border-2">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-person-badge text-primary" viewBox="0 0 16 16">
                                            <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path d="M9.5 0a.5.5 0 0 1 .5.5V1h3a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3V.5a.5.5 0 0 1 .5-.5h3zM3 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-3v1h1a.5.5 0 0 1 0 1H3v-1h1V2H3z"/>
                                        </svg>
                                    </div>
                                    <h6 class="fw-bold">Login Pendaftar</h6>
                                    <p class="small text-muted">Akses untuk calon mahasiswa baru</p>
                                    <a href="{{ route('pendaftar.login.form') }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>