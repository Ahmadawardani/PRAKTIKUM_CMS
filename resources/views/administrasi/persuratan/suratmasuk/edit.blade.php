@extends('layouts.app')

@section('content')
<style>
    :root {
        --netflix-red: #e50914;
        --netflix-dark: #141414;
        --netflix-maroon: #8b0000;
        --netflix-light: #f5f5f1;
    }

    body {
        background: linear-gradient(135deg, var(--netflix-dark) 0%, #000 100%);
        color: var(--netflix-light);
        font-family: 'Netflix Sans', 'Helvetica Neue', Arial, sans-serif;
        min-height: 100vh;
        margin: 0;
        overflow-x: hidden;
    }

    /* Netflix Logo Inspired Header */
    .netflix-header {
        position: relative;
        text-align: center;
        margin-bottom: 3rem;
        padding: 1rem 0;
        background: linear-gradient(180deg, rgba(0,0,0,0.8) 0%, transparent 100%);
    }

    .netflix-logo {
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--netflix-red);
        text-shadow: 0 0 15px rgba(229, 9, 20, 0.7);
        letter-spacing: -2px;
        margin-bottom: 0.5rem;
    }

    .netflix-subtitle {
        font-size: 1.8rem;
        font-weight: 500;
        color: var(--netflix-light);
        margin-top: -1rem;
        letter-spacing: 2px;
        position: relative;
        display: inline-block;
    }

    .netflix-subtitle::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 4px;
        background: linear-gradient(90deg, transparent, var(--netflix-red), transparent);
        border-radius: 2px;
    }

    /* Form Container */
    .netflix-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        position: relative;
        perspective: 1000px;
    }

    .netflix-card {
        background: linear-gradient(145deg, rgba(20, 20, 20, 0.95), rgba(10, 10, 10, 0.95));
        border-radius: 15px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.05);
        position: relative;
        overflow: hidden;
        transform-style: preserve-3d;
        transition: transform 0.5s ease;
    }

    .netflix-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--netflix-maroon), var(--netflix-red), var(--netflix-maroon));
    }

    .netflix-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 30%, rgba(139, 0, 0, 0.15) 0%, transparent 50%);
        pointer-events: none;
    }

    /* Form Group Styling */
    .netflix-form-group {
        margin-bottom: 2.5rem;
        position: relative;
        transform-style: preserve-3d;
    }

    /* Label Styling */
    .netflix-label {
        display: block;
        font-size: 0.9rem;
        color: #b3b3b3;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        font-weight: 600;
        position: relative;
        padding-left: 30px;
    }

    .netflix-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: var(--netflix-red);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.7rem;
    }

    .netflix-label[for*="pengirim"]::before { content: '👤'; }
    .netflix-label[for*="perihal"]::before { content: '📋'; background-color: #e50914; }
    .netflix-label[for*="tanggal"]::before { content: '📅'; background-color: #b8070f; }

    /* Input Styling */
    .netflix-input {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        color: var(--netflix-light);
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 1;
    }

    .netflix-input:focus {
        outline: none;
        border-color: var(--netflix-red);
        box-shadow: 
            0 0 20px rgba(229, 9, 20, 0.3),
            inset 0 2px 10px rgba(0, 0, 0, 0.3);
        transform: translateY(-3px);
        background: linear-gradient(135deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    .netflix-input::placeholder {
        color: #666;
        font-style: italic;
    }

    /* Button Styling */
    .netflix-btn {
        padding: 1.2rem 3rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 1rem;
        z-index: 1;
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--netflix-maroon), var(--netflix-red));
        z-index: -1;
        transition: all 0.4s ease;
    }

    .netflix-btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
        z-index: -1;
    }

    .netflix-btn:hover::after {
        left: 100%;
    }

    .netflix-btn:hover::before {
        background: linear-gradient(135deg, var(--netflix-red), var(--netflix-maroon));
    }

    .netflix-btn-primary {
        color: white;
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
    }

    .netflix-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(229, 9, 20, 0.6);
    }

    .netflix-btn-icon {
        font-size: 1.2rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-form-container {
            padding: 1rem;
        }
        
        .netflix-logo {
            font-size: 2.5rem;
        }
        
        .netflix-subtitle {
            font-size: 1.3rem;
        }
        
        .netflix-card {
            padding: 2rem 1.5rem;
        }
    }

    /* Netflix Glow Effect */
    .netflix-glow {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(229, 9, 20, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .glow-1 {
        top: -100px;
        right: -100px;
    }

    .glow-2 {
        bottom: -50px;
        left: -50px;
    }

    /* Netflix Loading Animation */
    @keyframes netflix-pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.02); }
    }

    .netflix-card:hover {
        animation: netflix-pulse 3s infinite;
    }

    /* Netflix Floating Elements */
    .netflix-floating {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .floating-element {
        position: absolute;
        opacity: 0.05;
        background: var(--netflix-red);
        border-radius: 2px;
    }

    /* Netflix Footer */
    .netflix-footer {
        text-align: center;
        margin-top: 3rem;
        color: #777;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }

    /* Netflix 3D Effect on Hover */
    .netflix-card:hover {
        transform: rotateY(5deg) rotateX(2deg);
    }

    /* Netflix Input Animation */
    @keyframes netflix-input-glow {
        0%, 100% { box-shadow: 0 0 10px rgba(229, 9, 20, 0); }
        50% { box-shadow: 0 0 15px rgba(229, 9, 20, 0.3); }
    }

    .netflix-input:focus {
        animation: netflix-input-glow 2s infinite;
    }
</style>

<!-- Netflix Floating Elements Background -->
<div class="netflix-floating">
    <div class="floating-element" style="width: 100px; height: 3px; top: 20%; left: 10%; animation: float 15s linear infinite;"></div>
    <div class="floating-element" style="width: 150px; height: 3px; top: 40%; left: 70%; animation: float 20s linear infinite reverse;"></div>
    <div class="floating-element" style="width: 200px; height: 3px; top: 70%; left: 30%; animation: float 25s linear infinite;"></div>
    <div class="floating-element" style="width: 80px; height: 3px; top: 60%; left: 80%; animation: float 18s linear infinite reverse;"></div>
</div>

<!-- Netflix Glow Effects -->
<div class="netflix-glow glow-1"></div>
<div class="netflix-glow glow-2"></div>

<div class="netflix-form-container">
    <div class="netflix-header">
        <div class="netflix-logo">HMPS SI</div>
        <div class="netflix-subtitle">EDIT SURAT MASUK</div>
    </div>
    
    <div class="netflix-card">
        <form method="POST" action="{{ route('suratmasuk.update', $suratMasuk->id) }}">
            @csrf
            @method('PUT')
            <div class="netflix-form-group">
                <label class="netflix-label" for="pengirim">Pengirim</label>
                <input type="text" name="pengirim" class="netflix-input" value="{{ $suratMasuk->pengirim }}" required>
            </div>
            <div class="netflix-form-group">
                <label class="netflix-label" for="perihal">Perihal</label>
                <input type="text" name="perihal" class="netflix-input" value="{{ $suratMasuk->perihal }}" required>
            </div>
            <div class="netflix-form-group">
                <label class="netflix-label" for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="netflix-input" value="{{ $suratMasuk->tanggal }}" required>
            </div>
            <button type="submit" class="netflix-btn netflix-btn-primary">
                <span class="netflix-btn-icon">✏️</span> PERBARUI DATA
            </button>
        </form>
    </div>
    
    <div class="netflix-footer">
        NETFLIX ADMIN PANEL © {{ date('Y') }} | SURAT MASUK MANAGEMENT SYSTEM
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const formGroups = document.querySelectorAll('.netflix-form-group');
    const netflixCard = document.querySelector('.netflix-card');
    
    // Initial state for animations
    netflixCard.style.opacity = '0';
    netflixCard.style.transform = 'translateY(50px) rotateX(20deg)';
    
    setTimeout(() => {
        netflixCard.style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        netflixCard.style.opacity = '1';
        netflixCard.style.transform = 'translateY(0) rotateX(0)';
    }, 300);
    
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.6s ease';
            group.style.opacity = '1';
            group.style.transform = 'translateX(0)';
        }, index * 200 + 800);
    });
    
    // Dynamic glow effect follow mouse
    const glow1 = document.querySelector('.glow-1');
    const glow2 = document.querySelector('.glow-2');
    
    document.addEventListener('mousemove', (e) => {
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        
        glow1.style.transform = `translate(${x * 50}px, ${y * 50}px)`;
        glow2.style.transform = `translate(${-x * 30}px, ${-y * 30}px)`;
    });
    
    // Input validation effects
    const inputs = document.querySelectorAll('.netflix-input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.style.borderColor = '#28a745';
                this.parentElement.style.transform = 'translateZ(20px)';
            } else {
                this.style.borderColor = 'rgba(255, 255, 255, 0.05)';
                this.parentElement.style.transform = 'translateZ(0)';
            }
        });
        
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateZ(30px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateZ(0)';
        });
    });
    
    // Create floating elements dynamically
    function createFloatingElement() {
        const floatingContainer = document.querySelector('.netflix-floating');
        const element = document.createElement('div');
        element.className = 'floating-element';
        
        const size = Math.random() * 4 + 1;
        const duration = Math.random() * 20 + 10;
        const delay = Math.random() * 5;
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        
        element.style.width = `${Math.random() * 200 + 50}px`;
        element.style.height = `${size}px`;
        element.style.top = `${posY}%`;
        element.style.left = `${posX}%`;
        element.style.animation = `float ${duration}s linear ${delay}s infinite`;
        element.style.opacity = Math.random() * 0.1 + 0.05;
        element.style.background = `linear-gradient(90deg, transparent, var(--netflix-red), transparent)`;
        
        if (Math.random() > 0.5) {
            element.style.animationDirection = 'reverse';
        }
        
        floatingContainer.appendChild(element);
        
        setTimeout(() => {
            element.remove();
        }, duration * 1000 + delay * 1000);
    }
    
    // Create initial floating elements
    for (let i = 0; i < 5; i++) {
        setTimeout(createFloatingElement, i * 2000);
    }
    
    // Periodically add new floating elements
    setInterval(createFloatingElement, 3000);
    
    // Button hover effect enhancement
    const button = document.querySelector('.netflix-btn');
    button.addEventListener('mouseenter', () => {
        button.style.transform = 'translateY(-5px) scale(1.05)';
    });
    
    button.addEventListener('mouseleave', () => {
        button.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection