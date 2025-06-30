@extends('layouts.app')

@section('content')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Netflix-inspired Theme */
    body {
        background: linear-gradient(135deg, #1a0707 0%, #2d0a0a 50%, #000000 100%);
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
    }

    .netflix-container {
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin: 2rem auto;
        max-width: 95%;
        box-shadow: 0 20px 40px rgba(220, 53, 69, 0.3);
        border: 1px solid rgba(220, 53, 69, 0.2);
        position: relative;
        overflow: hidden;
    }

    .netflix-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #dc3545, #8b0000, #dc3545);
        animation: pulse-border 2s ease-in-out infinite;
    }

    @keyframes pulse-border {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }

    .netflix-title {
        font-size: 3rem;
        font-weight: 900;
        text-align: center;
        margin-bottom: 2rem;
        background: linear-gradient(45deg, #dc3545, #8b0000, #dc3545);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradient-flow 3s ease infinite;
        text-shadow: 0 0 30px rgba(220, 53, 69, 0.5);
    }

    @keyframes gradient-flow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .kas-card {
        background: linear-gradient(135deg, #8b0000 0%, #dc3545 50%, #2d0a0a 100%);
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(220, 53, 69, 0.4);
        transform: translateY(0);
        transition: all 0.3s ease;
        border: 2px solid transparent;
        background-clip: padding-box;
        position: relative;
    }

    .kas-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(220, 53, 69, 0.6);
    }

    .kas-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 15px;
        padding: 2px;
        background: linear-gradient(45deg, #dc3545, #8b0000);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: exclude;
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask-composite: exclude;
    }

    .kas-amount {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        margin-bottom: 0.5rem;
    }

    .kas-label {
        font-size: 1.2rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .chart-container {
        background: rgba(0, 0, 0, 0.6);
        border-radius: 15px;
        padding: 2rem;
        margin: 2rem 0;
        border: 1px solid rgba(220, 53, 69, 0.3);
        position: relative;
    }

    .chart-container::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #dc3545, #8b0000, #dc3545);
        border-radius: 17px;
        z-index: -1;
        animation: border-glow 2s linear infinite;
    }

    @keyframes border-glow {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.8; }
    }

    .chart-title {
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1.5rem;
        color: #dc3545;
        text-shadow: 0 0 10px rgba(220, 53, 69, 0.5);
    }

    .netflix-btn {
        background: linear-gradient(45deg, #dc3545, #8b0000);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        margin: 0 8px 8px 0;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
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
        transition: left 0.5s;
    }

    .netflix-btn:hover::before {
        left: 100%;
    }

    .netflix-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6);
    }

    .netflix-btn.btn-success {
        background: linear-gradient(45deg, #28a745, #1e7e34);
    }

    .netflix-btn.btn-warning {
        background: linear-gradient(45deg, #ffc107, #e0a800);
    }

    .netflix-btn.btn-danger {
        background: linear-gradient(45deg, #dc3545, #8b0000);
    }

    .netflix-table {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 15px;
        overflow: hidden;
        margin: 2rem 0;
        border: 1px solid rgba(220, 53, 69, 0.3);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    .netflix-table table {
        width: 100%;
        border-collapse: collapse;
        color: white;
    }

    .netflix-table th {
        background: linear-gradient(45deg, #8b0000, #dc3545);
        padding: 1rem;
        text-align: left;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid rgba(220, 53, 69, 0.5);
    }

    .netflix-table td {
        padding: 1rem;
        border-bottom: 1px solid rgba(220, 53, 69, 0.2);
        transition: background-color 0.3s ease;
    }

    .netflix-table tr:hover td {
        background-color: rgba(220, 53, 69, 0.1);
    }

    .section-title {
        font-size: 2rem;
        font-weight: bold;
        margin: 2rem 0 1rem 0;
        color: #dc3545;
        text-shadow: 0 0 15px rgba(220, 53, 69, 0.5);
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #dc3545, transparent);
        border-radius: 2px;
    }

    .buttons-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin: 2rem 0;
        justify-content: center;
    }

    .floating-particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #dc3545;
        border-radius: 50%;
        opacity: 0.3;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin: 2rem 0;
    }

    @media (max-width: 768px) {
        .netflix-title { font-size: 2rem; }
        .kas-amount { font-size: 2rem; }
        .netflix-container { padding: 1rem; margin: 1rem; }
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="floating-particles">
    <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
    <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
    <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
    <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
    <div class="particle" style="left: 70%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 80%; animation-delay: 3s;"></div>
    <div class="particle" style="left: 90%; animation-delay: 1s;"></div>
</div>

<div class="netflix-container">
    <h1 class="netflix-title">💰 DASHBOARD KEUANGAN</h1>

    {{-- Total Kas dengan Animasi --}}
    <div class="kas-card">
        <div class="kas-label">Total Uang Kas</div>
        <div class="kas-amount" id="kasAmount">Rp {{ number_format($total_kas) }}</div>
        <div style="font-size: 0.9rem; opacity: 0.8; margin-top: 0.5rem;">
            💎 Kelola keuangan dengan bijak
        </div>
    </div>

    {{-- Grafik Keuangan Premium --}}
    <div class="chart-container">
        <h3 class="chart-title">📊 Analisis Keuangan Tahunan</h3>
        <canvas id="grafikKeuangan" height="100"></canvas>
    </div>

    {{-- Tombol Aksi yang Menarik --}}
    <div class="buttons-container">
        <a href="{{ route('uangmasuk.create') }}" class="netflix-btn btn-success">
            ➕ Tambah Uang Masuk
        </a>
        <a href="{{ route('uangkeluar.create') }}" class="netflix-btn btn-danger">
            ➖ Tambah Uang Keluar
        </a>
    </div>

    <div class="stats-grid">
        {{-- Tabel Uang Masuk Premium --}}
        <div>
            <h3 class="section-title">💚 Uang Masuk</h3>
            <div class="netflix-table">
                <table>
                    <thead>
                        <tr>
                            <th>📅 Tanggal</th>
                            <th>💰 Jumlah</th>
                            <th>📝 Keterangan</th>
                            <th>⚡ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($masuk as $m)
                        <tr>
                            <td>{{ $m->tanggal }}</td>
                            <td><strong>Rp {{ number_format($m->jumlah) }}</strong></td>
                            <td>{{ $m->keterangan }}</td>
                            <td>
                                <a href="{{ route('uangmasuk.edit', $m->id) }}" class="netflix-btn btn-warning" style="padding: 8px 16px; font-size: 0.8rem;">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('uangmasuk.destroy', $m->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="netflix-btn btn-danger" style="padding: 8px 16px; font-size: 0.8rem;" onclick="return confirm('🗑️ Hapus data ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tabel Uang Keluar Premium --}}
        <div>
            <h3 class="section-title">❤️ Uang Keluar</h3>
            <div class="netflix-table">
                <table>
                    <thead>
                        <tr>
                            <th>📅 Tanggal</th>
                            <th>💸 Jumlah</th>
                            <th>📝 Keterangan</th>
                            <th>⚡ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keluar as $k)
                        <tr>
                            <td>{{ $k->tanggal }}</td>
                            <td><strong>Rp {{ number_format($k->jumlah) }}</strong></td>
                            <td>{{ $k->keterangan }}</td>
                            <td>
                                <a href="{{ route('uangkeluar.edit', $k->id) }}" class="netflix-btn btn-warning" style="padding: 8px 16px; font-size: 0.8rem;">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('uangkeluar.destroy', $k->id) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="netflix-btn btn-danger" style="padding: 8px 16px; font-size: 0.8rem;" onclick="return confirm('🗑️ Hapus data ini?')">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Enhanced Chart Script --}}
<script>
    // Animasi untuk total kas
    function animateKasAmount() {
        const kasElement = document.getElementById('kasAmount');
        kasElement.style.transform = 'scale(1.1)';
        setTimeout(() => {
            kasElement.style.transform = 'scale(1)';
        }, 300);
    }

    // Jalankan animasi setiap 5 detik
    setInterval(animateKasAmount, 5000);

    // Chart dengan tema Netflix
    const ctx = document.getElementById('grafikKeuangan');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: '💚 Uang Masuk',
                    backgroundColor: 'linear-gradient(45deg, #28a745, #20c997)',
                    borderColor: '#28a745',
                    borderWidth: 2,
                    data: {!! json_encode($dataMasuk) !!},
                    borderRadius: 8,
                    borderSkipped: false,
                },
                {
                    label: '❤️ Uang Keluar',
                    backgroundColor: 'linear-gradient(45deg, #dc3545, #fd7e14)',
                    borderColor: '#dc3545',
                    borderWidth: 2,
                    data: {!! json_encode($dataKeluar) !!},
                    borderRadius: 8,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#ffffff',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#dc3545',
                    bodyColor: '#ffffff',
                    borderColor: '#dc3545',
                    borderWidth: 1,
                    cornerRadius: 10,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#ffffff',
                        font: {
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(220, 53, 69, 0.2)'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ffffff',
                        font: {
                            weight: 'bold'
                        },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        color: 'rgba(220, 53, 69, 0.2)'
                    }
                }
            }
        }
    });

    // Animasi hover untuk tombol
    document.querySelectorAll('.netflix-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.05)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Efek partikel tambahan saat load
    window.addEventListener('load', function() {
        setTimeout(() => {
            document.querySelector('.netflix-container').style.opacity = '1';
            document.querySelector('.netflix-container').style.transform = 'translateY(0)';
        }, 100);
    });
</script>

<style>
    .netflix-container {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease;
    }
</style>

@endsection