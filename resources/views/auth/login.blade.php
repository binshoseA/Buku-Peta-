<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Buku PETA</title>
    
    <!-- Import Font -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind Script & Config dengan Animasi Gelombang -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['"Source Serif 4"', 'serif'],
                    },
                    keyframes: {
                        sway: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '50%': { transform: 'translateX(-3%)' },
                        }
                    },
                    animation: {
                        'wave-slow': 'sway 12s ease-in-out infinite',
                        'wave-medium': 'sway 8s ease-in-out infinite reverse',
                        'wave-fast': 'sway 10s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans text-[#17324a] bg-white">

    <main class="min-h-screen grid grid-cols-1 md:grid-cols-[1.1fr_1fr]">
        
        <!-- Sisi Kiri (Hero) -->
        <aside class="hidden md:flex flex-col justify-center overflow-hidden relative px-14 py-16 bg-[linear-gradient(160deg,#1fb3e6_0%,#1a86c9_55%,#0f5f96_100%)]">
            
            <!-- Ornamen Gelombang Bergerak -->
            <div class="absolute -left-[5%] right-[-5%] bottom-[-2px] z-0 leading-none w-[110%]">
                <svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto block">
                    <path class="animate-wave-slow" fill="rgba(255,255,255,0.05)" d="M0,160L48,176C96,192,192,224,288,213.3C384,203,480,149,576,149.3C672,149,768,203,864,218.7C960,235,1056,213,1152,192C1248,171,1344,149,1392,138.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path class="animate-wave-medium" fill="rgba(255,255,255,0.08)" d="M0,256L48,245.3C96,235,192,213,288,202.7C384,192,480,192,576,213.3C672,235,768,277,864,272C960,267,1056,213,1152,181.3C1248,149,1344,139,1392,133.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    <path class="animate-wave-fast" fill="rgba(255,255,255,0.15)" d="M0,288L48,272C96,256,192,224,288,213.3C384,203,480,213,576,229.3C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>

            <div class="relative z-10 max-w-[420px]">
                <header class="flex items-center gap-3 mb-8">
                    <figure class="w-[42px] h-[42px] rounded-xl flex items-center justify-center text-white bg-white/20 backdrop-blur-sm m-0">
                        <svg class="w-[22px] h-[22px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </figure>
                    <div>
                        <h2 class="font-serif font-bold text-[17px] text-white leading-tight">Buku PETA</h2>
                        <p class="text-[11px] text-white/80">UMKM Edition</p>
                    </div>
                </header>

                <article class="mt-[34px] bg-gradient-to-br from-white/10 to-white/5 border border-white/25 rounded-[22px] p-7 backdrop-blur-md">
                    <h1 class="font-serif text-[26px] text-white font-bold leading-snug mb-3">
                        Kelola keuangan UMKM kamu,<br>tanpa ribet hitung manual.
                    </h1>
                    <p class="text-white/90 text-[14.5px] leading-relaxed">
                        Catat transaksi, biar sistem yang kategorikan otomatis, dan lihat laporan keuntungan tokomu kapan aja.
                    </p>
                </article>
            </div>
        </aside>

        <!-- Sisi Kanan (Form Panel) -->
        <section class="flex items-center justify-center p-8 md:p-10 bg-white relative z-20">
            <article class="w-full max-w-[360px]">
                
                <header class="mb-6">
                    <h2 class="font-serif text-[26px] font-bold text-[#17324a] mb-1">Selamat Datang Kembali!</h2>
                    <p class="text-[#5a7280] text-[14.5px]">Masuk untuk kelola keuangan UMKM kamu</p>
                </header>

                <!-- Tabs (Login Aktif) -->
                <nav class="flex bg-[#eaf6fc] rounded-full p-1 mb-7" aria-label="Navigasi Autentikasi">
                    <a href="{{ route('login') }}" class="flex-1 text-center bg-white text-[#17324a] shadow-[0_6px_14px_-8px_rgba(23,50,74,0.35)] font-semibold rounded-full py-2.5 text-[14.5px] transition-all">
                        Log in
                    </a>
                    <a href="{{ route('register') }}" class="flex-1 text-center text-[#5a7280] hover:text-[#17324a] font-semibold rounded-full py-2.5 text-[14.5px] transition-all">
                        Daftar
                    </a>
                </nav>

                @if($errors->any())
                    <aside class="bg-[#fbe4e4] text-[#e15c5c] p-3 rounded-[10px] mb-4 text-[12.5px] font-medium" role="alert">
                        {{ $errors->first() }}
                    </aside>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <fieldset class="border-none p-0 m-0 space-y-4">
                        <div class="relative">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" 
                                class="w-full px-5 py-[13px] rounded-full border border-[#e2edf3] bg-[#eaf6fc] text-[14.5px] text-[#17324a] placeholder-[#93a7b3] focus:outline-none focus:border-[#4bc3e0] focus:bg-white transition-colors" required>
                        </div>
                        
                        <div class="relative">
                            <label for="password" class="sr-only">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Kata Sandi" 
                                class="w-full px-5 py-[13px] rounded-full border border-[#e2edf3] bg-[#eaf6fc] text-[14.5px] text-[#17324a] placeholder-[#93a7b3] focus:outline-none focus:border-[#4bc3e0] focus:bg-white transition-colors" required>
                        </div>
                    </fieldset>
                    
                    <div class="flex justify-end mt-2 mb-5">
                        <a href="#" class="text-[13.5px] text-[#1e6f8c] font-semibold hover:underline">Lupa Kata Sandi?</a>
                    </div>
                    
                    <button type="submit" class="w-full bg-gradient-to-br from-[#4bc3e0] to-[#2e9bc7] text-white font-semibold py-3.5 rounded-full shadow-[0_10px_20px_-8px_rgba(46,155,199,0.55)] hover:shadow-[0_14px_24px_-8px_rgba(46,155,199,0.65)] hover:-translate-y-[1px] transition-all text-[15px]">
                        Masuk
                    </button>
                </form>
                
                <footer class="text-center mt-6">
                    <p class="text-[14px] text-[#5a7280]">Belum punya akun? <a href="{{ route('register') }}" class="text-[#1e6f8c] font-bold hover:underline">Daftar</a></p>
                </footer>
            </article>
        </section>
        
    </main>

    <script>
(function () {
    if (sessionStorage.getItem('peta_transition') === '1') {
        sessionStorage.removeItem('peta_transition');

        var overlay = document.createElement('div');
        overlay.id = 'page-transition-overlay';
        overlay.style.position = 'fixed';
        overlay.style.inset = '0';
        overlay.style.background = '#1a86c9';
        overlay.style.zIndex = '99999';
        overlay.style.pointerEvents = 'none';
        overlay.style.transition = 'opacity 0.6s ease';
        document.body.appendChild(overlay);

        window.addEventListener('load', function () {
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    overlay.style.opacity = '0';
                });
            });
            overlay.addEventListener('transitionend', function () {
                overlay.remove();
            }, { once: true });
        });
    }
})();
</script>

</body>


</html>