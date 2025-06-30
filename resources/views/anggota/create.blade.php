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

    .netflix-create-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Animated Background */
    .netflix-create-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 30%, rgba(229, 9, 20, 0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(184, 7, 15, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 50% 50%, rgba(139, 0, 0, 0.05) 0%, transparent 50%);
        animation: backgroundPulse 6s ease-in-out infinite alternate;
        z-index: 1;
    }

    @keyframes backgroundPulse {
        0% { opacity: 0.8; transform: scale(1) rotate(0deg); }
        100% { opacity: 1; transform: scale(1.1) rotate(2deg); }
    }

    .create-form-wrapper {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95), rgba(13, 13, 13, 0.95));
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 3rem;
        max-width: 600px;
        width: 100%;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 2;
        animation: formEntrance 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    @keyframes formEntrance {
        0% { opacity: 0; transform: translateY(50px) scale(0.9); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .create-form-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
        border-radius: 20px 20px 0 0;
    }

    .form-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .form-title {
        font-size: 2.8rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #e50914);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: titleGradient 3s ease-in-out infinite;
        margin-bottom: 0.5rem;
        text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
    }

    @keyframes titleGradient {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .form-subtitle {
        font-size: 1.1rem;
        color: #b3b3b3;
        margin-bottom: 2rem;
    }

    .form-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        animation: iconFloat 3s ease-in-out infinite;
    }

    @keyframes iconFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Form Styling */
    .netflix-form {
        position: relative;
    }

    .form-group {
        margin-bottom: 2rem;
        position: relative;
        animation: fieldSlideIn 0.6s ease-out;
        animation-fill-mode: both;
    }

    .form-group:nth-child(1) { animation-delay: 0.1s; }
    .form-group:nth-child(2) { animation-delay: 0.2s; }
    .form-group:nth-child(3) { animation-delay: 0.3s; }
    .form-group:nth-child(4) { animation-delay: 0.4s; }

    @keyframes fieldSlideIn {
        0% { opacity: 0; transform: translateX(-30px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #b3b3b3;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .label-icon {
        font-size: 1rem;
        color: #e50914;
    }

    .form-input, .form-select {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(145deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
    }

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 
            0 0 0 3px rgba(229, 9, 20, 0.2),
            0 8px 25px rgba(229, 9, 20, 0.1);
        transform: translateY(-2px);
        background: linear-gradient(145deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    .form-input::placeholder {
        color: #666;
        transition: color 0.3s ease;
    }

    .form-input:focus::placeholder {
        color: #999;
    }

    .form-select {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23e50914' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 3rem;
    }

    .form-select option {
        background: #1a1a1a;
        color: #ffffff;
        padding: 0.5rem;
    }

    /* Input Animations */
    .form-input:not(:placeholder-shown) {
        border-color: rgba(229, 9, 20, 0.5);
    }

    .form-group.has-content .form-label {
        color: #e50914;
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 3rem;
        flex-wrap: wrap;
    }

    .netflix-btn {
        flex: 1;
        min-width: 140px;
        padding: 1rem 2rem;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
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

    .btn-submit {
        background: linear-gradient(135deg, #e50914, #b8070f);
        color: white;
        box-shadow: 0 6px 20px rgba(229, 9, 20, 0.4);
    }

    .btn-cancel {
        background: linear-gradient(135deg, #333333, #1a1a1a);
        color: white;
        border: 1px solid #555;
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
    }

    .btn-submit:hover {
        box-shadow: 0 12px 30px rgba(229, 9, 20, 0.6);
        color: white;
    }

    .btn-cancel:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        color: white;
    }

    /* Success Animation */
    .form-success {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        display: none;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        animation: successPop 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    @keyframes successPop {
        0% { transform: translate(-50%, -50%) scale(0); }
        100% { transform: translate(-50%, -50%) scale(1); }
    }

    /* Floating Elements */
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(184, 7, 15, 0.05));
        animation: floatShape 8s ease-in-out infinite;
    }

    .shape:nth-child(1) {
        width: 60px;
        height: 60px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 40px;
        height: 40px;
        top: 70%;
        right: 15%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 80px;
        height: 80px;
        bottom: 20%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes floatShape {
        0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
        50% { transform: translateY(-20px) rotate(180deg); opacity: 0.6; }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-create-container {
            padding: 1rem;
        }
        
        .create-form-wrapper {
            padding: 2rem;
        }
        
        .form-title {
            font-size: 2.2rem;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .netflix-btn {
            flex: none;
            width: 100%;
        }
    }

    /* Loading State */
    .loading .netflix-btn {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading .btn-submit::after {
        content: '';
        width: 16px;
        height: 16px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 8px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="netflix-create-container">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="create-form-wrapper">
        <div class="form-header">
            <div class="form-icon">🎬</div>
            <h1 class="form-title">TAMBAH ANGGOTA</h1>
            <p class="form-subtitle">Daftarkan anggota baru ke dalam sistem</p>
        </div>

        <form action="{{ route('anggota.store') }}" method="POST" class="netflix-form" id="memberForm">
            @csrf

            <div class="form-group">
                <label for="nim" class="form-label">
                    <span class="label-icon">🎓</span>
                    Nomor Induk Mahasiswa
                </label>
                <input type="text" 
                       name="NIM" 
                       id="NIM"
                       class="form-input" 
                       placeholder="Masukkan NIM"
                       required>
            </div>

            <div class="form-group">
                <label for="nama" class="form-label">
                    <span class="label-icon">👤</span>
                    Nama Lengkap
                </label>
                <input type="text" 
                       name="NAMA" 
                       id="NAMA"
                       class="form-input" 
                       placeholder="Masukkan nama lengkap"
                       required>
            </div>

            <div class="form-group">
                <label for="jabatan" class="form-label">
                    <span class="label-icon">🏆</span>
                    Jabatan
                </label>
                <input type="text" 
                       name="JABATAN" 
                       id="JABATAN"
                       class="form-input" 
                       placeholder="Masukkan jabatan"
                       required>
            </div>

            <div class="form-group">
                <label for="divisi_id" class="form-label">
                    <span class="label-icon">🏢</span>
                    Divisi
                </label>
                <select name="DIVISI_ID" id="DIVISI_ID" class="form-select">
                    <option value="">-- Pilih Divisi --</option>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id }}" {{ (old('divisi_id') == $divisi->id) ? 'selected' : '' }}>
                            {{ $divisi->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="netflix-btn btn-submit">
                    <span>💾</span>
                    Simpan Anggota
                </button>
                <a href="{{ route('anggota.index') }}" class="netflix-btn btn-cancel">
                    <span>❌</span>
                    Batal
                </a>
            </div>
        </form>

        <div class="form-success" id="successMessage">
            <span>✅</span>
            Anggota berhasil ditambahkan!
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('memberForm');
    const inputs = document.querySelectorAll('.form-input, .form-select');
    const submitBtn = document.querySelector('.btn-submit');
    
    // Add input focus animations
    inputs.forEach(input => {
        const formGroup = input.closest('.form-group');
        
        input.addEventListener('focus', function() {
            formGroup.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            formGroup.classList.remove('focused');
            if (this.value) {
                formGroup.classList.add('has-content');
            } else {
                formGroup.classList.remove('has-content');
            }
        });
        
        // Check for initial content
        if (input.value) {
            formGroup.classList.add('has-content');
        }
    });

    // Enhanced form validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            const formGroup = field.closest('.form-group');
            
            if (!field.value.trim()) {
                isValid = false;
                formGroup.style.animation = 'shake 0.5s ease-in-out';
                field.style.borderColor = '#dc3545';
                
                setTimeout(() => {
                    formGroup.style.animation = '';
                    field.style.borderColor = '';
                }, 500);
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            return false;
        }
        
        // Add loading state
        form.classList.add('loading');
        submitBtn.innerHTML = '<span>💾</span> Menyimpan...';
    });

    // Real-time validation
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.hasAttribute('required') && this.value.trim()) {
                this.style.borderColor = '#28a745';
                setTimeout(() => {
                    this.style.borderColor = '';
                }, 1000);
            }
        });
    });

    // Add typing effect to placeholder
    const nimInput = document.getElementById('nim');
    const nameInput = document.getElementById('nama');
    
    function addTypingEffect(input, texts) {
        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        function type() {
            const currentText = texts[textIndex];
            
            if (input === document.activeElement) return;
            
            if (isDeleting) {
                input.placeholder = currentText.substring(0, charIndex - 1);
                charIndex--;
            } else {
                input.placeholder = currentText.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentText.length) {
                setTimeout(() => isDeleting = true, 1500);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
            }
            
            setTimeout(type, isDeleting ? 50 : 100);
        }
        
        setTimeout(type, 2000);
    }
    
    // Add typing effects
    addTypingEffect(nimInput, ['Contoh: 123456789', 'Masukkan NIM Anda', 'NIM harus unik']);
    addTypingEffect(nameInput, ['Contoh: John Doe', 'Nama lengkap', 'Masukkan nama Anda']);
});

// Add shake animation for validation errors
const shakeKeyframes = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
`;

const style = document.createElement('style');
style.textContent = shakeKeyframes;
document.head.appendChild(style);
</script>
@endsection