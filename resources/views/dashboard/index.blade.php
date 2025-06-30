<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Netflix Style</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --netflix-red: #E50914;
            --netflix-dark-red: #B81D24;
            --netflix-black: #141414;
            --netflix-dark-gray: #221F1F;
            --netflix-gray: #333333;
            --netflix-light-gray: #757575;
        }

        body {
            background: linear-gradient(135deg, var(--netflix-black) 0%, var(--netflix-dark-gray) 50%, var(--netflix-gray) 100%);
            min-height: 100vh;
            color: #ffffff;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }

        .netflix-container {
            background: rgba(20, 20, 20, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(229, 9, 20, 0.3);
            border: 1px solid rgba(229, 9, 20, 0.2);
        }

        .netflix-header {
            background: linear-gradient(90deg, var(--netflix-red) 0%, var(--netflix-dark-red) 100%);
            padding: 20px;
            border-radius: 12px 12px 0 0;
            position: relative;
            overflow: hidden;
        }

        .netflix-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        .netflix-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
            letter-spacing: -1px;
            position: relative;
            z-index: 2;
        }

        .netflix-card {
            background: linear-gradient(145deg, rgba(34, 31, 31, 0.9) 0%, rgba(51, 51, 51, 0.8) 100%);
            border: 1px solid rgba(229, 9, 20, 0.3);
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .netflix-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(229, 9, 20, 0.1), transparent);
            transition: left 0.5s;
        }

        .netflix-card:hover::before {
            left: 100%;
        }

        .netflix-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(229, 9, 20, 0.4);
            border-color: var(--netflix-red);
        }

        .netflix-card-body {
            padding: 2rem;
            position: relative;
            z-index: 2;
        }

        .netflix-card-title {
            color: var(--netflix-red);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .netflix-text {
            color: #e5e5e5;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .netflix-info {
            background: rgba(229, 9, 20, 0.1);
            padding: 12px 16px;
            border-radius: 6px;
            border-left: 4px solid var(--netflix-red);
            margin-bottom: 1rem;
        }

        .netflix-info strong {
            color: var(--netflix-red);
        }

        .logout-btn {
            background: linear-gradient(45deg, var(--netflix-red), var(--netflix-dark-red));
            border: none;
            padding: 10px 25px;
            border-radius: 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
        }

        .logout-btn:hover {
            background: linear-gradient(45deg, var(--netflix-dark-red), #8B0000);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(229, 9, 20, 0.5);
            color: white;
        }

        .welcome-badge {
            background: linear-gradient(45deg, var(--netflix-red), var(--netflix-dark-red));
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(229, 9, 20, 0.3);
        }

        .stats-row {
            margin-top: 2rem;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(229, 9, 20, 0.1) 0%, rgba(34, 31, 31, 0.8) 100%);
            border: 1px solid rgba(229, 9, 20, 0.2);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(229, 9, 20, 0.3);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--netflix-red);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--netflix-light-gray);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            background: var(--netflix-red);
            border-radius: 50%;
            opacity: 0.1;
            animation: float 6s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.1;
            }
            90% {
                opacity: 0.1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Particles Background -->
    <div class="floating-particles">
        <div class="particle" style="left: 10%; width: 4px; height: 4px; animation-delay: 0s; animation-duration: 6s;"></div>
        <div class="particle" style="left: 20%; width: 6px; height: 6px; animation-delay: 1s; animation-duration: 8s;"></div>
        <div class="particle" style="left: 30%; width: 3px; height: 3px; animation-delay: 2s; animation-duration: 7s;"></div>
        <div class="particle" style="left: 40%; width: 5px; height: 5px; animation-delay: 3s; animation-duration: 9s;"></div>
        <div class="particle" style="left: 50%; width: 4px; height: 4px; animation-delay: 4s; animation-duration: 6s;"></div>
        <div class="particle" style="left: 60%; width: 7px; height: 7px; animation-delay: 5s; animation-duration: 8s;"></div>
        <div class="particle" style="left: 70%; width: 3px; height: 3px; animation-delay: 6s; animation-duration: 7s;"></div>
        <div class="particle" style="left: 80%; width: 5px; height: 5px; animation-delay: 7s; animation-duration: 9s;"></div>
        <div class="particle" style="left: 90%; width: 4px; height: 4px; animation-delay: 8s; animation-duration: 6s;"></div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="netflix-container">
                    <!-- Header -->
                    <div class="netflix-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="netflix-title mb-0">
                                <i class="fas fa-tv me-3"></i>Dashboard
                            </h2>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Main Content -->
                    <div class="netflix-card-body">
                        <div class="netflix-card">
                            <div class="netflix-card-body">
                                <div class="welcome-badge">
                                    <i class="fas fa-user-circle me-2"></i>Welcome Back
                                </div>
                                <h5 class="netflix-card-title">
                                    <i class="fas fa-crown me-2"></i>Selamat Datang, {{ Auth::user()->name }}!
                                </h5>
                                <p class="netflix-text">
                                    <i class="fas fa-check-circle me-2 text-success"></i>
                                    Anda berhasil login ke sistem dan siap untuk memulai.
                                </p>
                                
                                <div class="netflix-info">
                                    <strong><i class="fas fa-envelope me-2"></i>Email:</strong> 
                                    <span class="ms-2">{{ Auth::user()->email }}</span>
                                </div>

                                <!-- Stats Row -->
                                <div class="row stats-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-chart-line"></i>
                                            </div>
                                            <div class="stat-number">24</div>
                                            <div class="stat-label">Total Views</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <div class="stat-number">156</div>
                                            <div class="stat-label">Active Users</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="stat-number">98%</div>
                                            <div class="stat-label">Satisfaction</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Content Area -->
                                <div class="mt-4">
                                    <h6 class="netflix-card-title">
                                        <i class="fas fa-bolt me-2"></i>Quick Actions
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <button class="btn btn-outline-danger w-100">
                                                <i class="fas fa-plus me-2"></i>Add New Content
                                            </button>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <button class="btn btn-outline-danger w-100">
                                                <i class="fas fa-cog me-2"></i>Settings
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>