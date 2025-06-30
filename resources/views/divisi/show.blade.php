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

    .netflix-division-container {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* Hero Banner Section */
    .division-hero {
        height: 70vh;
        background: 
            linear-gradient(
                180deg, 
                rgba(20, 20, 20, 0.3) 0%, 
                rgba(20, 20, 20, 0.7) 60%,
                rgba(20, 20, 20, 1) 100%
            ),
            linear-gradient(
                45deg,
                #e50914 0%,
                #b8070f 20%,
                #8b0000 40%,
                #660000 60%,
                #330000 80%,
                #1a1a1a 100%
            );
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .division-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(ellipse at 20% 30%, rgba(229, 9, 20, 0.4) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 70%, rgba(184, 7, 15, 0.3) 0%, transparent 60%),
            url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.02"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.02"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: heroShimmer 6s ease-in-out infinite alternate;
    }

    @keyframes heroShimmer {
        0% { opacity: 0.8; transform: scale(1) rotate(0deg); }
        100% { opacity: 1; transform: scale(1.02) rotate(0.5deg); }
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        z-index: 2;
        position: relative;
        display: flex;
        align-items: center;
        gap: 3rem;
    }

    .division-icon-large {
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
        color: #e50914;
        border: 3px solid rgba(255, 255, 255, 0.2);
        box-shadow: 
            0 0 40px rgba(229, 9, 20, 0.4),
            0 0 80px rgba(229, 9, 20, 0.2),
            inset 0 0 20px rgba(255, 255, 255, 0.1);
        animation: iconFloat 4s ease-in-out infinite;
        position: relative;
    }

    @keyframes iconFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }

    .division-icon-large::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, #e50914, transparent, #e50914);
        border-radius: 25px;
        z-index: -1;
        animation: iconGlow 2s ease-in-out infinite alternate;
    }

    @keyframes iconGlow {
        0% { opacity: 0.5; }
        100% { opacity: 0.8; }
    }

    .hero-info {
        flex: 1;
    }

    .division-title {
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffffff, #f0f0f0, #ffffff, #e0e0e0);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleShimmer 4s ease-in-out infinite;
        margin-bottom: 1rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        line-height: 1.1;
    }

    @keyframes titleShimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .division-subtitle {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        font-weight: 300;
    }

    .division-stats {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .stat-item {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-align: center;
        min-width: 120px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 900;
        color: #e50914;
        display: block;
    }

    .stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Members Section */
    .members-section {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 3;
    }

    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
    }

    .members-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .member-episode-card {
        background: linear-gradient(145deg, rgba(30, 30, 30, 0.9), rgba(20, 20, 20, 0.9));
        backdrop-filter: blur(15px);
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .member-episode-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 40px rgba(229, 9, 20, 0.3);
        border-color: rgba(229, 9, 20, 0.5);
    }

    .member-episode-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.05), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .member-episode-card:hover::before {
        opacity: 1;
    }

    .episode-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .episode-number {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #e50914, #b8070f);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        color: white;
        font-size: 1.2rem;
    }

    .member-avatar-small {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #ffffff, #f0f0f0);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        color: #e50914;
        font-size: 1.2rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
        position: relative;
        z-index: 2;
    }

    .episode-info {
        flex: 1;
    }

    .member-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.3rem;
    }

    .member-position {
        font-size: 0.9rem;
        color: #b3b3b3;
        margin-bottom: 0.5rem;
    }

    .member-nim {
        font-size: 0.8rem;
        color: #888;
        background: rgba(255, 255, 255, 0.1);
        padding: 2px 8px;
        border-radius: 12px;
        display: inline-block;
    }

    .episode-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .action-btn-small {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-detail-small {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
    }

    .btn-edit-small {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        color: #212529;
    }

    .action-btn-small:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .btn-detail-small:hover {
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        color: white;
    }

    .btn-edit-small:hover {
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
        color: #212529;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.8), rgba(13, 13, 13, 0.8));
        backdrop-filter: blur(15px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 3rem;
    }

    .empty-icon {
        font-size: 4rem;
        color: #666;
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .empty-title {
        font-size: 1.5rem;
        color: #b3b3b3;
        margin-bottom: 0.5rem;
    }

    .empty-subtitle {
        color: #666;
        font-size: 1rem;
    }

    /* Back Button */
    .back-section {
        text-align: center;
        padding: 2rem;
    }

    .netflix-back-btn {
        background: linear-gradient(135deg, #333333, #1a1a1a);
        color: white;
        border: 1px solid #555;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        font-size: 1rem;
        position: relative;
        overflow: hidden;
    }

    .netflix-back-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .netflix-back-btn:hover::before {
        left: 100%;
    }

    .netflix-back-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        color: white;
        text-decoration: none;
    }

    /* Floating Background Elements */
    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
        overflow: hidden;
    }

    .floating-element {
        position: absolute;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(229, 9, 20, 0.1), transparent);
        animation: floatMove 20s linear infinite;
    }

    @keyframes floatMove {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 0.5; }
        90% { opacity: 0.5; }
        100% { transform: translateY(-10vh) rotate(360deg); opacity: 0; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .division-hero {
            height: auto;
            padding: 3rem 1rem;
        }
        
        .hero-content {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }
        
        .division-icon-large {
            width: 150px;
            height: 150px;
            font-size: 4rem;
        }
        
        .division-title {
            font-size: 2.5rem;
        }
        
        .division-stats {
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .members-section {
            padding: 2rem 1rem;
        }
        
        .members-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
    }
</style>

<div class="netflix-division-container">
    <!-- Floating Background Elements -->
    <div class="floating-elements">
        <div class="floating-element" style="width: 100px; height: 100px; left: 10%; animation-delay: 0s;"></div>
        <div class="floating-element" style="width: 150px; height: 150px; left: 30%; animation-delay: 5s;"></div>
        <div class="floating-element" style="width: 80px; height: 80px; left: 50%; animation-delay: 10s;"></div>
        <div class="floating-element" style="width: 120px; height: 120px; left: 70%; animation-delay: 15s;"></div>
        <div class="floating-element" style="width: 90px; height: 90px; left: 90%; animation-delay: 3s;"></div>
    </div>

    <!-- Hero Banner -->
    <div class="division-hero">
        <div class="hero-content">
            <div class="division-icon-large">
                🏢
            </div>
            <div class="hero-info">
                <h1 class="division-title">{{ $divisi->nama_divisi }}</h1>
                <p class="division-subtitle">Divisi Detail & Daftar Anggota</p>
                <div class="division-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ $divisi->anggotas->count() }}</span>
                        <span class="stat-label">Total Anggota</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">{{ $divisi->anggotas->where('jabatan', 'Ketua')->count() + $divisi->anggotas->where('jabatan', 'Wakil Ketua')->count() }}</span>
                        <span class="stat-label">Pimpinan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Members Section -->
    <div class="members-section">
        <div class="section-header">
            <h2 class="section-title">Team Members</h2>
        </div>

        @if ($divisi->anggotas->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">👥</div>
                <h3 class="empty-title">Belum Ada Anggota</h3>
                <p class="empty-subtitle">Divisi ini belum memiliki anggota. Tambahkan anggota untuk memulai.</p>
            </div>
        @else
            <div class="members-grid">
                @foreach ($divisi->anggotas as $index => $anggota)
                <div class="member-episode-card">
                    <div class="episode-header">
                        <div class="episode-number">{{ $index + 1 }}</div>
                        <div class="member-avatar-small">
                            {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                        </div>
                        <div class="episode-info">
                            <h4 class="member-name">{{ $anggota->nama }}</h4>
                            <p class="member-position">{{ $anggota->jabatan }}</p>
                            <span class="member-nim">{{ $anggota->nim }}</span>
                        </div>
                    </div>
                    <div class="episode-actions">
                        <a href="{{ route('anggota.show', $anggota->id) }}" class="action-btn-small btn-detail-small">
                            👁️ Detail
                        </a>
                        <a href="{{ route('anggota.edit', $anggota->id) }}" class="action-btn-small btn-edit-small">
                            ✏️ Edit
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

        <div class="back-section">
            <a href="{{ route('divisi.index') }}" class="netflix-back-btn">
                <span>⬅️</span>
                Kembali ke Daftar Divisi
            </a>
        </div>
    </div>
</div>

<script>
// Add entrance animations
document.addEventListener('DOMContentLoaded', function() {
    const memberCards = document.querySelectorAll('.member-episode-card');
    
    memberCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px) scale(0.9)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) scale(1)';
        }, index * 150 + 800);
    });

    // Add floating elements periodically
    function createFloatingElement() {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.width = (Math.random() * 100 + 50) + 'px';
        element.style.height = element.style.width;
        element.style.left = Math.random() * 100 + '%';
        element.style.animationDelay = '0s';
        element.style.animationDuration = (Math.random() * 10 + 15) + 's';
        
        document.querySelector('.floating-elements').appendChild(element);
        
        setTimeout(() => {
            element.remove();
        }, 25000);
    }

    // Create floating elements periodically
    setInterval(createFloatingElement, 3000);
});

// Add interactive hover effects
document.querySelectorAll('.member-episode-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.zIndex = '10';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.zIndex = '1';
    });
});

// Stats animation
function animateStats() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    statNumbers.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 30);
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                currentValue = finalValue;
                clearInterval(timer);
            }
            stat.textContent = currentValue;
        }, 50);
    });
}

// Trigger stats animation after a delay
setTimeout(animateStats, 1000);
</script>
@endsection