<section>
    <div class="container mx-auto my-10 w-11/12 border-b-2 border-black pb-3 sm:w-4/5">
        <div class="mb-3 flex items-center gap-2">
            <ion-icon class="text-5xl" src="{{ asset('assets/images/icon/location-sharp.svg') }}"></ion-icon>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl">Lokasi</h2>
        </div>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Lokasi Rumah Siswa Cicurug 2</p>
    </div>

    <div class="container mx-auto mb-10 w-11/12 border-b-2 pb-3 sm:w-4/5">
        <div class="flex w-full items-center justify-center">
            <div class="h-96 w-full" id="map"></div>

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
                            console.log(rumah.siswa);
                            L.marker([rumah.siswa.latitude, rumah.siswa.longitude], {
                                    icon: getCustomIcon(color)
                                })
                                .addTo(map)
                                .bindPopup(`
                                    <p class="text-sm">Nama : ${rumah.siswa.nama}
                                        <br>
                                        <span class="text-sm">Jurusan : ${rumah.siswa.jurusan}</span>
                                    </p>
                                `);
                        }
                    });
                } else {
                    console.log('No location data available.');
                }
            </script>
        </div>
    </div>
</section>