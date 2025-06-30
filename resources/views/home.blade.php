<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMPS Sistem Informasi - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --netflix-red: #E50914;
            --netflix-dark-red: #B81D24;
            --maroon: #800020;
            --dark-maroon: #5C0011;
            --netflix-black: #141414;
            --netflix-gray: #2F2F2F;
            --light-gray: #B3B3B3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--netflix-black) 0%, var(--dark-maroon) 50%, var(--maroon) 100%);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Animated Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, var(--netflix-red) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, var(--maroon) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, var(--dark-maroon) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Header & Navigation */
        .navbar-custom {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--netflix-red);
            padding: 15px 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: rgba(20, 20, 20, 0.98);
            box-shadow: 0 4px 20px rgba(229, 9, 20, 0.3);
        }

        .navbar-brand {
            font-size: 2rem;
            font-weight: bold;
            color: var(--netflix-red) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links a {
            color: var(--light-gray);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            padding: 8px 0;
        }

        .nav-links a:hover {
            color: var(--netflix-red);
            transform: translateY(-2px);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--netflix-red);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .search-bar {
            width: 200px;
        }

        /* Hero Section */
        .hero-section {
            margin-top: 80px;
            padding: 80px 0;
            position: relative;
            min-height: 70vh;
            display: flex;
            align-items: center;
            background: linear-gradient(45deg, var(--netflix-black) 0%, var(--maroon) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .greeting {
            font-size: 1.5rem;
            color: var(--netflix-red);
            margin-bottom: 10px;
            animation: slideInLeft 1s ease;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 20px;
            background: linear-gradient(45deg, var(--netflix-red), var(--maroon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: slideInRight 1s ease;
        }

        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--light-gray);
            margin-bottom: 40px;
            animation: fadeInUp 1s ease 0.5s both;
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Quick Access Cards */
        .quick-access {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: var(--netflix-red);
        }

        .access-card {
            background: linear-gradient(135deg, var(--netflix-gray) 0%, var(--dark-maroon) 100%);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            height: 100%;
        }

        .access-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.5s ease;
        }

        .access-card:hover::before {
            left: 100%;
        }

        .access-card:hover {
            transform: translateY(-10px) scale(1.05);
            border-color: var(--netflix-red);
            box-shadow: 0 20px 40px rgba(229, 9, 20, 0.3);
        }

        .access-card i {
            font-size: 3rem;
            color: var(--netflix-red);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .access-card:hover i {
            transform: scale(1.2) rotate(10deg);
        }

        .access-card h4 {
            color: white;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .access-card p {
            color: var(--light-gray);
            font-size: 0.9rem;
        }

        /* Administration Section */
        .administration-section {
            background: linear-gradient(135deg, rgba(229, 9, 20, 0.05) 0%, rgba(128, 0, 32, 0.08) 100%);
            padding: 80px 0;
            border-radius: 20px;
            margin: 50px 0;
            border: 1px solid rgba(229, 9, 20, 0.2);
        }

        .admin-card {
            background: linear-gradient(135deg, var(--netflix-gray) 0%, var(--netflix-black) 100%);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid rgba(229, 9, 20, 0.1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            height: 100%;
        }

        .admin-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(229, 9, 20, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .admin-card:hover::before {
            left: 100%;
        }

        .admin-card:hover {
            transform: translateY(-8px);
            border-color: var(--netflix-red);
            box-shadow: 0 15px 35px rgba(229, 9, 20, 0.2);
        }

        .admin-card i {
            font-size: 2.5rem;
            color: var(--netflix-red);
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .admin-card:hover i {
            transform: scale(1.1) rotate(5deg);
            color: #FF3B47;
        }

        .admin-card h5 {
            color: white;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .admin-card p {
            color: var(--light-gray);
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        /* Stats Section */
        .stats-section {
            background: rgba(229, 9, 20, 0.1);
            padding: 60px 0;
            border-radius: 20px;
            margin: 50px 0;
        }

        .stat-item {
            text-align: center;
            margin-bottom: 30px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--netflix-red);
            display: block;
        }

        .stat-label {
            color: var(--light-gray);
            font-size: 1.1rem;
        }

        /* Recent Activities */
        .recent-activities {
            padding: 80px 0;
        }

        .activity-card {
            background: var(--netflix-gray);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid var(--netflix-red);
            transition: all 0.3s ease;
        }

        .activity-card:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .activity-date {
            color: var(--netflix-red);
            font-size: 0.9rem;
            font-weight: bold;
        }

        .activity-title {
            color: white;
            font-weight: bold;
            margin: 10px 0 5px;
        }

        .activity-desc {
            color: var(--light-gray);
            font-size: 0.9rem;
        }

        /* Footer */
        .footer {
            background: var(--netflix-black);
            padding: 50px 0 30px;
            border-top: 3px solid var(--netflix-red);
            margin-top: 80px;
        }

        .footer-content {
            text-align: center;
        }

        .footer h5 {
            color: var(--netflix-red);
            margin-bottom: 20px;
        }

        .footer p {
            color: var(--light-gray);
            margin-bottom: 10px;
        }

        .social-links {
            margin-top: 30px;
        }

        .social-links a {
            color: var(--light-gray);
            font-size: 1.5rem;
            margin: 0 15px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: var(--netflix-red);
            transform: translateY(-3px);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                gap: 15px;
            }

            .search-bar {
                width: 200px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .access-card, .admin-card {
                margin-bottom: 20px;
            }
            /* Hero Section Buttons */
.hero-content .btn-netflix {
    padding: 12px 25px;
    font-size: 1.1rem;
    margin-right: 15px;
    margin-bottom: 10px;
    display: inline-flex;
    align-items: center;
}

.hero-content .btn-outline-netflix {
    padding: 10px 20px;
    font-size: 1.1rem;
    margin-bottom: 10px;
    display: inline-flex;
    align-items: center;
}

.hero-content .btn-netflix i,
.hero-content .btn-outline-netflix i {
    font-size: 1.2rem;
}

@media (max-width: 768px) {
    .hero-content .btn-netflix,
    .hero-content .btn-outline-netflix {
        width: 100%;
        justify-content: center;
        margin-right: 0;
        margin-bottom: 15px;
    }
}

/* Welcome Message */
.welcome-message .content-card {
    background: rgba(229, 9, 20, 0.1);
    border: 2px solid var(--netflix-red);
    border-radius: 15px;
    padding: 30px;
    transition: all 0.3s ease;
}

.welcome-message .content-card:hover {
    background: rgba(229, 9, 20, 0.15);
    box-shadow: 0 10px 30px rgba(229, 9, 20, 0.2);
}

.welcome-message h3 {
    color: var(--netflix-red);
    font-weight: bold;
}

.welcome-message p {
    color: var(--light-gray);
    font-size: 1.1rem;
}
        }
    </style>
</head>
<body>
    <div class="bg-animation"></div>
    
    <!-- Navigation -->
    <nav class="navbar-custom" id="navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <a href="#" class="navbar-brand">
                    <i class="fas fa-graduation-cap"></i>
                    HMPS SI
                </a>
                <div class="nav-links">
                    <a href="{{ route('anggota.index') }}">Anggota</a>
                    <a href="{{ route('divisi.index') }}">Divisi</a>
                    <a href="{{ route('kegiatan.index') }}">Kegiatan</a>
                    <a href="{{ route('administrasi.index') }}">Administrasi</a>
                    <a href="{{ url('/profil') }}">Profil</a>
                    <a href="{{ url('/struktur') }}">Struktur</a>
                        @auth
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link nav-link" style="color: var(--light-gray);">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
        </button>
    </form>
    @endauth
    
    @guest
    <a href="{{ route('login') }}">
        <i class="fas fa-sign-in-alt me-1"></i> Login
    </a>
    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <div class="greeting" id="greeting"></div>
                        <h1 class="hero-title">Himpunan Mahasiswa<br>Sistem Informasi</h1>
                        <p class="hero-subtitle">
                            MENGINSPIRASI BERSAMA
                            MEMBERDAYAKAN SEMUA
                        </p>
                            <div class="mt-4">
        @auth
        <a href="{{ route('dashboard') }}" class="btn btn-netflix me-3">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-netflix">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
        @endauth
        
        @guest
        <a href="{{ route('login') }}" class="btn btn-netflix me-3">
            <i class="fas fa-sign-in-alt me-2"></i> Login
        </a>
        <a href="{{ route('register') }}" class="btn btn-outline-netflix">
            <i class="fas fa-user-plus me-2"></i> Register
        </a>
        @endguest
    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @auth
<!-- Welcome Message for Logged In Users -->
<section class="welcome-message py-5">
    <div class="container">
        <div class="content-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-3">Selamat datang kembali, {{ auth()->user()->name }}!</h3>
                    <p class="mb-4">Anda login sebagai anggota HMPS Sistem Informasi. Akses penuh fitur tersedia untuk Anda.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-netflix">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('profil') }}" class="btn btn-outline-netflix">
                            <i class="fas fa-user-circle me-2"></i> Profil Saya
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-user-check" style="font-size: 5rem; color: var(--netflix-red);"></i>
                </div>
            </div>
        </div>
    </div>
</section>
@endauth

    <!-- Quick Access -->
    <section class="quick-access">
        <div class="container">
            <h2 class="section-title">Jelajahi HMPS SI</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="access-card" onclick="window.location.href='{{ route('anggota.index') }}'">
                        <i class="fas fa-users"></i>
                        <h4>Anggota</h4>
                        <p>Kenali keluarga besar HMPS Sistem Informasi dan jaringan mahasiswa aktif</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="access-card" onclick="window.location.href='{{ route('divisi.index') }}'">
                        <i class="fas fa-sitemap"></i>
                        <h4>Divisi</h4>
                        <p>Temukan berbagai divisi dan bidang keahlian yang ada di HMPS</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="access-card" onclick="window.location.href='{{ route('kegiatan.index') }}'">
                        <i class="fas fa-calendar-alt"></i>
                        <h4>Kegiatan</h4>
                        <p>Ikuti dan pantau kegiatan-kegiatan menarik yang telah dan akan dilaksanakan</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="access-card" onclick="window.location.href='{{ url('/profil') }}'">
                        <i class="fas fa-info-circle"></i>
                        <h4>Profil</h4>
                        <p>Pelajari lebih dalam tentang sejarah, visi, misi, dan pencapaian HMPS SI</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="access-card" onclick="window.location.href='{{ url('/struktur') }}'">
                        <i class="fas fa-chart-line"></i>
                        <h4>Struktur Organisasi</h4>
                        <p>Lihat struktur kepengurusan dan hierarki organisasi HMPS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Administration Section -->
    <section class="administration-section">
        <div class="container">
            <h2 class="section-title">Administrasi & Layanan</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="admin-card" onclick="window.location.href='{{ route('persuratan.index') }}'">
                        <i class="fas fa-file-alt"></i>
                        <h5>Dokumen</h5>
                        <p>Akses dokumen penting, formulir, dan berkas administrasi HMPS</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="admin-card" onclick="window.location.href='#'">
                        <i class="fas fa-clipboard-list"></i>
                        <h5>Pendaftaran</h5>
                        <p>Formulir pendaftaran anggota baru dan kegiatan organisasi</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="admin-card" onclick="window.location.href='{{ route('kegiatan.index') }}'">
                        <i class="fas fa-chart-bar"></i>
                        <h5>Laporan</h5>
                        <p>Laporan kegiatan, pertanggungjawaban, dan progress organisasi</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="admin-card" onclick="window.location.href='{{ route('persuratan.index') }}'">
                        <i class="fas fa-envelope"></i>
                        <h5>Surat Menyurat</h5>
                        <p>Template surat resmi dan korespondensi organisasi</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="admin-card" onclick="window.location.href='{{ route('keuangan.index') }}'">
                        <i class="fas fa-coins"></i>
                        <h5>Keuangan</h5>
                        <p>Transparansi keuangan organisasi dan laporan kas</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="admin-card" onclick="window.location.href='{{ route('persuratan.index') }}'">
                        <i class="fas fa-archive"></i>
                        <h5>Arsip</h5>
                        <p>Penyimpanan dan pengelolaan arsip digital organisasi</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="admin-card" onclick="window.location.href='#'">
                        <i class="fas fa-headset"></i>
                        <h5>Bantuan</h5>
                        <p>Layanan bantuan dan panduan penggunaan sistem</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number" data-count="27">27</span>
                        <span class="stat-label">Anggota Aktif</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number" data-count="8">8</span>
                        <span class="stat-label">Divisi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number" data-count="4">4</span>
                        <span class="stat-label">Kegiatan/Tahun</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-item">
                        <span class="stat-number" data-count="2011">2011</span>
                        <span class="stat-label">Tahun Berdiri</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Activities -->
    <section class="recent-activities">
        <div class="container">
            <h2 class="section-title">Aktivitas Terbaru</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="activity-card">
                        <div class="activity-date">{{ date('d M Y') }}</div>
                        <div class="activity-title">Workshop Web Development</div>
                        <div class="activity-desc">Pelatihan pembuatan website menggunakan Laravel untuk mahasiswa semester 4-6</div>
                    </div>
                    <div class="activity-card">
                        <div class="activity-date">{{ date('d M Y', strtotime('-2 days')) }}</div>
                        <div class="activity-title">Rapat Koordinasi Bulanan</div>
                        <div class="activity-desc">Evaluasi program kerja dan perencanaan kegiatan bulan depan</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="activity-card">
                        <div class="activity-date">{{ date('d M Y', strtotime('-5 days')) }}</div>
                        <div class="activity-title">Seminar IT Career Path</div>
                        <div class="activity-desc">Sharing session mengenai karir di bidang teknologi informasi</div>
                    </div>
                    <div class="activity-card">
                        <div class="activity-date">{{ date('d M Y', strtotime('-1 week')) }}</div>
                        <div class="activity-title">Bakti Sosial Digital</div>
                        <div class="activity-desc">Program pengabdian masyarakat melalui edukasi teknologi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h5>HMPS Sistem Informasi</h5>
                <p>Universitas Mercu Buana Yogyakarta</p>
                <p>Jl. Wates Km. 10, Yogyakarta 55753</p>
                <p>&copy; {{ date('Y') }} HMPS SI UMBY. Dibuat dengan ❤️ dan semangat kolaborasi</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
// Greeting based on time
function setGreeting() {
    const now = new Date();
    const hour = now.getHours();
    const greetingElement = document.getElementById('greeting');
    
    let greeting;
    let icon;
    
    if (hour >= 5 && hour < 12) {
        greeting = "Selamat Pagi";
        icon = "🌅";
    } else if (hour >= 12 && hour < 15) {
        greeting = "Selamat Siang";
        icon = "☀️";
    } else if (hour >= 15 && hour < 18) {
        greeting = "Selamat Sore";
        icon = "🌇";
    } else {
        greeting = "Selamat Malam";
        icon = "🌙";
    }
    
    // Check if user is authenticated
    const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
    
    if (isAuthenticated) {
        const userName = "{{ auth()->user()->name }}";
        greetingElement.innerHTML = `${icon} ${greeting}, ${userName}!`;
    } else {
        greetingElement.innerHTML = `${icon} ${greeting}, Keluarga HMPS SI!`;
    }
}

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count'));
            let current = 0;
            const increment = target / 50;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 40);
        }

        // Intersection Observer for counters
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.stat-number');
                    counters.forEach(counter => {
                        if (!counter.classList.contains('animated')) {
                            counter.classList.add('animated');
                            animateCounter(counter);
                        }
                    });
                }
            });
        }, observerOptions);

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setGreeting();
            
            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }

            // Add smooth scrolling to all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });

        // Update greeting every minute
        setInterval(setGreeting, 60000);
    </script>
</body>
</html>