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
        overflow-x: auto;
    }

    .netflix-org-container {
        min-height: 100vh;
        padding: 2rem;
        position: relative;
        background: 
            radial-gradient(circle at 20% 20%, rgba(229, 9, 20, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(184, 7, 15, 0.08) 0%, transparent 50%);
    }

    /* Header Section */
    .org-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
    }

    .org-title {
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #e50914);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s ease-in-out infinite;
        text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
        margin-bottom: 1rem;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .org-subtitle {
        font-size: 1.3rem;
        color: #b3b3b3;
        margin-bottom: 2rem;
        font-weight: 300;
    }

    /* Organization Chart Wrapper */
    .org-wrapper {
        position: relative;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Organization Levels */
    .org-level {
        margin-bottom: 3rem;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
        position: relative;
    }

    /* Organization Box Styles */
    .org-box {
        background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
        border: 2px solid transparent;
        background-clip: padding-box;
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 15px;
        font-weight: 700;
        text-align: center;
        position: relative;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow: hidden;
        min-width: 200px;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    /* Different box styles for hierarchy */
    .org-box.president {
        background: linear-gradient(135deg, #e50914, #b8070f);
        box-shadow: 
            0 15px 40px rgba(229, 9, 20, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transform: scale(1.1);
        font-size: 1.1rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .org-box.vice-president {
        background: linear-gradient(135deg, #dc3545, #c82333);
        box-shadow: 
            0 12px 35px rgba(220, 53, 69, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.15);
        font-size: 1.05rem;
    }

    .org-box.secretary, .org-box.treasurer {
        background: linear-gradient(135deg, #17a2b8, #138496);
        box-shadow: 
            0 10px 30px rgba(23, 162, 184, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }

    .org-box.division {
        background: linear-gradient(135deg, #28a745, #20c997);
        box-shadow: 
            0 8px 25px rgba(40, 167, 69, 0.3),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        font-size: 0.9rem;
    }

    /* Hover Effects */
    .org-box:hover {
        transform: translateY(-10px) scale(1.05);
        box-shadow: 
            0 20px 50px rgba(229, 9, 20, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(229, 9, 20, 0.6);
    }

    .org-box.president:hover {
        transform: translateY(-10px) scale(1.15);
        box-shadow: 
            0 25px 60px rgba(229, 9, 20, 0.6),
            inset 0 1px 0 rgba(255, 255, 255, 0.3);
    }

    /* Glow effect on hover */
    .org-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(229, 9, 20, 0.1), transparent, rgba(229, 9, 20, 0.1));
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 15px;
    }

    .org-box:hover::before {
        opacity: 1;
    }

    /* Connection Lines */
    .connection-line {
        position: absolute;
        background: linear-gradient(90deg, #e50914, #b8070f);
        height: 3px;
        z-index: 1;
        border-radius: 2px;
        box-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
        animation: connectionPulse 2s ease-in-out infinite;
    }

    @keyframes connectionPulse {
        0%, 100% { opacity: 0.8; box-shadow: 0 0 10px rgba(229, 9, 20, 0.5); }
        50% { opacity: 1; box-shadow: 0 0 20px rgba(229, 9, 20, 0.8); }
    }

    /* Vertical connection lines */
    .vertical-line {
        position: absolute;
        background: linear-gradient(180deg, #e50914, #b8070f);
        width: 3px;
        z-index: 1;
        border-radius: 2px;
        left: 50%;
        transform: translateX(-50%);
        box-shadow: 0 0 10px rgba(229, 9, 20, 0.5);
        animation: connectionPulse 2s ease-in-out infinite;
    }

    /* Level-specific styling */
    .level-1 { /* President */
        margin-bottom: 4rem;
    }

    .level-2 { /* Vice President */
        margin-bottom: 4rem;
    }

    .level-3 { /* Secretary & Treasurer */
        margin-bottom: 4rem;
    }

    .level-4 { /* Divisions */
        margin-bottom: 2rem;
    }

    /* Sub-positions (Secretary 2, Treasurer 2) */
    .sub-position {
        margin-top: 1.5rem;
        transform: scale(0.9);
        opacity: 0.9;
    }

    .sub-connector {
        width: 2px;
        height: 30px;
        background: linear-gradient(180deg, #17a2b8, #138496);
        margin: 10px auto;
        border-radius: 1px;
        box-shadow: 0 0 8px rgba(23, 162, 184, 0.4);
    }

    /* Position Groups */
    .position-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 1rem;
    }

    /* Floating Animation */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .org-box.floating {
        animation: float 3s ease-in-out infinite;
    }

    /* Background Particles */
    .bg-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: #e50914;
        border-radius: 50%;
        animation: particleFloat 8s linear infinite;
        opacity: 0.6;
    }

    @keyframes particleFloat {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 0.6; }
        90% { opacity: 0.6; }
        100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .org-title {
            font-size: 2.8rem;
        }
        
        .org-level {
            flex-direction: column;
            gap: 1rem;
        }
        
        .level-3 {
            flex-direction: row;
            justify-content: center;
            gap: 3rem;
        }
    }

    @media (max-width: 768px) {
        .netflix-org-container {
            padding: 1rem;
        }
        
        .org-title {
            font-size: 2.2rem;
        }
        
        .org-box {
            min-width: 180px;
            padding: 1rem 1.5rem;
            font-size: 0.9rem;
        }
        
        .org-box.president {
            transform: scale(1.05);
        }
        
        .level-3 {
            flex-direction: column;
            gap: 1rem;
        }
        
        .level-4 {
            flex-direction: column;
            gap: 1rem;
        }
    }

    /* Interactive tooltip */
    .org-box[data-tooltip] {
        position: relative;
    }

    .org-box[data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.9);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        white-space: nowrap;
        z-index: 100;
        margin-bottom: 5px;
        border: 1px solid #e50914;
    }
</style>

<div class="netflix-org-container">
    <!-- Background Particles -->
    <div class="bg-particles">
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 12s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 14s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 16s;"></div>
    </div>

    <!-- Header Section -->
    <div class="org-header">
        <h1 class="org-title">STRUKTUR ORGANISASI</h1>
        <p class="org-subtitle">Himpunan Mahasiswa Program Studi Sistem Informasi</p>
    </div>

    <!-- Organization Chart -->
    <div class="org-wrapper">
        <!-- Level 1: President -->
        <div class="org-level level-1">
            <div class="org-box president floating" 
                 data-tooltip="Pemimpin tertinggi organisasi">
                🏆 Ketua Himpunan
            </div>
        </div>

        <!-- Vertical Line to Vice President -->
        <div class="vertical-line" style="height: 50px; top: 180px;"></div>
        <div class="org-arrow" style="top: 220px;">
            <div class="arrow-down"></div>
        </div>

        <!-- Level 2: Vice President -->
        <div class="org-level level-2">
            <div class="org-box vice-president floating" 
                 data-tooltip="Wakil pemimpin dan koordinator"
                 style="animation-delay: 0.5s;">
                👑 Wakil Ketua Himpunan
            </div>
        </div>

        <!-- Vertical Line to Secretary & Treasurer -->
        <div class="vertical-line" style="height: 50px; top: 350px;"></div>
        <div class="org-arrow" style="top: 390px;">
            <div class="arrow-down"></div>
        </div>

        <!-- Level 3: Secretary & Treasurer -->
        <div class="org-level level-3">
            <div class="position-group">
                <div class="org-box secretary floating" 
                     data-tooltip="Mengatur administrasi organisasi"
                     style="animation-delay: 1s;">
                    📝 Sekretaris 1
                </div>
                <div class="sub-connector"></div>
                <div class="org-box secretary sub-position floating"
                     style="animation-delay: 1.2s;">
                    📋 Sekretaris 2
                </div>
            </div>

            <div class="position-group">
                <div class="org-box treasurer floating" 
                     data-tooltip="Mengelola keuangan organisasi"
                     style="animation-delay: 1.4s;">
                    💰 Bendahara 1
                </div>
                <div class="sub-connector"></div>
                <div class="org-box treasurer sub-position floating"
                     style="animation-delay: 1.6s;">
                    💳 Bendahara 2
                </div>
            </div>
        </div>

        <!-- Vertical Line to Divisions -->
        <div class="vertical-line" style="height: 50px; top: 620px;"></div>
        <div class="org-arrow" style="top: 660px;">
            <div class="arrow-down"></div>
        </div>

        <!-- Level 4: Divisions -->
        <div class="org-level level-4">
            <div class="org-box division floating" 
                 data-tooltip="Menjalin hubungan dengan pihak eksternal"
                 style="animation-delay: 2s;">
                🤝 Hubungan<br>Masyarakat
            </div>
            
            <div class="org-box division floating" 
                 data-tooltip="Mengembangkan kapasitas organisasi"
                 style="animation-delay: 2.2s;">
                📈 Pengembangan<br>Organisasi
            </div>
            
            <div class="org-box division floating" 
                 data-tooltip="Mengelola informasi dan publikasi"
                 style="animation-delay: 2.4s;">
                📱 Media<br>Informasi
            </div>
            
            <div class="org-box division floating" 
                 data-tooltip="Mengatur kegiatan pengabdian masyarakat"
                 style="animation-delay: 2.6s;">
                🌟 Wirabakti
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const orgBoxes = document.querySelectorAll('.org-box');
    
    orgBoxes.forEach((box, index) => {
        box.style.opacity = '0';
        box.style.transform = 'translateY(50px) scale(0.8)';
        
        setTimeout(() => {
            box.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            box.style.opacity = '1';
            
            if (box.classList.contains('president')) {
                box.style.transform = 'translateY(0) scale(1.1)';
            } else if (box.classList.contains('sub-position')) {
                box.style.transform = 'translateY(0) scale(0.9)';
            } else {
                box.style.transform = 'translateY(0) scale(1)';
            }
        }, index * 200 + 300);
    });

    // Add click interaction
    orgBoxes.forEach(box => {
        box.addEventListener('click', function() {
            // Add click effect
            this.style.transform += ' scale(0.95)';
            setTimeout(() => {
                this.style.transform = this.style.transform.replace(' scale(0.95)', '');
            }, 150);
        });
    });

    // Dynamic particle creation
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = '0s';
        particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
        
        document.querySelector('.bg-particles').appendChild(particle);
        
        setTimeout(() => {
            if (particle.parentNode) {
                particle.remove();
            }
        }, 10000);
    }

    // Create particles periodically
    setInterval(createParticle, 1000);

    // Add connection lines animation
    const lines = document.querySelectorAll('.vertical-line, .connection-line');
    lines.forEach((line, index) => {
        line.style.opacity = '0';
        setTimeout(() => {
            line.style.transition = 'opacity 0.5s ease';
            line.style.opacity = '1';
        }, (index + 1) * 800 + 1000);
    });

    // Add arrows animation
    const arrows = document.querySelectorAll('.org-arrow');
    arrows.forEach((arrow, index) => {
        arrow.style.opacity = '0';
        setTimeout(() => {
            arrow.style.transition = 'opacity 0.5s ease';
            arrow.style.opacity = '1';
        }, (index + 1) * 800 + 1200);
    });
});
</script>
@endsection