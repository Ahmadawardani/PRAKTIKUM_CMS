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
        --netflix-green: #00b894;
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
    .netflix-income-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        padding-top: 2rem;
    }

    .netflix-income-title {
        font-size: 2.8rem;
        font-weight: 900;
        background: linear-gradient(45deg, var(--netflix-green), #55efc4, var(--netflix-green));
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s ease infinite;
        text-shadow: 0 0 20px rgba(0, 184, 148, 0.3);
        letter-spacing: -1px;
        margin-bottom: 0.5rem;
    }

    .netflix-income-subtitle {
        font-size: 1.2rem;
        color: var(--netflix-gray);
        letter-spacing: 3px;
        text-transform: uppercase;
        position: relative;
        display: inline-block;
    }

    .netflix-income-subtitle::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--netflix-green), transparent);
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Form Container */
    .netflix-income-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
        position: relative;
    }

    /* Form Card */
    .netflix-income-card {
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

    .netflix-income-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6);
    }

    .netflix-income-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--netflix-green), #55efc4, var(--netflix-green));
    }

    /* Form Elements */
    .netflix-income-group {
        margin-bottom: 2.5rem;
        position: relative;
    }

    .netflix-income-label {
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

    .netflix-income-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: var(--netflix-green);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.7rem;
        transition: all 0.3s ease;
    }

    .netflix-income-label[for="tanggal"]::before { content: '📅'; background-color: #00a884; }
    .netflix-income-label[for="jumlah"]::before { content: '💰'; background-color: #00b894; }
    .netflix-income-label[for="keterangan"]::before { content: '📝'; background-color: #008b74; }

    .netflix-income-input {
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

    .netflix-income-input:focus {
        outline: none;
        border-color: var(--netflix-green);
        box-shadow: 
            0 0 20px rgba(0, 184, 148, 0.3),
            inset 0 2px 10px rgba(0, 0, 0, 0.4);
        transform: translateY(-2px);
        background: linear-gradient(135deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    /* Button Styling */
    .netflix-income-btn {
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
        background: linear-gradient(135deg, var(--netflix-green), #55efc4);
        box-shadow: 0 8px 25px rgba(0, 184, 148, 0.4);
    }

    .netflix-income-btn::before {
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

    .netflix-income-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 184, 148, 0.6);
    }

    .netflix-income-btn:hover::before {
        left: 100%;
    }

    /* Background Elements */
    .netflix-income-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .netflix-income-element {
        position: absolute;
        background: linear-gradient(90deg, transparent, var(--netflix-green), transparent);
        opacity: 0.05;
        animation: float 15s linear infinite;
    }

    @keyframes float {
        0% { transform: translateY(100vh) translateX(-50px); }
        100% { transform: translateY(-100px) translateX(50px); }
    }

    /* Currency Input Style */
    .netflix-income-input[type="number"] {
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8)) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2300b894' viewBox='0 0 16 16'%3E%3Cpath d='M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z'/%3E%3C/svg%3E") no-repeat 15px center;
        padding-left: 45px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-income-container {
            padding: 1rem;
        }
        
        .netflix-income-title {
            font-size: 2rem;
        }
        
        .netflix-income-subtitle {
            font-size: 1rem;
        }
        
        .netflix-income-card {
            padding: 2rem 1.5rem;
        }
    }
</style>

<!-- Background Elements -->
<div class="netflix-income-bg">
    <div class="netflix-income-element" style="width: 200px; height: 2px; top: 20%; left: 10%; animation-delay: 0s;"></div>
    <div class="netflix-income-element" style="width: 150px; height: 2px; top: 40%; left: 70%; animation-delay: 3s; animation-duration: 20s;"></div>
    <div class="netflix-income-element" style="width: 250px; height: 2px; top: 70%; left: 30%; animation-delay: 6s; animation-duration: 25s;"></div>
</div>

<div class="netflix-income-container">
    <div class="netflix-income-header">
        <h1 class="netflix-income-title">EDIT UANG MASUK</h1>
        <div class="netflix-income-subtitle">Update Catatan Pemasukan</div>
    </div>
    
    <form method="POST" action="{{ route('uangmasuk.update', $uangMasuk->id) }}" class="netflix-income-card">
        @csrf
        @method('PUT')
        <div class="netflix-income-group">
            <label class="netflix-income-label" for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="netflix-income-input" value="{{ $uangMasuk->tanggal }}" required>
        </div>
        <div class="netflix-income-group">
            <label class="netflix-income-label" for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" class="netflix-income-input" value="{{ $uangMasuk->jumlah }}" required step="0.01" min="0">
        </div>
        <div class="netflix-income-group">
            <label class="netflix-income-label" for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="netflix-income-input" value="{{ $uangMasuk->keterangan }}" required>
        </div>
        <button type="submit" class="netflix-income-btn">
            <span>💾</span> PERBARUI DATA
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const formCard = document.querySelector('.netflix-income-card');
    const formGroups = document.querySelectorAll('.netflix-income-group');
    
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
        const container = document.querySelector('.netflix-income-bg');
        const element = document.createElement('div');
        element.className = 'netflix-income-element';
        
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
    
    // Format currency input
    const amountInput = document.querySelector('input[name="jumlah"]');
    amountInput.addEventListener('blur', function() {
        if (this.value) {
            this.value = parseFloat(this.value).toFixed(2);
        }
    });
});
</script>
@endsection