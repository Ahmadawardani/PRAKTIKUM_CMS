@extends('layouts.app')

@section('content')
<style>
    /* Netflix-inspired Form Theme */
    body {
        background: linear-gradient(135deg, #1a0707 0%, #2d0a0a 50%, #000000 100%);
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .netflix-form-container {
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        padding: 3rem;
        margin: 3rem auto;
        max-width: 600px;
        box-shadow: 0 25px 50px rgba(220, 53, 69, 0.4);
        border: 2px solid rgba(220, 53, 69, 0.3);
        position: relative;
        overflow: hidden;
        transform: translateY(0);
        transition: all 0.3s ease;
    }

    .netflix-form-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 35px 70px rgba(220, 53, 69, 0.5);
    }

    .netflix-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #dc3545, #8b0000, #dc3545, #8b0000);
        background-size: 300% 100%;
        animation: flowing-border 3s linear infinite;
    }

    @keyframes flowing-border {
        0% { background-position: 0% 0%; }
        100% { background-position: 300% 0%; }
    }

    .netflix-form-container::after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #dc3545, transparent, #8b0000, transparent);
        border-radius: 25px;
        z-index: -1;
        opacity: 0.3;
        animation: rotate-border 4s linear infinite;
    }

    @keyframes rotate-border {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .netflix-title {
        font-size: 2.5rem;
        font-weight: 900;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #dc3545, #ff6b6b, #dc3545);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradient-text 3s ease infinite;
        text-shadow: 0 0 30px rgba(220, 53, 69, 0.5);
        position: relative;
    }

    .netflix-title::after {
        content: '📨';
        position: absolute;
        right: -50px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2rem;
        animation: bounce-icon 2s ease-in-out infinite;
    }

    @keyframes bounce-icon {
        0%, 100% { transform: translateY(-50%) scale(1); }
        50% { transform: translateY(-60%) scale(1.1); }
    }

    @keyframes gradient-text {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .netflix-label {
        display: block;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 0.8rem;
        color: #dc3545;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
        position: relative;
    }

    .netflix-label::before {
        content: '';
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        width: 8px;
        height: 8px;
        background: #dc3545;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(220, 53, 69, 0.8);
    }

    .netflix-input {
        width: 100%;
        padding: 1.2rem 1.5rem;
        border: 2px solid rgba(220, 53, 69, 0.3);
        border-radius: 12px;
        background: rgba(0, 0, 0, 0.7);
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .netflix-input:focus {
        outline: none;
        border-color: #dc3545;
        box-shadow: 
            inset 0 2px 10px rgba(0, 0, 0, 0.3),
            0 0 20px rgba(220, 53, 69, 0.4),
            0 0 40px rgba(220, 53, 69, 0.2);
        transform: translateY(-2px);
    }

    .netflix-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
        font-style: italic;
    }

    .netflix-input:hover {
        border-color: rgba(220, 53, 69, 0.6);
        transform: translateY(-1px);
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #dc3545, #8b0000);
        transition: all 0.3s ease;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    .input-wrapper:focus-within::after {
        width: 100%;
    }

    .netflix-btn {
        background: linear-gradient(45deg, #dc3545, #8b0000, #dc3545);
        background-size: 300% 300%;
        border: none;
        color: white;
        padding: 1.2rem 3rem;
        border-radius: 12px;
        font-weight: bold;
        font-size: 1.2rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        position: relative;
        overflow: hidden;
        width: 100%;
        margin-top: 1rem;
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 1s;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(220, 53, 69, 0.6);
        animation: pulse-button 0.5s ease;
        background-position: 100% 50%;
    }

    .netflix-btn:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.8);
    }

    @keyframes pulse-button {
        0%, 100% { transform: translateY(-3px) scale(1); }
        50% { transform: translateY(-3px) scale(1.02); }
    }

    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: rgba(220, 53, 69, 0.6);
        border-radius: 50%;
        animation: float-particle 8s ease-in-out infinite;
    }

    @keyframes float-particle {
        0%, 100% { 
            transform: translateY(0px) translateX(0px) rotate(0deg);
            opacity: 0.3;
        }
        25% { 
            transform: translateY(-30px) translateX(20px) rotate(90deg);
            opacity: 0.8;
        }
        50% { 
            transform: translateY(-60px) translateX(-10px) rotate(180deg);
            opacity: 0.5;
        }
        75% { 
            transform: translateY(-30px) translateX(-30px) rotate(270deg);
            opacity: 0.8;
        }
    }

    .form-decoration {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 4rem;
        opacity: 0.1;
        animation: rotate-slow 20s linear infinite;
        color: #dc3545;
    }

    @keyframes rotate-slow {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .success-message {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        animation: slide-down 0.5s ease;
    }

    @keyframes slide-down {
        0% { transform: translateY(-100%); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }

    .field-icons {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(220, 53, 69, 0.6);
        font-size: 1.2rem;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within .field-icons {
        color: #dc3545;
        transform: translateY(-50%) scale(1.2);
    }

    @media (max-width: 768px) {
        .netflix-form-container {
            margin: 1rem;
            padding: 2rem;
        }
        
        .netflix-title {
            font-size: 2rem;
        }
        
        .netflix-title::after {
            right: -30px;
            font-size: 1.5rem;
        }
    }
</style>

<div class="floating-elements">
    <div class="floating-particle" style="left: 10%; top: 20%; animation-delay: 0s;"></div>
    <div class="floating-particle" style="left: 80%; top: 30%; animation-delay: 2s;"></div>
    <div class="floating-particle" style="left: 20%; top: 60%; animation-delay: 4s;"></div>
    <div class="floating-particle" style="left: 70%; top: 70%; animation-delay: 6s;"></div>
    <div class="floating-particle" style="left: 40%; top: 40%; animation-delay: 3s;"></div>
    <div class="floating-particle" style="left: 90%; top: 80%; animation-delay: 5s;"></div>
</div>

<div class="netflix-form-container">
    <div class="form-decoration">✉️</div>
    
    <h3 class="netflix-title">Tambah Surat Keluar</h3>
    
    <form method="POST" action="{{ route('suratkeluar.store') }}" id="suratKeluarForm">
        @csrf
        
        <div class="form-group">
            <label class="netflix-label">🎯 Tujuan</label>
            <div class="input-wrapper">
                <input type="text" name="tujuan" class="netflix-input" required 
                       placeholder="Masukkan tujuan surat..." autocomplete="off">
                <div class="field-icons">🏢</div>
            </div>
        </div>

        <div class="form-group">
            <label class="netflix-label">📋 Perihal</label>
            <div class="input-wrapper">
                <input type="text" name="perihal" class="netflix-input" required 
                       placeholder="Masukkan perihal surat..." autocomplete="off">
                <div class="field-icons">📝</div>
            </div>
        </div>

        <div class="form-group">
            <label class="netflix-label">📅 Tanggal</label>
            <div class="input-wrapper">
                <input type="date" name="tanggal" class="netflix-input" required>
                <div class="field-icons">🗓️</div>
            </div>
        </div>

        <button type="submit" class="netflix-btn" id="submitBtn">
            💾 Simpan Surat Keluar
        </button>
    </form>
</div>

<script>
    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('suratKeluarForm');
        const submitBtn = document.getElementById('submitBtn');
        const inputs = document.querySelectorAll('.netflix-input');

        // Set default date to today
        const dateInput = document.querySelector('input[name="tanggal"]');
        if (dateInput.value === '') {
            dateInput.value = new Date().toISOString().split('T')[0];
        }

        // Add floating label effect
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentNode.classList.remove('focused');
                }
            });

            // Real-time validation feedback
            input.addEventListener('input', function() {
                if (this.value.trim() !== '') {
                    this.style.borderColor = '#28a745';
                    this.style.boxShadow = 'inset 0 2px 10px rgba(0, 0, 0, 0.3), 0 0 20px rgba(40, 167, 69, 0.3)';
                } else {
                    this.style.borderColor = 'rgba(220, 53, 69, 0.3)';
                    this.style.boxShadow = 'inset 0 2px 10px rgba(0, 0, 0, 0.3)';
                }
            });
        });

        // Enhanced submit button animation
        form.addEventListener('submit', function(e) {
            submitBtn.innerHTML = '⏳ Menyimpan...';
            submitBtn.style.background = 'linear-gradient(45deg, #ffc107, #fd7e14)';
            submitBtn.disabled = true;

            // Add loading animation
            setTimeout(() => {
                submitBtn.innerHTML = '✅ Berhasil Disimpan!';
                submitBtn.style.background = 'linear-gradient(45deg, #28a745, #20c997)';
            }, 1000);
        });

        // Add typing effect for placeholders
        const placeholders = [
            'Masukkan tujuan surat...',
            'Masukkan perihal surat...'
        ];

        inputs.forEach((input, index) => {
            if (index < 2) {
                let placeholder = placeholders[index];
                let currentText = '';
                let currentIndex = 0;

                function typePlaceholder() {
                    if (currentIndex < placeholder.length) {
                        currentText += placeholder[currentIndex];
                        input.placeholder = currentText;
                        currentIndex++;
                        setTimeout(typePlaceholder, 100);
                    }
                }

                // Start typing effect after a delay
                setTimeout(() => {
                    input.placeholder = '';
                    typePlaceholder();
                }, index * 500);
            }
        });

        // Form validation with custom messages
        form.addEventListener('submit', function(e) {
            let isValid = true;
            inputs.forEach(input => {
                if (input.hasAttribute('required') && input.value.trim() === '') {
                    isValid = false;
                    input.style.borderColor = '#dc3545';
                    input.style.animation = 'shake 0.5s ease-in-out';
                    
                    setTimeout(() => {
                        input.style.animation = '';
                    }, 500);
                }
            });

            if (!isValid) {
                e.preventDefault();
                submitBtn.innerHTML = '❌ Lengkapi Form!';
                submitBtn.style.background = 'linear-gradient(45deg, #dc3545, #8b0000)';
                
                setTimeout(() => {
                    submitBtn.innerHTML = '💾 Simpan Surat Keluar';
                    submitBtn.style.background = 'linear-gradient(45deg, #dc3545, #8b0000, #dc3545)';
                }, 2000);
            }
        });
    });

    // Add shake animation for validation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection