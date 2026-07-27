<nav x-data="{ open: false }" class="sticky top-0 z-50 w-full bg-blue-800 shadow-md border-b border-blue-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center text-white text-xl font-bold tracking-tight">
                    <i class="fas fa-parking mr-2 text-blue-300"></i>
                    Sistem Parkir
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden sm:flex sm:items-center sm:ms-8 space-x-1">
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-100 hover:text-white hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('vehicles.index') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-100 hover:text-white hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-car"></i> Data Kendaraan
                    </a>
                    <a href="{{ route('parkings.index') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-100 hover:text-white hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-parking"></i> Data Parkir
                    </a>
                    <a href="{{ route('parkings.riwayat') }}"
                       class="px-3 py-2 rounded-md text-sm font-medium text-blue-100 hover:text-white hover:bg-blue-700 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-history"></i> Riwayat
                    </a>
                </div>
            </div>

            {{-- User Dropdown --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-blue-100 hover:text-white hover:bg-blue-700 transition-colors duration-200">
                            @if (Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                     alt="Foto Profil"
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