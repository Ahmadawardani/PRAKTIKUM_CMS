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

    .netflix-dashboard {
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* Hero Header */
    .dashboard-hero {
        height: 40vh;
        background: 
            linear-gradient(
                180deg, 
                rgba(20, 20, 20, 0.3) 0%, 
                rgba(20, 20, 20, 0.7) 70%,
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

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(229, 9, 20, 0.4) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(184, 7, 15, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(139, 0, 0, 0.2) 0%, transparent 50%);
        animation: heroFlow 8s ease-in-out infinite alternate;
    }

    @keyframes heroFlow {
        0% { transform: translateX(-10px) scale(1); opacity: 0.8; }
        100% { transform: translateX(10px) scale(1.05); opacity: 1; }
    }

    .hero-content {
        text-align: center;
        z-index: 2;
        position: relative;
        max-width: 800px;
        padding: 2rem;
    }

    .dashboard-title {
        font-size: 4rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffffff, #f0f0f0, #ffffff, #e0e0e0);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleGlow 4s ease-in-out infinite;
        margin-bottom: 1rem;
        text-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
    }

    @keyframes titleGlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .dashboard-subtitle {
        font-size: 1.4rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 0;
        font-weight: 300;
    }

    /* Admin Stats */
    .admin-stats {
        position: absolute;
        bottom: -50px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 2rem;
        z-index: 3;
    }

    .stat-item {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.9), rgba(13, 13, 13, 0.9));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        min-width: 120px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 900;
        color: #e50914;
        display: block;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #b3b3b3;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Main Content */
    .dashboard-content {
        padding: 8rem 2rem 4rem;
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #e50914, transparent);
        border-radius: 2px;
    }

    /* Module Cards Grid */
    .modules-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .module-card {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.8), rgba(13, 13, 13, 0.8));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        cursor: pointer;
    }

    .module-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);
        border-color: rgba(229, 9, 20, 0.5);
    }

    .module-card::before {
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

    .module-card:hover::before {
        opacity: 1;
    }

    .module-header {
        height: 120px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .keuangan-header {
        background: linear-gradient(135deg, #28a745, #20c997, #17a2b8);
    }

    .persuratan-header {
        background: linear-gradient(135deg, #007bff, #6610f2, #e83e8c);
    }

    .module-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2) 0%, transparent 50%),
            radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        animation: headerGlow 3s ease-in-out infinite alternate;
    }

    @keyframes headerGlow {
        0% { opacity: 0.7; transform: scale(1); }
        100% { opacity: 1; transform: scale(1.05); }
    }

    .module-icon {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.9);
        z-index: 2;
        position: relative;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .module-body {
        padding: 2rem;
        position: relative;
        z-index: 2;
    }

    .module-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1rem;
    }

    .module-description {
        font-size: 1rem;
        color: #b3b3b3;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Feature List */
    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem 0;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        color: #d3d3d3;
        font-size: 0.9rem;
    }

    .feature-icon {
        color: #e50914;
        font-size: 1rem;
    }

    /* Action Button */
    .module-action {
        width: 100%;
        padding: 1rem 2rem;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        color: white;
    }

    .btn-keuangan {
        background: linear-gradient(135deg, #28a745, #20c997);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .btn-persuratan {
        background: linear-gradient(135deg, #007bff, #6610f2);
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
    }

    .module-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .module-action:hover::before {
        left: 100%;
    }

    .module-action:hover {
        transform: translateY(-2px);
        text-decoration: none;
        color: white;
    }

    .btn-keuangan:hover {
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.5);
    }

    .btn-persuratan:hover {
        box-shadow: 0 8px 25px rgba(0, 123, 255, 0.5);
    }

    /* Quick Actions */
    .quick-actions {
        margin-top: 4rem;
        text-align: center;
    }

    .quick-actions-grid {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }

    .quick-action-btn {
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        padding: 1rem 1.5rem;
        color: #ffffff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .quick-action-btn:hover {
        transform: translateY(-3px);
        border-color: rgba(229, 9, 20, 0.5);
        color: #ffffff;
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

    .floating-element {
        position: absolute;
        width: 6px;
        height: 6px;
        background: #e50914;
        border-radius: 50%;
        animation: floatUp 8s linear infinite;
        opacity: 0.6;
    }

    @keyframes floatUp {
        0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 0.6; }
        90% { opacity: 0.6; }
        100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2.5rem;
        }
        
        .dashboard-content {
            padding: 6rem 1rem 2rem;
        }
        
        .modules-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .admin-stats {
            flex-direction: column;
            gap: 1rem;
            position: static;
            transform: none;
            margin-top: 2rem;
        }
        
        .dashboard-hero {
            height: 50vh;
        }
        
        .quick-actions-grid {
            flex-direction: column;
            align-items: center;
        }
        
        .quick-action-btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
    }
