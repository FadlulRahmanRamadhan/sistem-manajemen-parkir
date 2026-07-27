<x-adminlte-layout>
    <style>
        .vehicles-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
        }
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
        }
        /* Efek hover warna-warni pada baris tabel */
        .table-glass tbody tr:hover {
            background: linear-gradient(90deg, #e0f2fe 0%, #ddd6fe 100%);
            /* atau bisa juga pakai warna solid dengan opacity */
            /* background: rgba(99, 102, 241, 0.1); */
            transform: scale(1.01);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
            border-color: #818cf8;
        }
        /* Efek pada sel saat baris di-hover */
        .table-glass tbody tr:hover td {
            color: #1e1b4b; /* warna teks lebih gelap */
        }
        .table-glass tbody tr:hover .badge-jenis {
            box-shadow: 0 0 0 2px #818cf8;
        }
        .filter-input {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.8);
            transition: all 0.2s;
        }
        .filter-input:focus {
            background: rgba(255,255,255,0.9);
            border-color: #818cf8;
            ring: 2px solid #818cf8;
        }
        /* Animasi tambahan untuk tombol aksi saat hover */
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="vehicles-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <!-- Form Pencarian -->
            <form action="{{ route('vehicles.index') }}" method="GET" class="glass-card p-4 rounded-2xl shadow-sm mb-6">
                <div class="flex flex-wrap gap-3 items-center">
                    <input type="text"
                           name="keyword"
                           value="{{ request('keyword') }}"
                           placeholder="Cari plat nomor atau pemilik..."
                           class="flex-1 min-w-[150px] filter-input rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <select name="jenis"
                            class="filter-input rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        <option value="">Semua Jenis</option>
                        <option value="Motor" {{ request('jenis') == 'Motor' ? 'selected' : '' }}>Motor</option>
                        <option value="Mobil" {{ request('jenis') == 'Mobil' ? 'selected' : '' }}>Mobil</option>
                    </select>
                    <button type="submit"
                            class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-5 py-2 rounded-lg transition shadow-sm shadow-indigo-200/50">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                    <a href="{{ route('vehicles.index') }}"
                       class="bg-white/70 backdrop-blur-sm hover:bg-white/90 text-gray-600 px-5 py-2 rounded-lg transition border border-white/60">
                        <i class="fas fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>

            <!-- Header & Tombol Tambah -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                        <span class="bg-indigo-100 text-indigo-600 p-2.5 rounded-2xl shadow-sm">
                            <i class="fas fa-car-side"></i>
                        </span>
                        Data Kendaraan
                    </h1>
                    <p class="text-gray-500 mt-1 flex items-center gap-2 text-sm">
                        <i class="fas fa-database text-indigo-400"></i>
                        Kelola data kendaraan yang terdaftar.
                    </p>
                </div>
                <a href="{{ route('vehicles.create') }}"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white px-5 py-3 rounded-xl shadow-md shadow-indigo-200/50 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Kendaraan
                </a>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
                <div class="glass-card p-5 rounded-2xl hover-lift border-l-4 border-indigo-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-indigo-400 uppercase tracking-wider">Total Kendaraan</h2>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $vehicles->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-500">
                            <i class="fas fa-car text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-5 rounded-2xl hover-lift border-l-4 border-emerald-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-emerald-400 uppercase tracking-wider">Motor</h2>
                            <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $vehicles->where('jenis_kendaraan', 'Motor')->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-500">
                            <i class="fas fa-motorcycle text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="glass-card p-5 rounded-2xl hover-lift border-l-4 border-blue-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-blue-400 uppercase tracking-wider">Mobil</h2>
                            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $vehicles->where('jenis_kendaraan', 'Mobil')->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-500">
                            <i class="fas fa-car text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="table-glass rounded-2xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-white/30 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-700 flex items-center gap-2">
                        <i class="fas fa-list-ul text-indigo-500"></i>
                        Daftar Kendaraan
                    </h2>
                    <span class="text-xs text-gray-500 bg-white/50 px-3 py-1 rounded-full border border-white/60">
                        {{ $vehicles->count() }} data
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Plat Nomor</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Pemilik</th>
                                <th class="p-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis Kendaraan</th>
                                <th class="p-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $vehicle)
                                <tr class="border-t border-white/30 hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 transition-all duration-300 transform hover:scale-[1.01] hover:shadow-md">
                                    <td class="p-4 text-gray-500">{{ $loop->iteration }}</td>
                                    <td class="p-4 font-mono font-semibold text-gray-800">{{ $vehicle->plat_nomor }}</td>
                                    <td class="p-4 text-gray-700">{{ $vehicle->nama_pemilik }}</td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium
                                            @if($vehicle->jenis_kendaraan == 'Motor') bg-emerald-100 text-emerald-700
                                            @else bg-blue-100 text-blue-700 @endif
                                            transition-all duration-200 hover:shadow-md hover:scale-105">
                                            <span class="w-1.5 h-1.5 rounded-full
                                                @if($vehicle->jenis_kendaraan == 'Motor') bg-emerald-500
                                                @else bg-blue-500 @endif">
                                            </span>
                                            {{ $vehicle->jenis_kendaraan }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                               class="inline-flex items-center gap-1 bg-amber-400 hover:bg-amber-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition shadow-sm hover:shadow-md hover:scale-105 action-btn">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                        class="inline-flex items-center gap-1 bg-rose-400 hover:bg-rose-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium transition shadow-sm hover:shadow-md hover:scale-105 action-btn">
                                                    <i class="fas fa-trash-can"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-10 text-gray-400">
                                        <i class="fas fa-inbox text-3xl block mb-3 text-indigo-200"></i>
                                        Belum ada data kendaraan.
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