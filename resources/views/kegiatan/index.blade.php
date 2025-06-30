@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #141414 0%, #0f0f0f 100%);
        color: #ffffff;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        min-height: 100vh;
        margin: 0;
    }

    .netflix-activities-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Header Section */
    .activities-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        padding: 2rem 0;
    }

    .activities-title {
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #ffa500, #e50914);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: activityGradient 4s ease-in-out infinite;
        text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
        margin-bottom: 1rem;
        letter-spacing: -2px;
    }

    @keyframes activityGradient {
        0%, 100% { background-position: 0% 50%; }
        25% { background-position: 100% 0%; }
        50% { background-position: 100% 100%; }
        75% { background-position: 0% 100%; }
    }

    .activities-subtitle {
        font-size: 1.3rem;
        color: #b3b3b3;
        margin-bottom: 2.5rem;
        font-weight: 300;
    }

    .add-activity-btn {
        background: linear-gradient(135deg, #e50914, #b8070f);
        border: none;
        padding: 15px 35px;
        border-radius: 10px;
        color: white;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        box-shadow: 0 6px 20px rgba(229, 9, 20, 0.4);
        font-size: 1.1rem;
        position: relative;
        overflow: hidden;
    }

    .add-activity-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .add-activity-btn:hover::before {
        left: 100%;
    }

    .add-activity-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 30px rgba(229, 9, 20, 0.6);
        color: white;
        text-decoration: none;
    }

    /* Activities Grid */
    .activities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .activity-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        cursor: pointer;
        height: 320px;
    }

    .activity-card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.6),
            0 0 30px rgba(229, 9, 20, 0.3);
        border-color: rgba(229, 9, 20, 0.6);
    }

    .activity-card::before {
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

    .activity-card:hover::before {
        opacity: 1;
    }

    /* Activity Header */
    .activity-header {
        background: linear-gradient(135deg, #e50914, #b8070f, #8b0000);
        padding: 2rem;
        position: relative;
        overflow: hidden;
        height: 140px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .activity-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
        animation: headerRotate 8s linear infinite;
    }

    @keyframes headerRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .activity-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .activity-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        margin: 0;
        position: relative;
        z-index: 2;
        text-align: center;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        line-height: 1.2;
    }

    /* Activity Body */
    .activity-body {
        padding: 1.5rem 2rem;
        position: relative;
        z-index: 2;
        height: calc(100% - 140px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .activity-info {
        margin-bottom: 1.5rem;
    }

    .activity-date {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
        color: #b3b3b3;
        margin-bottom: 1rem;
        font-weight: 500;
    }

    .activity-participants {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1rem;
        color: #ffffff;
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.2), rgba(32, 201, 151, 0.2));
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid rgba(40, 167, 69, 0.3);
        display: inline-flex;
        width: fit-content;
    }

    .participants-count {
        font-weight: 700;
        color: #28a745;
    }

    /* Activity Actions */
    .activity-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        min-width: 80px;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
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

    .btn-detail {
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

    .btn-detail:hover {
        box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .btn-edit:hover {
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        color: #212529;
    }

    .btn-delete:hover {
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 6rem 2rem;
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.8), rgba(13, 13, 13, 0.8));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        margin-top: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .empty-icon {
        font-size: 5rem;
        color: #666;
        margin-bottom: 2rem;
        animation: emptyFloat 3s ease-in-out infinite;
    }

    @keyframes emptyFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
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

    /* Loading Animation */
    .loading-skeleton {
        background: linear-gradient(90deg, #2a2a2a 25%, #3a3a3a 50%, #2a2a2a 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Activity Categories */
    .activity-category {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .activities-title {
            font-size: 2.8rem;
        }
        
        .activities-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .netflix-activities-container {
            padding: 1rem;
        }
        
        .activity-card {
            height: auto;
            min-height: 280px;
        }
        
        .activity-actions {
            flex-direction: column;
        }
        
        .action-btn {
            flex: none;
        }
    }

    @media (max-width: 480px) {
        .activities-title {
            font-size: 2.2rem;
        }
        
        .add-activity-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="netflix-activities-container">
    <div class="activities-header">
        <h1 class="activities-title">KEGIATAN</h1>
        <p class="activities-subtitle">Kelola dan pantau semua kegiatan organisasi</p>
        <a href="{{ route('kegiatan.create') }}" class="add-activity-btn">
            <span>🎬</span>
            Buat Kegiatan Baru
        </a>
    </div>

    @if($kegiatans->count() > 0)
        <div class="activities-grid">
            @foreach($kegiatans as $kegiatan)
            <div class="activity-card">
                <div class="activity-category">EVENT</div>
                
                <div class="activity-header">
                    <div class="activity-icon">🎪</div>
                    <h3 class="activity-name">{{ $kegiatan->nama_kegiatan }}</h3>
                </div>
                
                <div class="activity-body">
                    <div class="activity-info">
                        <div class="activity-date">
                            <span>📅</span>
                            {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                        </div>
                        
                        <div class="activity-participants">
                            <span>👥</span>
                            <span class="participants-count">{{ $kegiatan->anggotas_count }}</span>
                            <span>Peserta</span>
                        </div>
                    </div>
                    
                    <div class="activity-actions">
                        <a href="{{ route('kegiatan.show', $kegiatan->id) }}" class="action-btn btn-detail">
                            👁️ Detail
                        </a>
                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="action-btn btn-edit">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" style="display:inline; flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('🚨 Yakin hapus kegiatan ini?')" class="action-btn btn-delete" style="width: 100%;">
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
            <div class="empty-icon">🎭</div>
            <h3 class="empty-text">Belum ada kegiatan</h3>
            <p class="empty-subtext">Mulai dengan membuat kegiatan pertama untuk organisasi Anda</p>
        </div>
    @endif
</div>

<script>
// Add entrance animation
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.activity-card');
    
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px) scale(0.9)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) scale(1)';
        }, index * 150 + 300);
    });
});

// Add dynamic interaction effects
document.querySelectorAll('.activity-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.zIndex = '10';
        
        // Add subtle rotation effect
        const header = this.querySelector('.activity-header');
        if (header) {
            header.style.transform = 'scale(1.02)';
        }
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.zIndex = '1';
        
        const header = this.querySelector('.activity-header');
        if (header) {
            header.style.transform = 'scale(1)';
        }
    });
    
    // Add click ripple effect
    card.addEventListener('click', function(e) {
        if (e.target.tagName.toLowerCase() !== 'button' && e.target.tagName.toLowerCase() !== 'a') {
            const ripple = document.createElement('div');
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(229, 9, 20, 0.3)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.left = (e.clientX - this.offsetLeft) + 'px';
            ripple.style.top = (e.clientY - this.offsetTop) + 'px';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.pointerEvents = 'none';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }
    });
});

// Add CSS for ripple animation
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