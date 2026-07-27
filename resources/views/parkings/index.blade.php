<x-adminlte-layout>
    <style>
        /* Background */
        .parking-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
        }

        /* Glassmorphism Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.08);
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.12);
        }

        /* Tabel Glass */
        .table-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
        }
        .table-glass thead {
            background: rgba(255, 255, 255, 0.5);
        }
        .table-glass tbody tr {
            border-color: rgba(255,255,255,0.3);
            transition: all 0.3s ease;
            position: relative;
        }

        /* ===== EFEK HOVER WARNA-WARNI ===== */
        .table-glass tbody tr:hover {
            background: linear-gradient(90deg,
                rgba(99, 102, 241, 0.12),
                rgba(139, 92, 246, 0.12),
                rgba(236, 72, 153, 0.12),
                rgba(244, 63, 94, 0.12)
            );
            transform: scale(1.01);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.15);
            border-radius: 8px;
        }

        /* Efek per kolom saat hover (opsional) */
        .table-glass tbody tr:hover td {
            color: #1f2937;
            font-weight: 500;
        }

        /* Filter input */
        .filter-input {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.8);
            transition: all 0.2s;
        }
        .filter-input:focus {
            background: rgba(255,255,255,0.9);
            border-color: #818cf8;
            outline: none;
            ring: 2px solid #818cf8;
        }

        /* Tombol aksi */
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }
        .action-buttons form {
            display: inline-block;
        }
        .action-buttons .btn-sm {
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-keluar {
            background: #f87171;
            color: white;
        }
        .btn-keluar:hover {
            background: #ef4444;
            transform: scale(1.05);
        }
        .btn-hapus {
            background: #9ca3af;
            color: white;
        }
        .btn-hapus:hover {
            background: #6b7280;
            transform: scale(1.05);
        }
        .status-selesai {
            color: #9ca3af;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Tambahan animasi untuk badge status */
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        .badge-status .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
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

        /* Responsive */
        @media (max-width: 640px) {
            .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
        }
    </style>

    <div class="parking-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            {{-- FORM PENCARIAN --}}
            <form action="{{ route('parkings.index') }}" method="GET" class="glass-card p-4 rounded-2xl shadow-sm mb-6">
                <div class="flex flex-wrap gap-3 items-center">
                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                           placeholder="Cari plat nomor atau pemilik..."
                           class="flex-1 min-w-[150px] filter-input rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <select name="status"
                            class="filter-input rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Status</option>
                        <option value="Masuk" {{ request('status') == 'Masuk' ? 'selected' : '' }}>Sedang Parkir</option>
                        <option value="Keluar" {{ request('status') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                    </select>
                    <button type="submit"
                            class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-5 py-2 rounded-lg transition shadow-sm shadow-indigo-200/50">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                    <a href="{{ route('parkings.index') }}"
                       class="bg-white/70 backdrop-blur-sm hover:bg-white/90 text-gray-600 px-5 py-2 rounded-lg transition border border-white/60">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>

            {{-- HEADER & TOMBOL TAMBAH --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                        <span class="bg-indigo-100 text-indigo-600 p-2.5 rounded-2xl shadow-sm">
                            <i class="fas fa-parking"></i>
                        </span>
                        Data Parkir
                    </h1>
                    <p class="text-gray-500 mt-1 flex items-center gap-2 text-sm">
                        <i class="fas fa-database text-indigo-400"></i>
                        Kelola data kendaraan yang sedang parkir.
                    </p>
                </div>
                <a href="{{ route('parkings.create') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-5 py-3 rounded-xl shadow-md shadow-indigo-200/50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Parkir
                </a>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
                <div class="glass-card p-5 rounded-2xl hover-lift border-l-4 border-indigo-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-indigo-400 uppercase tracking-wider">Total Parkir</h2>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $parkings->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-500">
                            <i class="fas fa-parking text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-5 rounded-2xl hover-lift border-l-4 border-emerald-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-emerald-400 uppercase tracking-wider">Sedang Parkir</h2>
                            <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $parkings->where('status', 'Masuk')->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-500">
                            <i class="fas fa-arrow-right text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-5 rounded-2xl hover-lift border-l-4 border-rose-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-rose-400 uppercase tracking-wider">Kendaraan Keluar</h2>
                            <p class="text-3xl font-bold text-rose-500 mt-1">{{ $parkings->where('status', 'Keluar')->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-rose-100 rounded-2xl flex items-center justify-center text-rose-500">
                            <i class="fas fa-arrow-left text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL --}}
            <div class="table-glass rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-white/30 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-list-ul text-indigo-500"></i>
                        Daftar Parkir
                    </h2>
                    <span class="text-xs text-gray-500 bg-white/50 px-3 py-1 rounded-full border border-white/60">
                        {{ $parkings->count() }} data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Plat Nomor</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pemilik</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Masuk</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Keluar</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Durasi</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="p-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tarif</th>
                                <th class="p-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($parkings as $parking)
                                <tr class="border-t border-white/30 hover:bg-gradient-to-r hover:from-indigo-50/50 hover:via-purple-50/50 hover:to-pink-50/50 transition-all duration-300">
                                    <td class="p-3 text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="p-3 font-mono font-semibold text-gray-800">{{ $parking->vehicle->plat_nomor }}</td>
                                    <td class="p-3 text-gray-700">{{ $parking->vehicle->nama_pemilik }}</td>
                                    <td class="p-3 text-gray-600">{{ $parking->waktu_masuk }}</td>
                                    <td class="p-3 text-gray-600">{{ $parking->waktu_keluar ?? '-' }}</td>
                                    <td class="p-3 text-gray-600">{{ $parking->durasi ?? '-' }} jam</td>
                                    <td class="p-3">
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
                                    <td class="p-3 font-semibold text-indigo-600">Rp {{ number_format($parking->tarif, 0, ',', '.') }}</td>
                                    <td class="p-3 text-center">
                                        <div class="action-buttons">
                                            @if ($parking->status == 'Masuk')
                                                <form action="{{ route('parkings.keluar', $parking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                            onclick="return confirm('Kendaraan akan keluar?')"
                                                            class="btn-sm btn-keluar">
                                                        <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                                                    </button>
                                                </form>
                                            @else
                                                <span class="status-selesai">Selesai</span>
                                                <form action="{{ route('parkings.destroy', $parking->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Yakin ingin menghapus data parkir ini?')"
                                                            class="btn-sm btn-hapus">
                                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center p-10 text-gray-400">
                                        <i class="fas fa-inbox text-3xl block mb-3 text-indigo-200"></i>
                                        Belum ada data parkir.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-adminlte-layout>