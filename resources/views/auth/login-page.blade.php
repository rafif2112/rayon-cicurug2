<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}

    <link rel="stylesheet" href="{{ asset('build/assets/app-6ng7sL5A.css') }}">
    <script src="build/assets/app-DdQ1e7RN.js"></script>
    
    <link rel="icon" href="{{ asset('assets/images/icon/wikrama-logo.png') }}" type="image/x-icon">
</head>

<body class="flex min-h-screen items-center justify-center bg-gradient-to-b from-blue-500 to-white p-4">
    <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-md md:max-w-lg lg:max-w-xl">
        <div class="mb-4 flex justify-center">
            <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Logo" class="h-20">
        </div>
        <h2 class="mb-6 text-center text-3xl font-semibold text-gray-800">Masuk Sebagai admin</h2>
        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm"
                    autocomplete="off">
                @error('username')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative mb-8">
                <label for="password" class="mb-2 block text-sm font-bold text-gray-700">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="w-full rounded-md border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your password" required autocomplete="off">
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 flex items-center rounded-e-md border border-gray-300 bg-gray-50 px-3 text-gray-500">
                        <ion-icon name="eye-off-outline" class="text-xl"></ion-icon>
                    </button>
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
            </script>
            <button type="submit"
                class="w-full rounded-md bg-blue-500 px-4 py-3 font-bold text-white transition duration-300 hover:bg-blue-600">Masuk</button>
        </form>
        <a href="{{ url('/') }}" class="mt-4 block text-center text-blue-500 hover:underline">Back to Home</a>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
