<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Netflix Style</title>
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
            background: linear-gradient(135deg, var(--netflix-black) 0%, var(--netflix-dark-gray) 25%, var(--netflix-gray) 75%, #000000 100%);
            min-height: 100vh;
            color: #ffffff;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(229, 9, 20, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(229, 9, 20, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 40% 80%, rgba(229, 9, 20, 0.06) 0%, transparent 50%);
            animation: backgroundShift 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes backgroundShift {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 1; }
        }

        .login-container {
            background: rgba(20, 20, 20, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 25px 50px rgba(229, 9, 20, 0.3), 0 0 100px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(229, 9, 20, 0.3);
            position: relative;
            overflow: hidden;
            animation: cardFloat 6s ease-in-out infinite;
        }

        @keyframes cardFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(229, 9, 20, 0.1), transparent);
            animation: cardShimmer 3s infinite;
        }

        @keyframes cardShimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .netflix-header {
            background: linear-gradient(135deg, var(--netflix-red) 0%, var(--netflix-dark-red) 100%);
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .netflix-header::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            animation: headerShine 4s infinite;
        }

        @keyframes headerShine {
            0% { transform: translateX(-100%) skewX(-25deg); }
            100% { transform: translateX(200%) skewX(-25deg); }
        }

        .netflix-title {
            font-size: 2.2rem;
            font-weight: 700;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
            letter-spacing: -1px;
            position: relative;
            z-index: 2;
            margin: 0;
        }

        .netflix-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .login-body {
            padding: 2.5rem;
            position: relative;
            z-index: 2;
        }

        .netflix-form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .netflix-label {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            display: block;
        }

        .netflix-input {
            background: rgba(51, 51, 51, 0.8);
            border: 2px solid rgba(229, 9, 20, 0.3);
            border-radius: 8px;
            color: #ffffff;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
        }

        .netflix-input:focus {
            background: rgba(51, 51, 51, 0.9);
            border-color: var(--netflix-red);
            box-shadow: 0 0 20px rgba(229, 9, 20, 0.4);
            outline: none;
            color: #ffffff;
        }

        .netflix-input::placeholder {
            color: var(--netflix-light-gray);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--netflix-red);
            font-size: 1.1rem;
            pointer-events: none;
        }

        .netflix-checkbox {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .netflix-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--netflix-red);
            cursor: pointer;
        }

        .netflix-checkbox label {
            color: #e5e5e5;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .netflix-btn {
            background: linear-gradient(45deg, var(--netflix-red), var(--netflix-dark-red));
            border: none;
            padding: 14px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .netflix-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .netflix-btn:hover::before {
            left: 100%;
        }

        .netflix-btn:hover {
            background: linear-gradient(45deg, var(--netflix-dark-red), #8B0000);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(229, 9, 20, 0.5);
        }

        .netflix-btn:active {
            transform: translateY(0px);
        }

        .netflix-alert {
            background: linear-gradient(45deg, rgba(220, 38, 38, 0.9), rgba(185, 28, 28, 0.8));
            border: 1px solid rgba(220, 38, 38, 0.5);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: alertSlide 0.5s ease-out;
        }

        @keyframes alertSlide {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .netflix-alert p {
            margin: 0;
            color: #ffffff;
            font-weight: 500;
        }

        .netflix-link {
            color: var(--netflix-red);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .netflix-link:hover {
            color: #ffffff;
            text-shadow: 0 0 10px var(--netflix-red);
        }

        .register-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(229, 9, 20, 0.2);
        }

        .register-section p {
            color: #e5e5e5;
            margin: 0;
        }

        /* Floating Elements */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            background: var(--netflix-red);
            border-radius: 50%;
            opacity: 0.05;
            animation: float 8s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 0.05;
            }
            90% {
                opacity: 0.05;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                margin: 1rem;
            }
            
            .netflix-title {
                font-size: 1.8rem;
            }
            
            .login-body {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Elements Background -->
    <div class="floating-elements">
        <div class="floating-element" style="left: 5%; width: 6px; height: 6px; animation-delay: 0s; animation-duration: 8s;"></div>
        <div class="floating-element" style="left: 15%; width: 8px; height: 8px; animation-delay: 1s; animation-duration: 10s;"></div>
        <div class="floating-element" style="left: 25%; width: 4px; height: 4px; animation-delay: 2s; animation-duration: 9s;"></div>
        <div class="floating-element" style="left: 35%; width: 7px; height: 7px; animation-delay: 3s; animation-duration: 11s;"></div>
        <div class="floating-element" style="left: 45%; width: 5px; height: 5px; animation-delay: 4s; animation-duration: 8s;"></div>
        <div class="floating-element" style="left: 55%; width: 9px; height: 9px; animation-delay: 5s; animation-duration: 10s;"></div>
        <div class="floating-element" style="left: 65%; width: 6px; height: 6px; animation-delay: 6s; animation-duration: 9s;"></div>
        <div class="floating-element" style="left: 75%; width: 4px; height: 4px; animation-delay: 7s; animation-duration: 11s;"></div>
        <div class="floating-element" style="left: 85%; width: 8px; height: 8px; animation-delay: 8s; animation-duration: 8s;"></div>
        <div class="floating-element" style="left: 95%; width: 5px; height: 5px; animation-delay: 9s; animation-duration: 10s;"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-5">
                <div class="login-container">
                    <!-- Header -->
                    <div class="netflix-header">
                        <h4 class="netflix-title">
                            <i class="fas fa-tv me-3"></i>Sign In
                        </h4>
                        <p class="netflix-subtitle">Welcome back to your streaming experience</p>
                    </div>
                    
                    <!-- Body -->
                    <div class="login-body">
                        @if ($errors->any())
                            <div class="netflix-alert">
                                @foreach ($errors->all() as $error)
                                    <p class="mb-0">
                                        <i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}
                                    </p>
                                @endforeach
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="netflix-form-group">
                                <label for="email" class="netflix-label">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                <div class="position-relative">
                                    <input type="email" 
                                           class="netflix-input" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Enter your email"
                                           required>
                                    <i class="fas fa-at input-icon"></i>
                                </div>
                            </div>

                            <div class="netflix-form-group">
                                <label for="password" class="netflix-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="position-relative">
                                    <input type="password" 
                                           class="netflix-input" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Enter your password"
                                           required>
                                    <i class="fas fa-key input-icon"></i>
                                </div>
                            </div>

                            <div class="netflix-checkbox">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="remember" 
                                       name="remember">
                                <label class="form-check-label" for="remember">
                                    <i class="fas fa-user-check me-2"></i>Remember Me
                                </label>
                            </div>

                            <button type="submit" class="netflix-btn">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>
                        
                        <div class="register-section">
                            <p>
                                <i class="fas fa-user-plus me-2"></i>
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="netflix-link">Sign up now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Input focus effects
            const inputs = document.querySelectorAll('.netflix-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Button click effect
            const submitBtn = document.querySelector('.netflix-btn');
            submitBtn.addEventListener('click', function(e) {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>
</html>