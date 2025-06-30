<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HMPS Sistem Informasi')</title>
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

        .nav-links a.active {
            color: var(--netflix-red);
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

        .nav-links a:hover::after,
        .nav-links a.active::after {
            width: 100%;
        }

        /* Mobile Navigation */
        .navbar-toggler {
            border: none;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28229, 9, 20, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(20, 20, 20, 0.98);
                margin-top: 15px;
                padding: 20px;
                border-radius: 10px;
                border: 1px solid var(--netflix-red);
            }

            .nav-links {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        /* Main Content */
        .main-content {
            margin-top: 90px;
            min-height: calc(100vh - 90px - 120px);
            padding: 40px 0;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(45deg, var(--netflix-black) 0%, var(--maroon) 100%);
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 30% 30%, rgba(229, 9, 20, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 70%, rgba(128, 0, 32, 0.1) 0%, transparent 50%);
            animation: float 8s ease-in-out infinite;
        }

        .page-header .container {
            position: relative;
            z-index: 2;
        }

        .page-title {
            font-size: 3rem;
            font-weight: bold;
            color: var(--netflix-red);
            margin-bottom: 15px;
            text-align: center;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: var(--light-gray);
            text-align: center;
            margin-bottom: 0;
        }

        /* Content Cards */
        .content-card {
            background: rgba(47, 47, 47, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(229, 9, 20, 0.2);
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            border-color: var(--netflix-red);
            box-shadow: 0 15px 35px rgba(229, 9, 20, 0.2);
        }

        /* Buttons */
        .btn-netflix {
            background: linear-gradient(45deg, var(--netflix-red), var(--netflix-dark-red));
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-netflix:hover {
            background: linear-gradient(45deg, var(--netflix-dark-red), var(--maroon));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(229, 9, 20, 0.3);
            color: white;
        }

        .btn-outline-netflix {
            background: transparent;
            border: 2px solid var(--netflix-red);
            color: var(--netflix-red);
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-netflix:hover {
            background: var(--netflix-red);
            color: white;
            transform: translateY(-2px);
        }

        /* Tables */
        .table-netflix {
            background: rgba(47, 47, 47, 0.8);
            color: white;
            border-radius: 15px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .table-netflix th {
            background: var(--netflix-red);
            color: white;
            font-weight: bold;
            border: none;
            padding: 15px;
        }

        .table-netflix td {
            border-color: rgba(229, 9, 20, 0.2);
            padding: 15px;
        }

        .table-netflix tbody tr:hover {
            background: rgba(229, 9, 20, 0.1);
        }

        /* Forms */
        .form-control-netflix {
            background: rgba(47, 47, 47, 0.8);
            border: 2px solid transparent;
            color: white;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control-netflix:focus {
            background: rgba(47, 47, 47, 1);
            border-color: var(--netflix-red);
            box-shadow: 0 0 15px rgba(229, 9, 20, 0.3);
            color: white;
        }

        .form-control-netflix::placeholder {
            color: var(--light-gray);
        }

        .form-label-netflix {
            color: var(--light-gray);
            font-weight: 500;
            margin-bottom: 8px;
        }

        /* Footer */
        .footer {
            background: var(--netflix-black);
            padding: 40px 0 20px;
            border-top: 3px solid var(--netflix-red);
            margin-top: 60px;
        }

        .footer-content {
            text-align: center;
        }

        .footer h5 {
            color: var(--netflix-red);
            margin-bottom: 15px;
        }

        .footer p {
            color: var(--light-gray);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            color: var(--light-gray);
            font-size: 1.3rem;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            color: var(--netflix-red);
            transform: translateY(-3px);
        }

        /* Alert Styles */
        .alert-netflix {
            background: rgba(229, 9, 20, 0.1);
            border: 1px solid var(--netflix-red);
            color: white;
            border-radius: 10px;
        }

        .alert-success-netflix {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #d4edda;
            border-radius: 10px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.2rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }

            .content-card {
                padding: 20px;
            }

            .main-content {
                padding: 20px 0;
            }

            /* Logout Button Style */
.nav-links .btn-link.nav-link {
    padding: 8px 0;
    text-decoration: none;
    position: relative;
    transition: all 0.3s ease;
    background: none;
    border: none;
    cursor: pointer;
}

.nav-links .btn-link.nav-link:hover {
    color: var(--netflix-red) !important;
    transform: translateY(-2px);
}

.nav-links .btn-link.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--netflix-red);
    transition: width 0.3s ease;
}

.nav-links .btn-link.nav-link:hover::after {
    width: 100%;
}

@media (max-width: 991.98px) {
    .nav-links .btn-link.nav-link {
        padding: 8px 0;
        text-align: left;
        width: 100%;
    }
    
    .nav-links form {
        width: 100%;
    }
}


        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="bg-animation"></div>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom" id="navbar">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">
                <i class="fas fa-graduation-cap"></i>
                HMPS SI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="nav-links ms-auto">
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ url('/profil') }}" class="{{ request()->is('profil') ? 'active' : '' }}">Profil</a>
                    <a href="{{ route('anggota.index') }}" class="{{ request()->is('anggota*') ? 'active' : '' }}">Anggota</a>
                    <a href="{{ route('divisi.index') }}" class="{{ request()->is('divisi*') ? 'active' : '' }}">Divisi</a>
                    <a href="{{ route('kegiatan.index') }}" class="{{ request()->is('kegiatan*') ? 'active' : '' }}">Kegiatan</a>
                    <a href="{{ route('administrasi.index') }}" class="{{ request()->is('administrasi*') ? 'active' : '' }}">Administrasi</a>
                    <a href="{{ url('/struktur') }}" class="{{ request()->is('struktur') ? 'active' : '' }}">Struktur</a>
                        @auth
    <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-link nav-link" style="color: var(--light-gray);">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
        </button>
    </form>
    @endauth
    
    @guest
    <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">
        <i class="fas fa-sign-in-alt me-1"></i> Login
    </a>
    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @if(!request()->is('/'))
        <div class="page-header">
            <div class="container">
                <h1 class="page-title">@yield('page-title', 'HMPS Sistem Informasi')</h1>
                <p class="page-subtitle">@yield('page-subtitle', 'Universitas Mercu Buana Yogyakarta')</p>
            </div>
        </div>
        @endif

        <div class="container">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success-netflix alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-netflix alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-netflix alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <h5>HMPS Sistem Informasi</h5>
                <p>Universitas Mercu Buana Yogyakarta</p>
                <p>Jl. Wates Km. 10, Yogyakarta 55753</p>
                <p>&copy; {{ date('Y') }} HMPS SI UMBY. Dibuat dengan ❤️ dan semangat kolaborasi</p>
                <div class="social-links">
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Auto dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert && alert.parentNode) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>