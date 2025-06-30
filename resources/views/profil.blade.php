@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #141414 0%, #0f0f0f 100%);
        color: #ffffff;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    /* Hero Section */
    .netflix-hero {
        height: 100vh;
        background: 
            linear-gradient(
                180deg, 
                rgba(20, 20, 20, 0.3) 0%, 
                rgba(20, 20, 20, 0.7) 50%,
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

    .hero-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: #e50914;
        border-radius: 50%;
        animation: floatUp 8s linear infinite;
        opacity: 0.7;
    }

    @keyframes floatUp {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { transform: translateY(-10px) rotate(360deg); opacity: 0; }
    }

    .hero-content {
        text-align: center;
        z-index: 10;
        max-width: 800px;
        padding: 2rem;
    }

    .hero-logo {
        width: 200px;
        height: 200px;
        margin: 0 auto 2rem;
        position: relative;
    }

    .hero-logo img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 5px solid rgba(255, 255, 255, 0.3);
        box-shadow: 
            0 0 40px rgba(229, 9, 20, 0.6),
            0 0 80px rgba(229, 9, 20, 0.4),
            inset 0 0 20px rgba(255, 255, 255, 0.1);
        animation: logoGlow 4s ease-in-out infinite alternate;
        object-fit: cover;
    }

    @keyframes logoGlow {
        0% { 
            box-shadow: 
                0 0 40px rgba(229, 9, 20, 0.6),
                0 0 80px rgba(229, 9, 20, 0.4),
                inset 0 0 20px rgba(255, 255, 255, 0.1);
        }
        100% { 
            box-shadow: 
                0 0 60px rgba(229, 9, 20, 0.8),
                0 0 120px rgba(229, 9, 20, 0.6),
                inset 0 0 30px rgba(255, 255, 255, 0.2);
        }
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffffff, #f0f0f0, #ffffff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: textShimmer 3s ease-in-out infinite;
        margin-bottom: 1rem;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
    }

    @keyframes textShimmer {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .hero-subtitle {
        font-size: 1.5rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
        font-weight: 300;
    }

    .scroll-indicator {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.7);
        animation: bounce 2s infinite;
        font-size: 2rem;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
        40% { transform: translateX(-50%) translateY(-10px); }
        60% { transform: translateX(-50%) translateY(-5px); }
    }

    /* Content Sections */
    .content-wrapper {
        background: linear-gradient(180deg, #141414, #0a0a0a);
        position: relative;
        z-index: 2;
    }

    .netflix-section {
        padding: 4rem 2rem;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
    }

    .section-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 3rem;
        margin-bottom: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .section-card:hover {
        transform: translateY(-10px);
        box-shadow: 
            0 30px 60px rgba(0, 0, 0, 0.6),
            0 0 30px rgba(229, 9, 20, 0.2);
        border-color: rgba(229, 9, 20, 0.3);
    }

    .section-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #e50914;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #e50914, transparent);
        border-radius: 2px;
    }

    .section-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #e6e6e6;
    }

    /* Vision Section */
    .vision-text {
        font-size: 1.3rem;
        font-style: italic;
        text-align: center;
        padding: 2rem;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(184, 7, 15, 0.05));
        border-radius: 15px;
        border-left: 5px solid #e50914;
        position: relative;
    }

    .vision-text::before,
    .vision-text::after {
        content: '"';
        font-size: 4rem;
        color: #e50914;
        position: absolute;
        opacity: 0.3;
    }

    .vision-text::before {
        top: 10px;
        left: 20px;
    }

    .vision-text::after {
        bottom: 10px;
        right: 20px;
    }

    /* Mission List */
    .mission-list {
        list-style: none;
        padding: 0;
        counter-reset: mission-counter;
    }

    .mission-list li {
        counter-increment: mission-counter;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border-radius: 12px;
        border-left: 4px solid #e50914;
        position: relative;
        transition: all 0.3s ease;
    }

    .mission-list li:hover {
        transform: translateX(10px);
        background: linear-gradient(135deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    .mission-list li::before {
        content: counter(mission-counter);
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #e50914, #b8070f);
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
    }

    /* Highlight Boxes */
    .highlight-card {
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(184, 7, 15, 0.05));
        border: 1px solid rgba(229, 9, 20, 0.3);
        border-radius: 15px;
        padding: 2.5rem;
        margin: 2rem 0;
        position: relative;
        overflow: hidden;
    }

    .highlight-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #e50914, #b8070f, #e50914);
    }

    .highlight-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e50914;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .feature-list {
        list-style: none;
        padding: 0;
    }

    .feature-list li {
        padding: 1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .feature-list li:hover {
        color: #e50914;
        transform: translateX(10px);
    }

    .feature-list li:last-child {
        border-bottom: none;
    }

    /* Netflix Footer */
    .netflix-footer {
        background: linear-gradient(135deg, #0a0a0a, #141414);
        padding: 4rem 2rem 2rem;
        text-align: center;
        border-top: 1px solid rgba(229, 9, 20, 0.3);
        position: relative;
    }

    .netflix-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
    }

    .footer-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .footer-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #e50914;
        margin-bottom: 1rem;
    }

    .footer-text {
        color: #b3b3b3;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .footer-quote {
        font-style: italic;
        color: #e50914;
        font-size: 1.1rem;
        margin-top: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
        }
        
        .hero-logo {
            width: 150px;
            height: 150px;
        }
        
        .netflix-section {
            padding: 2rem 1rem;
        }
        
        .section-card {
            padding: 2rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .vision-text {
            font-size: 1.1rem;
            padding: 1.5rem;
        }
        
        .mission-list li {
            padding: 1rem;
            margin-left: 20px;
        }
    }

    /* Loading Animation */
    .fade-in {
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

{{-- Hero Section --}}
<div class="netflix-hero">
    <div class="hero-particles" id="particles"></div>
    
    <div class="hero-content">
        <div class="hero-logo">
            <img src="{{ asset('images/logo-hmps.jpeg') }}" alt="Logo HMPS-SI">
        </div>
        <h1 class="hero-title">HMPS-SI</h1>
        <p class="hero-subtitle">Himpunan Mahasiswa Sistem Informasi</p>
    </div>
    
    <div class="scroll-indicator">
        ⬇️
    </div>
</div>

<div class="content-wrapper">
    {{-- Visi Section --}}
    <div class="netflix-section">
        <div class="section-card fade-in">
            <h2 class="section-title">🎯 Visi Kami</h2>
            <div class="vision-text">
                Membangun Himpunan Mahasiswa Sistem Informasi menjadi keluarga besar yang harmonis, inovatif, kolaboratif, serta mampu menginspirasi perubahan positif dengan mengedepankan nilai kebersamaan, empati, dan pemberdayaan mahasiswa.
            </div>
        </div>
    </div>

    {{-- Misi Section --}}
    <div class="netflix-section">
        <div class="section-card fade-in">
            <h2 class="section-title">🚀 Misi Kami</h2>
            <ol class="mission-list">
                <li>Memastikan setiap anggota merasa dihargai, diterima, dan didukung dalam mengembangkan potensi diri.</li>
                <li>Menjadikan rasa peduli dan saling membantu sebagai dasar dalam perencanaan dan pelaksanaan kegiatan.</li>
                <li>Melibatkan setiap anggota secara aktif dalam kegiatan himpunan, sehingga semua merasa memiliki peran penting.</li>
                <li>Menghargai perbedaan latar belakang, pemikiran, dan kemampuan setiap anggota sebagai kekuatan untuk mencapai tujuan bersama.</li>
                <li>Menjamin kesempatan yang setara bagi semua anggota, tanpa memandang gender, untuk berkontribusi dalam kepanitian, proyek, atau kegiatan himpunan.</li>
            </ol>
        </div>
    </div>

    {{-- Tentang Kami Section --}}
    <div class="netflix-section">
        <div class="highlight-card fade-in">
            <h3 class="highlight-title">
                <span>🏠</span>
                Tentang Kami
            </h3>
            <div class="section-content">
                HMPS Sistem Informasi adalah rumah bagi para mahasiswa yang ingin tumbuh, berkontribusi, dan saling mendukung dalam suasana kekeluargaan. Kami percaya bahwa setiap ide berharga, setiap suara penting, dan setiap langkah berarti. Dengan semangat kolaborasi dan empati, kami bergerak bersama demi masa depan yang lebih inklusif dan kreatif.
            </div>
        </div>
    </div>

    {{-- Kenapa Harus HMPS-SI Section --}}
    <div class="netflix-section">
        <div class="highlight-card fade-in">
            <h3 class="highlight-title">
                <span>⭐</span>
                Kenapa Harus HMPS-SI?
            </h3>
            <ul class="feature-list">
                <li>🎧 Kegiatan seru, edukatif, dan berdampak</li>
                <li>🌱 Ruang berkembang untuk semua potensi</li>
                <li>💚 Budaya gotong royong dan saling dukung</li>
                <li>📈 Jejak prestasi dan inovasi nyata</li>
            </ul>
        </div>
    </div>
</div>

<script>
// Create floating particles
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 50;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 8 + 's';
        particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
        particlesContainer.appendChild(particle);
    }
}

// Fade in animation on scroll
function animateOnScroll() {
    const elements = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = '0.2s';
                entry.target.classList.add('fade-in');
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(el => observer.observe(el));
}

// Smooth scroll for indicator
document.querySelector('.scroll-indicator').addEventListener('click', () => {
    document.querySelector('.content-wrapper').scrollIntoView({
        behavior: 'smooth'
    });
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
    animateOnScroll();
    
    // Stagger animation for elements
    const cards = document.querySelectorAll('.section-card, .highlight-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = (index * 0.2) + 's';
    });
});

// Add dynamic particle creation
setInterval(() => {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.left = Math.random() * 100 + '%';
    particle.style.animationDuration = (Math.random() * 4 + 6) + 's';
    
    document.getElementById('particles').appendChild(particle);
    
    setTimeout(() => {
        particle.remove();
    }, 10000);
}, 1000);
</script>
@endsection