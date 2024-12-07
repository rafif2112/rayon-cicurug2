<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('assets/images/icon/wikrama-logo.png') }}" type="image/x-icon">
</head>
<body class="bg-gradient-to-b from-blue-500 to-white min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md md:max-w-lg lg:max-w-xl">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Logo" class="h-20">
        </div>
        <h2 class="text-3xl font-semibold mb-6 text-center text-gray-800">Masuk Sebagai admin</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" autocomplete="off">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        
            <div class="mb-8 relative">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required autocomplete="off">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center bg-gray-50 border border-gray-300 rounded-e-md text-gray-500">
                        <ion-icon name="eye-off-outline" class="text-xl"></ion-icon>
                    </button>
                </div>
            </div>
            <script>
                document.getElementById('togglePassword').addEventListener('click', function (e) {
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
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-md hover:bg-blue-600 transition duration-300">Masuk</button>
        </form>
        <a href="{{ url('/') }}" class="block text-center mt-4 text-blue-500 hover:underline">Back to Home</a>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
