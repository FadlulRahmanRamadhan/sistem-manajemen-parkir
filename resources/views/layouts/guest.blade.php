<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Sistem Manajemen Parkir</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Style untuk Loading Overlay --}}
        <style>
            /* Loading Overlay */
            .loading-overlay {
                position: fixed;
                inset: 0;
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(6px);
                -webkit-backdrop-filter: blur(6px);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                flex-direction: column;
                gap: 1.5rem;
                transition: all 0.3s ease;
            }

            .loading-overlay.active {
                display: flex;
            }

            /* Spinner */
            .spinner {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                border: 6px solid #e5e7eb;
                border-top-color: #2563eb;
                border-bottom-color: #7c3aed;
                animation: spin 0.9s cubic-bezier(0.68, -0.55, 0.27, 1.55) infinite;
                box-shadow: 0 8px 30px rgba(37, 99, 235, 0.15);
            }

            @keyframes spin {
                to {
                    transform: rotate(360deg);
                }
            }

            /* Teks loading */
            .loading-text {
                font-size: 1.1rem;
                font-weight: 500;
                color: #1f2937;
                letter-spacing: 0.5px;
                display: flex;
                align-items: center;
                gap: 4px;
            }

            .loading-text .dot {
                animation: pulse-dot 1.4s ease-in-out infinite;
            }
            .loading-text .dot:nth-child(2) {
                animation-delay: 0.2s;
            }
            .loading-text .dot:nth-child(3) {
                animation-delay: 0.4s;
            }

            @keyframes pulse-dot {
                0%, 80%, 100% { opacity: 0; transform: scale(0.8); }
                40% { opacity: 1; transform: scale(1.2); }
            }

            /* Efek tambahan biar lebih keren */
            .loading-overlay .sub-text {
                color: #6b7280;
                font-size: 0.85rem;
                font-weight: 400;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

            {{-- ===== GANTI LOGO DENGAN JUDUL ===== --}}
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-blue-600">
                    🚗 Sistem Parkir
                </h1>
                <p class="text-gray-500 text-sm mt-1">Sistem Manajemen Parkir</p>
            </div>

            {{-- ===== KONTEN FORM ===== --}}
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        {{-- ===== LOADING OVERLAY ===== --}}
        <div id="loadingOverlay" class="loading-overlay">
            <div class="spinner"></div>
            <div class="loading-text">
                Memproses
                <span class="dot">.</span>
                <span class="dot">.</span>
                <span class="dot">.</span>
            </div>
            <div class="sub-text">Harap tunggu sebentar...</div>
        </div>

        {{-- ===== SCRIPT UNTUK MENAMPILKAN LOADING ===== --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const overlay = document.getElementById('loadingOverlay');

                // Ambil semua form di halaman ini (login, register, reset password)
                const forms = document.querySelectorAll('form');

                forms.forEach(form => {
                    form.addEventListener('submit', function (e) {
                        // Tampilkan loading
                        overlay.classList.add('active');

                        // Nonaktifkan tombol submit agar tidak double
                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = 'Memproses...';
                        }

                        // Optional: sembunyikan loading jika terjadi error (misal validasi gagal)
                        // Tapi karena redirect, biasanya tidak diperlukan.
                        // Jika halaman tidak redirect (error), kita bisa handle dengan timeout.
                        // Tapi lebih baik menggunakan session flash di controller.
                    });
                });

                // Jika ada error dari server (misal validasi), loading akan tetap muncul.
                // Untuk itu kita bisa sembunyikan jika ada error flash dari Laravel.
                @if($errors->any())
                    overlay.classList.remove('active');
                    // Aktifkan kembali tombol jika ada error
                    document.querySelectorAll('form button[type="submit"]').forEach(btn => {
                        btn.disabled = false;
                        btn.innerHTML = btn.dataset.originalText || 'Log in';
                    });
                @endif
            });
        </script>
    </body>
</html>