    <nav class="fixed top-0 h-20 w-full border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900"
        style="z-index: 50">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 py-5">
            <a href="{{ route('home') }}" class="flex items-center space-x-5 rtl:space-x-reverse">
                <img class="-mt-[2px] w-6 md:w-8" src="{{ asset('assets/images/icon/cicurug2.png') }}" alt="">
                <span
                    class="self-center whitespace-nowrap bg-gradient-to-l from-blue-400 to-blue-700 bg-clip-text text-2xl font-extrabold text-transparent md:text-3xl">Cicurug
                    2</span>
            </a>
            <button data-collapse-toggle="navbar-dropdown" type="button"
                class="inline-flex h-12 w-12 items-center justify-center rounded-lg p-2 text-gray-600 transition-all duration-200 hover:bg-blue-50 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 lg:hidden"
                aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Toggle navigation menu</span>
                <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full lg:block lg:w-auto" id="navbar-dropdown">
                <ul
                    class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 font-medium dark:border-gray-700 dark:bg-gray-800 lg:mt-0 lg:flex-row lg:space-x-8 lg:border-0 lg:bg-white lg:p-0 lg:dark:bg-gray-900 rtl:space-x-reverse">
                    <li>
                        <a href="{{ route('home') }}"
                            class="{{ Request::is('/') ? 'text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            aria-current="page">
                            {{-- <ion-icon class="text-xl px-2 -mb-1" src="{{asset('assets/images/icon/home.svg')}}"></ion-icon> --}}
                            Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.index') }}"
                            class="{{ request()->is('siswa') ? ' text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            {{-- <ion-icon class="text-lg px-2 -mb-1" src="{{asset('assets/images/icon/people.svg')}}"></ion-icon> --}}
                            Siswa</a>
                    </li>

                    <li>
                        <a href="{{ route('alumni.index') }}"
                            class="{{ Request::is('alumni') ? 'text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            aria-current="page">
                            Alumni</a>
                    </li>

                    <li>
                        <a href="{{ route('prestasi') }}"
                            class="{{ Request::is('prestasi') ? 'text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            aria-current="page">
                            Prestasi</a>
                    </li>

                    {{-- <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                            class="{{ request()->is('kegiatan') || request()->is('tentang') ? 'text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} flex w-full items-center justify-between rounded py-2">
                            <span>
                                Lainnya
                            </span>
                            <svg class="ms-2.5 mt-1 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar"
                            class="z-10 hidden w-48 divide-y divide-gray-100 rounded-lg bg-white font-normal shadow dark:divide-gray-600 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400"
                                aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('alumni.index') }}"
                                        class="{{ request()->is('tentang') ? ' text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Alumni</a>
                                </li>
                                <li>
                                    <a href="{{ route('kegiatan.index') }}"
                                        class="{{ request()->is('kegiatan') ? ' text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Kegiatan</a>
                                </li>
                                <li>
                                    <a href="{{ route('tentang.index') }}"
                                        class="{{ request()->is('tentang') ? ' text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Tentang Rayon ini</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    {{-- <li>
                        <a href="{{ route('tentang.index') }}"
                            class="{{ Request::is('tentang') ? 'text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            aria-current="page">
                            Tentang</a>
                    </li> --}}
                    <li>
                        <a href="{{ route('kegiatan.index') }}"
                            class="{{ Request::is('kegiatan') ? 'text-blue-500 dark:bg-blue-600 lg:text-blue-700 lg:dark:bg-transparent lg:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 lg:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            aria-current="page">
                            Kegiatan</a>
                    </li>

                    @auth
                        <li>
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('dashboard') }}"
                                    class="block rounded-full bg-blue-600 px-4 py-2 text-white duration-300 hover:bg-blue-500">Dashboard</a>
                            @elseif(auth()->user()->role === 'siswa')
                                <a href="{{ route('siswa.dashboard') }}"
                                    class="block rounded-full bg-blue-600 px-4 py-2 text-white duration-300 hover:bg-blue-500">Dashboard</a>
                            @endif
                        </li> 
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="h-20 bg-white"></div>
