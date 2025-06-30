@extends('layouts.app')

@section('content')
<style>
    /* Netflix Dark Theme */
    body {
        background: linear-gradient(135deg, #0f0404 0%, #1a0707 25%, #2d0a0a 50%, #1a0707 75%, #000000 100%);
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
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
        background: 
            radial-gradient(circle at 20% 80%, rgba(220, 53, 69, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(139, 0, 0, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(220, 53, 69, 0.05) 0%, transparent 50%);
        z-index: -1;
        animation: bg-shift 10s ease-in-out infinite;
    }

    @keyframes bg-shift {
        0%, 100% { transform: translateX(0) translateY(0); }
        25% { transform: translateX(-10px) translateY(-5px); }
        50% { transform: translateX(10px) translateY(10px); }
        75% { transform: translateX(-5px) translateY(5px); }
    }

    .mail-container {
        background: rgba(0, 0, 0, 0.85);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        padding: 3rem;
        margin: 2rem auto;
        max-width: 95%;
        box-shadow: 
            0 25px 50px rgba(220, 53, 69, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        border: 2px solid transparent;
        background-clip: padding-box;
        position: relative;
        overflow: hidden;
    }

    .mail-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, #dc3545, #8b0000, #dc3545, #2d0a0a);
        background-size: 400% 400%;
        border-radius: 25px;
        z-index: -1;
        animation: gradient-border 6s ease infinite;
        opacity: 0.3;
    }

    @keyframes gradient-border {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .netflix-title {
        font-size: 3.5rem;
        font-weight: 900;
        text-align: center;
        margin-bottom: 3rem;
        background: linear-gradient(45deg, #dc3545, #ff6b6b, #8b0000, #dc3545);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: title-glow 4s ease infinite;
        text-shadow: 0 0 40px rgba(220, 53, 69, 0.6);
        position: relative;
    }

    .netflix-title::after {
        content: '📧';
        position: absolute;
        right: -80px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 2.5rem;
        animation: mail-bounce 2s ease-in-out infinite;
    }

    @keyframes title-glow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes mail-bounce {
        0%, 100% { transform: translateY(-50%) rotate(0deg); }
        50% { transform: translateY(-60%) rotate(10deg); }
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin: 3rem 0;
    }

    .stat-card {
        background: linear-gradient(135deg, #8b0000 0%, #dc3545 50%, #ff6b6b 100%);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 15px 35px rgba(220, 53, 69, 0.4);
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 2px solid rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: rotate(45deg);
        transition: all 0.5s;
        opacity: 0;
    }

    .stat-card:hover::before {
        animation: shine 0.8s ease-in-out;
    }

    @keyframes shine {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); opacity: 0; }
    }

    .stat-card:hover {
        transform: translateY(-15px) scale(1.05);
        box-shadow: 0 25px 50px rgba(220, 53, 69, 0.6);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        display: block;
        animation: icon-pulse 2s ease-in-out infinite;
    }

    @keyframes icon-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        justify-content: center;
        margin: 3rem 0;
    }

    .netflix-btn {
        background: linear-gradient(45deg, #dc3545, #8b0000);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 12px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .netflix-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 12px 30px rgba(220, 53, 69, 0.6);
        color: white;
        text-decoration: none;
    }

    .netflix-btn.btn-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }

    .netflix-btn.btn-success:hover {
        box-shadow: 0 12px 30px rgba(40, 167, 69, 0.6);
    }

    .netflix-btn.btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
    }

    .netflix-btn.btn-primary:hover {
        box-shadow: 0 12px 30px rgba(0, 123, 255, 0.6);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 3rem 0 2rem 0;
        padding-bottom: 1rem;
        border-bottom: 3px solid;
        border-image: linear-gradient(90deg, #dc3545, transparent) 1;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #dc3545;
        text-shadow: 0 0 20px rgba(220, 53, 69, 0.5);
        margin: 0;
    }

    .section-icon {
        font-size: 2rem;
        animation: section-icon-rotate 3s linear infinite;
    }

    @keyframes section-icon-rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .mail-table-container {
        background: rgba(0, 0, 0, 0.8);
        border-radius: 20px;
        overflow: hidden;
        margin: 2rem 0;
        border: 2px solid rgba(220, 53, 69, 0.3);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.6);
        position: relative;
    }

    .mail-table-container::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #dc3545, #8b0000, #dc3545);
        border-radius: 22px;
        z-index: -1;
        animation: table-glow 3s linear infinite;
        opacity: 0.6;
    }

    @keyframes table-glow {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.8; }
    }

    .mail-table {
        width: 100%;
        border-collapse: collapse;
        color: white;
    }

    .mail-table th {
        background: linear-gradient(45deg, #8b0000, #dc3545, #ff6b6b);
        padding: 1.5rem 1rem;
        text-align: left;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 1rem;
        border-bottom: 3px solid rgba(220, 53, 69, 0.6);
        position: relative;
    }

    .mail-table th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #fff, transparent);
        animation: header-shine 2s ease-in-out infinite;
    }

    @keyframes header-shine {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    .mail-table td {
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(220, 53, 69, 0.2);
        transition: all 0.3s ease;
        position: relative;
    }

    .mail-table tbody tr {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .mail-table tbody tr:hover {
        background: linear-gradient(90deg, rgba(220, 53, 69, 0.1), rgba(220, 53, 69, 0.2), rgba(220, 53, 69, 0.1));
        transform: scale(1.02);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .mail-table tbody tr:hover td {
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    .table-btn {
        background: linear-gradient(45deg, #dc3545, #8b0000);
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: bold;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        margin: 0 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .table-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4);
        color: white;
        text-decoration: none;
    }

    .table-btn.btn-warning {
        background: linear-gradient(45deg, #ffc107, #e0a800);
    }

    .table-btn.btn-warning:hover {
        box-shadow: 0 6px 15px rgba(255, 193, 7, 0.4);
    }

    .table-btn.btn-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.2rem;
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
        animation: empty-float 3s ease-in-out infinite;
    }

    @keyframes empty-float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    @media (max-width: 768px) {
        .netflix-title { 
            font-size: 2.5rem; 
        }
        
        .netflix-title::after {
            right: -50px;
            font-size: 2rem;
        }
        
        .mail-container { 
            padding: 2rem 1rem; 
            margin: 1rem; 
        }
        
        .stats-cards { 
            grid-template-columns: 1fr; 
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .mail-table {
            font-size: 0.9rem;
        }
        
        .mail-table th,
        .mail-table td {
            padding: 1rem 0.5rem;
        }
    }

    /* Floating Animation */
    .floating {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Loading animation */
    .mail-container {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.8s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="mail-container">
    <h1 class="netflix-title floating">DASHBOARD PERSURATAN</h1>

    {{-- Statistics Cards --}}
    <div class="stats-cards">
        <div class="stat-card">
            <span class="stat-icon">📥</span>
            <div class="stat-number">{{ count($masuk) }}</div>
            <div class="stat-label">Surat Masuk</div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📤</span>
            <div class="stat-number">{{ count($keluar) }}</div>
            <div class="stat-label">Surat Keluar</div>
        </div>
        <div class="stat-card">
            <span class="stat-icon">📊</span>
            <div class="stat-number">{{ count($masuk) + count($keluar) }}</div>
            <div class="stat-label">Total Surat</div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="action-buttons">
        <a href="{{ route('suratmasuk.create') }}" class="netflix-btn btn-success">
            <span>📥</span> Tambah Surat Masuk
        </a>
        <a href="{{ route('suratkeluar.create') }}" class="netflix-btn btn-primary">
            <span>📤</span> Tambah Surat Keluar
        </a>
    </div>

    {{-- Surat Masuk Section --}}
    <div class="section-header">
        <span class="section-icon">📥</span>
        <h3 class="section-title">Surat Masuk</h3>
    </div>
    
    <div class="mail-table-container">
        @if(count($masuk) > 0)
            <table class="mail-table">
                <thead>
                    <tr>
                        <th>👤 Pengirim</th>
                        <th>📋 Perihal</th>
                        <th>📅 Tanggal</th>
                        <th>⚡ Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($masuk as $s)
                        <tr>
                            <td><strong>{{ $s->pengirim }}</strong></td>
                            <td>{{ $s->perihal }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('suratmasuk.edit', $s->id) }}" class="table-btn btn-warning">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('suratmasuk.destroy', $s->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="table-btn btn-danger" onclick="return confirm('🗑️ Hapus surat ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div>Belum ada surat masuk</div>
            </div>
        @endif
    </div>

    {{-- Surat Keluar Section --}}
    <div class="section-header">
        <span class="section-icon">📤</span>
        <h3 class="section-title">Surat Keluar</h3>
    </div>
    
    <div class="mail-table-container">
        @if(count($keluar) > 0)
            <table class="mail-table">
                <thead>
                    <tr>
                        <th>🎯 Tujuan</th>
                        <th>📋 Perihal</th>
                        <th>📅 Tanggal</th>
                        <th>⚡ Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keluar as $s)
                        <tr>
                            <td><strong>{{ $s->tujuan }}</strong></td>
                            <td>{{ $s->perihal }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('suratkeluar.edit', $s->id) }}" class="table-btn btn-warning">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('suratkeluar.destroy', $s->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="table-btn btn-danger" onclick="return confirm('🗑️ Hapus surat ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <div>Belum ada surat keluar</div>
            </div>
        @endif
    </div>
</div>

<script>
    // Enhanced interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Add ripple effect to buttons
        document.querySelectorAll('.netflix-btn, .table-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                let ripple = document.createElement('span');
                let rect = this.getBoundingClientRect();
                let size = Math.max(rect.width, rect.height);
                let x = e.clientX - rect.left - size / 2;
                let y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Animate statistics on scroll
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });

        // Auto-refresh statistics every 30 seconds
        setInterval(() => {
            document.querySelectorAll('.stat-number').forEach(stat => {
                stat.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    stat.style.transform = 'scale(1)';
                }, 200);
            });
        }, 30000);
    });
</script>

<style>
    /* Ripple Effect */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>

@endsection