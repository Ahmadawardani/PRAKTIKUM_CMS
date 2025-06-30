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

    .netflix-activity-container {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* Hero Banner Section */
    .hero-banner {
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
                #ff6b35 20%,
                #f7931e 40%,
                #ffd700 60%,
                #32cd32 80%,
                #1e90ff 100%
            );
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        animation: colorShift 10s ease-in-out infinite;
    }

    @keyframes colorShift {
        0%, 100% { filter: hue-rotate(0deg); }
        25% { filter: hue-rotate(45deg); }
        50% { filter: hue-rotate(90deg); }
        75% { filter: hue-rotate(135deg); }
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(ellipse at 20% 30%, rgba(229, 9, 20, 0.4) 0%, transparent 60%),
            radial-gradient(ellipse at 80% 70%, rgba(255, 107, 53, 0.3) 0%, transparent 60%),
            radial-gradient(ellipse at 50% 50%, rgba(247, 147, 30, 0.2) 0%, transparent 70%);
        animation: heroGlow 6s ease-in-out infinite alternate;
    }

    @keyframes heroGlow {
        0% { opacity: 0.8; transform: scale(1) rotate(0deg); }
        100% { opacity: 1; transform: scale(1.1) rotate(2deg); }
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        z-index: 2;
        position: relative;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 3rem;
        align-items: center;
    }

    .activity-poster {
        width: 300px;
        height: 400px;
        background: linear-gradient(145deg, #2a2a2a, #1a1a1a);
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 3px solid rgba(229, 9, 20, 0.5);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.6),
            0 0 30px rgba(229, 9, 20, 0.3);
        position: relative;
        overflow: hidden;
        animation: posterFloat 4s ease-in-out infinite;
    }

    @keyframes posterFloat {
        0%, 100% { transform: translateY(0px) rotateY(0deg); }
        50% { transform: translateY(-10px) rotateY(5deg); }
    }

    .activity-poster::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(255, 107, 53, 0.05));
        animation: posterShimmer 3s ease-in-out infinite;
    }

    @keyframes posterShimmer {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.6; }
    }

    .poster-icon {
        font-size: 6rem;
        color: #e50914;
        margin-bottom: 1rem;
        animation: iconPulse 2s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .poster-text {
        font-size: 1.2rem;
        font-weight: 700;
        text-align: center;
        color: #ffffff;
        z-index: 2;
        position: relative;
    }

    .activity-info {
        z-index: 2;
        position: relative;
    }

    .activity-title {
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffffff, #f0f0f0, #ffffff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleShimmer 4s ease-in-out infinite;
        margin-bottom: 1rem;
        line-height: 1.1;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    @keyframes titleShimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .activity-date {
        font-size: 1.4rem;
        color: #e50914;
        font-weight: 700;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .activity-description {
        font-size: 1.1rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        background: rgba(0, 0, 0, 0.3);
        padding: 1.5rem;
        border-radius: 15px;
        border-left: 4px solid #e50914;
    }

    /* Committee Section */
    .committee-section {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 3;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 900;
        color: #ffffff;
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
        border-radius: 2px;
    }

    .committee-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .member-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.9), rgba(13, 13, 13, 0.9));
        backdrop-filter: blur(20px);
        border-radius: 16px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
    }

    .member-card:hover {
        transform: translateY(-15px) scale(1.03);
        box-shadow: 0 25px 50px rgba(229, 9, 20, 0.3);
        border-color: rgba(229, 9, 20, 0.6);
    }

    .member-card::before {
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

    .member-card:hover::before {
        opacity: 1;
    }

    .member-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e50914, #b8070f);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .member-name {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .member-nim {
        font-size: 0.9rem;
        color: #b3b3b3;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 2;
    }

    .member-position {
        background: linear-gradient(135deg, #333, #2a2a2a);
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
        position: relative;
        z-index: 2;
    }

    .empty-committee {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.5), rgba(13, 13, 13, 0.5));
        border-radius: 20px;
        border: 2px dashed rgba(255, 255, 255, 0.2);
    }

    .empty-icon {
        font-size: 4rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .empty-text {
        font-size: 1.2rem;
        color: #b3b3b3;
        margin-bottom: 0.5rem;
    }

    .empty-subtext {
        color: #666;
    }

    /* Action Button */
    .back-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #e50914, #b8070f);
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .back-button:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 15px 35px rgba(229, 9, 20, 0.6);
        color: white;
        text-decoration: none;
    }

    /* Floating Elements */
    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .floating-shape {
        position: absolute;
        background: rgba(229, 9, 20, 0.1);
        border-radius: 50%;
        animation: floatUpDown 8s ease-in-out infinite;
    }

    .floating-shape:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-shape:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .floating-shape:nth-child(3) {
        width: 100px;
        height: 100px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes floatUpDown {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
        50% { transform: translateY(-30px) rotate(180deg); opacity: 0.6; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-content {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 2rem;
        }
        
        .activity-poster {
            width: 250px;
            height: 300px;
            margin: 0 auto;
        }
        
        .activity-title {
            font-size: 2.5rem;
        }
        
        .committee-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .committee-section {
            padding: 2rem 1rem;
        }
        
        .back-button {
            bottom: 20px;
            right: 20px;
            padding: 0.8rem 1.5rem;
        }
    }
</style>

<div class="netflix-activity-container">
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
        <div class="floating-shape"></div>
    </div>

    <!-- Hero Banner -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="activity-poster">
                <div class="poster-icon">🎭</div>
                <div class="poster-text">KEGIATAN<br>SPESIAL</div>
            </div>
            
            <div class="activity-info">
                <h1 class="activity-title">{{ $kegiatan->nama_kegiatan }}</h1>
                <div class="activity-date">
                    <span>📅</span>
                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}
                </div>
                <div class="activity-description">
                    {{ $kegiatan->deskripsi }}
                </div>
            </div>
        </div>
    </div>

    <!-- Committee Section -->
    <div class="committee-section">
        <h2 class="section-title">🎬 CREW & PANITIA</h2>
        
        @if ($kegiatan->anggotas->isEmpty())
            <div class="empty-committee">
                <div class="empty-icon">👥</div>
                <h3 class="empty-text">Belum Ada Anggota Panitia</h3>
                <p class="empty-subtext">Kegiatan ini belum memiliki anggota panitia yang terdaftar</p>
            </div>
        @else
            <div class="committee-grid">
                @foreach ($kegiatan->anggotas as $anggota)
                <div class="member-card">
                    <div class="member-avatar">
                        {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                    </div>
                    <div class="member-name">{{ $anggota->nama }}</div>
                    <div class="member-nim">{{ $anggota->nim }}</div>
                    <span class="member-position">{{ $anggota->jabatan }}</span>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Back Button -->
    <a href="{{ route('kegiatan.index') }}" class="back-button">
        <span>⬅️</span>
        Kembali
    </a>
</div>

<script>
// Add entrance animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate committee cards
    const memberCards = document.querySelectorAll('.member-card');
    memberCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px) scale(0.9)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0) scale(1)';
        }, index * 150 + 800);
    });

    // Animate poster
    const poster = document.querySelector('.activity-poster');
    poster.style.transform = 'scale(0) rotateY(-90deg)';
    setTimeout(() => {
        poster.style.transition = 'all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        poster.style.transform = 'scale(1) rotateY(0deg)';
    }, 300);

    // Animate title
    const title = document.querySelector('.activity-title');
    title.style.opacity = '0';
    title.style.transform = 'translateX(-100px)';
    setTimeout(() => {
        title.style.transition = 'all 1s ease';
        title.style.opacity = '1';
        title.style.transform = 'translateX(0)';
    }, 600);
});

// Add parallax effect to hero
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero-banner');
    const rate = scrolled * -0.5;
    
    if (hero) {
        hero.style.transform = `translateY(${rate}px)`;
    }
});

// Add interactive hover effects
document.querySelectorAll('.member-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.zIndex = '10';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.zIndex = '1';
    });
});

// Dynamic background color animation
let hue = 0;
setInterval(() => {
    hue = (hue + 1) % 360;
    document.querySelector('.hero-banner').style.filter = `hue-rotate(${hue}deg)`;
}, 100);
</script>
@endsection