</style>

<div class="netflix-dashboard">
    <!-- Floating Elements -->
    <div class="floating-elements">
        <div class="floating-element" style="left: 10%; animation-delay: 0s;"></div>
        <div class="floating-element" style="left: 20%; animation-delay: 2s;"></div>
        <div class="floating-element" style="left: 30%; animation-delay: 4s;"></div>
        <div class="floating-element" style="left: 40%; animation-delay: 6s;"></div>
        <div class="floating-element" style="left: 50%; animation-delay: 8s;"></div>
        <div class="floating-element" style="left: 60%; animation-delay: 10s;"></div>
        <div class="floating-element" style="left: 70%; animation-delay: 12s;"></div>
        <div class="floating-element" style="left: 80%; animation-delay: 14s;"></div>
        <div class="floating-element" style="left: 90%; animation-delay: 16s;"></div>
    </div>

    <!-- Hero Section -->
    <div class="dashboard-hero">
        <div class="hero-content">
            <h1 class="dashboard-title">ADMIN PANEL</h1>
            <p class="dashboard-subtitle">Dashboard Administrasi Organisasi</p>
        </div>
        
        <div class="admin-stats">
            <div class="stat-item">
                <span class="stat-number">2</span>
                <span class="stat-label">Modul</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">∞</span>
                <span class="stat-label">Fitur</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">24/7</span>
                <span class="stat-label">Akses</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="dashboard-content">
        <h2 class="section-title">Modul Administrasi</h2>
        
        <div class="modules-grid">
            <!-- Keuangan Module -->
            <div class="module-card">
                <div class="module-header keuangan-header">
                    <div class="module-icon">💰</div>
                </div>
                <div class="module-body">
                    <h3 class="module-title">Keuangan</h3>
                    <p class="module-description">
                        Kelola seluruh aspek keuangan organisasi dengan mudah dan terpadu. 
                        Monitor kas, transaksi, dan laporan keuangan secara real-time.
                    </p>
                    
                    <ul class="feature-list">
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Kelola uang masuk & keluar</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Monitor total kas organisasi</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Laporan keuangan lengkap</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Tracking transaksi harian</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('keuangan.index') }}" class="module-action btn-keuangan">
                        <span>💳</span>
                        Buka Modul Keuangan
                    </a>
                </div>
            </div>

            <!-- Persuratan Module -->
            <div class="module-card">
                <div class="module-header persuratan-header">
                    <div class="module-icon">📄</div>
                </div>
                <div class="module-body">
                    <h3 class="module-title">Persuratan</h3>
                    <p class="module-description">
                        Sistem manajemen surat yang komprehensif untuk mengatur 
                        surat masuk dan keluar organisasi dengan efisien.
                    </p>
                    
                    <ul class="feature-list">
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Kelola surat masuk</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Kelola surat keluar</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Arsip surat digital</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon">✓</span>
                            <span>Tracking status surat</span>
                        </li>
                    </ul>
                    
                    <a href="{{ route('persuratan.index') }}" class="module-action btn-persuratan">
                        <span>📨</span>
                        Buka Modul Persuratan
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2 class="section-title">Aksi Cepat</h2>
            <div class="quick-actions-grid">
                <a href="#" class="quick-action-btn">
                    <span>📊</span>
                    Laporan Keuangan
                </a>
                <a href="#" class="quick-action-btn">
                    <span>📝</span>
                    Buat Surat Baru
                </a>
                <a href="#" class="quick-action-btn">
                    <span>👥</span>
                    Kelola Anggota
                </a>
                <a href="#" class="quick-action-btn">
                    <span>⚙️</span>
                    Pengaturan
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Add entrance animations
document.addEventListener('DOMContentLoaded', function() {
    const moduleCards = document.querySelectorAll('.module-card');
    
    // Animate module cards entrance
    moduleCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 300 + 1000);
    });

    // Animate stats
    const statItems = document.querySelectorAll('.stat-item');
    statItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 150 + 500);
    });

    // Dynamic floating elements
    function createFloatingElement() {
        const element = document.createElement('div');
        element.className = 'floating-element';
        element.style.left = Math.random() * 100 + '%';
        element.style.animationDelay = Math.random() * 8 + 's';
        element.style.animationDuration = (Math.random() * 4 + 6) + 's';
        
        document.querySelector('.floating-elements').appendChild(element);
        
        setTimeout(() => {
            element.remove();
        }, 10000);
    }

    // Create floating elements periodically
    setInterval(createFloatingElement, 1000);
});

// Add interactive effects
document.querySelectorAll('.module-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.zIndex = '10';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.zIndex = '1';
    });
});

// Add click ripple effect
document.querySelectorAll('.module-action, .quick-action-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
        `;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection