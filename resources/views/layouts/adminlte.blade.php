<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Toastr CSS (untuk notifikasi) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* --- Gaya Dasar --- */
        .sidebar-gradient {
            background: linear-gradient(180deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }
        .sidebar-menu a {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-weight: 500;
        }
        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.08);
            border-left-color: #818cf8;
            transform: translateX(4px);
        }
        .sidebar-menu a.active {
            background: rgba(99, 102, 241, 0.2);
            border-left-color: #818cf8;
            color: #fff;
            box-shadow: inset 0 0 15px rgba(99,102,241,0.1);
        }
        .sidebar-menu a i {
            width: 1.75rem;
            text-align: center;
            font-size: 1.1rem;
        }
        .sidebar-brand {
            background: rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-brand span {
            background: linear-gradient(to right, #c084fc, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }
        .sidebar-divider {
            border-color: rgba(255,255,255,0.06);
        }

        .navbar-glass {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 4px 30px rgba(0,0,0,0.2);
        }
        .toggle-btn {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(4px);
            transition: all 0.3s;
        }
        .toggle-btn:hover {
            background: rgba(255,255,255,0.2);
            transform: scale(1.05);
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
        }

        /* --- DARK MODE --- */
        html.dark {
            background-color: #0f172a;
            color: #e2e8f0;
        }
        html.dark body {
            background-color: #0f172a;
        }
        /* Ganti background halaman */
        html.dark .dashboard-content-bg,
        html.dark .page-bg,
        html.dark .vehicles-bg,
        html.dark .parking-bg,
        html.dark .riwayat-bg,
        html.dark .profile-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #1e1b4b 100%) !important;
        }
        /* Card & Table */
        html.dark .glass-card,
        html.dark .glass-card-profile,
        html.dark .table-glass,
        html.dark .glass-card-dark {
            background: rgba(30, 27, 75, 0.7);
            backdrop-filter: blur(8px);
            border-color: rgba(255,255,255,0.1);
        }
        html.dark .glass-card *,
        html.dark .table-glass * {
            color: #e2e8f0;
        }
        html.dark .bg-white {
            background: rgba(30, 27, 75, 0.8) !important;
        }
        html.dark .bg-gray-100,
        html.dark .bg-gray-50 {
            background: #0f172a !important;
        }
        html.dark .text-gray-800,
        html.dark .text-gray-700 {
            color: #e2e8f0 !important;
        }
        html.dark .text-gray-500,
        html.dark .text-gray-400,
        html.dark .text-gray-600 {
            color: #94a3b8 !important;
        }
        html.dark .border,
        html.dark .border-t,
        html.dark .border-b {
            border-color: rgba(255,255,255,0.08) !important;
        }
        html.dark .glass-card:hover {
            background: rgba(30, 27, 75, 0.9);
        }
        /* Input, select, textarea */
        html.dark .input-glass,
        html.dark .filter-input {
            background: rgba(15, 23, 42, 0.6);
            border-color: rgba(255,255,255,0.15);
            color: #e2e8f0;
        }
        html.dark .input-glass:focus,
        html.dark .filter-input:focus {
            background: rgba(15, 23, 42, 0.9);
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
        html.dark .input-glass-readonly {
            background: rgba(15, 23, 42, 0.4);
            border-color: rgba(255,255,255,0.08);
            color: #94a3b8;
        }
        html.dark .btn-secondary {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.15);
            color: #e2e8f0;
        }
        html.dark .btn-secondary:hover {
            background: rgba(255,255,255,0.2);
        }
        /* Dropdown */
        html.dark .bg-white/70 {
            background: rgba(15, 23, 42, 0.7) !important;
        }
        html.dark .bg-white/50 {
            background: rgba(15, 23, 42, 0.5) !important;
        }
        /* Tabel */
        html.dark .table-glass thead {
            background: rgba(30, 27, 75, 0.5);
        }
        html.dark .table-glass tbody tr {
            border-color: rgba(255,255,255,0.05);
        }
        html.dark .table-glass tbody tr:hover {
            background: rgba(30, 27, 75, 0.4);
        }
        /* Badge */
        html.dark .bg-emerald-100 {
            background: rgba(16, 185, 129, 0.2) !important;
            color: #34d399 !important;
        }
        html.dark .bg-red-100 {
            background: rgba(239, 68, 68, 0.2) !important;
            color: #f87171 !important;
        }
        html.dark .bg-blue-100 {
            background: rgba(59, 130, 246, 0.2) !important;
            color: #60a5fa !important;
        }
        html.dark .bg-amber-100 {
            background: rgba(245, 158, 11, 0.2) !important;
            color: #fbbf24 !important;
        }
        html.dark .bg-gray-100 {
            background: rgba(255,255,255,0.05) !important;
            color: #94a3b8 !important;
        }
        /* Tabel header gradient di dark */
        html.dark .bg-gradient-to-r.from-indigo-500.to-purple-500 {
            background: linear-gradient(to right, #4f46e5, #7c3aed) !important;
        }
        /* Marquee */
        html.dark .marquee span {
            background: linear-gradient(to right, #a5b4fc, #c084fc, #f472b6) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
        }
        /* Toastr di dark (tambahan) */
        html.dark .toast-success {
            background-color: #065f46 !important;
        }
        html.dark .toast-error {
            background-color: #991b1b !important;
        }
    </style>

    @stack('styles')
</head>
<body x-data="{ 
    sidebarOpen: window.innerWidth >= 768,
    darkMode: localStorage.getItem('darkMode') === 'true' || window.matchMedia('(prefers-color-scheme: dark)').matches
}" 
@resize.window="sidebarOpen = window.innerWidth >= 768"
x-init="
    if (darkMode) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    $watch('darkMode', value => {
        localStorage.setItem('darkMode', value);
        if (value) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })
"
class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex">

        {{-- ========== SIDEBAR ========== --}}
        <aside x-show="sidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.300ms
               class="w-64 sidebar-gradient text-gray-300 flex-shrink-0 min-h-screen sticky top-0 overflow-y-auto sidebar-scroll"
               style="height: 100vh;">

            {{-- Brand / Logo --}}
            <div class="sidebar-brand flex items-center justify-center h-16">
                <span class="text-2xl font-bold flex items-center gap-3">
                    <i class="fas fa-parking text-indigo-400 text-2xl"></i>
                    <span>Sistem Parkir</span>
                </span>
            </div>

            {{-- Menu --}}
            <nav class="mt-6 px-3 sidebar-menu">
                <ul class="space-y-1">

                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm transition-all duration-200
                                  @class(['active' => request()->routeIs('dashboard'), 'text-gray-400 hover:text-white' => !request()->routeIs('dashboard')])">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Data Kendaraan --}}
                    <li>
                        <a href="{{ route('vehicles.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm transition-all duration-200
                                  @class(['active' => request()->routeIs('vehicles.*'), 'text-gray-400 hover:text-white' => !request()->routeIs('vehicles.*')])">
                            <i class="fas fa-car"></i>
                            <span>Data Kendaraan</span>
                        </a>
                    </li>

                    {{-- Data Parkir --}}
                    <li>
                        <a href="{{ route('parkings.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm transition-all duration-200
                                  @class(['active' => request()->routeIs('parkings.index'), 'text-gray-400 hover:text-white' => !request()->routeIs('parkings.index')])">
                            <i class="fas fa-parking"></i>
                            <span>Data Parkir</span>
                        </a>
                    </li>

                    {{-- Riwayat --}}
                    <li>
                        <a href="{{ route('parkings.riwayat') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm transition-all duration-200
                                  @class(['active' => request()->routeIs('parkings.riwayat'), 'text-gray-400 hover:text-white' => !request()->routeIs('parkings.riwayat')])">
                            <i class="fas fa-history"></i>
                            <span>Riwayat</span>
                        </a>
                    </li>

                    {{-- ===== LAPORAN ===== --}}
                    <li class="text-xs font-semibold text-gray-500 uppercase tracking-wider pt-4 pb-2 px-4">
                        Laporan
                    </li>
                    <li>
                        <a href="{{ route('laporan.index') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm transition-all duration-200
                                  @class(['active' => request()->routeIs('laporan.*'), 'text-gray-400 hover:text-white' => !request()->routeIs('laporan.*')])">
                            <i class="fas fa-file-alt text-rose-400"></i>
                            <span>Laporan Parkir</span>
                        </a>
                    </li>

                    <hr class="sidebar-divider my-4">

                    {{-- Profil --}}
                    <li>
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm transition-all duration-200
                                  @class(['active' => request()->routeIs('profile.*'), 'text-gray-400 hover:text-white' => !request()->routeIs('profile.*')])">
                            <i class="fas fa-user-circle"></i>
                            <span>Profil</span>
                        </a>
                    </li>

                    {{-- Logout --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm text-red-400 hover:bg-red-900/20 hover:text-red-300 transition-all duration-200">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>
            </nav>

            {{-- Footer sidebar --}}
            <div class="absolute bottom-0 left-0 right-0 p-4 text-center text-xs text-gray-600 border-t border-white/5">
                v1.0 • © 2025
            </div>
        </aside>

        {{-- ========== KONTEN UTAMA ========== --}}
        <div class="flex-1 flex flex-col min-h-screen">

            {{-- Top Navbar dengan efek glass --}}
            <nav class="sticky top-0 z-50 w-full navbar-glass">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">

                        {{-- Kiri: toggle sidebar + judul --}}
                        <div class="flex items-center gap-3">
                            {{-- Tombol toggle sidebar (hanya di mobile) --}}
                            <button @click="sidebarOpen = !sidebarOpen" class="toggle-btn text-white p-2 rounded-lg md:hidden">
                                <i class="fas fa-bars text-lg"></i>
                            </button>
                            <span class="text-white font-semibold text-lg md:hidden bg-gradient-to-r from-indigo-300 to-purple-300 bg-clip-text text-transparent">
                                Sistem Parkir
                            </span>
                        </div>

                        {{-- Kanan: Dark Mode Toggle + User Dropdown --}}
                        <div class="flex items-center gap-2">

                            {{-- Tombol Dark Mode --}}
                            <button @click="darkMode = !darkMode" 
                                    class="p-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition-all duration-200">
                                <i class="fas text-lg" 
                                   :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                            </button>

                            {{-- User Dropdown --}}
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-white/80 hover:text-white hover:bg-white/10 transition-all duration-200">
                                        @if (Auth::user()->foto)
                                            <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                                 alt="Foto"
                                                 class="w-8 h-8 rounded-full object-cover border-2 border-indigo-400 shadow-md">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-sm font-bold text-white shadow-md">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                                        <i class="fas fa-chevron-down text-xs text-white/50 ml-1"></i>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 rounded-t-lg">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                    </div>
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-3 px-4 py-2 hover:bg-indigo-50 dark:hover:bg-gray-700 transition-colors">
                                        <i class="fas fa-user-circle text-indigo-500 w-5"></i> Profil
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center gap-3 px-4 py-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                            <i class="fas fa-sign-out-alt w-5"></i> Logout
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                    </div>
                </div>
            </nav>

            {{-- Konten halaman --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

        </div>
    </div>

    {{-- Toastr JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000",
        };

        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif

        @if (session('warning'))
            toastr.warning('{{ session('warning') }}');
        @endif

        @if (session('info'))
            toastr.info('{{ session('info') }}');
        @endif
    </script>

    @stack('scripts')
</body>
</html>