<x-adminlte-layout>
    <style>
        .profile-bg {
            background: linear-gradient(135deg, #e0e7ff 0%, #f3e8ff 50%, #fce7f3 100%);
            min-height: 100vh;
            padding: 0;
            margin: -1.5rem -1.5rem;
        }
        .glass-card-profile {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.08);
            transition: all 0.3s ease;
        }
        .glass-card-profile:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.12);
        }
        /* Dark mode override untuk glass card */
        .dark .glass-card-profile {
            background: rgba(30, 27, 75, 0.75);
            border-color: rgba(255,255,255,0.1);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }
        .dark .glass-card-profile:hover {
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
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
        .dark .input-glass {
            background: rgba(30, 27, 75, 0.6);
            border-color: rgba(255,255,255,0.2);
            color: #e5e7eb;
        }
        .dark .input-glass:focus {
            background: rgba(30, 27, 75, 0.8);
            border-color: #818cf8;
        }
        .btn-gradient {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            transition: all 0.3s;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3);
        }
        .content-wrapper {
            padding: 1.5rem 2rem 2rem 2rem;
        }
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }
        }
        /* Header profile (slot) */
        .profile-header {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
        }
        .dark .profile-header {
            color: #e5e7eb;
        }
    </style>

    <div class="profile-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 content-wrapper">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 dark:text-gray-100 flex items-center gap-3">
                    <span class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 p-2.5 rounded-2xl shadow-sm">
                        <i class="fas fa-user-circle"></i>
                    </span>
                    Profile
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-2 text-sm">
                    <i class="fas fa-cog text-indigo-400"></i>
                    Kelola informasi akun dan keamanan Anda.
                </p>
            </div>

            <div class="space-y-6">

                {{-- Update Profile Information --}}
                <div class="glass-card-profile rounded-2xl p-6">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Update Password --}}
                <div class="glass-card-profile rounded-2xl p-6">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Upload Foto Profil --}}
                <div class="glass-card-profile rounded-2xl p-6">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            {{ __('Upload Foto Profil') }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            Upload foto profil Anda. Format yang didukung: JPG, PNG, maksimal 2MB.
                        </p>

                        @if (session('success'))
                            <div class="mb-4 p-3 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-lg border border-emerald-200 dark:border-emerald-800">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-4 p-3 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 rounded-lg border border-rose-200 dark:border-rose-800">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('profile.foto') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                <input type="file"
                                       name="foto"
                                       accept="image/*"
                                       class="flex-1 input-glass rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 dark:text-white">
                                <button type="submit"
                                        class="btn-gradient text-white px-5 py-2.5 rounded-lg font-semibold shadow-md shadow-indigo-200/50 dark:shadow-indigo-900/30 transition-all duration-200 inline-flex items-center gap-2">
                                    <i class="fas fa-upload"></i>
                                    Simpan Foto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Delete Account --}}
                <div class="glass-card-profile rounded-2xl p-6">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-adminlte-layout>