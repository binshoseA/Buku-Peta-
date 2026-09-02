@extends('layouts.app')

@section('content')
<!-- Memanggil file CSS khusus Profil -->
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container" x-data="{ confirmDelete: false }">
    
    <header class="profile-header">
        <h1 class="page-title">Profil</h1>
        <p class="page-subtitle">Informasi akun dan tokomu</p>
    </header>

    <!-- Kartu Utama: Info Pengguna & Toko -->
    <article class="card-main">
        
        <!-- Header User -->
        <div class="user-info">
            <figure class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </figure>
            <div class="user-text">
                <h2 class="user-name">{{ Auth::user()->name }}</h2>
                <p class="user-role">Pemilik toko</p>
            </div>
        </div>

        <!-- Garis Pemisah Tipis -->
        <div class="divider-wrap">
            <hr class="solid-divider">
        </div>

        <!-- Detail Toko & Email -->
        <div class="detail-section">
            <div class="detail-row">
                <div class="detail-icon">
                    <!-- Icon Toko (Solid) -->
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 6V4h16v2H4zm0 14v-8h16v8H4zm2-6h12v4H6v-4z"></path>
                        <path d="M2 9l2-3h16l2 3v2H2V9z"></path>
                    </svg>
                </div>
                <div class="detail-text">
                    <span class="detail-label">Nama Toko</span>
                    <span class="detail-value">{{ Auth::user()->store_name ?? 'Toko' }}</span>
                </div>
            </div>

            <div class="detail-row">
                <div class="detail-icon">
                    <!-- Icon Email (Solid) -->
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"></path>
                    </svg>
                </div>
                <div class="detail-text">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
    </article>

    <!-- Kartu Statistik (Kiri Kanan) -->
    <section class="stats-grid">
        <article class="stat-card">
            <div class="stat-icon">
                <!-- Icon ID Card / Bergabung -->
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1z"></path>
                </svg>
            </div>
            <div class="stat-text">
                <span class="stat-label">Bergabung Sejak</span>
                <span class="stat-value">{{ Auth::user()->created_at->format('j F Y') }}</span>
            </div>
        </article>

        <article class="stat-card">
            <div class="stat-icon">
                <!-- Icon Uang / Transaksi -->
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                    <path d="M5 6h14v2H5zm0 10h14v2H5z"></path>
                </svg>
            </div>
            <div class="stat-text">
                <span class="stat-label">Total Transaksi</span>
                <span class="stat-value">{{ Auth::user()->transactions()->count() }} Transaksi</span>
            </div>
        </article>
    </section>

    <!-- Tombol Hapus Akun -->
    <button @click="confirmDelete = true" class="btn-delete-account">
        <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"></path>
        </svg>
        Hapus Akun
    </button>

    <!-- Modal Konfirmasi Hapus (Tetap menggunakan Tailwind & Alpine untuk fungsionalitas overlay) -->
    <section role="dialog" aria-modal="true" x-show="confirmDelete" class="fixed inset-0 bg-gray-900 bg-opacity-40 flex items-center justify-center z-50 backdrop-blur-sm" style="display: none;">
        <article class="bg-white rounded-[24px] shadow-2xl w-full max-w-sm p-8 text-center relative">
            <h2 class="text-xl font-bold text-gray-800 mb-2 font-serif">Hapus Akun</h2>
            <p class="text-sm text-gray-500 mb-6">Anda yakin ingin hapus akun? Semua data transaksi akan hilang permanen.</p>
            
            <form action="{{ route('profile.destroy') }}" method="POST" class="flex gap-4">
                @csrf
                @method('DELETE')
                <button type="button" @click="confirmDelete = false" class="flex-1 bg-gray-100 text-gray-600 rounded-full py-3 text-sm font-bold transition hover:bg-gray-200">Batal</button>
                <button type="submit" class="flex-1 bg-[#EF4444] text-white rounded-full py-3 text-sm font-bold shadow-lg transition hover:bg-red-600">Hapus</button>
            </form>
        </article>
    </section>

</div>
@endsection