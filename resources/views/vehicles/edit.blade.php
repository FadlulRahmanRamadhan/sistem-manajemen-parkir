<x-app-layout>

    <div class="min-h-screen bg-gray-100 py-10">

        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-2xl shadow-lg p-8">

                <h1 class="text-3xl font-bold mb-6">
                    ✏️ Edit Kendaraan
                </h1>

                <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-5">

                        <label class="block mb-2 font-semibold">
                            Plat Nomor
                        </label>

                        <input
                            type="text"
                            name="plat_nomor"
                            value="{{ $vehicle->plat_nomor }}"
                            class="w-full border rounded-xl p-3">

                    </div>

                    <div class="mb-5">

                        <label class="block mb-2 font-semibold">
                            Nama Pemilik
                        </label>

                        <input
                            type="text"
                            name="nama_pemilik"
                            value="{{ $vehicle->nama_pemilik }}"
                            class="w-full border rounded-xl p-3">

                    </div>

                    <div class="mb-5">

                        <label class="block mb-2 font-semibold">
                            Jenis Kendaraan
                        </label>

                        <select
                            name="jenis_kendaraan"
                            class="w-full border rounded-xl p-3">

                            <option value="Motor"
                                {{ $vehicle->jenis_kendaraan == 'Motor' ? 'selected' : '' }}>
                                Motor
                            </option>

                            <option value="Mobil"
                                {{ $vehicle->jenis_kendaraan == 'Mobil' ? 'selected' : '' }}>
                                Mobil
                            </option>

                        </select>

                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                            Update

                        </button>

                        <a
                            href="{{ route('vehicles.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl">

                            Kembali

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>