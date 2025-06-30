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

    .netflix-detail-container {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* Hero Section with Background */
    .hero-section {
        height: 60vh;
        background: 
            linear-gradient(
                180deg, 
                rgba(20, 20, 20, 0.4) 0%, 
                rgba(20, 20, 20, 0.8) 50%,
                rgba(20, 20, 20, 1) 100%
            ),
            linear-gradient(
                45deg,
                #e50914 0%,
                #b8070f 25%,
                #8b0000 50%,
                #660000 75%,
                #330000 100%
            );
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 30%, rgba(229, 9, 20, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 70% 70%, rgba(184, 7, 15, 0.2) 0%, transparent 50%);
        animation: heroGlow 4s ease-in-out infinite alternate;
    }

    @keyframes heroGlow {
        0% { opacity: 0.8; transform: scale(1); }
        100% { opacity: 1; transform: scale(1.05); }
    }

    .hero-content {
        text-align: center;
        z-index: 2;
        position: relative;
        max-width: 600px;
        padding: 2rem;
    }

    .member-avatar-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffffff, #f0f0f0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        font-weight: 900;
        color: #e50914;
        margin: 0 auto 2rem;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 
            0 0 30px rgba(229, 9, 20, 0.5),
            0 0 60px rgba(229, 9, 20, 0.3);
        animation: avatarPulse 3s ease-in-out infinite;
        position: relative;
    }

    @keyframes avatarPulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 30px rgba(229, 9, 20, 0.5), 0 0 60px rgba(229, 9, 20, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 0 40px rgba(229, 9, 20, 0.7), 0 0 80px rgba(229, 9, 20, 0.4); }
    }

    .member-name-hero {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffffff, #f0f0f0, #ffffff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShimmer 3s ease-in-out infinite;
        margin-bottom: 1rem;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
    }

    @keyframes textShimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .member-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
    }

    /* Detail Section */
    .detail-section {
        padding: 4rem 2rem;
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        z-index: 3;
    }

    .detail-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.9), rgba(13, 13, 13, 0.9));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .detail-item {
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        padding: 2rem;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
    }

    .detail-item:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 40px rgba(229, 9, 20, 0.2);
        border-color: rgba(229, 9, 20, 0.5);
    }

    .detail-item::before {
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

    .detail-item:hover::before {
        opacity: 1;
    }

    .detail-label {
        font-size: 0.9rem;
        color: #b3b3b3;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #ffffff;
        word-break: break-word;
        position: relative;
        z-index: 2;
    }

    .detail-icon {
        font-size: 1.2rem;
        color: #e50914;
    }

    /* Action Buttons */
    .action-section {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .netflix-btn {
        padding: 1rem 2rem;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        font-size: 1rem;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .netflix-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .btn-back {
        background: linear-gradient(135deg, #333333, #1a1a1a);
        color: white;
        border: 1px solid #555;
    }

    .btn-edit {
        background: linear-gradient(135deg, #e50914, #b8070f);
        color: white;
        box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
    }

    .btn-back:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .btn-edit:hover {
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.5);
        color: white;
    }

    /* Member Status Badge */
    .member-status {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    /* Floating Particles */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #e50914;
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
        opacity: 0.7;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            height: 50vh;
        }
        
        .member-name-hero {
            font-size: 2.5rem;
        }
        
        .member-avatar-large {
            width: 120px;
            height: 120px;
            font-size: 3rem;
        }
        
        .detail-section {
            padding: 2rem 1rem;
        }
        
        .detail-card {
            padding: 2rem;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .action-section {
            flex-direction: column;
            align-items: center;
        }
        
        .netflix-btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
    }
</style>

<div class="netflix-detail-container">
    <!-- Floating Particles -->
    <div class="particles">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 6s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 7s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 8s;"></div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="member-avatar-large">
                {{ strtoupper(substr($anggota->nama, 0, 1)) }}
            </div>
            <h1 class="member-name-hero">{{ $anggota->nama }}</h1>
            <p class="member-subtitle">Detail Profil Anggota</p>
        </div>
    </div>

    <!-- Detail Section -->
    <div class="detail-section">
        <div class="detail-card">
            <div class="member-status">
                <span>✓</span>
                Anggota Aktif
            </div>

            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">
                        <span class="detail-icon">🎓</span>
                        Nomor Induk Mahasiswa
                    </div>
                    <div class="detail-value">{{ $anggota->nim }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span class="detail-icon">👤</span>
                        Nama Lengkap
                    </div>
                    <div class="detail-value">{{ $anggota->nama }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span class="detail-icon">🏆</span>
                        Jabatan
                    </div>
                    <div class="detail-value">{{ $anggota->jabatan }}</div>
                </div>
            </div>

            <div class="action-section">
                <a href="{{ route('anggota.index') }}" class="netflix-btn btn-back">
                    <span>⬅️</span>
                    Kembali ke Daftar
                </a>
                <a href="{{ route('anggota.edit', $anggota->id) }}" class="netflix-btn btn-edit">
                    <span>✏️</span>
                    Edit Anggota
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Add entrance animation
document.addEventListener('DOMContentLoaded', function() {
    const detailItems = document.querySelectorAll('.detail-item');
    
    detailItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(50px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 200 + 500);
    });

    // Add dynamic particles
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 6 + 's';
        particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
        
        document.querySelector('.particles').appendChild(particle);
        
        setTimeout(() => {
            particle.remove();
        }, 8000);
    }

    // Create particles periodically
    setInterval(createParticle, 800);
});

// Add interactive hover sound effect (visual feedback)
document.querySelectorAll('.detail-item').forEach(item => {
    item.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.02)';
    });
    
    item.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});
</script>
@endsection