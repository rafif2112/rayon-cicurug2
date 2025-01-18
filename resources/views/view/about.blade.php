<x-layout>
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #map {
                height: 400px;
            }
        </style>
    @endpush

    <x-navbar></x-navbar>

    <x-header></x-header>

    <section>
        <div class="container w-11/12 pb-3 mx-auto mb-10 border-b-2 border-black sm:w-4/5">
            <div class="flex items-center gap-2 mb-3">
                <ion-icon class="text-5xl" src="{{asset('assets/images/icon/information-circle-outline.svg')}}"></ion-icon>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">Tentang Rayon
                    Ini</h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Tentang Rayon Cicurug 2</p>
        </div>

        <div class="py-12">
            <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center justify-center gap-5 md:items-start md:flex-row">
                <img src="{{ asset('assets/images/other/wikrama.jpg') }}" alt="Descriptive Alt Text"
                class="w-11/12 mb-10 rounded-lg shadow-lg h-80 md:mb-0 sm:w-3/4 md:w-1/3 lg:w-1/4">
                <div class="w-full h-full md:w-1/2">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Cicurug 2</h2>
                    <p class="mt-4 mb-4 text-lg text-gray-700 dark:text-gray-300">Rayon Cicurug 2 mencakup wilayah dari Cikereteg hingga Cimande, tergantung pada peserta didik baru di SMK Wikrama Bogor.</p>
                    <div id="accordion-color" data-accordion="collapse"
                        data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                        <h2 id="accordion-color-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 rounded-t-xl hover:bg-blue-100 focus:ring-4 focus:ring-blue-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-blue-800"
                            data-accordion-target="#accordion-color-body-1" aria-expanded="false"
                            aria-controls="accordion-color-body-1">
                            <span>Prestasi Rayon</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                        </h2>
                        <div id="accordion-color-body-1" class="hidden" aria-labelledby="accordion-color-heading-1">
                        <div
                            class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Rayon Cicurug 2 telah meraih berbagai prestasi di bidang akademik maupun non-akademik, termasuk juara lomba sains dan olahraga.</p>
                        </div>
                        </div>
                        <h2 id="accordion-color-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-b-0 border-gray-200 hover:bg-blue-100 focus:ring-4 focus:ring-blue-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-blue-800"
                            data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                            aria-controls="accordion-color-body-2">
                            <span>Kegiatan Rayon</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                        </h2>
                        <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Rayon ini aktif mengadakan berbagai kegiatan seperti seminar, workshop, dan kegiatan sosial yang melibatkan siswa dan masyarakat sekitar.</p>
                        </div>
                        </div>
                        <h2 id="accordion-color-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full gap-3 p-5 font-medium text-gray-500 border border-gray-200 hover:bg-blue-100 focus:ring-4 focus:ring-blue-200 rtl:text-right dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-blue-800"
                            data-accordion-target="#accordion-color-body-3" aria-expanded="false"
                            aria-controls="accordion-color-body-3">
                            <span>Fasilitas Rayon</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                        </h2>
                        <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
                        <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Rayon Cicurug 2 dilengkapi dengan berbagai fasilitas seperti laboratorium, perpustakaan, dan ruang olahraga untuk mendukung kegiatan belajar mengajar.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container w-11/12 pb-3 mx-auto my-10 border-b-2 border-black sm:w-4/5">
            <div class="flex items-center gap-2 mb-3">
                <ion-icon class="text-5xl" src="{{asset('assets/images/icon/location-sharp.svg')}}"></ion-icon>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl">Lokasi</h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Lokasi Rumah Siswa Cicurug 2</p>
        </div>

        <div class="container w-11/12 pb-3 mx-auto mb-10 border-b-2 sm:w-4/5">
            <div class="flex items-center justify-center w-full">
                <div class="w-full h-96" id="map"></div>

                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

                <script>
                    // Initialize the map
                    var map = L.map('map').setView([-6.723, 106.834], 12);
    
                    // Add OpenStreetMap tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);
    
                    // Define custom icon using SVG
                    function getCustomIcon(color) {
                        return L.divIcon({
                            className: 'custom-icon',
                            html: `
                                <svg width="30" height="40" viewBox="0 0 30 40" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 2C8.925 2 4 6.925 4 13c0 7 11 25 11 25s11-18 11-25c0-6.075-4.925-11-11-11z" fill="${color}" stroke="#000" stroke-width="1"/>
                                    <circle cx="15" cy="13" r="5" fill="white"/>
                                </svg>
                            `,
                            iconSize: [30, 40],
                            iconAnchor: [15, 40],
                            popupAnchor: [0, -40]
                        });
                    }
    
                var locations = @json($rumah);
    
                if (locations && locations.length > 0) {
                    locations.forEach(function(rumah) {
                        let color = '#000000';
    
                        if (rumah.siswa && rumah.siswa.angkatan) {
                            if (rumah.siswa.angkatan % 3 == 0) {
                                color = '#FB0297FF';
                            } else if (rumah.siswa.angkatan % 3 == 1) {
                                color = '#FFFF00';
                            } else if (rumah.siswa.angkatan % 3 == 2) {
                                color = '#0000FF';
                            } else {
                                color = '#000000';
                            }
                        }
    
                        // Add marker with the corresponding custom icon
                        if (rumah.siswa.latitude && rumah.siswa.longitude) {
                            L.marker([rumah.siswa.latitude, rumah.siswa.longitude], { icon: getCustomIcon(color) })
                                .addTo(map)
                                .bindPopup(`<b>${rumah.siswa.nama}</b>`);
                        }
                    });
                } else {
                    console.log('No location data available.');
                }
                </script>
            </div>
        </div>
    </section>
    
</x-layout>
