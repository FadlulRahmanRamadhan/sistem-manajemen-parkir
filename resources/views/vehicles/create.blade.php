<x-adminlte-layout>
    <style>
        .page-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
            margin: -1.5rem -1.5rem; /* sesuaikan dengan padding layout */
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.08);
        }
        .glass-card-dark {
            background: rgba(30, 27, 75, 0.85);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.12);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.8);
            transition: all 0.2s;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.9);
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        .btn-gradient {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            transition: all 0.3s;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }
        .btn-secondary {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.8);
            color: #374151;
        }
        .btn-secondary:hover {
            background: rgba(255,255,255,0.8);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .content-wrapper {
            padding: 1.5rem 2rem 2rem 2rem;
        }
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }
        }
    </style>

    <div class="page-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 content-wrapper">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                    <span class="bg-indigo-100 text-indigo-600 p-2.5 rounded-2xl shadow-sm">
                        <i class="fas fa-car-side"></i>
                    </span>
                    Tambah Kendaraan
                </h1>
                <p class="text-gray-500 mt-1 flex items-center gap-2 text-sm">
                    <i class="fas fa-plus-circle text-indigo-400"></i>
                    Tambahkan data kendaraan baru ke sistem parkir.
                </p>
            </div>

            {{-- Form dan Informasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card Informasi --}}
                <div class="glass-card-dark rounded-2xl p-6 hover-lift">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-300"></i>
                        Informasi
                    </h2>
                    <ul class="space-y-3 text-sm text-gray-200">
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400">✅</span>
                            Isi plat nomor kendaraan.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400">✅</span>
                            Isi nama pemilik kendaraan.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400">✅</span>
                            Pilih jenis kendaraan.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400">✅</span>
                            Tekan tombol simpan.
                        </li>
                    </ul>
                    <div class="mt-6 p-3 bg-white/10 rounded-lg border border-white/10">
                        <p class="text-xs text-gray-300">
                            <i class="fas fa-shield-alt text-indigo-300 mr-1"></i>
                            Pastikan data yang diisi benar.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="md:col-span-2 glass-card rounded-2xl p-8 hover-lift">
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf

                        {{-- Plat Nomor --}}
                        <div class="mb-5">
                            <label class="block font-semibold text-gray-700 mb-2">
                                <i class="fas fa-license-plate text-indigo-500 mr-1"></i>
                                Plat Nomor
                            </label>
                            <input
                                type="text"
                                name="plat_nomor"
                                value="{{ old('plat_nomor') }}"
                                placeholder="Contoh: BA 1234 XX"
                                class="w-full input-glass rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                required
                            >
                            @error('plat_nomor')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nama Pemilik --}}
                        <div class="mb-5">
                            <label class="block font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-indigo-500 mr-1"></i>
                                Nama Pemilik
                            </label>
                            <input
                                type="text"
                                name="nama_pemilik"
                                value="{{ old('nama_pemilik') }}"
                                placeholder="Masukkan nama pemilik"
                                class="w-full input-glass rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                required
                            >
                            @error('nama_pemilik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jenis Kendaraan --}}
                        <div class="mb-6">
                            <label class="block font-semibold text-gray-700 mb-2">
                                <i class="fas fa-car text-indigo-500 mr-1"></i>
                                Jenis Kendaraan
                            </label>
                            <select
                                name="jenis_kendaraan"
                                class="w-full input-glass rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                required
                            >
                                <option value="">Pilih kendaraan</option>
                                <option value="Motor" {{ old('jenis_kendaraan') == 'Motor' ? 'selected' : '' }}>
                                    🏍️ Motor
                                </option>
                                <option value="Mobil" {{ old('jenis_kendaraan') == 'Mobil' ? 'selected' : '' }}>
                                    🚗 Mobil
                                </option>
                            </select>
                            @error('jenis_kendaraan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="flex flex-wrap gap-3">
                            <button
                                type="submit"
                                class="btn-gradient text-white px-6 py-3 rounded-xl font-semibold shadow-md shadow-indigo-200/50 transition-all duration-200"
                            >
                                <i class="fas fa-save mr-2"></i>
                                Simpan
                            </button>
                            <a
                                href="{{ route('vehicles.index') }}"
                                class="btn-secondary px-6 py-3 rounded-xl font-semibold transition-all duration-200 inline-flex items-center gap-2"
                            >
                                <i class="fas fa-arrow-left"></i>
                                Kembali
                            </a>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</x-adminlte-layout>