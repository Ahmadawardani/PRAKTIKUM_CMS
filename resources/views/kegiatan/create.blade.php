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

    .netflix-form-container {
        min-height: 100vh;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Background Animation */
    .netflix-form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(229, 9, 20, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(184, 7, 15, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 50% 50%, rgba(139, 0, 0, 0.05) 0%, transparent 70%);
        animation: backgroundPulse 8s ease-in-out infinite alternate;
        z-index: 1;
    }

    @keyframes backgroundPulse {
        0% { opacity: 0.5; transform: scale(1); }
        100% { opacity: 1; transform: scale(1.1); }
    }

    /* Header Section */
    .form-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        z-index: 2;
    }

    .form-title {
        font-size: 3rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #e50914);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s ease-in-out infinite;
        margin-bottom: 1rem;
        text-shadow: 0 0 30px rgba(229, 9, 20, 0.3);
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .form-subtitle {
        font-size: 1.2rem;
        color: #b3b3b3;
        margin-bottom: 0;
    }

    /* Main Form Container */
    .form-wrapper {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 2;
    }

    .netflix-form {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 3rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .netflix-form::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
        animation: topGlow 2s ease-in-out infinite alternate;
    }

    @keyframes topGlow {
        0% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    /* Error Alert */
    .netflix-alert {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.2), rgba(184, 7, 15, 0.2));
        border: 1px solid rgba(220, 53, 69, 0.4);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
    }

    .netflix-alert ul {
        margin: 0;
        padding-left: 1.5rem;
        list-style: none;
    }

    .netflix-alert li {
        position: relative;
        margin-bottom: 0.5rem;
        color: #ff6b6b;
    }

    .netflix-alert li::before {
        content: '⚠️';
        position: absolute;
        left: -1.5rem;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
    }

    .form-label::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        width: 30px;
        height: 2px;
        background: #e50914;
        border-radius: 2px;
    }

    /* Input Styles */
    .netflix-input {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(145deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        backdrop-filter: blur(10px);
        box-sizing: border-box;
    }

    .netflix-input:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 
            0 0 0 3px rgba(229, 9, 20, 0.2),
            0 8px 25px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
        background: linear-gradient(145deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    .netflix-input::placeholder {
        color: #888;
    }

    /* Textarea */
    .netflix-textarea {
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
    }

    /* Checkbox Section */
    .checkbox-section {
        background: linear-gradient(145deg, rgba(35, 35, 35, 0.6), rgba(25, 25, 25, 0.6));
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-top: 1rem;
    }

    .checkbox-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .checkbox-item {
        background: linear-gradient(135deg, rgba(45, 45, 45, 0.8), rgba(35, 35, 35, 0.8));
        border-radius: 10px;
        padding: 1rem;
        border: 2px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .checkbox-item:hover {
        border-color: rgba(229, 9, 20, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.1);
    }

    .checkbox-item.checked {
        border-color: #e50914;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.2), rgba(184, 7, 15, 0.2));
    }

    .checkbox-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(229, 9, 20, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .checkbox-item:hover::before {
        left: 100%;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        position: relative;
        z-index: 2;
    }

    .checkbox-input {
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #666;
        border-radius: 4px;
        background: transparent;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .checkbox-input:checked {
        background: #e50914;
        border-color: #e50914;
    }

    .checkbox-input:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .checkbox-label {
        font-weight: 500;
        color: #ffffff;
        cursor: pointer;
        flex: 1;
    }

    .member-info {
        font-size: 0.85rem;
        color: #b3b3b3;
        margin-top: 4px;
    }

    /* Buttons */
    .button-group {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 3rem;
        flex-wrap: wrap;
    }

    .netflix-btn {
        padding: 1rem 2.5rem;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
        overflow: hidden;
        min-width: 150px;
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

    .btn-primary {
        background: linear-gradient(135deg, #e50914, #b8070f);
        color: white;
        box-shadow: 0 6px 20px rgba(229, 9, 20, 0.4);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #333333, #1a1a1a);
        color: white;
        border: 1px solid #555;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
    }

    .btn-primary:hover {
        box-shadow: 0 10px 30px rgba(229, 9, 20, 0.6);
        color: white;
    }

    .btn-secondary:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        color: white;
    }

    /* Floating Elements */
    .floating-icon {
        position: absolute;
        font-size: 2rem;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-form-container {
            padding: 1rem;
        }
        
        .form-title {
            font-size: 2.2rem;
        }
        
        .netflix-form {
            padding: 2rem;
        }
        
        .checkbox-grid {
            grid-template-columns: 1fr;
        }
        
        .button-group {
            flex-direction: column;
            align-items: center;
        }
        
        .netflix-btn {
            width: 100%;
            max-width: 300px;
        }
    }
</style>

<div class="netflix-form-container">
    <!-- Floating Icons -->
    <div class="floating-icon" style="top: 10%; left: 5%; animation-delay: 0s;">🎬</div>
    <div class="floating-icon" style="top: 20%; right: 10%; animation-delay: 2s;">📅</div>
    <div class="floating-icon" style="bottom: 30%; left: 8%; animation-delay: 4s;">✨</div>
    <div class="floating-icon" style="bottom: 20%; right: 5%; animation-delay: 6s;">🎭</div>

    <div class="form-header">
        <h1 class="form-title">TAMBAH KEGIATAN</h1>
        <p class="form-subtitle">Buat kegiatan baru yang menginspirasi</p>
    </div>

    <div class="form-wrapper">
        <div class="netflix-form">
            @if($errors->any())
                <div class="netflix-alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kegiatan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_kegiatan" class="form-label">🎯 Nama Kegiatan</label>
                    <input type="text" 
                           name="nama_kegiatan" 
                           id="nama_kegiatan"
                           class="netflix-input" 
                           value="{{ old('nama_kegiatan') }}" 
                           placeholder="Masukkan nama kegiatan yang menarik..."
                           required>
                </div>

                <div class="form-group">
                    <label for="tanggal" class="form-label">📅 Tanggal Pelaksanaan</label>
                    <input type="date" 
                           name="tanggal" 
                           id="tanggal"
                           class="netflix-input" 
                           value="{{ old('tanggal') }}">
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">📝 Deskripsi Kegiatan</label>
                    <textarea name="deskripsi" 
                              id="deskripsi"
                              class="netflix-input netflix-textarea" 
                              placeholder="Jelaskan detail kegiatan, tujuan, dan hal-hal penting lainnya...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">👥 Pilih Anggota Panitia</label>
                    <div class="checkbox-section">
                        <div class="checkbox-title">
                            <span>🎪</span>
                            Tim Panitia Kegiatan
                        </div>
                        <div class="checkbox-grid">
                            @foreach($anggotas as $anggota)
                                <div class="checkbox-item" onclick="toggleCheckbox('anggota{{ $anggota->id }}')">
                                    <div class="custom-checkbox">
                                        <input class="checkbox-input" 
                                               type="checkbox" 
                                               name="anggota_id[]" 
                                               value="{{ $anggota->id }}" 
                                               id="anggota{{ $anggota->id }}"
                                               onchange="updateCheckboxStyle(this)">
                                        <div class="checkbox-label">
                                            <div>{{ $anggota->nama }}</div>
                                            <div class="member-info">{{ $anggota->nim }} • {{ $anggota->jabatan }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="netflix-btn btn-primary">
                        <span>💾</span>
                        Simpan Kegiatan
                    </button>
                    <a href="{{ route('kegiatan.index') }}" class="netflix-btn btn-secondary">
                        <span>❌</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Form Animation on Load
document.addEventListener('DOMContentLoaded', function() {
    const formGroups = document.querySelectorAll('.form-group');
    
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, index * 150 + 300);
    });

    // Add focus effects to inputs
    const inputs = document.querySelectorAll('.netflix-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
});

// Checkbox Functions
function toggleCheckbox(checkboxId) {
    const checkbox = document.getElementById(checkboxId);
    checkbox.checked = !checkbox.checked;
    updateCheckboxStyle(checkbox);
}

function updateCheckboxStyle(checkbox) {
    const checkboxItem = checkbox.closest('.checkbox-item');
    if (checkbox.checked) {
        checkboxItem.classList.add('checked');
    } else {
        checkboxItem.classList.remove('checked');
    }
}

// Initialize checkbox styles
document.querySelectorAll('.checkbox-input').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        updateCheckboxStyle(this);
    });
});

// Add ripple effect to buttons
document.querySelectorAll('.netflix-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        const ripple = document.createElement('div');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add ripple keyframes
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