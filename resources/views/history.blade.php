@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/history.css') }}">

<div class="history-container" x-data="{ filter: 'semua' }">
    
    <header class="history-header">
        <h1 class="page-title">Riwayat Transaksi</h1>
    </header>

    <section class="history-card">
        
        <!-- Filter Tabs (Pill style) -->
        <nav class="filter-group" aria-label="Filter Transaksi">
            <button @click="filter = 'semua'" 
                    :class="filter === 'semua' ? 'filter-btn active' : 'filter-btn inactive'" 
                    class="transition-colors">
                Semua
            </button>
            <button @click="filter = 'pemasukan'" 
                    :class="filter === 'pemasukan' ? 'filter-btn active' : 'filter-btn inactive'" 
                    class="transition-colors">
                Pemasukan
            </button>
            <button @click="filter = 'pengeluaran'" 
                    :class="filter === 'pengeluaran' ? 'filter-btn active' : 'filter-btn inactive'" 
                    class="transition-colors">
                Pengeluaran
            </button>
        </nav>

        <!-- List Transaksi -->
        <ul class="history-list">
            @forelse($transactions as $trx)
            <li x-show="filter === 'semua' || filter === '{{ $trx->type }}'" 
                class="history-item" 
                style="display: none;" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0">
                
                <div class="trx-info">
                    <!-- Icon Berdasarkan Tipe -->
                    <figure class="icon-box {{ $trx->type == 'pemasukan' ? 'icon-in' : 'icon-out' }}">
                        @if($trx->type == 'pemasukan')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 17L17 7M17 7H7M17 7V17"></path>
                            </svg>
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 7L7 17M7 17H17M7 17V7"></path>
                            </svg>
                        @endif
                    </figure>
                    
                    <!-- Detail Teks -->
                    <div class="trx-details">
                        <p class="trx-title">{{ $trx->description }}</p>
                        <p class="trx-meta">{{ $trx->category ?? 'Tanpa Kategori' }} • {{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</p>
                    </div>
                </div>
                
                <!-- Nominal -->
                <div class="trx-amount {{ $trx->type == 'pemasukan' ? 'text-in' : 'text-out' }}">
                    {{ $trx->type == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($trx->amount, 0, ',', '.') }}
                </div>
                
            </li>
            @empty
            <li class="history-empty">
                Belum ada riwayat transaksi yang dicatat.
            </li>
            @endforelse
        </ul>

    </section>
</div>
@endsection