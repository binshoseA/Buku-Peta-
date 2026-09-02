<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku PETA - UMKM</title>
    <!-- Pemanggilan CSS Murni -->
    <link rel="stylesheet" href="{{ asset('css/onboarding.css') }}">
</head>
<body>

    <!-- Header & Lewati -->
    <header class="brand-header">
        <figure class="brand-logo">
            <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
        </figure>
        <h1 class="brand-title">Buku PETA - UMKM</h1>
    </header>

    <nav class="top-nav">
        <a href="{{ route('login') }}" class="skip-link">
            Lewati, langsung masuk <span class="skip-icon">&gt;</span>
        </a>
    </nav>

    <!-- Area Slider -->
    <main class="onboarding-main">
        
        <button class="nav-arrow prev" id="btn-prev" style="display: none;">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <article class="slider-wrapper">
            <div class="slider-track" id="slider-track">
                
                <!-- Slide 1 -->
                <section class="slide">
                    <span class="slide-label">Dibuat Khusus Pelaku UMKM</span>
                    <figure class="slide-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    </figure>
                    <h2 class="slide-title">Kelola Keuangan Tokomu,<br>Tanpa Ribet Hitung Manual</h2>
                    <p class="slide-desc">Buku PETA (Pembukuan dan Evaluasi Transaksi Otomatis) dibuat untuk mencatat transaksi harian, biar sistem yang kategorikan otomatis — lalu pantau keuntungan dan unduh laporan kapan pun kamu butuh.</p>
                </section>

                <!-- Slide 2 -->
                <section class="slide">
                    <span class="slide-label">Kenapa harus pakai web ini?</span>
                    <figure class="slide-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </figure>
                    <h2 class="slide-title">Buku Catatan Digital,<br>Ndak Bakalan Hilang</h2>
                    <p class="slide-desc">Selama ini rentan robek, basah, atau kececer. Semua tercatat aman di sistem, bisa dibuka kapan aja dari mana aja — nggak ada lagi cerita catatan ilang pas paling butuh.</p>
                </section>

                <!-- Slide 3 -->
                <section class="slide">
                    <span class="slide-label">Kenapa harus pakai web ini?</span>
                    <figure class="slide-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    </figure>
                    <h2 class="slide-title">Arsip Transaksi<br>Tertata Rapi</h2>
                    <p class="slide-desc">Semua transaksi otomatis kearsip per tanggal dan kategori. Nggak perlu bongkar tumpukan nota buat cari catatan bulan lalu — tinggal cari, langsung ketemu.</p>
                </section>

                <!-- Slide 4 -->
                <section class="slide">
                    <span class="slide-label">Cara pakainya?? Langkah 01</span>
                    <figure class="slide-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </figure>
                    <h2 class="slide-title">Daftar Akun</h2>
                    <p class="slide-desc">Buat akun toko kamu dalam kurang dari semenit, langsung bisa dipakai — nggak ribet, cukup nama, email, dan kata sandi.</p>
                </section>

                <!-- Slide 5 -->
                <section class="slide">
                    <span class="slide-label">Cara pakainya?? Langkah 02</span>
                    <figure class="slide-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </figure>
                    <h2 class="slide-title">Catat Transaksi,<br>Sistem Kategorikan Otomatis</h2>
                    <p class="slide-desc">Ketik deskripsi tiap transaksi masuk/keluar (mis. "beli tepung 5kg"), sistem langsung nebak kategorinya. Tinggal cek, atau ganti manual kalau perlu.</p>
                </section>

                <!-- Slide 6 -->
                <section class="slide">
                    <span class="slide-label">Cara pakainya?? Langkah 03</span>
                    <figure class="slide-icon">
                        <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </figure>
                    <h2 class="slide-title">Pantau Grafik<br>Keuntungan</h2>
                    <p class="slide-desc">Lihat tren untung-rugi harian langsung dari dashboard, lengkap dengan breakdown pengeluaran per kategori — tanpa hitung manual satu-satu.</p>
                </section>

            </div>

            <!-- Kontrol Bawah -->
            <footer class="slider-controls">
                <div class="dots" id="dots-container">
                    <!-- Dots dibuat via JS -->
                </div>
                <button class="btn-primary" id="btn-lanjut">Lanjut &rarr;</button>
            </footer>
        </article>

        <button class="nav-arrow next" id="btn-next">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
        </button>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('slider-track');
            const slides = document.querySelectorAll('.slide');
            const btnPrev = document.getElementById('btn-prev');
            const btnNext = document.getElementById('btn-next');
            const btnLanjut = document.getElementById('btn-lanjut');
            const dotsContainer = document.getElementById('dots-container');
            
            let currentSlide = 0;
            const totalSlides = slides.length;

            // Buat indikator titik (dots)
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }
            const dots = document.querySelectorAll('.dot');

            function updateUI() {
                // Geser track
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });

                // Sembunyikan/tampilkan panah
                btnPrev.style.display = currentSlide === 0 ? 'none' : 'flex';
                btnNext.style.display = currentSlide === totalSlides - 1 ? 'none' : 'flex';

                // Update teks tombol utama
                if (currentSlide === totalSlides - 1) {
                    btnLanjut.innerHTML = 'Mulai Sekarang &rarr;';
                } else {
                    btnLanjut.innerHTML = 'Lanjut &rarr;';
                }
            }

            function goToSlide(index) {
                currentSlide = index;
                updateUI();
            }

            btnNext.addEventListener('click', () => {
                if (currentSlide < totalSlides - 1) goToSlide(currentSlide + 1);
            });

            btnPrev.addEventListener('click', () => {
                if (currentSlide > 0) goToSlide(currentSlide - 1);
            });

           btnLanjut.addEventListener('click', () => {
    if (currentSlide < totalSlides - 1) {
        goToSlide(currentSlide + 1);
    } else {
        transitionToLogin();
    }
});

function transitionToLogin() {
    const rect = btnLanjut.getBoundingClientRect();

    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = rect.top + 'px';
    overlay.style.left = rect.left + 'px';
    overlay.style.width = rect.width + 'px';
    overlay.style.height = rect.height + 'px';
    overlay.style.borderRadius = '999px';
    overlay.style.background = 'linear-gradient(160deg,#1fb3e6 0%,#1a86c9 55%,#0f5f96 100%)';
    overlay.style.boxShadow = '0 10px 20px -8px rgba(46,155,199,0.55)';
    overlay.style.zIndex = '99999';
    overlay.style.pointerEvents = 'none';
    overlay.style.transition = 'top 0.6s cubic-bezier(0.65,0,0.35,1), left 0.6s cubic-bezier(0.65,0,0.35,1), width 0.6s cubic-bezier(0.65,0,0.35,1), height 0.6s cubic-bezier(0.65,0,0.35,1), border-radius 0.6s cubic-bezier(0.65,0,0.35,1)';
    document.body.appendChild(overlay);

    // Redupkan konten sekitar biar fokus ke overlay yang membesar
    ['.onboarding-main', '.top-nav', '.brand-header'].forEach(sel => {
        const el = document.querySelector(sel);
        if (el) {
            el.style.transition = 'opacity 0.4s ease';
            el.style.opacity = '0';
        }
    });

    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            overlay.style.top = '0px';
            overlay.style.left = '0px';
            overlay.style.width = '100vw';
            overlay.style.height = '100vh';
            overlay.style.borderRadius = '0px';
        });
    });

    overlay.addEventListener('transitionend', () => {
        sessionStorage.setItem('peta_transition', '1');
        window.location.href = "{{ route('login') }}";
    }, { once: true });
}
        });
    </script>
</body>
</html>