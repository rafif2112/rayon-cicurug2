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
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>
        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:static lg:inset-0 lg:translate-x-0">
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
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-300 transition-colors duration-200 transform hover:bg-gray-700 hover:text-white"
                        href="{{ route($item['route']) }}">
                        <ion-icon class="text-xl" name="{{ $item['icon'] }}"></ion-icon>
                        <span class="mx-3">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </div>
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between w-full h-16 px-6 py-4 bg-white dark:bg-gray-800 shadow-md">
                <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <div class="text-2xl font-semibold text-gray-800 dark:text-white">
                    @if (Request::is('dashboard'))
                        Dashboard
                    @elseif (Request::is('admin/siswa'))
                        Siswa
                    @elseif (Request::is('siswa/*/edit'))
                        Edit Siswa
                    @elseif (Request::is('siswa/create'))
                        Tambah Data Siswa
                    @elseif (Request::is('admin/galeri'))
                        Galeri
                    @elseif (Request::is('galeri/*/edit'))
                        Edit Galeri
                    @elseif (Request::is('admin/galeri/create'))
                        Tambah Data Galeri
                    @elseif (Request::is('admin/struktur'))
                        Struktur
                    @elseif (Request::is('struktur/*/edit'))
                        Edit Struktur
                    @elseif (Request::is('admin/struktur/create'))
                        Tambah Data Struktur
                    @elseif (Request::is('admin/kegiatan'))
                        Kegiatan
                    @elseif (Request::is('kegiatan/*/edit'))
                        Edit Kegiatan
                    @elseif (Request::is('kegiatan/create'))
                        Tambah Data Kegiatan
                    @elseif (Request::is('admin/alumni'))
                        Alumni
                    @elseif (Request::is('alumni/*/edit'))
                        Edit Alumni
                    @elseif (Request::is('alumni/create'))
                        Tambah Data Alumni
                    @elseif (Request::is('admin/maps'))
                        Maps
                    @elseif (Request::is('maps/*/edit'))
                        Edit Maps
                    @elseif (Request::is('admin/maps/create'))
                        Tambah Data Maps
                    @else
                        Dashboard
                    @endif
                </div>
                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">
                    <ion-icon name="log-out-outline" class="text-3xl text-black"></ion-icon>
                </a>
            </header>

            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @vite('resources/js/app.js')
</body>
</html>
