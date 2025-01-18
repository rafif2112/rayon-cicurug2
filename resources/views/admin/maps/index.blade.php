<x-admin-layout>
    <div class="mx-auto w-4/5 pb-3 sm:w-full">
        <div class="flex w-full items-center justify-center">

            <div class="h-[350px] w-full rounded-xl" id="map"></div>

            <!-- Import Leaflet CSS -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

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
                            L.marker([rumah.siswa.latitude, rumah.siswa.longitude], {
                                    icon: getCustomIcon(color)
                                })
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

    <div class="mx-auto py-6">
        <div class="flex items-center justify-between">
            <div class="items center flex">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Maps</h2>
            </div>
        </div>
        <div class="mt-4 overflow-hidden rounded-lg bg-white shadow-md">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="sticky top-0 px-4 py-3 text-left">Nama</th>
                            <th class="sticky top-0 px-4 py-3 text-left">Angkatan</th>
                            <th class="sticky top-0 px-1 py-3 text-center" colspan="2">Titik kordinat</th>
                            <th class="sticky top-0 px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="max-h-[400px] overflow-y-auto">
                        @foreach ($data as $map)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-3">{{ $map->siswa->nama }}</td>
                                <td class="px-4 py-3">{{ $map->siswa->angkatan }}</td>
                                <td class="px-4 py-3">{{ $map->siswa->latitude }}</td>
                                <td class="px-4 py-3">{{ $map->siswa->longitude }}</td>
                                <td class="px-4 py-3">
                                    <div class="items flex gap-1">
                                        <a href="{{ route('siswa.edit', $map->siswa->id) }}"
                                            class="rounded border border-blue-500 px-2 py-1 font-semibold text-blue-500 hover:bg-blue-500 hover:text-white">
                                            Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-4 flex justify-center">
        {{ $data->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-admin-layout>
