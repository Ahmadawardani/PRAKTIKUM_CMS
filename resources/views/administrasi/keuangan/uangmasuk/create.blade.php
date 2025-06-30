@extends('layouts.app')

@section('content')

<style>
    /* Netflix-inspired Theme untuk Form */
    body {
        background: linear-gradient(135deg, #1a0707 0%, #2d0a0a 50%, #000000 100%);
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        overflow-x: hidden;
    }

    .netflix-form-container {
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        padding: 3rem;
        margin: 2rem auto;
        max-width: 600px;
        box-shadow: 0 25px 50px rgba(220, 53, 69, 0.4);
        border: 2px solid rgba(220, 53, 69, 0.3);
        position: relative;
        overflow: hidden;
        animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
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
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #dc3545, #8b0000, #dc3545, #8b0000);
        background-size: 400% 100%;
        animation: gradient-move 3s ease infinite;
    }

    @keyframes gradient-move {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .netflix-form-container::after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #dc3545, transparent, #8b0000, transparent, #dc3545);
        border-radius: 27px;
        z-index: -1;
        animation: border-rotate 4s linear infinite;
    }

    @keyframes border-rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .netflix-title {
        font-size: 2.8rem;
        font-weight: 900;
        text-align: center;
        margin-bottom: 2.5rem;
        background: linear-gradient(45deg, #28a745, #20c997, #28a745);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: title-glow 3s ease infinite;
        text-shadow: 0 0 30px rgba(40, 167, 69, 0.5);
        position: relative;
    }

    @keyframes title-glow {
        0%, 100% { 
            background-position: 0% 50%;
            filter: brightness(1);
        }
        50% { 
            background-position: 100% 50%;
            filter: brightness(1.2);
        }
    }

    .netflix-title::after {
        content: '💰';
        position: absolute;
        right: -60px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 3rem;
        animation: money-bounce 2s ease-in-out infinite;
    }

    @keyframes money-bounce {
        0%, 100% { transform: translateY(-50%) rotate(0deg) scale(1); }
        50% { transform: translateY(-70%) rotate(10deg) scale(1.1); }
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .netflix-label {
        display: block;
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0.8rem;
        color: #28a745;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        padding-left: 35px;
    }

    .netflix-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 25px;
        height: 3px;
        background: linear-gradient(90deg, #28a745, #20c997);
        border-radius: 2px;
    }

    .netflix-input {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: rgba(0, 0, 0, 0.7);
        border: 2px solid rgba(40, 167, 69, 0.3);
        border-radius: 12px;
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        position: relative;
    }

    .netflix-input:focus {
        outline: none;
        border-color: #28a745;
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.4);
        background: rgba(0, 0, 0, 0.8);
        transform: translateY(-2px);
    }

    .netflix-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
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
        font-size: 1.3rem;
        color: #28a745;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .netflix-input:focus + .input-icon {
        color: #20c997;
        transform: translateY(-50%) scale(1.2);
    }

    .netflix-btn {
        background: linear-gradient(45deg, #28a745, #20c997);
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
        margin: 1rem 0;
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        position: relative;
        overflow: hidden;
        width: 100%;
        border: 2px solid transparent;
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(40, 167, 69, 0.6);
        border-color: #20c997;
    }

    .netflix-btn:active {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }

    .back-btn {
        background: linear-gradient(45deg, #6c757d, #495057);
        margin-right: 1rem;
        width: auto;
        padding: 1rem 2rem;
        margin-bottom: 2rem;
    }

    .back-btn:hover {
        box-shadow: 0 15px 35px rgba(108, 117, 125, 0.4);
    }

    .floating-money {
        position: fixed;
        font-size: 2rem;
        color: #28a745;
        opacity: 0.1;
        animation: float-money 8s ease-in-out infinite;
        pointer-events: none;
        z-index: -1;
    }

    @keyframes float-money {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg);
            opacity: 0.1;
        }
        50% { 
            transform: translateY(-30px) rotate(180deg);
            opacity: 0.3;
        }
    }

    .success-message {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: bold;
        animation: pulse-success 2s ease-in-out infinite;
    }

    @keyframes pulse-success {
        0%, 100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        50% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
    }

    .form-subtitle {
        text-align: center;
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        font-style: italic;
    }

    .money-counter {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(40, 167, 69, 0.9);
        color: white;
        padding: 1rem;
        border-radius: 50%;
        font-size: 1.5rem;
        animation: money-spin 3s linear infinite;
        z-index: 1000;
    }

    @keyframes money-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .input-group {
        position: relative;
        margin-bottom: 2rem;
    }

    .currency-prefix {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #28a745;
        font-weight: bold;
        font-size: 1.1rem;
        z-index: 2;
    }

    .netflix-input.with-prefix {
        padding-left: 45px;
    }

    @media (max-width: 768px) {
        .netflix-form-container {
            margin: 1rem;
            padding: 1.5rem;
        }
        
        .netflix-title {
            font-size: 2rem;
        }
        
        .netflix-title::after {
            right: -40px;
            font-size: 2rem;
        }
    }
</style>

<!-- Floating Money Elements -->
<div class="floating-money" style="top: 10%; left: 5%; animation-delay: 0s;">💰</div>
<div class="floating-money" style="top: 20%; left: 85%; animation-delay: 2s;">💵</div>
<div class="floating-money" style="top: 60%; left: 10%; animation-delay: 4s;">💸</div>
<div class="floating-money" style="top: 80%; left: 80%; animation-delay: 6s;">💎</div>
<div class="floating-money" style="top: 40%; left: 90%; animation-delay: 1s;">🤑</div>

<!-- Money Counter -->
<div class="money-counter">💰</div>

<div class="netflix-form-container">
    <h1 class="netflix-title">Tambah Uang Masuk</h1>
    <p class="form-subtitle">✨ Catat pemasukan Kas HMPS SI ✨</p>

    <form method="POST" action="{{ route('uangmasuk.store') }}" id="moneyForm">
        @csrf
        
        <div class="form-group">
            <label class="netflix-label">📅 Tanggal Pemasukan</label>
            <div class="input-wrapper">
                <input type="date" name="tanggal" class="netflix-input" required>
                <span class="input-icon">📅</span>
            </div>
        </div>

        <div class="form-group">
            <label class="netflix-label">💰 Jumlah Uang</label>
            <div class="input-group">
                <span class="currency-prefix">Rp</span>
                <input type="number" name="jumlah" class="netflix-input with-prefix" 
                       placeholder="Masukkan jumlah uang..." required min="1" step="1000">
                <span class="input-icon">💵</span>
            </div>
        </div>

        <div class="form-group">
            <label class="netflix-label">📝 Keterangan</label>
            <div class="input-wrapper">
                <input type="text" name="keterangan" class="netflix-input" 
                       placeholder="Dari mana uang ini berasal..." required maxlength="255">
                <span class="input-icon">📋</span>
            </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 2rem;">
            <a href="{{ url()->previous() }}" class="netflix-btn back-btn">
                ← Kembali ke Administrasi
            </a>
            <button type="submit" class="netflix-btn" style="flex: 1;">
                💾 Simpan Uang Masuk
            </button>
        </div>
    </form>
</div>

<script>
    // Form Enhancement Script
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('moneyForm');
        const inputs = document.querySelectorAll('.netflix-input');
        
        // Add floating label effect
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
                
                // Add sparkle effect
                createSparkles(this);
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
            
            // Auto-format number input
            if (input.type === 'number') {
                input.addEventListener('input', function() {
                    // Format number with thousand separators
                    let value = this.value.replace(/\D/g, '');
                    if (value) {
                        // Update placeholder to show formatted number
                        this.setAttribute('data-formatted', 'Rp ' + parseInt(value).toLocaleString('id-ID'));
                    }
                });
            }
        });
        
        // Form submission with animation
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '⏳ Menyimpan...';
            submitBtn.style.background = 'linear-gradient(45deg, #ffc107, #fd7e14)';
            
            // Add success animation
            setTimeout(() => {
                submitBtn.innerHTML = '✅ Berhasil Disimpan!';
                submitBtn.style.background = 'linear-gradient(45deg, #28a745, #20c997)';
            }, 1000);
        });
        
        // Create sparkle effect
        function createSparkles(element) {
            const rect = element.getBoundingClientRect();
            for (let i = 0; i < 5; i++) {
                const sparkle = document.createElement('div');
                sparkle.innerHTML = '✨';
                sparkle.style.position = 'fixed';
                sparkle.style.left = (rect.left + Math.random() * rect.width) + 'px';
                sparkle.style.top = (rect.top + Math.random() * rect.height) + 'px';
                sparkle.style.color = '#28a745';
                sparkle.style.fontSize = '1rem';
                sparkle.style.pointerEvents = 'none';
                sparkle.style.zIndex = '1000';
                sparkle.style.animation = 'sparkle-fade 1s ease-out forwards';
                
                document.body.appendChild(sparkle);
                
                setTimeout(() => {
                    document.body.removeChild(sparkle);
                }, 1000);
            }
        }
        
        // Auto-set today's date
        const dateInput = document.querySelector('input[type="date"]');
        if (dateInput && !dateInput.value) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
        }
    });
    
    // Add sparkle animation CSS
    const sparkleStyle = document.createElement('style');
    sparkleStyle.textContent = `
        @keyframes sparkle-fade {
            0% {
                opacity: 1;
                transform: scale(0) rotate(0deg);
            }
            50% {
                opacity: 1;
                transform: scale(1) rotate(180deg);
            }
            100% {
                opacity: 0;
                transform: scale(0.5) rotate(360deg) translateY(-20px);
            }
        }
        
        .focused .input-icon {
            animation: icon-bounce 0.6s ease;
        }
        
        @keyframes icon-bounce {
            0%, 100% { transform: translateY(-50%) scale(1); }
            50% { transform: translateY(-50%) scale(1.3) rotate(10deg); }
        }
    `;
    document.head.appendChild(sparkleStyle);
</script>

@endsection