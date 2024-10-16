    <nav class="fixed top-0 h-20 w-full border-gray-200 bg-white shadow-lg dark:border-gray-700 dark:bg-gray-900" style="z-index: 50">
        <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between px-4 py-5">
            <a href="/" class="flex items-center space-x-5 rtl:space-x-reverse">
                <img class="w-6 md:w-8 -mt-[2px]" src="{{asset('assets/images/icon/cicurug2.png')}}" alt="">
                <span class="self-center whitespace-nowrap bg-gradient-to-l from-blue-400 to-blue-700 bg-clip-text text-2xl font-extrabold text-transparent md:text-3xl">Cicurug 2</span>
            </a>
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden" aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                <ul class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 font-medium rtl:space-x-reverse dark:border-gray-700 dark:bg-gray-800 md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-white md:p-0 md:dark:bg-gray-900">
                    <li>
                        <a href="/" class="{{ Request::is('/') ? 'text-blue-500 dark:bg-blue-600 md:text-blue-700 md:dark:bg-transparent md:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 md:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" aria-current="page"><ion-icon class="text-xl px-2 -mb-1" src="{{asset('assets/images/icon/home.svg')}}"></ion-icon>Home</a>
                    </li>
                    <li>
                        <a href="/siswa" class="{{ request()->is('siswa') || request()->is('alumni') ? ' text-blue-500 dark:bg-blue-600 md:text-blue-700 md:dark:bg-transparent md:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 md:hover:bg-transparent' }} block py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><ion-icon class="text-lg px-2 -mb-1" src="{{asset('assets/images/icon/people.svg')}}"></ion-icon>Siswa</a>
                    </li>
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="{{ request()->is('kegiatan') || request()->is('tentang') ? 'text-blue-500 dark:bg-blue-600 md:text-blue-700 md:dark:bg-transparent md:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 md:hover:bg-transparent' }} flex w-full items-center justify-between rounded py-2">
                            <span>
                                <ion-icon class="text-xl -mb-1 px-2" src="{{asset('assets/images/icon/list.svg')}}"></ion-icon>Lainnya
                            </span>
                            <svg class="ms-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden w-48 divide-y divide-gray-100 rounded-lg bg-white font-normal shadow dark:divide-gray-600 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="/kegiatan" class="{{ request()->is('kegiatan') ? ' text-blue-500 dark:bg-blue-600 md:text-blue-700 md:dark:bg-transparent md:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 md:hover:bg-transparent' }} block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><ion-icon class="text-lg pr-2 -mb-0.5" src="{{asset('assets/images/icon/bar-chart.svg')}}"></ion-icon>Kegiatan</a>
                                </li>
                                <li>
                                    <a href="/tentang" class="{{ request()->is('tentang') ? ' text-blue-500 dark:bg-blue-600 md:text-blue-700 md:dark:bg-transparent md:dark:text-blue-500' : 'text-black hover:text-blue-700 hover:bg-gray-100 md:hover:bg-transparent' }} block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><ion-icon class="text-xl pr-1 -mb-1" src="{{asset('assets/images/icon/information-circle-outline.svg')}}"></ion-icon>Tentang Rayon ini</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="h-20 bg-white"></div>
