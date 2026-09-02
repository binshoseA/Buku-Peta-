<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku PETA - UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F0F7FF] flex h-screen font-sans">

    <!-- Sidebar / Navigasi Samping -->
    <aside class="w-64 bg-white border-r border-blue-100 flex flex-col justify-between">
        <section>
            <!-- Header Sidebar -->
            <header class="p-6 mb-4">
                <h1 class="flex items-center gap-3 text-[#00AEEF] font-bold text-lg">
                    <span class="bg-[#00AEEF] p-2 rounded-lg text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </span>
                    Buku PETA
                </h1>
            </header>
            
            <!-- Menu Navigasi -->
            <nav class="space-y-2 px-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-[#E5F6FF] text-[#00AEEF] font-bold' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl transition">
                    Beranda
                </a>
                <a href="{{ route('history') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('history') ? 'bg-[#E5F6FF] text-[#00AEEF] font-bold' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl transition">
                    Riwayat
                </a>
            </nav>
        </section>

        <!-- Footer Sidebar (Profil & Logout) -->
        <footer class="p-6 border-t border-gray-50">
            <a href="{{ route('profile') }}" class="flex items-center gap-3 bg-[#E5F6FF] p-3 rounded-xl cursor-pointer hover:bg-blue-100 transition">
                <figure class="w-10 h-10 bg-[#00AEEF] text-white rounded-full flex items-center justify-center font-bold text-lg shadow m-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </figure>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->store_name ?? 'Pemilik Toko' }}</p>
                </div>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-500 flex items-center gap-2 w-full px-2 transition">
                    Keluar
                </button>
            </form>
        </footer>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-8 overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>