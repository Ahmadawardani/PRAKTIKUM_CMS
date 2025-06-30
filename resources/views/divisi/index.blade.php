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

    .netflix-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
    }

    /* Header Section */
    .netflix-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
        padding: 3rem 0;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(139, 0, 0, 0.05));
        border-radius: 20px;
        border: 1px solid rgba(229, 9, 20, 0.2);
        overflow: hidden;
    }

    .netflix-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 20%, rgba(229, 9, 20, 0.2) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(184, 7, 15, 0.15) 0%, transparent 50%);
        animation: headerGlow 6s ease-in-out infinite alternate;
    }

    @keyframes headerGlow {
        0% { opacity: 0.5; transform: scale(1); }
        100% { opacity: 1; transform: scale(1.02); }
    }

    .netflix-title {
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #e50914, #cc0812);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleGradient 4s ease-in-out infinite;
        text-shadow: 0 0 40px rgba(229, 9, 20, 0.6);
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    @keyframes titleGradient {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .netflix-subtitle {
        font-size: 1.4rem;
        color: #b3b3b3;
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
    }

    .add-divisi-btn {
        background: linear-gradient(135deg, #e50914, #cc0812);
        border: none;
        padding: 15px 35px;
        border-radius: 12px;
        color: white;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
        font-size: 1.1rem;
        position: relative;
        z-index: 2;
        overflow: hidden;
    }

    .add-divisi-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .add-divisi-btn:hover::before {
        left: 100%;
    }

    .add-divisi-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 35px rgba(229, 9, 20, 0.6);
        color: white;
        text-decoration: none;
    }

    /* Divisi Grid */
    .divisi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .divisi-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        cursor: pointer;
    }

    .divisi-card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.8);
        border-color: rgba(229, 9, 20, 0.5);
    }

    .divisi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
    }

    .divisi-card:hover::before {
        opacity: 1;
    }

    .divisi-header {
        background: linear-gradient(135deg, #e50914, #b8070f, #8b0000);
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .divisi-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%),
            linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.05) 50%, transparent 70%);
        transform: rotate(45deg);
        transition: transform 0.8s ease;
    }

    .divisi-card:hover .divisi-header::before {
        transform: rotate(45deg) translate(30px, 30px);
    }

    .divisi-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 240, 240, 0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        z-index: 2;
    }

    .divisi-name {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .divisi-description {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        position: relative;
        z-index: 2;
    }

    .divisi-body {
        padding: 2rem;
        position: relative;
        z-index: 2;
    }

    .member-count {
        background: linear-gradient(135deg, #333, #2a2a2a);
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 25px;
        font-size: 1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 2rem;
        border: 1px solid #444;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .member-count-number {
        background: linear-gradient(135deg, #e50914, #cc0812);
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .divisi-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        min-width: 90px;
        padding: 12px 16px;
        border: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .btn-view {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #212529;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-view:hover { 
        box-shadow: 0 6px 15px rgba(23, 162, 184, 0.4); 
        color: white;
    }
    .btn-edit:hover { 
        box-shadow: 0 6px 15px rgba(255, 193, 7, 0.4); 
        color: #212529;
    }
    .btn-delete:hover { 
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4); 
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 6rem 2rem;
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.8), rgba(13, 13, 13, 0.8));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        margin-top: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .empty-icon {
        font-size: 5rem;
        color: #666;
        margin-bottom: 2rem;
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }

    .empty-text {
        font-size: 1.5rem;
        color: #b3b3b3;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .empty-subtext {
        color: #666;
        font-size: 1rem;
    }

    /* Stats Section */
    .stats-section {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        backdrop-filter: blur(10px);
        padding: 1.5rem;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(229, 9, 20, 0.2);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: #e50914;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #b3b3b3;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-title {
            font-size: 2.5rem;
        }
        
        .divisi-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .netflix-container {
            padding: 1rem;
        }
        
        .divisi-actions {
            flex-direction: column;
        }
        
        .action-btn {
            flex: none;
        }
        
        .stats-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Loading Animation */
    .loading-animation {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="netflix-container">
    <div class="netflix-header">
        <h1 class="netflix-title">DIVISI</h1>
        <p class="netflix-subtitle">Kelola dan organisir departemen dengan mudah</p>
        <a href="{{ route('divisi.create') }}" class="add-divisi-btn">
            <span>➕</span>
            Tambah Divisi Baru
        </a>
    </div>

    @if($divisis->count() > 0)
        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stat-card">
                <div class="stat-number">{{ $divisis->count() }}</div>
                <div class="stat-label">Total Divisi</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $divisis->sum('anggotas_count') }}</div>
                <div class="stat-label">Total Anggota</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ number_format($divisis->avg('anggotas_count'), 1) }}</div>
                <div class="stat-label">Rata-rata per Divisi</div>
            </div>
        </div>

        <div class="divisi-grid">
            @foreach($divisis as $index => $divisi)
            <div class="divisi-card loading-animation" style="animation-delay: {{ $index * 0.1 }}s">
                <div class="divisi-header">
                    <div class="divisi-icon">
                        @php
                            $icons = ['🏢', '💼', '🎯', '⚡', '🚀', '💡', '🔧', '📊', '🎨', '📱'];
                            echo $icons[$index % count($icons)];
                        @endphp
                    </div>
                    <h3 class="divisi-name">{{ $divisi->nama_divisi }}</h3>
                    <p class="divisi-description">Departemen Organisasi</p>
                </div>
                
                <div class="divisi-body">
                    <div class="member-count">
                        <span>👥 Anggota:</span>
                        <span class="member-count-number">{{ $divisi->anggotas_count }}</span>
                    </div>
                    
                    <div class="divisi-actions">
                        <a href="{{ route('divisi.show', $divisi->id) }}" class="action-btn btn-view">
                            👁️ Lihat
                        </a>
                        <a href="{{ route('divisi.edit', $divisi->id) }}" class="action-btn btn-edit">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('divisi.destroy', $divisi->id) }}" method="POST" style="display:inline; flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('🚨 Yakin hapus divisi ini?')" class="action-btn btn-delete" style="width: 100%;">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">🏢</div>
            <h3 class="empty-text">Belum ada divisi</h3>
            <p class="empty-subtext">Buat divisi pertama untuk mengorganisir anggota</p>
        </div>
    @endif
</div>

<script>
// Add entrance animation
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.divisi-card');
    
    // Stagger animation for cards
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('loading-animation');
        }, index * 100);
    });
    
    // Add hover sound effect simulation
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });
});

// Add dynamic icon rotation on hover
document.querySelectorAll('.divisi-icon').forEach(icon => {
    icon.addEventListener('mouseenter', function() {
        this.style.transform = 'rotate(360deg) scale(1.1)';
        this.style.transition = 'transform 0.6s ease';
    });
    
    icon.addEventListener('mouseleave', function() {
        this.style.transform = 'rotate(0deg) scale(1)';
    });
});

// Add click ripple effect
document.querySelectorAll('.action-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        const ripple = document.createElement('div');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255, 255, 255, 0.6)';
        ripple.style.transform = 'scale(0)';
        ripple.style.animation = 'ripple 0.6s linear';
        ripple.style.pointerEvents = 'none';
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add ripple animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection