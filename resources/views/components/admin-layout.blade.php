<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- <link rel="stylesheet" href="{{ asset('build/assets/app-B0a9OMnn.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-CsugfyOk.css') }}"> --}}
    <script src="build/assets/app-D7BWGOZj.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
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
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed inset-y-0 left-0 z-30 w-64 transform overflow-y-auto bg-gray-900 transition duration-300 lg:static lg:inset-0 lg:translate-x-0">
            <div class="-ml-10 mt-8 flex items-center justify-center">
                <img src="{{ asset('assets/images/icon/wikrama-logo.png') }}" alt="Wikrama Logo" class="h-12 w-12">
                <div class="ml-4 text-2xl font-semibold text-white">Cicurug 2</div>
            </div>
            <nav class="mt-10">
                @foreach ([['route' => 'dashboard', 'icon' => 'bar-chart-outline', 'label' => 'Dashboard'], ['route' => 'siswa.admin', 'icon' => 'people-outline', 'label' => 'Siswa'], ['route' => 'galeri.admin', 'icon' => 'images-outline', 'label' => 'Galeri'], ['route' => 'struktur.admin', 'icon' => 'person-outline', 'label' => 'Struktur'], ['route' => 'kegiatan.admin', 'icon' => 'calendar-outline', 'label' => 'Kegiatan'], ['route' => 'alumni.admin', 'icon' => 'people-outline', 'label' => 'Alumni'], ['route' => 'maps.admin', 'icon' => 'location-outline', 'label' => 'Maps'], ['route' => 'prestasi.admin', 'icon' => 'ribbon-outline', 'label' => 'Prestasi']] as $item)
                    <a class="mt-4 flex transform items-center px-6 py-2 text-gray-300 transition-colors duration-200 hover:bg-gray-700 hover:text-white"
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
                    <div class="flex items-center justify-center">
                        <a href="{{ route('home') }}"
                            class="block rounded-full bg-blue-600 px-3 py-2 text-white duration-300 hover:bg-blue-500">Home</a>
                    </div>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                        <ion-icon name="log-out-outline" class="text-3xl text-black"></ion-icon>
                    </a>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
