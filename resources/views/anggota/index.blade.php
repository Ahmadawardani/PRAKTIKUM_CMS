@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #141414 0%, #0f0f0f 100%);
        color: #ffffff;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        min-height: 100vh;
    }

    .netflix-container {
        padding: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .netflix-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .netflix-title {
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

    .netflix-subtitle {
        font-size: 1.2rem;
        color: #b3b3b3;
        margin-bottom: 2rem;
    }

    .add-member-btn {
        background: linear-gradient(135deg, #e50914, #cc0812);
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
        margin-bottom: 2rem;
    }

    .add-member-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.5);
        color: white;
        text-decoration: none;
    }

    .members-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .member-card {
        background: linear-gradient(145deg, #1a1a1a, #0d0d0d);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        border: 1px solid #333;
        position: relative;
        cursor: pointer;
    }

    .member-card:hover {
        transform: scale(1.05) rotateY(5deg);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        border-color: #e50914;
    }

    .member-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 1;
    }

    .member-card:hover::before {
        opacity: 1;
    }

    .member-header {
        background: linear-gradient(135deg, #e50914, #b8070f);
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .member-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        transform: rotate(45deg);
        transition: transform 0.6s ease;
    }

    .member-card:hover .member-header::before {
        transform: rotate(45deg) translate(20px, 20px);
    }

    .member-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffffff, #f0f0f0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 700;
        color: #e50914;
        margin-bottom: 1rem;
        border: 3px solid rgba(255, 255, 255, 0.3);
        position: relative;
        z-index: 2;
    }

    .member-name {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: white;
        position: relative;
        z-index: 2;
    }

    .member-nim {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        position: relative;
        z-index: 2;
    }

    .member-body {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .member-position {
        background: linear-gradient(135deg, #333, #2a2a2a);
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 1.5rem;
        border: 1px solid #444;
    }

    .member-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-btn {
        flex: 1;
        min-width: 70px;
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
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
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .btn-detail:hover { box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4); }
    .btn-edit:hover { box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4); }
    .btn-delete:hover { box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4); }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: linear-gradient(145deg, #1a1a1a, #0d0d0d);
        border-radius: 12px;
        margin-top: 2rem;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-title {
            font-size: 2.5rem;
        }
        
        .members-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .netflix-container {
            padding: 1rem;
        }
        
        .member-actions {
            flex-direction: column;
        }
        
        .action-btn {
            flex: none;
        }
    }

    /* Loading Animation */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .loading {
        animation: pulse 2s infinite;
    }
</style>

<div class="netflix-container">
    <div class="netflix-header">
        <h1 class="netflix-title">MEMBERS</h1>
        <p class="netflix-subtitle">Kelola anggota organisasi dengan mudah</p>
        <a href="{{ route('anggota.create') }}" class="add-member-btn">
            <span>➕</span>
            Tambah Anggota Baru
        </a>
    </div>

    @if($anggotas->count() > 0)
        <div class="members-grid">
            @foreach($anggotas as $anggota)
            <div class="member-card">
                <div class="member-header">
                    <div class="member-avatar">
                        {{ strtoupper(substr($anggota->nama, 0, 1)) }}
                    </div>
                    <h3 class="member-name">{{ $anggota->nama }}</h3>
                    <p class="member-nim">{{ $anggota->nim }}</p>
                </div>
                
                <div class="member-body">
                    <span class="member-position">{{ $anggota->jabatan }}</span>
                    
                    <div class="member-actions">
                        <a href="{{ route('anggota.show', $anggota->id) }}" class="action-btn btn-detail">
                            👁️ Detail
                        </a>
                        <a href="{{ route('anggota.edit', $anggota->id) }}" class="action-btn btn-edit">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" style="display:inline; flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('🚨 Yakin ingin menghapus anggota ini?')" class="action-btn btn-delete" style="width: 100%;">
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
            <div class="empty-icon">👥</div>
            <h3 class="empty-text">Belum ada anggota</h3>
            <p class="empty-subtext">Tambahkan anggota pertama untuk memulai</p>
        </div>
    @endif
</div>

<script>
// Add smooth loading effect
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.member-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
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
</script>
@endsection