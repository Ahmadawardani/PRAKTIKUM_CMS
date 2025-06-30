@extends('layouts.app')

@section('content')

<style>
    /* Netflix Premium Form Styling */
    body {
        background: linear-gradient(135deg, #1a0707 0%, #2d0a0a 30%, #8b0000 70%, #000000 100%);
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    /* Animated Background Particles */
    .bg-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -2;
        overflow: hidden;
    }

    .floating-shapes {
        position: absolute;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: 0.1;
        animation: float-around 20s linear infinite;
    }

    .shape-1 {
        background: linear-gradient(45deg, #dc3545, #8b0000);
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        background: linear-gradient(45deg, #8b0000, #dc3545);
        top: 70%;
        right: 20%;
        animation-delay: 5s;
        width: 150px;
        height: 150px;
    }

    .shape-3 {
        background: linear-gradient(45deg, #dc3545, #2d0a0a);
        bottom: 20%;
        left: 30%;
        animation-delay: 10s;
        width: 80px;
        height: 80px;
    }

    @keyframes float-around {
        0% { transform: translateY(0px) rotate(0deg); }
        33% { transform: translateY(-30px) rotate(120deg); }
        66% { transform: translateY(20px) rotate(240deg); }
        100% { transform: translateY(0px) rotate(360deg); }
    }

    .netflix-form-container {
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 3rem;
        margin: 3rem auto;
        max-width: 600px;
        box-shadow: 
            0 25px 50px rgba(220, 53, 69, 0.4),
            0 0 100px rgba(220, 53, 69, 0.1);
        border: 2px solid transparent;
        background-clip: padding-box;
        position: relative;
        overflow: hidden;
        animation: slideInUp 0.8s ease-out;
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .netflix-form-container::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 25px;
        padding: 2px;
        background: linear-gradient(45deg, 
            #dc3545, 
            #8b0000, 
            #dc3545, 
            #ff6b6b);
        background-size: 300% 300%;
        animation: gradient-border 4s ease infinite;
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: exclude;
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask-composite: exclude;
    }

    @keyframes gradient-border {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .netflix-title {
        font-size: 3rem;
        font-weight: 900;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #dc3545, #ff6b6b, #8b0000, #dc3545);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradient-text 3s ease infinite;
        text-shadow: 0 0 30px rgba(220, 53, 69, 0.6);
        position: relative;
    }

    .netflix-title::after {
        content: '✉️';
        position: absolute;
        top: -10px;
        right: -50px;
        font-size: 2rem;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    @keyframes gradient-text {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        display: block;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.8rem;
        color: #dc3545;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
        position: relative;
    }

    .form-label::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
        height: 12px;
        background: linear-gradient(45deg, #dc3545, #8b0000);
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(220, 53, 69, 0.5);
    }

    .netflix-input {
        width: 100%;
        padding: 1.2rem 1.5rem;
        font-size: 1.1rem;
        border: 2px solid transparent;
        border-radius: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: #ffffff;
        transition: all 0.3s ease;
        box-shadow: 
            inset 0 2px 10px rgba(0, 0, 0, 0.3),
            0 0 20px rgba(220, 53, 69, 0.1);
        position: relative;
    }

    .netflix-input:focus {
        outline: none;
        border-color: #dc3545;
        background: rgba(0, 0, 0, 0.9);
        box-shadow: 
            inset 0 2px 10px rgba(0, 0, 0, 0.5),
            0 0 30px rgba(220, 53, 69, 0.4),
            0 0 0 4px rgba(220, 53, 69, 0.1);
        transform: translateY(-2px);
    }

    .netflix-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
        font-style: italic;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #dc3545;
        font-size: 1.2rem;
        opacity: 0.7;
        transition: all 0.3s ease;
    }

    .netflix-input:focus + .input-icon {
        opacity: 1;
        color: #ff6b6b;
        transform: translateY(-50%) scale(1.2);
    }

    .netflix-btn {
        background: linear-gradient(45deg, #dc3545, #8b0000, #dc3545);
        background-size: 300% 300%;
        border: none;
        color: white;
        padding: 1.2rem 3rem;
        border-radius: 50px;
        font-weight: bold;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.4s ease;
        box-shadow: 
            0 10px 30px rgba(220, 53, 69, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        width: 100%;
        margin-top: 1rem;
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {
        0%, 100% {
            box-shadow: 
                0 10px 30px rgba(220, 53, 69, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
        50% {
            box-shadow: 
                0 15px 40px rgba(220, 53, 69, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.4), 
            transparent);
        transition: left 0.6s;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        background-position: 100% 0;
        box-shadow: 
            0 20px 50px rgba(220, 53, 69, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
        animation: none;
    }

    .netflix-btn:active {
        transform: translateY(-1px);
        box-shadow: 
            0 5px 20px rgba(220, 53, 69, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
    }

    .form-subtitle {
        text-align: center;
        font-size: 1.2rem;
        margin-bottom: 2rem;
        color: rgba(255, 255, 255, 0.8);
        font-style: italic;
    }

    /* Decorative Elements */
    .form-decoration {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        border: 3px solid rgba(220, 53, 69, 0.3);
        border-radius: 50%;
        animation: spin-slow 10s linear infinite;
    }

    .form-decoration::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 30px;
        height: 30px;
        background: linear-gradient(45deg, #dc3545, #8b0000);
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes pulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.2); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-form-container {
            margin: 1rem;
            padding: 2rem;
        }
        
        .netflix-title {
            font-size: 2.2rem;
        }
        
        .netflix-title::after {
            right: -30px;
            font-size: 1.5rem;
        }
        
        .form-label::before {
            left: -15px;
            width: 8px;
            height: 8px;
        }
    }

    /* Success Animation */
    .form-success {
        animation: success-bounce 0.6s ease-out;
    }

    @keyframes success-bounce {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>

<div class="bg-animation">
    <div class="floating-shapes shape-1"></div>
    <div class="floating-shapes shape-2"></div>
    <div class="floating-shapes shape-3"></div>
</div>

<div class="netflix-form-container">
    <div class="form-decoration"></div>
    
    <h1 class="netflix-title">Tambah Surat Masuk</h1>
    <p class="form-subtitle">Kelola surat masuk dengan sistem yang elegan dan modern</p>
    
    <form method="POST" action="{{ route('suratmasuk.store') }}" id="suratForm">
        @csrf
        
        <div class="form-group">
            <label class="form-label">👤 Pengirim</label>
            <div class="input-wrapper">
                <input type="text" 
                       name="pengirim" 
                       class="netflix-input" 
                       placeholder="Masukkan nama pengirim surat..."
                       required>
                <span class="input-icon">📤</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">📋 Perihal</label>
            <div class="input-wrapper">
                <input type="text" 
                       name="perihal" 
                       class="netflix-input" 
                       placeholder="Masukkan perihal/subjek surat..."
                       required>
                <span class="input-icon">📝</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">📅 Tanggal</label>
            <div class="input-wrapper">
                <input type="date" 
                       name="tanggal" 
                       class="netflix-input" 
                       required>
                <span class="input-icon">🗓️</span>
            </div>
        </div>

        <button type="submit" class="netflix-btn" id="submitBtn">
            💾 Simpan Surat Masuk
        </button>
    </form>
</div>

<script>
    // Enhanced Form Interactions
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('suratForm');
        const inputs = document.querySelectorAll('.netflix-input');
        const submitBtn = document.getElementById('submitBtn');

        // Input Focus Effects
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });

            // Real-time validation visual feedback
            input.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.borderColor = '#28a745';
                    this.style.boxShadow = `
                        inset 0 2px 10px rgba(0, 0, 0, 0.3),
                        0 0 20px rgba(40, 167, 69, 0.3)
                    `;
                } else {
                    this.style.borderColor = 'transparent';
                    this.style.boxShadow = `
                        inset 0 2px 10px rgba(0, 0, 0, 0.3),
                        0 0 20px rgba(220, 53, 69, 0.1)
                    `;
                }
            });
        });

        // Form Submit Animation
        form.addEventListener('submit', function(e) {
            submitBtn.innerHTML = '⏳ Menyimpan...';
            submitBtn.style.background = 'linear-gradient(45deg, #28a745, #20c997)';
            
            // Add loading animation
            submitBtn.style.animation = 'pulse 0.5s ease-in-out infinite';
            
            // Add success class to container
            document.querySelector('.netflix-form-container').classList.add('form-success');
        });

        // Auto-set today's date if empty
        const dateInput = document.querySelector('input[name="tanggal"]');
        if (!dateInput.value) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + Enter to submit
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                form.submit();
            }
        });

        // Form validation enhancement
        const validateForm = () => {
            let isValid = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = '#dc3545';
                    input.style.animation = 'shake 0.5s ease-in-out';
                    isValid = false;
                    
                    setTimeout(() => {
                        input.style.animation = '';
                    }, 500);
                }
            });
            return isValid;
        };

        // Add shake animation for invalid inputs
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);
    });

    // Floating animation for background shapes
    const shapes = document.querySelectorAll('.floating-shapes');
    shapes.forEach((shape, index) => {
        shape.style.animationDelay = `${index * 2}s`;
        
        // Random movement on mouse move
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth) * 10;
            const y = (e.clientY / window.innerHeight) * 10;
            
            shape.style.transform = `translateX(${x}px) translateY(${y}px)`;
        });
    });
</script>

@endsection