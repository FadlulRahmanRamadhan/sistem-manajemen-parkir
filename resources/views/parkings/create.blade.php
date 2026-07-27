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
        .input-glass-readonly {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,0.3);
            color: #4b5563;
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
                        <i class="fas fa-parking"></i>
                    </span>
                    Tambah Data Parkir
                </h1>
                <p class="text-gray-500 mt-1 flex items-center gap-2 text-sm">
                    <i class="fas fa-plus-circle text-indigo-400"></i>
                    Pilih kendaraan yang akan masuk ke area parkir.
                </p>
            </div>

            {{-- Form dan Informasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Card Informasi Tarif --}}
                <div class="glass-card-dark rounded-2xl p-6 hover-lift">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-indigo-300"></i>
                        Informasi Tarif
                    </h2>
                    <ul class="space-y-3 text-sm text-gray-200">
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">🏍️</span>
                            Motor: Rp 2.000 / jam
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-emerald-400">🚗</span>
                            Mobil: Rp 5.000 / jam
                        </li>
                        <li class="flex items-start gap-2 mt-2">
                            <span class="text-emerald-400">✅</span>
                            Pastikan kendaraan sudah terdaftar.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400">✅</span>
                            Waktu masuk otomatis diisi sistem.
                        </li>
                    </ul>
                    <div class="mt-6 p-3 bg-white/10 rounded-lg border border-white/10">
                        <p class="text-xs text-gray-300">
                            <i class="fas fa-shield-alt text-indigo-300 mr-1"></i>
                            Pastikan data kendaraan benar sebelum menyimpan.
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <div class="md:col-span-2 glass-card rounded-2xl p-8 hover-lift">
                    <form action="{{ route('parkings.store') }}" method="POST">
                        @csrf

                        {{-- Pilih Kendaraan --}}
                        <div class="mb-5">
                            <label class="block font-semibold text-gray-700 mb-2">
                                <i class="fas fa-car text-indigo-500 mr-1"></i>
                                Kendaraan
                            </label>
                            <select
                                name="vehicle_id"
                                class="w-full input-glass rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                required
                            >
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->plat_nomor }} - {{ $vehicle->nama_pemilik }} ({{ $vehicle->jenis_kendaraan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Waktu Masuk --}}
                        <div class="mb-5">
                            <label class="block font-semibold text-gray-700 mb-2">
                                <i class="fas fa-clock text-indigo-500 mr-1"></i>
                                Waktu Masuk
                            </label>
                            <input
                                type="text"
                                value="{{ now()->format('d/m/Y H:i') }}"
                                class="w-full input-glass-readonly rounded-xl px-4 py-3"
                                readonly
                            >
                            <p class="text-xs text-gray-400 mt-1">Waktu masuk diambil dari sistem.</p>
                        </div>

                        {{-- Status --}}
                        <div class="mb-6">
                            <label class="block font-semibold text-gray-700 mb-2">
                                <i class="fas fa-circle-check text-indigo-500 mr-1"></i>
                                Status
                            </label>
                            <input
                                type="text"
                                value="Masuk"
                                class="w-full input-glass-readonly rounded-xl px-4 py-3"
                                readonly
                            >
                            <p class="text-xs text-gray-400 mt-1">Status akan berubah menjadi "Keluar" setelah kendaraan keluar.</p>
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
                                href="{{ route('parkings.index') }}"
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