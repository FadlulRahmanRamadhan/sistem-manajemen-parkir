<x-adminlte-layout>
    <style>
        .dashboard-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.08);
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.12);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.7s ease-out forwards;
        }
        .marquee-header {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
        }
        .marquee-header span {
            display: inline-block;
            padding-left: 100%;
            animation: marqueeScroll 20s linear infinite;
            font-size: 1.6rem;
            font-weight: 800;
            background: linear-gradient(to right, #4f46e5, #7c3aed, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 1px;
        }
        @keyframes marqueeScroll {
            0%   { transform: translate(0, 0); }
            100% { transform: translate(-100%, 0); }
        }
        @media (max-width: 640px) {
            .marquee-header span {
                font-size: 1.1rem;
                animation-duration: 12s;
            }
        }

        .table-glass tbody tr {
            transition: all 0.3s ease;
        }
        .table-glass tbody tr:hover {
            background: linear-gradient(90deg,
                rgba(99, 102, 241, 0.10),
                rgba(139, 92, 246, 0.10),
                rgba(236, 72, 153, 0.10),
                rgba(244, 63, 94, 0.10)
            );
            transform: scale(1.01);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.10);
            border-radius: 8px;
        }
        .table-glass tbody tr:hover td {
            color: #1f2937;
            font-weight: 500;
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-masuk {
            background: rgba(52, 211, 153, 0.2);
            color: #065f46;
        }
        .badge-masuk .dot {
            background: #10b981;
            animation: pulse-dot 1.5s ease-in-out infinite;
        }
        .badge-keluar {
            background: rgba(156, 163, 175, 0.2);
            color: #4b5563;
        }
        .badge-keluar .dot {
            background: #9ca3af;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }

        /* ===== ANIMASI SLIDE ===== */
        .animate-up {
            animation: slideUp 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            opacity: 0;
        }
        .animate-left {
            animation: slideLeft 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            opacity: 0;
        }
        .animate-right {
            animation: slideRight 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            opacity: 0;
        }

        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideLeft {
            from { transform: translateX(-40px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideRight {
            from { transform: translateX(40px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .delay-1 { animation-delay: 0.05s; }
        .delay-2 { animation-delay: 0.12s; }
        .delay-3 { animation-delay: 0.20s; }
        .delay-4 { animation-delay: 0.28s; }
        .delay-5 { animation-delay: 0.36s; }
        .delay-6 { animation-delay: 0.44s; }
        .delay-7 { animation-delay: 0.52s; }
    </style>

    <div class="dashboard-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 content-wrapper">

            {{-- ===== HEADER ===== --}}
            <div class="mb-6 text-center animate-up delay-1">

                {{-- Running text --}}
                <div class="glass-card rounded-2xl p-4 mb-4 border border-indigo-200/60 bg-gradient-to-r from-indigo-100 to-purple-100 shadow-md">
                    <div class="marquee-header">
                        <span>🚗 Dashboard Sistem Manajemen Parkir — Selamat Datang di Aplikasi Parkir 🚗</span>
                    </div>
                </div>

                {{-- Sapaan dinamis --}}
                @php
                    $hour = now()->hour;
                    if ($hour < 12) $greeting = 'Pagi';
                    elseif ($hour < 18) $greeting = 'Siang';
                    else $greeting = 'Malam';
                @endphp

                <p class="text-gray-600 mt-3 flex items-center justify-center gap-2 text-sm">
                    <i class="fas fa-user-circle text-indigo-400"></i>
                    Selamat {{ $greeting }}, <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                </p>

                {{-- Tanggal & Jam Digital --}}
                <div class="mt-2 bg-white/70 backdrop-blur-sm px-5 py-2.5 rounded-full shadow-sm text-xs text-gray-600 border border-white/60 inline-flex items-center gap-2">
                    <i class="far fa-calendar-alt text-indigo-400"></i>
                    {{ now()->format('l, d F Y') }}
                    <span class="text-indigo-300 mx-1">|</span>
                    <i class="fas fa-clock text-indigo-400"></i>
                    <span id="clock" class="font-mono font-semibold text-indigo-600 min-w-[70px] inline-block text-center"></span>
                </div>
            </div>

            {{-- ===== STATISTIK ===== --}}
            @php
                $totalKendaraan = \App\Models\Parking::count();
                $totalMasuk = \App\Models\Parking::where('status', 'Masuk')->count();
                $totalKeluar = \App\Models\Parking::where('status', 'Keluar')->count();
                $totalPendapatan = \App\Models\Parking::sum('tarif');
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <div class="glass-card p-4 rounded-2xl hover-lift border-l-4 border-indigo-400 animate-left delay-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-indigo-400 uppercase tracking-wider">Total Kendaraan</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalKendaraan }}</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-500">
                            <i class="fas fa-car-side text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs text-emerald-500">
                        <i class="fas fa-arrow-up mr-1"></i> 12% dari bulan lalu
                    </div>
                </div>

                <div class="glass-card p-4 rounded-2xl hover-lift border-l-4 border-emerald-400 animate-left delay-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-emerald-400 uppercase tracking-wider">Kendaraan Masuk</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalMasuk }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-500">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs text-emerald-500">
                        <i class="fas fa-arrow-up mr-1"></i> 8% dari kemarin
                    </div>
                </div>

                <div class="glass-card p-4 rounded-2xl hover-lift border-l-4 border-amber-400 animate-right delay-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-amber-400 uppercase tracking-wider">Kendaraan Keluar</p>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalKeluar }}</p>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-500">
                            <i class="fas fa-arrow-left text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs text-rose-400">
                        <i class="fas fa-arrow-down mr-1"></i> 3% dari kemarin
                    </div>
                </div>

                <div class="bg-gradient-to-br from-indigo-500 to-purple-500 p-4 rounded-2xl shadow-lg shadow-indigo-200/50 text-white hover-lift animate-right delay-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-indigo-100 uppercase tracking-wider">Total Pendapatan</p>
                            <p class="text-2xl font-bold mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white">
                            <i class="fas fa-coins text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center text-xs text-indigo-100">
                        <i class="fas fa-arrow-up mr-1"></i> 5% dari kemarin
                    </div>
                </div>

            </div>

            {{-- ===== MENU CEPAT ===== --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-6">

                <a href="{{ route('vehicles.index') }}"
                   class="glass-card p-5 rounded-2xl hover-lift group border border-white/40 transition-all duration-300 animate-up delay-4">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="fas fa-car text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mt-4">Data Kendaraan</h3>
                    <p class="text-sm text-gray-400 mt-1">Kelola seluruh data kendaraan.</p>
                    <span class="inline-flex items-center text-xs text-indigo-500 font-medium mt-3 group-hover:gap-2 transition-all">
                        Kelola <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </span>
                </a>

                <a href="{{ route('parkings.index') }}"
                   class="glass-card p-5 rounded-2xl hover-lift group border border-white/40 transition-all duration-300 animate-up delay-5">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="fas fa-parking text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mt-4">Data Parkir</h3>
                    <p class="text-sm text-gray-400 mt-1">Kelola kendaraan masuk & keluar.</p>
                    <span class="inline-flex items-center text-xs text-emerald-500 font-medium mt-3 group-hover:gap-2 transition-all">
                        Kelola <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </span>
                </a>

                <a href="{{ route('parkings.riwayat') }}"
                   class="glass-card p-5 rounded-2xl hover-lift group border border-white/40 transition-all duration-300 animate-up delay-6">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                        <i class="fas fa-clock-rotate-left text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mt-4">Riwayat Parkir</h3>
                    <p class="text-sm text-gray-400 mt-1">Lihat riwayat transaksi parkir.</p>
                    <span class="inline-flex items-center text-xs text-purple-500 font-medium mt-3 group-hover:gap-2 transition-all">
                        Lihat <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </span>
                </a>

            </div>

            {{-- ===== TABEL AKTIVITAS ===== --}}
            <div class="glass-card rounded-2xl mt-6 p-5 border border-white/40 table-glass animate-up delay-7">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-clock text-indigo-500"></i> Aktivitas Hari Ini
                    </h2>
                    <span class="text-xs text-gray-500 bg-white/50 px-3 py-1 rounded-full mt-1 sm:mt-0 border border-white/60">
                        <i class="far fa-calendar-check mr-1"></i> {{ now()->format('d M Y') }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-white/50 rounded-xl">
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Plat Nomor</th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu Masuk</th>
                                <th class="text-left py-3 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $aktivitas = \App\Models\Parking::with('vehicle')->latest()->take(5)->get();
                            @endphp
                            @forelse ($aktivitas as $parking)
                                <tr class="border-b border-white/30 transition-colors">
                                    <td class="py-3 px-4 font-medium text-gray-800">
                                        {{ $parking->vehicle->plat_nomor ?? '-' }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-500">
                                        {{ \Carbon\Carbon::parse($parking->waktu_masuk)->format('H:i') }}
                                    </td>
                                    <td class="py-3 px-4">
                                        @if ($parking->status == 'Masuk')
                                            <span class="badge-status badge-masuk">
                                                <span class="dot"></span>
                                                Sedang Parkir
                                            </span>
                                        @else
                                            <span class="badge-status badge-keluar">
                                                <span class="dot"></span>
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-gray-400 text-sm">
                                        <i class="fas fa-inbox text-2xl block mb-2 text-indigo-200"></i>
                                        Belum ada aktivitas hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($aktivitas->count() > 0)
                    <div class="mt-4 text-xs text-gray-400 flex justify-between items-center border-t border-white/50 pt-3">
                        <span>Menampilkan {{ $aktivitas->count() }} aktivitas terbaru</span>
                        <a href="{{ route('parkings.index') }}" class="text-indigo-500 hover:text-indigo-700 font-medium flex items-center gap-1 transition-colors">
                            Lihat semua <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ===== SCRIPT JAM DIGITAL ===== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function updateClock() {
                const now = new Date();
                const time = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                });
                const clockElement = document.getElementById('clock');
                if (clockElement) {
                    clockElement.textContent = time;
                }
            }
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
</x-adminlte-layout>