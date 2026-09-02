@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<div x-data="{ openModal: false }" class="dashboard-container">

    <header class="dashboard-header">
        <div class="header-titles">
            <h1 class="page-title">Beranda</h1>
            <p class="page-subtitle">Ringkasan keuangan tokomu</p>
        </div>
        <button @click="openModal = true" class="btn-add-trx">
            <svg class="icon-plus" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Transaksi
        </button>
    </header>

    <section class="dashboard-grid">
        <!-- Card Keuntungan -->
        <article id="keuntunganCard" class="card-keuntungan">
            <h2 class="keuntungan-label">Keuntungan bulan ini</h2>
            <p class="keuntungan-total">Rp {{ number_format($keuntungan, 0, ',', '.') }}</p>
            <div class="keuntungan-stats">
                <span class="stat-item">
                    <svg class="icon-stat up" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path>
                    </svg>
                    Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                </span>
                <span class="stat-item">
                    <svg class="icon-stat down" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7L17 17M17 17H7M17 17V7"></path>
                    </svg>
                    Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                </span>
            </div>
        </article>

        <!-- Card Grafik Gradient -->
        <article class="card-grafik-gradient">
            <header class="chart-header">
                <div class="chart-title-group">
                    <svg class="chart-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                    <h2 class="grafik-title" id="grafikTitle">Tren 7 hari</h2>
                </div>
                <div class="chart-filters">
                    <button class="filter-btn" data-range="12_jam">12 Jam</button>
                    <button class="filter-btn" data-range="1_hari">1 Hari</button>
                    <button class="filter-btn active" data-range="7_hari">7 Hari</button>
                    <button class="filter-btn" data-range="30_hari">30 Hari</button>
                </div>
            </header>
            
            <div class="chart-container-line">
                <canvas id="trendChart"></canvas>
            </div>

            <!-- Custom Legend -->
            <div class="custom-legend" id="customLegend">
            </div>
        </article>
    </section>

    <section class="card-table">
        <header class="table-header">
            <h2 class="table-title">Transaksi Terbaru</h2>
            <nav class="table-actions">
                <a href="{{ route('history') }}" class="link-lihat-semua">Lihat Semua</a>
                <a href="{{ route('export.excel') }}" class="btn-export" style="text-decoration: none; display: inline-block;">Ekspor Excel</a>
            </nav>
        </header>

        <ul class="trx-list">
            @forelse($recentTransactions as $trx)
                <li class="trx-item">
                    <div class="trx-info">
                        <figure class="trx-icon-box {{ $trx->type == 'pemasukan' ? 'is-pemasukan' : 'is-pengeluaran' }}">
                            @if($trx->type == 'pemasukan')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7M17 7V17"></path></svg>
                            @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7L17 17M17 17H7M17 17V7"></path></svg>
                            @endif
                        </figure>
                        <div class="trx-details">
                            <p class="trx-name">{{ $trx->description }}</p>
                            <p class="trx-meta">{{ $trx->category ?? 'Lainnya' }} • {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</p>
                        </div>
                    </div>
                    <div class="trx-amount {{ $trx->type == 'pemasukan' ? 'text-green' : 'text-red' }}">
                        {{ $trx->type == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($trx->amount, 0, ',', '.') }}
                    </div>
                </li>
            @empty
                <li class="trx-empty">Belum ada transaksi.</li>
            @endforelse
        </ul>
    </section>

    <!-- Modal Tambah Transaksi -->
    <section role="dialog" aria-modal="true" x-show="openModal" class="modal-overlay" style="display: none;">
        <article @click.away="openModal = false" class="modal-box">
            <button @click="openModal = false" class="btn-close-modal" aria-label="Tutup modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <h2 class="modal-title">Tambah Transaksi</h2>
            <form action="{{ route('transactions.store') }}" method="POST" x-data="{ type: 'pemasukan' }">
                @csrf
                <fieldset class="toggle-group">
                    <button type="button" @click="type = 'pemasukan'" :class="type === 'pemasukan' ? 'active-pemasukan' : 'inactive-toggle'" class="toggle-btn">Pemasukan</button>
                    <button type="button" @click="type = 'pengeluaran'" :class="type === 'pengeluaran' ? 'active-pengeluaran' : 'inactive-toggle'" class="toggle-btn">Pengeluaran</button>
                </fieldset>
                <input type="hidden" name="type" x-bind:value="type">
                <fieldset class="form-fields">
                    <div class="input-group">
                        <label for="amount">Nominal</label>
                        <input type="number" id="amount" name="amount" placeholder="Rp 0" required>
                    </div>
                    <div class="input-group">
                        <label for="desc">Deskripsi</label>
                        <input type="text" id="desc" name="description" placeholder="mis. Terjual Kopi 5 cup" required>
                    </div>
                    <div class="input-group">
                        <label for="cat">Kategori</label>
                        <input type="text" id="cat" name="category" placeholder="mis. Penjualan">
                    </div>
                </fieldset>
                <footer class="modal-actions">
                    <button type="button" @click="openModal = false" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn-save">Simpan</button>
                </footer>
            </form>
        </article>
    </section>
</div>



<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const canvas = document.getElementById('trendChart');
        if (!canvas) return; 
        
        const ctx = canvas.getContext('2d');
        const chartData = @json($chartData);
        let currentRange = '7_hari'; 

        const formatMoney = (val) => {
            if(val >= 1000000) return (val / 1000000).toFixed(1).replace('.0','') + 'jt';
            if(val >= 1000) return (val / 1000).toFixed(0) + 'rb';
            return val;
        };

        // Fungsi Update Legend Total Saja
        const updateLegendUI = (range) => {
            const legendContainer = document.getElementById('customLegend');
            let totalIn = chartData[range].in.reduce((a,b)=>a+b, 0);
            let totalOut = chartData[range].out.reduce((a,b)=>a+b, 0);
            
            legendContainer.innerHTML = `
                <div class="legend-item"><span class="legend-dot" style="border-color: #00AEEF;"></span> Pemasukan: Rp ${formatMoney(totalIn)}</div>
                <div class="legend-item"><span class="legend-dot" style="border-color: #FF8B7B;"></span> Pengeluaran: Rp ${formatMoney(totalOut)}</div>
            `;
        };

        const dataConfig = {
            labels: chartData[currentRange].labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: chartData[currentRange].in,
                    borderColor: '#00AEEF',
                    backgroundColor: 'rgba(0, 174, 239, 0.15)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#00AEEF',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Pengeluaran',
                    data: chartData[currentRange].out,
                    borderColor: '#FF8B7B',
                    backgroundColor: 'rgba(255, 139, 123, 0.1)',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#FF8B7B',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }
            ]
        };

        let trendChart = new Chart(ctx, {
            type: 'line',
            data: dataConfig,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { 
                            display: true, 
                            color: 'rgba(0, 174, 239, 0.1)', 
                            borderDash: [5, 5],
                            drawBorder: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { 
                            display: true, 
                            color: 'rgba(0, 174, 239, 0.1)', 
                            borderDash: [5, 5],
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) { return formatMoney(value); }
                        }
                    }
                }
            }
        });

        updateLegendUI(currentRange);

        const filterBtns = document.querySelectorAll('.filter-btn');
        const titleEl = document.getElementById('grafikTitle');
        
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const range = this.getAttribute('data-range');
                const titleText = this.innerText;
                
                titleEl.innerText = 'Tren ' + titleText;
                trendChart.data.labels = chartData[range].labels;
                trendChart.data.datasets[0].data = chartData[range].in;
                trendChart.data.datasets[1].data = chartData[range].out;
                trendChart.update();
                
                updateLegendUI(range);
            });
        });
    });
</script>

<!-- Script AI Auto-Kategori -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen berdasarkan ID yang dibikin tim lu
    const inputDeskripsi = document.getElementById('desc');
    const inputKategori = document.getElementById('cat');

    if(inputDeskripsi && inputKategori) {
        // Event 'blur' jalan pas user beres ngetik dan klik ke luar kolom
        inputDeskripsi.addEventListener('blur', async function() {
            const teks = inputDeskripsi.value;
            if(!teks) return;

            try {
                // Kasih efek loading biar UI kerasa hidup
                inputKategori.value = "Sedang menebak..."; 
                
                const response = await fetch('http://127.0.0.1:5000/predict', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ deskripsi: teks })
                });
                
                const data = await response.json();
                
                // Isi otomatis kolom kategori pakai hasil dari Python
                if (data.kategori) {
                    inputKategori.value = data.kategori; 
                } else {
                    inputKategori.value = "Lainnya";
                }
                
            } catch (error) {
                console.error('AI belum nyambung cuy:', error);
                inputKategori.value = ""; 
            }
        });
    }
});
</script>

@endsection