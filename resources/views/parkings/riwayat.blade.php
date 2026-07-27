<x-adminlte-layout>
    <style>
        /* Background gradien */
        .riwayat-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
        }

        /* Glassmorphism card */
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

        /* Filter input */
        .filter-input {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: all 0.2s;
            color: #1e293b;
        }
        .filter-input:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            outline: none;
        }

        /* Tabel glass */
        .table-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Efek hover baris tabel dengan gradien warna-warni */
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

        /* Badge durasi */
        .badge-durasi {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(251, 191, 36, 0.2);
            color: #92400e;
        }
        .badge-durasi i {
            color: #d97706;
        }

        /* Animasi fade-in */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.7s ease-out forwards;
        }

        /* Responsif */
        @media (max-width: 640px) {
            .riwayat-bg .content-wrapper {
                padding: 1rem 0.5rem;
            }
        }
    </style>

    <div class="riwayat-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 content-wrapper fade-in">

            {{-- ===== HEADER ===== --}}
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                        <span class="bg-indigo-100 text-indigo-600 p-2.5 rounded-2xl shadow-sm">
                            <i class="fas fa-clock-rotate-left"></i>
                        </span>
                        Riwayat Parkir
                        <span class="ml-2 text-sm font-medium text-indigo-600 bg-indigo-100 px-3 py-1 rounded-full">
                            {{ $riwayat->count() }} data
                        </span>
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm flex items-center gap-2">
                        <i class="fas fa-history text-indigo-400"></i>
                        Daftar kendaraan yang sudah keluar dari area parkir.
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex flex-wrap items-center gap-3">
                    <div class="glass-card px-4 py-2 rounded-xl text-center hover-lift border-l-4 border-emerald-400">
                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Total Pendapatan</p>
                        <p class="text-lg font-bold text-emerald-600">
                            Rp {{ number_format($riwayat->sum('tarif'), 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('parkings.pdf') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2.5 rounded-xl shadow-md shadow-red-200/50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-file-pdf"></i>
                        Download PDF
                    </a>
                </div>
            </div>

            {{-- ===== FILTER TANGGAL ===== --}}
            <div class="glass-card rounded-2xl p-4 mb-6 border border-white/40">
                <form action="{{ route('parkings.riwayat') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-indigo-500"></i>
                        <span class="text-sm text-gray-600">Dari:</span>
                        <input type="date"
                               name="tanggal_awal"
                               value="{{ request('tanggal_awal') }}"
                               class="filter-input rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Sampai:</span>
                        <input type="date"
                               name="tanggal_akhir"
                               value="{{ request('tanggal_akhir') }}"
                               class="filter-input rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <button type="submit"
                            class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-4 py-2 rounded-lg shadow-sm shadow-indigo-200/50 transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ route('parkings.riwayat') }}"
                       class="bg-white/70 backdrop-blur-sm hover:bg-white/90 text-gray-600 px-4 py-2 rounded-lg border border-white/60 transition">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </form>
            </div>

            {{-- ===== TABEL ===== --}}
            <div class="table-glass rounded-2xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200/50">
                        <thead class="bg-gradient-to-r from-indigo-500 to-purple-500">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Plat Nomor</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Pemilik</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Waktu Masuk</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Waktu Keluar</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Durasi</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100/50">
                            @forelse ($riwayat as $item)
                                <tr class="hover:bg-white/30 transition duration-150 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-semibold text-gray-800">
                                        {{ $item->vehicle->plat_nomor }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $item->vehicle->nama_pemilik }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="badge-durasi">
                                            <i class="fas fa-clock"></i> {{ $item->durasi }} jam
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600">
                                        Rp {{ number_format($item->tarif, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-12 text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-inbox text-4xl text-indigo-200 mb-3"></i>
                                            <span class="text-lg font-medium">Belum ada riwayat parkir.</span>
                                            <span class="text-sm text-gray-400">Data akan muncul setelah kendaraan keluar.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===== FOOTER ===== --}}
            <div class="mt-4 text-xs text-gray-400 text-right flex items-center justify-end gap-2">
                <i class="fas fa-sync-alt text-indigo-300"></i>
                Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}
            </div>

        </div>
    </div>
</x-adminlte-layout>