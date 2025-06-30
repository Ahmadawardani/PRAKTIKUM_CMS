@extends('layouts.app')

@section('content')
<style>
    :root {
        --netflix-red: #e50914;
        --netflix-maroon: #8b0000;
        --netflix-dark: #141414;
        --netflix-darker: #0a0a0a;
        --netflix-light: #f5f5f1;
        --netflix-gray: #b3b3b3;
    }

    body {
        background: linear-gradient(135deg, var(--netflix-dark), var(--netflix-darker));
        color: var(--netflix-light);
        font-family: 'Netflix Sans', 'Helvetica Neue', Arial, sans-serif;
        min-height: 100vh;
        margin: 0;
        overflow-x: hidden;
    }

    /* Netflix Header Style */
    .netflix-edit-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .netflix-edit-title {
        font-size: 2.8rem;
        font-weight: 900;
        background: linear-gradient(45deg, var(--netflix-maroon), var(--netflix-red), var(--netflix-maroon));
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s ease infinite;
        text-shadow: 0 0 20px rgba(229, 9, 20, 0.3);
        letter-spacing: -1px;
        margin-bottom: 0.5rem;
    }

    .netflix-edit-subtitle {
        font-size: 1.2rem;
        color: var(--netflix-gray);
        letter-spacing: 3px;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
    }

    .netflix-edit-subtitle::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--netflix-red), transparent);
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Form Container */
    .netflix-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        position: relative;
    }

    /* Form Card */
    .netflix-form-card {
        background: linear-gradient(145deg, rgba(30, 30, 30, 0.95), rgba(15, 15, 15, 0.95));
        border-radius: 12px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.03);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .netflix-form-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);
    }

    .netflix-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--netflix-maroon), var(--netflix-red), var(--netflix-maroon));
    }

    /* Form Elements */
    .netflix-form-group {
        margin-bottom: 2.5rem;
        position: relative;
    }

    .netflix-form-label {
        display: block;
        font-size: 0.9rem;
        color: var(--netflix-gray);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        font-weight: 600;
        position: relative;
        padding-left: 30px;
        transition: all 0.3s ease;
    }

    .netflix-form-label::before {
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
        transition: all 0.3s ease;
    }

    .netflix-form-label[for="tujuan"]::before { content: '📍'; background-color: #b8070f; }
    .netflix-form-label[for="perihal"]::before { content: '📝'; background-color: #e50914; }
    .netflix-form-label[for="tanggal"]::before { content: '📅'; background-color: #8b0000; }

    .netflix-form-input {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        color: var(--netflix-light);
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .netflix-form-input:focus {
        outline: none;
        border-color: var(--netflix-red);
        box-shadow: 
            0 0 20px rgba(229, 9, 20, 0.3),
            inset 0 2px 10px rgba(0, 0, 0, 0.4);
        transform: translateY(-2px);
        background: linear-gradient(135deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    /* Button Styling */
    .netflix-submit-btn {
        padding: 1.2rem 3rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
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
        color: white;
        background: linear-gradient(135deg, var(--netflix-maroon), var(--netflix-red));
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
    }

    .netflix-submit-btn::before {
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

    .netflix-submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(229, 9, 20, 0.6);
    }

    .netflix-submit-btn:hover::before {
        left: 100%;
    }

    /* Background Elements */
    .netflix-bg-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .netflix-bg-element {
        position: absolute;
        background: linear-gradient(90deg, transparent, var(--netflix-red), transparent);
        opacity: 0.05;
        animation: float 15s linear infinite;
    }

    @keyframes float {
        0% { transform: translateY(100vh) translateX(-50px); }
        100% { transform: translateY(-100px) translateX(50px); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-form-container {
            padding: 1rem;
        }
        
        .netflix-edit-title {
            font-size: 2rem;
        }
        
        .netflix-edit-subtitle {
            font-size: 1rem;
        }
        
        .netflix-form-card {
            padding: 2rem 1.5rem;
        }
    }

    /* Form Validation Effects */
    .netflix-form-input:valid {
        border-color: rgba(255, 255, 255, 0.15);
    }

    .netflix-form-group:focus-within .netflix-form-label {
        color: var(--netflix-light);
        transform: translateX(5px);
    }

    .netflix-form-group:focus-within .netflix-form-label::before {
        transform: translateY(-50%) scale(1.1);
    }
</style>

<!-- Background Elements -->
<div class="netflix-bg-elements">
    <div class="netflix-bg-element" style="width: 200px; height: 2px; top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="netflix-bg-element" style="width: 150px; height: 2px; top: 40%; left: 70%; animation-delay: 3s; animation-duration: 20s;"></div>
    <div class="netflix-bg-element" style="width: 250px; height: 2px; top: 70%; left: 30%; animation-delay: 6s; animation-duration: 25s;"></div>
</div>

<div class="netflix-form-container">
    <div class="netflix-edit-header">
        <h1 class="netflix-edit-title">EDIT SURAT KELUAR</h1>
        <div class="netflix-edit-subtitle">Update Dokumen Resmi</div>
    </div>
    
    <form method="POST" action="{{ route('suratkeluar.update', $suratKeluar->id) }}" class="netflix-form-card">
        @csrf
        @method('PUT')
        <div class="netflix-form-group">
            <label class="netflix-form-label" for="tujuan">Tujuan</label>
            <input type="text" name="tujuan" class="netflix-form-input" value="{{ $suratKeluar->tujuan }}" required>
        </div>
        <div class="netflix-form-group">
            <label class="netflix-form-label" for="perihal">Perihal</label>
            <input type="text" name="perihal" class="netflix-form-input" value="{{ $suratKeluar->perihal }}" required>
        </div>
        <div class="netflix-form-group">
            <label class="netflix-form-label" for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="netflix-form-input" value="{{ $suratKeluar->tanggal }}" required>
        </div>
        <button type="submit" class="netflix-submit-btn">
            <span>💾</span> PERBARUI SURAT
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const formCard = document.querySelector('.netflix-form-card');
    const formGroups = document.querySelectorAll('.netflix-form-group');
    
    // Initial state
    formCard.style.opacity = '0';
    formCard.style.transform = 'translateY(30px)';
    
    setTimeout(() => {
        formCard.style.transition = 'all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
        formCard.style.opacity = '1';
        formCard.style.transform = 'translateY(0)';
    }, 300);
    
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.5s ease';
            group.style.opacity = '1';
            group.style.transform = 'translateX(0)';
        }, index * 150 + 600);
    });
    
    // Create dynamic background elements
    function createBgElement() {
        const container = document.querySelector('.netflix-bg-elements');
        const element = document.createElement('div');
        element.className = 'netflix-bg-element';
        
        const width = Math.random() * 200 + 100;
        const duration = Math.random() * 15 + 10;
        const delay = Math.random() * 5;
        const left = Math.random() * 100;
        
        element.style.width = `${width}px`;
        element.style.height = `${Math.random() * 3 + 1}px`;
        element.style.top = `${Math.random() * 100 + 100}%`;
        element.style.left = `${left}%`;
        element.style.animation = `float ${duration}s linear ${delay}s infinite`;
        element.style.opacity = Math.random() * 0.05 + 0.03;
        
        container.appendChild(element);
        
        setTimeout(() => {
            element.remove();
        }, (duration + delay) * 1000);
    }
    
    // Create initial elements
    for (let i = 0; i < 5; i++) {
        setTimeout(createBgElement, i * 2000);
    }
    
    // Create elements periodically
    setInterval(createBgElement, 3000);
    
    // Input focus effects
    const inputs = document.querySelectorAll('.netflix-form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('.netflix-form-label').style.color = 'var(--netflix-light)';
            this.parentElement.querySelector('.netflix-form-label::before').style.transform = 'scale(1.1)';
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.querySelector('.netflix-form-label').style.color = 'var(--netflix-gray)';
            }
        });
    });
    
    // Button hover effect
    const submitBtn = document.querySelector('.netflix-submit-btn');
    submitBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-3px) scale(1.03)';
    });
    
    submitBtn.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection