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

    @stack('styles')
</head>
<body x-data="{ sidebarOpen: window.innerWidth >= 768 }" @resize.window="sidebarOpen = window.innerWidth >= 768" class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex">

        {{-- ========== SIDEBAR ========== --}}
        <aside x-show="sidebarOpen" x-transition:enter.duration.300ms x-transition:leave.duration.300ms
               class="w-64 bg-gray-800 text-gray-300 flex-shrink-0 min-h-screen sticky top-0 overflow-y-auto"
               style="height: 100vh;">

            {{-- Brand / Logo --}}
            <div class="flex items-center justify-center h-16 border-b border-gray-700">
                <span class="text-white text-xl font-bold flex items-center gap-2">
                    <i class="fas fa-parking text-blue-400"></i>
                    Sistem Parkir
                </span>
            </div>

            {{-- Menu --}}
            <nav class="mt-4 px-2">
                <ul class="space-y-1">

                    {{-- Dashboard --}}
                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors duration-200
                                  @request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' @endif">
                            <i class="fas fa-tachometer-alt w-5 text-center"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Data Kendaraan --}}
                    <li>
                        <a href="{{ route('vehicles.index') }}"
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors duration-200
                                  @request()->routeIs('vehicles.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' @endif">
                            <i class="fas fa-car w-5 text-center"></i>
                            <span>Data Kendaraan</span>
                        </a>
                    </li>

                    {{-- Data Parkir --}}
                    <li>
                        <a href="{{ route('parkings.index') }}"
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors duration-200
                                  @request()->routeIs('parkings.index') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' @endif">
                            <i class="fas fa-parking w-5 text-center"></i>
                            <span>Data Parkir</span>
                        </a>
                    </li>

                    {{-- Riwayat --}}
                    <li>
                        <a href="{{ route('parkings.riwayat') }}"
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors duration-200
                                  @request()->routeIs('parkings.riwayat') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' @endif">
                            <i class="fas fa-history w-5 text-center"></i>
                            <span>Riwayat</span>
                        </a>
                    </li>

                    <hr class="border-gray-700 my-3">

                    {{-- Profil --}}
                    <li>
                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm transition-colors duration-200
                                  @request()->routeIs('profile.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' @endif">
                            <i class="fas fa-user-circle w-5 text-center"></i>
                            <span>Profil</span>
                        </a>
                    </li>

                    {{-- Logout --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-red-400 hover:bg-red-900/30 hover:text-red-300 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt w-5 text-center"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>
            </nav>
        </aside>

        {{-- ========== KONTEN UTAMA ========== --}}
        <div class="flex-1 flex flex-col min-h-screen">

            {{-- Top Navbar (dengan tombol toggle sidebar) --}}
            <nav class="sticky top-0 z-50 w-full bg-blue-800 shadow-md border-b border-blue-900">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">

                        {{-- Kiri: toggle sidebar + judul --}}
                        <div class="flex items-center gap-3">
                            {{-- Tombol toggle sidebar (hanya di mobile) --}}
                            <button @click="sidebarOpen = !sidebarOpen" class="text-white text-xl md:hidden">
                                <i class="fas fa-bars"></i>
                            </button>
                            <span class="text-white font-semibold text-lg md:hidden">Sistem Parkir</span>
                        </div>

                        {{-- Kanan: user dropdown --}}
                        <div class="flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-blue-100 hover:text-white hover:bg-blue-700 transition-colors duration-200">
                                        @if (Auth::user()->foto)
                                            <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                                 alt="Foto"
                                                 class="w-8 h-8 rounded-full object-cover border-2 border-blue-300">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-sm font-bold text-white">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                                        <i class="fas fa-chevron-down text-xs ml-1"></i>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                    </div>
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                                        <i class="fas fa-user-circle w-4"></i> Profil
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center gap-2 text-red-500 hover:text-red-700">
                                            <i class="fas fa-sign-out-alt w-4"></i> Logout
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

    @stack('scripts')
</body>
</html>