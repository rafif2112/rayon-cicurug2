<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
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
    <div x-data="{ sidebarOpen: false, logoutOpen: false }" x-init="$watch('$route', () => logoutOpen = false)" class="flex h-screen">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:static lg:inset-0 lg:translate-x-0">
            <div class="flex items-center justify-center mt-8 -ml-10">
                <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Wikrama Logo" class="h-12 w-12">
                <div class="ml-4 text-2xl font-semibold text-white">Cicurug 2</div>
            </div>
            <nav class="mt-10">
                @foreach ([
                    ['route' => 'dashboard', 'icon' => 'bar-chart-outline', 'label' => 'Dashboard'],
                    ['route' => 'siswa.admin', 'icon' => 'people-outline', 'label' => 'Siswa'],
                    ['route' => 'galeri.admin', 'icon' => 'images-outline', 'label' => 'Galeri'],
                    ['route' => 'struktur.admin', 'icon' => 'person-outline', 'label' => 'Struktur'],
                    ['route' => 'kegiatan.admin', 'icon' => 'calendar-outline', 'label' => 'Kegiatan'],
                    ['route' => 'alumni.admin', 'icon' => 'people-outline', 'label' => 'Alumni'],
                    ['route' => 'maps.admin', 'icon' => 'location-outline', 'label' => 'Maps'],
                ] as $item)
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white" href="{{ route($item['route']) }}">
                        <ion-icon class="text-xl" name="{{ $item['icon'] }}"></ion-icon>
                        <span class="mx-3">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between w-full h-16 px-6 py-4 bg-white dark:bg-gray-800 shadow-md">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <div class="text-xl font-semibold text-gray-800 dark:text-white">
                    @switch(true)
                        @case(Request::is('dashboard'))
                            Dashboard
                            @break
                        @case(Request::is('admin/siswa'))
                            Siswa
                            @break
                        @case(Request::is('siswa/*/edit'))
                            Edit Siswa
                            @break
                        @case(Request::is('siswa/create'))
                            Tambah Data Siswa
                            @break
                        @case(Request::is('admin/galeri'))
                            Galeri
                            @break
                        @case(Request::is('galeri/*/edit'))
                            Edit Galeri
                            @break
                        @case(Request::is('admin/galeri/create'))
                            Tambah Data Galeri
                            @break
                        @case(Request::is('admin/struktur'))
                            Struktur
                            @break
                        @case(Request::is('struktur/*/edit'))
                            Edit Struktur
                            @break
                        @case(Request::is('admin/struktur/create'))
                            Tambah Data Struktur
                            @break
                        @case(Request::is('admin/kegiatan'))
                            Kegiatan
                            @break
                        @case(Request::is('kegiatan/*/edit'))
                            Edit Kegiatan
                            @break
                        @case(Request::is('kegiatan/create'))
                            Tambah Data Kegiatan
                            @break
                        @case(Request::is('admin/alumni'))
                            Alumni
                            @break
                        @case(Request::is('alumni/*/edit'))
                            Edit Alumni
                            @break
                        @case(Request::is('alumni/create'))
                            Tambah Data Alumni
                            @break
                        @case(Request::is('admin/maps'))
                            Maps
                            @break
                        @case(Request::is('maps/*/edit'))
                            Edit Maps
                            @break
                        @case(Request::is('admin/maps/create'))
                            Tambah Data Maps
                            @break
                        @default
                            Dashboard
                    @endswitch
                </div>
                <div class="flex gap-2">
                    <div class="flex justify-center items-center">
                        <a href="{{ route('home') }}" class="block py-2 px-3 bg-blue-600 text-white rounded-full duration-300 hover:bg-blue-500">Home</a>
                    </div>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                        <ion-icon name="log-out-outline" class="text-3xl text-black"></ion-icon>
                    </a>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- <div id="loading-screen" x-data="{ loading: true }" x-show="loading" x-init="window.addEventListener('load', () => loading = false)" class="fixed w-full h-screen inset-0 bg-black/20 flex items-center justify-center z-50">
        <svg aria-hidden="true" class="w-16 h-16 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
    </div> --}}

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @vite('resources/js/app.js')
</body>
</html>
