<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Rayon Cicurug 2</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-B0a9OMnn.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-CsugfyOk.css') }}"> --}}
    <script src="build/assets/app-D7BWGOZj.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="icon" href="{{ asset('assets/images/icon/wikrama-logo.png') }}" type="image/x-icon">
    <style>
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div x-data="{ sidebarOpen: false }" x-init="$watch('$route', () => logoutOpen = false)" class="flex h-screen">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed inset-y-0 left-0 z-30 w-64 transform overflow-y-auto bg-gray-900 transition duration-300 lg:static lg:inset-0 lg:translate-x-0">
            <div class="-ml-10 mt-8 flex items-center justify-center">
                <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Wikrama Logo" class="h-12 w-12">
                <div class="ml-4 text-2xl font-semibold text-white">Cicurug 2</div>
            </div>
            
            <nav class="mt-10">
                @foreach ([
                    ['route' => 'siswa.dashboard', 'icon' => 'bar-chart-outline', 'label' => 'Dashboard'], 
                    ['route' => 'siswa.profile', 'icon' => 'person-outline', 'label' => 'Profil Saya'],
                    ['route' => 'siswa.portofolio', 'icon' => 'briefcase-outline', 'label' => 'Portofolio Saya']
                ] as $item)
                    <a class="mt-4 flex transform items-center px-6 py-2 text-gray-300 transition-colors duration-200 hover:bg-gray-700 hover:text-white {{ Request::routeIs($item['route']) ? 'bg-gray-700 text-white' : '' }}"
                        href="{{ route($item['route']) }}">
                        <ion-icon class="text-xl" name="{{ $item['icon'] }}"></ion-icon>
                        <span class="mx-3">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
        
        <div class="flex flex-1 flex-col overflow-hidden">
            <header class="flex h-16 w-full items-center justify-between bg-white px-6 py-4 shadow-md dark:bg-gray-800">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                
                <div class="text-xl font-semibold text-gray-800 dark:text-white">
                    @switch(true)
                        @case(Request::is('siswa/dashboard'))
                            Dashboard Siswa
                        @break
                        @case(Request::is('siswa/profile'))
                            Profil Siswa
                        @break
                        @default
                            Dashboard Siswa
                    @endswitch
                </div>

                <div class="flex gap-2">
                    <form action="{{ route('logout') }}" method="GET" class="inline">
                        @csrf
                        <button type="submit" class="block rounded-full px-4 py-2 text-gray-800 hover:bg-gray-200">
                            <ion-icon name="log-out-outline" class="text-2xl text-black"></ion-icon>
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>