@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    body {
        background: 
            linear-gradient(135deg, rgba(20, 20, 20, 0.95), rgba(0, 0, 0, 0.9)),
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23333" stroke-width="0.5" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        min-height: 100vh;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        color: #ffffff;
        padding: 2rem 0;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated Background Elements */
    .bg-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(184, 7, 15, 0.05));
        animation: float 6s ease-in-out infinite;
    }

    .floating-circle:nth-child(1) {
        width: 200px;
        height: 200px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-circle:nth-child(2) {
        width: 150px;
        height: 150px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .floating-circle:nth-child(3) {
        width: 100px;
        height: 100px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) scale(1); opacity: 0.3; }
        50% { transform: translateY(-20px) scale(1.1); opacity: 0.6; }
    }

    /* Main Container */
    .netflix-register-container {
        position: relative;
        z-index: 2;
        max-width: 500px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Netflix Logo Style Header */
    .netflix-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .netflix-logo {
        font-size: 3rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #e50914);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: logoGlow 3s ease-in-out infinite;
        margin-bottom: 0.5rem;
        text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
    }

    @keyframes logoGlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .netflix-tagline {
        color: #b3b3b3;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .netflix-subtitle {
        color: #666;
        font-size: 0.9rem;
    }

    /* Registration Card */
    .register-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
        animation: borderGlow 2s ease-in-out infinite;
    }

    @keyframes borderGlow {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }

    .card-title {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #ffffff, #e0e0e0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Form Styling */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: #b3b3b3;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: color 0.3s ease;
    }

    .form-input {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        z-index: 2;
    }

    .form-input:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 
            0 0 0 3px rgba(229, 9, 20, 0.2),
            0 8px 25px rgba(229, 9, 20, 0.15);
        transform: translateY(-2px);
    }

    .form-input:focus + .form-label,
    .form-input:not(:placeholder-shown) + .form-label {
        color: #e50914;
    }

    .form-input::placeholder {
        color: #666;
        transition: opacity 0.3s ease;
    }

    .form-input:focus::placeholder {
        opacity: 0;
    }

    /* Password Strength Indicator */
    .password-strength {
        height: 3px;
        background: #333;
        border-radius: 2px;
        margin-top: 0.5rem;
        overflow: hidden;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .password-strength.active {
        opacity: 1;
    }

    .strength-bar {
        height: 100%;
        border-radius: 2px;
        transition: all 0.3s ease;
        width: 0%;
    }

    .strength-weak { background: #dc3545; width: 33%; }
    .strength-medium { background: #ffc107; width: 66%; }
    .strength-strong { background: #28a745; width: 100%; }

    /* Submit Button */
    .netflix-btn {
        width: 100%;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, #e50914, #b8070f);
        border: none;
        border-radius: 12px;
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        margin-top: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(229, 9, 20, 0.4);
    }

    .netflix-btn:active {
        transform: translateY(-1px);
    }

    /* Error Alert */
    .error-alert {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.9), rgba(176, 42, 55, 0.9));
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .error-alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: #dc3545;
    }

    .error-item {
        margin: 0;
        padding: 0.25rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-item::before {
        content: '⚠️';
        font-size: 0.9rem;
    }

    /* Login Link */
    .login-link {
        text-align: center;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .login-link p {
        color: #b3b3b3;
        margin-bottom: 0;
    }

    .login-link a {
        color: #e50914;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .login-link a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #e50914;
        transition: width 0.3s ease;
    }

    .login-link a:hover::after {
        width: 100%;
    }

    .login-link a:hover {
        color: #ff6b6b;
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-register-container {
            padding: 0 1rem;
        }
        
        .register-card {
            padding: 2rem;
            margin: 1rem 0;
        }
        
        .netflix-logo {
            font-size: 2.5rem;
        }
        
        .card-title {
            font-size: 1.5rem;
        }
    }

    /* Loading Animation */
    .loading {
        position: relative;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top: 2px solid #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="bg-animation">
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
</div>

<div class="netflix-register-container">
    <div class="netflix-header">
        <h1 class="netflix-logo">HMPS-SI</h1>
        <p class="netflix-tagline">MENGINSPIRASI BERSAMA</p>
        <p class="netflix-subtitle">MEMBERDAYAKAN SEMUA</p>
    </div>

    <div class="register-card">
        <h2 class="card-title">Buat Akun Baru</h2>

        @if ($errors->any())
            <div class="error-alert">
                @foreach ($errors->all() as $error)
                    <p class="error-item">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            
            <div class="form-group">
                <input type="text" 
                       class="form-input" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Masukkan nama lengkap"
                       required>
                <label for="name" class="form-label">Nama Lengkap</label>
            </div>

            <div class="form-group">
                <input type="email" 
                       class="form-input" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="contoh@email.com"
                       required>
                <label for="email" class="form-label">Alamat Email</label>
            </div>

            <div class="form-group">
                <input type="password" 
                       class="form-input" 
                       id="password" 
                       name="password" 
                       placeholder="Minimal 8 karakter"
                       required>
                <label for="password" class="form-label">Password</label>
                <div class="password-strength" id="passwordStrength">
                    <div class="strength-bar" id="strengthBar"></div>
                </div>
            </div>

            <div class="form-group">
                <input type="password" 
                       class="form-input" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="Ulangi password"
                       required>
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            </div>

            <button type="submit" class="netflix-btn" id="submitBtn">
                Daftar Sekarang
            </button>
        </form>

        <div class="login-link">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        
        if (password.length > 0) {
            passwordStrength.classList.add('active');
            updateStrengthBar(strength);
        } else {
            passwordStrength.classList.remove('active');
        }
    });

    function checkPasswordStrength(password) {
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        return Math.min(strength, 3);
    }

    function updateStrengthBar(strength) {
        strengthBar.className = 'strength-bar';
        
        if (strength === 1) {
            strengthBar.classList.add('strength-weak');
        } else if (strength === 2) {
            strengthBar.classList.add('strength-medium');
        } else if (strength >= 3) {
            strengthBar.classList.add('strength-strong');
        }
    }

    // Password confirmation validation
    confirmPasswordInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value && this.value.length > 0) {
            this.style.borderColor = '#dc3545';
        } else {
            this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
        }
    });

    // Form submission
    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.textContent = 'Mendaftar...';
        submitBtn.disabled = true;
    });

    // Animate form elements on load
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, index * 150 + 300);
    });

    // Card entrance animation
    const card = document.querySelector('.register-card');
    card.style.opacity = '0';
    card.style.transform = 'translateY(50px) scale(0.95)';
    
    setTimeout(() => {
        card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0) scale(1)';
    }, 200);
});
</script>
@endsection