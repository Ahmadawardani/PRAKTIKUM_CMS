@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #141414 0%, #0f0f0f 100%);
        color: #ffffff;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .netflix-form-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Animated Background */
    .netflix-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(229, 9, 20, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(184, 7, 15, 0.2) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(139, 0, 0, 0.1) 0%, transparent 50%);
        animation: backgroundShift 8s ease-in-out infinite alternate;
        z-index: 1;
    }

    @keyframes backgroundShift {
        0% { transform: scale(1) rotate(0deg); opacity: 0.8; }
        100% { transform: scale(1.1) rotate(5deg); opacity: 1; }
    }

    /* Floating Elements */
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 2;
    }

    .shape {
        position: absolute;
        background: linear-gradient(45deg, rgba(229, 9, 20, 0.1), rgba(229, 9, 20, 0.3));
        border-radius: 50%;
        animation: floatShape 10s ease-in-out infinite;
    }

    .shape:nth-child(1) {
        width: 100px;
        height: 100px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 70%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 80px;
        height: 80px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes floatShape {
        0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); opacity: 0.3; }
        25% { transform: translateY(-20px) translateX(10px) rotate(90deg); opacity: 0.6; }
        50% { transform: translateY(-10px) translateX(-10px) rotate(180deg); opacity: 0.4; }
        75% { transform: translateY(-30px) translateX(5px) rotate(270deg); opacity: 0.7; }
    }

    /* Main Form Card */
    .form-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 3rem;
        width: 100%;
        max-width: 500px;
        position: relative;
        z-index: 10;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1),
            0 0 100px rgba(229, 9, 20, 0.1);
        animation: cardEntrance 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    @keyframes cardEntrance {
        0% {
            opacity: 0;
            transform: translateY(50px) scale(0.9);
        }
        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
        border-radius: 24px 24px 0 0;
    }

    /* Header Section */
    .form-header {
        text-align: center;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .form-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e50914, #b8070f);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 1.5rem;
        box-shadow: 
            0 10px 30px rgba(229, 9, 20, 0.4),
            0 0 0 10px rgba(229, 9, 20, 0.1);
        animation: iconPulse 3s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 10px 30px rgba(229, 9, 20, 0.4), 0 0 0 10px rgba(229, 9, 20, 0.1); }
        50% { transform: scale(1.05); box-shadow: 0 15px 40px rgba(229, 9, 20, 0.6), 0 0 0 20px rgba(229, 9, 20, 0.2); }
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffffff, #e50914, #ffffff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleGradient 4s ease-in-out infinite;
        margin-bottom: 0.5rem;
    }

    @keyframes titleGradient {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .form-subtitle {
        color: #b3b3b3;
        font-size: 1rem;
        margin-bottom: 0;
    }

    /* Alert Styles */
    .netflix-alert {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.2), rgba(220, 53, 69, 0.1));
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
        animation: alertSlide 0.5s ease-out;
    }

    @keyframes alertSlide {
        0% { opacity: 0; transform: translateX(-20px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    .netflix-alert ul {
        margin: 0;
        padding-left: 1rem;
        color: #ff6b6b;
    }

    .netflix-alert li {
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #b3b3b3;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        z-index: 2;
    }

    .form-input {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(145deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        backdrop-filter: blur(10px);
        position: relative;
        z-index: 2;
    }

    .form-input:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 
            0 0 0 3px rgba(229, 9, 20, 0.2),
            0 10px 30px rgba(229, 9, 20, 0.1);
        transform: translateY(-2px);
        background: linear-gradient(145deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    .form-input::placeholder {
        color: #666;
        transition: color 0.3s ease;
    }

    .form-input:focus::placeholder {
        color: #999;
    }

    /* Input Animation Effect */
    .form-group::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(229, 9, 20, 0.1), transparent);
        border-radius: 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .form-group:focus-within::before {
        opacity: 1;
    }

    /* Button Section */
    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .netflix-btn {
        flex: 1;
        padding: 1rem 2rem;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .btn-save {
        background: linear-gradient(135deg, #e50914, #b8070f);
        color: white;
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.3);
    }

    .btn-cancel {
        background: linear-gradient(135deg, #333333, #1a1a1a);
        color: white;
        border: 1px solid #555;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
    }

    .btn-save:hover {
        box-shadow: 0 12px 35px rgba(229, 9, 20, 0.5);
        color: white;
    }

    .btn-cancel:hover {
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        color: white;
    }

    /* Loading State */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }

    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-form-container {
            padding: 1rem;
        }
        
        .form-card {
            padding: 2rem;
            margin: 1rem;
        }
        
        .form-title {
            font-size: 2rem;
        }
        
        .button-group {
            flex-direction: column;
        }
        
        .netflix-btn {
            width: 100%;
        }
    }

    /* Success Animation */
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .success-animation {
        animation: successPulse 0.6s ease-in-out;
    }
</style>

<div class="netflix-form-container">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="form-card">
        <!-- Header -->
        <div class="form-header">
            <div class="form-icon">
                🏢
            </div>
            <h2 class="form-title">TAMBAH DIVISI</h2>
            <p class="form-subtitle">Buat divisi baru untuk organisasi</p>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="netflix-alert">
                <ul>
                    @foreach ($errors->all() as $error) 
                        <li>{{ $error }}</li> 
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('divisi.store') }}" method="POST" id="divisionForm">
            @csrf

            <div class="form-group">
                <label for="nama_divisi" class="form-label">
                    📋 Nama Divisi
                </label>
                <input 
                    type="text" 
                    name="nama_divisi" 
                    id="nama_divisi"
                    class="form-input" 
                    value="{{ old('nama_divisi') }}" 
                    placeholder="Masukkan nama divisi..."
                    required
                    autocomplete="off"
                >
            </div>

            <div class="button-group">
                <button type="submit" class="netflix-btn btn-save" id="saveBtn">
                    <span>💾</span>
                    Simpan Divisi
                </button>
                <a href="{{ route('divisi.index') }}" class="netflix-btn btn-cancel">
                    <span>❌</span>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('divisionForm');
    const saveBtn = document.getElementById('saveBtn');
    const nameInput = document.getElementById('nama_divisi');

    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        saveBtn.classList.add('btn-loading');
        saveBtn.disabled = true;
        
        // Add success animation to form card
        setTimeout(() => {
            document.querySelector('.form-card').classList.add('success-animation');
        }, 100);
    });

    // Real-time input validation
    nameInput.addEventListener('input', function() {
        const value = this.value.trim();
        const formGroup = this.closest('.form-group');
        
        if (value.length > 0) {
            this.style.borderColor = '#28a745';
            this.style.boxShadow = '0 0 0 3px rgba(40, 167, 69, 0.2)';
        } else {
            this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
            this.style.boxShadow = 'none';
        }
    });

    // Enhanced focus effects
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Button hover sound effect (visual feedback)
    const buttons = document.querySelectorAll('.netflix-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });

        button.addEventListener('mouseleave', function() {
            if (!this.classList.contains('btn-loading')) {
                this.style.transform = 'translateY(0) scale(1)';
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl + Enter to submit
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            form.submit();
        }
        
        // Escape to cancel
        if (e.key === 'Escape') {
            window.location.href = "{{ route('divisi.index') }}";
        }
    });

    // Auto-focus on name input
    setTimeout(() => {
        nameInput.focus();
    }, 500);
});

// Add dynamic particle effects
function createParticle() {
    const particle = document.createElement('div');
    particle.style.position = 'absolute';
    particle.style.width = '4px';
    particle.style.height = '4px';
    particle.style.background = '#e50914';
    particle.style.borderRadius = '50%';
    particle.style.left = Math.random() * 100 + '%';
    particle.style.top = '100%';
    particle.style.opacity = '0.7';
    particle.style.pointerEvents = 'none';
    particle.style.animation = 'floatUp 4s linear forwards';
    
    document.querySelector('.netflix-form-container').appendChild(particle);
    
    setTimeout(() => {
        particle.remove();
    }, 4000);
}

// Add CSS for floating particles
const style = document.createElement('style');
style.textContent = `
    @keyframes floatUp {
        0% { transform: translateY(0) rotate(0deg); opacity: 0; }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
    }
`;
document.head.appendChild(style);

// Create particles periodically
setInterval(createParticle, 2000);
</script>
@endsection