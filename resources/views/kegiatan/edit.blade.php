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

    .netflix-edit-container {
        min-height: 100vh;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .netflix-edit-container::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 20%, rgba(229, 9, 20, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 80%, rgba(184, 7, 15, 0.1) 0%, transparent 50%);
        z-index: -1;
        animation: backgroundPulse 6s ease-in-out infinite alternate;
    }

    @keyframes backgroundPulse {
        0% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    .edit-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .edit-title {
        font-size: 3rem;
        font-weight: 900;
        background: linear-gradient(45deg, #e50914, #ff6b6b, #e50914);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s ease-in-out infinite;
        margin-bottom: 0.5rem;
        text-shadow: 0 0 30px rgba(229, 9, 20, 0.5);
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .edit-subtitle {
        font-size: 1.1rem;
        color: #b3b3b3;
        margin-bottom: 2rem;
    }

    .form-container {
        max-width: 800px;
        margin: 0 auto;
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

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, #e50914, transparent);
    }

    /* Error Alert Styling */
    .netflix-alert {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.9), rgba(176, 42, 55, 0.9));
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        backdrop-filter: blur(10px);
        animation: slideInDown 0.5s ease-out;
    }

    @keyframes slideInDown {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .netflix-alert ul {
        margin: 0;
        padding-left: 1.5rem;
        list-style: none;
    }

    .netflix-alert li {
        position: relative;
        padding: 0.25rem 0;
        color: #fff;
    }

    .netflix-alert li::before {
        content: '⚠️';
        position: absolute;
        left: -1.5rem;
    }

    /* Form Group Styling */
    .form-group {
        margin-bottom: 2rem;
        position: relative;
    }

    .form-label {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .label-icon {
        font-size: 1.2rem;
        color: #e50914;
    }

    .form-input {
        width: 100%;
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, rgba(40, 40, 40, 0.8), rgba(30, 30, 30, 0.8));
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        backdrop-filter: blur(10px);
    }

    .form-input:focus {
        outline: none;
        border-color: #e50914;
        box-shadow: 0 0 20px rgba(229, 9, 20, 0.3);
        transform: translateY(-2px);
        background: linear-gradient(135deg, rgba(50, 50, 50, 0.9), rgba(40, 40, 40, 0.9));
    }

    .form-input::placeholder {
        color: #888;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
        font-family: inherit;
    }

    /* Checkbox Section */
    .checkbox-section {
        background: linear-gradient(135deg, rgba(35, 35, 35, 0.8), rgba(25, 25, 25, 0.8));
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 2rem;
    }

    .checkbox-title {
        font-size: 1.2rem;
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
        background: linear-gradient(135deg, rgba(45, 45, 45, 0.6), rgba(35, 35, 35, 0.6));
        border-radius: 10px;
        padding: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .checkbox-item:hover {
        transform: translateY(-2px);
        border-color: rgba(229, 9, 20, 0.5);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .checkbox-item::before {
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

    .checkbox-item:hover::before {
        opacity: 1;
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
        width: 20px;
        height: 20px;
        border: 2px solid #666;
        border-radius: 4px;
        background: transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        flex-shrink: 0;
    }

    .checkbox-input:checked {
        background: linear-gradient(135deg, #e50914, #b8070f);
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
        color: #ffffff;
        font-weight: 500;
        flex: 1;
    }

    .checkbox-nim {
        color: #b3b3b3;
        font-size: 0.9rem;
        display: block;
        margin-top: 2px;
    }

    /* Button Styling */
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
        gap: 10px;
        position: relative;
        overflow: hidden;
        min-width: 150px;
        justify-content: center;
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
        box-shadow: 0 4px 15px rgba(229, 9, 20, 0.3);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #666666, #4a4a4a);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .netflix-btn:hover {
        transform: translateY(-3px);
        text-decoration: none;
        color: white;
    }

    .btn-primary:hover {
        box-shadow: 0 8px 25px rgba(229, 9, 20, 0.5);
    }

    .btn-secondary:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    }

    /* Floating Elements */
    .floating-icon {
        position: absolute;
        font-size: 2rem;
        color: rgba(229, 9, 20, 0.1);
        animation: float 6s ease-in-out infinite;
        pointer-events: none;
    }

    .floating-icon:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .floating-icon:nth-child(2) { top: 20%; right: 15%; animation-delay: 2s; }
    .floating-icon:nth-child(3) { bottom: 30%; left: 20%; animation-delay: 4s; }
    .floating-icon:nth-child(4) { bottom: 20%; right: 10%; animation-delay: 6s; }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .netflix-edit-container {
            padding: 1rem;
        }
        
        .edit-title {
            font-size: 2rem;
        }
        
        .form-container {
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

<div class="netflix-edit-container">
    <!-- Floating Icons -->
    <div class="floating-icon">🎬</div>
    <div class="floating-icon">📝</div>
    <div class="floating-icon">⭐</div>
    <div class="floating-icon">🎭</div>

    <div class="edit-header">
        <h1 class="edit-title">EDIT KEGIATAN</h1>
        <p class="edit-subtitle">Perbarui informasi kegiatan dan panitia</p>
    </div>

    <div class="form-container">
        @if($errors->any())
            <div class="netflix-alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_kegiatan" class="form-label">
                    <span class="label-icon">🎪</span>
                    Nama Kegiatan
                </label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-input" 
                       value="{{ $kegiatan->nama_kegiatan }}" required
                       placeholder="Masukkan nama kegiatan...">
            </div>

            <div class="form-group">
                <label for="tanggal" class="form-label">
                    <span class="label-icon">📅</span>
                    Tanggal Kegiatan
                </label>
                <input type="date" name="tanggal" id="tanggal" class="form-input" 
                       value="{{ $kegiatan->tanggal }}">
            </div>

            <div class="form-group">
                <label for="deskripsi" class="form-label">
                    <span class="label-icon">📋</span>
                    Deskripsi Kegiatan
                </label>
                <textarea name="deskripsi" id="deskripsi" class="form-input form-textarea"
                          placeholder="Jelaskan detail kegiatan...">{{ $kegiatan->deskripsi }}</textarea>
            </div>

            <div class="checkbox-section">
                <div class="checkbox-title">
                    <span class="label-icon">👥</span>
                    Pilih Anggota Panitia
                </div>
                <div class="checkbox-grid">
                    @foreach($anggotas as $anggota)
                        <div class="checkbox-item">
                            <label class="custom-checkbox">
                                <input type="checkbox" name="anggota_id[]" value="{{ $anggota->id }}"
                                       class="checkbox-input"
                                       {{ $kegiatan->anggotas->contains($anggota->id) ? 'checked' : '' }}>
                                <div class="checkbox-label">
                                    <strong>{{ $anggota->nama }}</strong>
                                    <span class="checkbox-nim">{{ $anggota->nim }} - {{ $anggota->jabatan }}</span>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="netflix-btn btn-primary">
                    <span>💾</span>
                    Update Kegiatan
                </button>
                <a href="{{ route('kegiatan.index') }}" class="netflix-btn btn-secondary">
                    <span>❌</span>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const formGroups = document.querySelectorAll('.form-group, .checkbox-section');
    
    formGroups.forEach((group, index) => {
        group.style.opacity = '0';
        group.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            group.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
        }, index * 100 + 300);
    });

    // Enhanced checkbox interactions
    const checkboxItems = document.querySelectorAll('.checkbox-item');
    
    checkboxItems.forEach(item => {
        const checkbox = item.querySelector('.checkbox-input');
        
        item.addEventListener('click', function(event) {
            if (event.target !== checkbox) {
                checkbox.checked = !checkbox.checked;
                updateCheckboxState(item, checkbox.checked);
            }
        });
        
        checkbox.addEventListener('change', function() {
            updateCheckboxState(item, this.checked);
        });
        
        // Initialize state
        updateCheckboxState(item, checkbox.checked);
    });
    
    function updateCheckboxState(item, isChecked) {
        if (isChecked) {
            item.style.borderColor = 'rgba(229, 9, 20, 0.8)';
            item.style.background = 'linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(184, 7, 15, 0.1))';
        } else {
            item.style.borderColor = 'rgba(255, 255, 255, 0.1)';
            item.style.background = 'linear-gradient(135deg, rgba(45, 45, 45, 0.6), rgba(35, 35, 35, 0.6))';
        }
    }

    // Form validation feedback
    const form = document.querySelector('form');
    const inputs = document.querySelectorAll('.form-input');
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        inputs.forEach(input => {
            if (input.hasAttribute('required') && !input.value.trim()) {
                input.style.borderColor = '#dc3545';
                input.style.boxShadow = '0 0 20px rgba(220, 53, 69, 0.3)';
                isValid = false;
            } else {
                input.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                input.style.boxShadow = 'none';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = document.querySelector('.form-input[style*="border-color: rgb(220, 53, 69)"]');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });

    // Auto-resize textarea
    const textarea = document.querySelector('.form-textarea');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
        
        // Initial resize
        textarea.style.height = textarea.scrollHeight + 'px';
    }
});
</script>
@endsection