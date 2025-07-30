<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}

    <link rel="stylesheet" href="{{ asset('build/assets/app-B0a9OMnn.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-CsugfyOk.css') }}">
    <script src="build/assets/app-D7BWGOZj.js"></script>

    <link rel="icon" href="{{ asset('assets/images/icon/wikrama-logo.png') }}" type="image/x-icon">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body class="min-h-screen bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Left Side - Image/Illustration -->
        <div
            class="relative hidden overflow-hidden bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-800 lg:flex lg:w-1/2">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="relative z-10 flex w-full flex-col items-center justify-center p-12 text-white">
                <div class="mb-4">
                    <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Logo"
                        class="h-32 w-32 object-contain drop-shadow-2xl">
                </div>
                <h1 class="mb-4 text-center text-4xl font-bold">Selamat Datang</h1>
                <p class="mb-8 text-center text-xl opacity-90">Silakan Masuk Untuk Mengakses Akun Anda</p>
            </div>
            <!-- Decorative shapes -->
            <div class="absolute left-20 top-20 h-20 w-20 rounded-full bg-white opacity-10"></div>
            <div class="absolute bottom-20 right-20 h-32 w-32 rounded-full bg-white opacity-5"></div>
            <div class="absolute right-10 top-1/2 h-16 w-16 rotate-45 transform bg-white opacity-10"></div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="flex w-full items-center justify-center p-8 lg:w-1/2">
            <div class="w-full max-w-md">
                <!-- Mobile Logo (visible only on small screens) -->
                <div class="mb-8 text-center lg:hidden">
                    <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Logo"
                        class="mx-auto mb-4 h-20">
                    <h1 class="text-2xl font-bold text-gray-800">Rayon Cicurug 2</h1>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-white p-8 shadow-xl">
                    <div class="mb-8 text-center">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800">Sign In</h2>
                        <p class="text-gray-600">Silakan masuk dengan akun anda</p>
                    </div>

                    <form method="POST" action="{{ route('login.process') }}" class="space-y-6" id="loginForm">
                        @csrf

                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <ion-icon name="person-outline" class="text-lg text-gray-400"></ion-icon>
                                </div>
                                <input id="username" type="text" name="username" value="{{ old('username') }}"
                                    required autofocus
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 pl-10 pr-4 transition duration-200 focus:border-transparent focus:bg-white focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan username" autocomplete="off">
                            </div>
                            @error('username')
                                <span class="flex items-center text-sm text-red-500">
                                    <ion-icon name="alert-circle-outline" class="mr-1"></ion-icon>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <ion-icon name="lock-closed-outline" class="text-lg text-gray-400"></ion-icon>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="w-full rounded-lg border border-gray-300 bg-gray-50 py-3 pl-10 pr-12 transition duration-200 focus:border-transparent focus:bg-white focus:ring-2 focus:ring-blue-500"
                                    placeholder="Masukkan password" required autocomplete="off">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 transition duration-200 hover:text-gray-600">
                                    <ion-icon name="eye-off-outline" class="text-lg"></ion-icon>
                                </button>
                            </div>
                            @error('password')
                                <span class="flex items-center text-sm text-red-500">
                                    <ion-icon name="alert-circle-outline" class="mr-1"></ion-icon>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <button type="submit" id="submitBtn"
                            class="w-full transform rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 px-4 py-3 font-semibold text-white shadow-lg transition duration-200 hover:scale-[1.02] hover:from-blue-700 hover:to-purple-700 hover:shadow-xl">
                            <span id="buttonText" class="flex items-center justify-center">
                                <ion-icon name="log-in-outline" class="mr-2 text-lg"></ion-icon>
                                Masuk Sekarang
                            </span>
                            <span id="loadingSpinner" class="flex hidden items-center justify-center">
                                <svg class="-ml-1 mr-3 h-5 w-5 animate-spin text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Sedang Masuk...
                            </span>
                        </button>
                    </form>

                    <div class="mt-6 text-center">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center font-medium text-blue-600 transition duration-200 hover:text-blue-800">
                            <ion-icon name="arrow-back-outline" class="mr-1"></ion-icon>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function(e) {
            const passwordInput = document.getElementById('password');
            const icon = e.currentTarget.querySelector('ion-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.name = 'eye-outline';
            } else {
                passwordInput.type = 'password';
                icon.name = 'eye-off-outline';
            }
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            buttonText.classList.add('hidden');
            loadingSpinner.classList.remove('hidden');
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
