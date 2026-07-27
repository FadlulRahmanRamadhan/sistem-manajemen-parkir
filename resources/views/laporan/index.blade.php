<x-adminlte-layout>
    <style>
        .page-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
            margin: -1.5rem -1.5rem;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 32px rgba(99,102,241,0.08);
        }
        .table-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
        }
        .filter-input {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.8);
            transition: all 0.2s;
        }
        .filter-input:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.2);
            outline: none;
        }
        .btn-gradient {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            transition: all 0.3s;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79,70,229,0.3);
        }
        .content-wrapper { padding: 1.5rem 2rem 2rem 2rem; }
        @media (max-width: 768px) { .content-wrapper { padding: 1rem; } }
    </style>

    <div class="page-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 content-wrapper">

            {{-- Header --}}
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                        <span class="bg-rose-100 text-rose-600 p-2.5 rounded-2xl shadow-sm">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        Laporan Parkir
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm flex items-center gap-2">
                        <i class="fas fa-chart-line text-rose-400"></i>
                        Laporan kendaraan yang sudah keluar.
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex flex-wrap items-center gap-3">
                    <div class="glass-card px-4 py-2 rounded-xl text-center">
                        <p class="text-xs text-gray-500">Total Pendapatan</p>
                        <p class="text-lg font-bold text-emerald-600">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </p>
                    </div>
                    <a href="{{ route('laporan.pdf') }}"
                       class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2.5 rounded-xl shadow-md shadow-red-200/50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                </div>
            </div>

            {{-- Filter Tanggal --}}
            <div class="glass-card rounded-2xl p-4 mb-6 border border-white/40">
                <form action="{{ route('laporan.index') }}" method="GET" class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-indigo-500"></i>
                        <span class="text-sm text-gray-600">Dari:</span>
                        <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="filter-input rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-600">Sampai:</span>
                        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="filter-input rounded-lg px-3 py-2 text-sm">
                    </div>
                    <button type="submit" class="btn-gradient text-white px-4 py-2 rounded-lg shadow-sm shadow-indigo-200/50">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ route('laporan.index') }}" class="bg-white/70 backdrop-blur-sm hover:bg-white/90 text-gray-600 px-4 py-2 rounded-lg border border-white/60 transition">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </form>
            </div>

            {{-- Tabel --}}
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
                            @forelse ($laporan as $item)
                                <tr class="hover:bg-white/30 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $item->vehicle->plat_nomor }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $item->vehicle->nama_pemilik }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->waktu_masuk)->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->waktu_keluar)->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                            <i class="fas fa-clock mr-1 text-amber-500"></i> {{ $item->durasi }} jam
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
                                            <i class="fas fa-inbox text-3xl text-indigo-200 mb-3"></i>
                                            <span class="text-lg font-medium">Belum ada data laporan.</span>
                                            <span class="text-sm text-gray-400">Data akan muncul setelah kendaraan keluar.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 text-xs text-gray-400 text-right">
                <i class="fas fa-sync-alt text-indigo-300 mr-1"></i>
                Terakhir diperbarui: {{ now()->format('d/m/Y H:i') }}
            </div>

        </div>
    </div>
</x-adminlte-layout>