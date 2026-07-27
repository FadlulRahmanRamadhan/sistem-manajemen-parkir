<x-guest-layout>
    <style>
        /* Reset dan background full halaman - gradien pastel */
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0e7ff, #f3e8ff) !important;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }
        .min-h-screen {
            background: transparent !important;
        }

        /* Dekorasi lingkaran blur di belakang */
        .bg-decoration {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
        }
        .bg-decoration-1 {
            width: 500px;
            height: 500px;
            background: #a5b4fc;
            top: -100px;
            right: -100px;
        }
        .bg-decoration-2 {
            width: 400px;
            height: 400px;
            background: #fbcfe8;
            bottom: -80px;
            left: -80px;
        }
        .bg-decoration-3 {
            width: 300px;
            height: 300px;
            background: #bfdbfe;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Card glassmorphism */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.15);
            position: relative;
            z-index: 1;
        }
    </style>

    {{-- Ornamen dekoratif --}}
    <div class="bg-decoration bg-decoration-1"></div>
    <div class="bg-decoration bg-decoration-2"></div>
    <div class="bg-decoration bg-decoration-3"></div>

    <div class="min-h-screen w-full flex items-center justify-center p-4" style="background: transparent;">
        <div class="w-full max-w-md glass-card rounded-3xl p-8 transition-all duration-300 hover:shadow-indigo-200/50">

            <!-- Logo & Judul -->
            <div class="text-center mb-8">
                <div class="text-7xl mb-4 inline-block bg-gradient-to-r from-indigo-400 to-purple-400 p-3 rounded-full shadow-lg">
                    🚗
                </div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    Sistem Manajemen Parkir
                </h1>
                <p class="text-gray-500 mt-2 text-sm">
                    Silakan login untuk melanjutkan
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-indigo-400 transition"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="contoh@email.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-400 focus:ring-indigo-400 transition"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="********"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="mt-4 flex items-center justify-between">
                    <label class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-400"
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-500 hover:text-indigo-700 hover:underline transition">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Tombol Login -->
                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white py-3 rounded-xl font-semibold transition transform hover:scale-[1.02] shadow-lg shadow-indigo-300/50"
                    >
                        Login
                    </button>
                </div>
            </form>

            <!-- Footer -->
            <div class="mt-6 text-center text-xs text-gray-400 border-t border-gray-200 pt-4">
                © {{ date('Y') }} Sistem Parkir. All rights reserved.
            </div>
        </div>
    </div>
</x-guest-layout>