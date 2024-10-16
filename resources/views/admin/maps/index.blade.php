<x-admin-layout>
    <div class="sm:w-11/12 pb-3 mx-auto w-4/5">
        <div class="flex items-center justify-center w-full">

            <div class="w-full h-[350px] rounded-xl" id="map" style="z-index: -1;"></div>

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

                // Get location data from controller
                var locations = @json($rumah);

                // Check if locations data exists
                if (locations && locations.length > 0) {
                    // Add markers for each location with custom icon
                    locations.forEach(function(rumah) {
                        let color = '#000000'; // Default color

                        // Check rumah.angkatan and assign color accordingly
                        if (rumah.angkatan) {
                            if (rumah.angkatan % 3 == 0) {
                                color = '#FB0297FF'; // Pink for angkatan 24, 27, 30, 33, etc.
                            } else if (rumah.angkatan % 3 == 1) {
                                color = '#FFFF00'; // Yellow for angkatan 25, 28, 31, 34, etc.
                            } else if (rumah.angkatan % 3 == 2) {
                                color = '#0000FF'; // Blue for angkatan 26, 29, 32, 35, etc.
                            } else {
                                color = '#000000'; // Default color
                            }
                        }

                        // Add marker with the corresponding custom icon
                        if (rumah.latitude && rumah.longitude) {
                            L.marker([rumah.latitude, rumah.longitude], { icon: getCustomIcon(color) })
                                .addTo(map)
                                .bindPopup(`<b>${rumah.nama}</b>`);
                        }
                    });
                } else {
                    console.log('No location data available.');
                }
            </script>
        </div>
    </div>
    
    <div class="py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items center">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Maps</h2>
            </div>
            <a href="{{ route('maps.create') }}"
                class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                Tambah Data Lokasi
            </a>
        </div>
        <div class="mt-4 overflow-hidden bg-white rounded-lg shadow-md">
            <table class="w-full">
                <thead>
                    <tr class="text-gray-700 bg-gray-200">
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Angkatan</th>
                        <th class="px-1 py-3 text-center" colspan="2">Titik kordinat</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rumah as $map)
                        <tr class="border-b border-gray-200">
                            <td class="px-4 py-3">{{ $map->nama }}</td>
                            <td class="px-4 py-3">{{ $map->angkatan }}</td>
                            <td class="px-4 py-3">{{ $map->latitude }}</td>
                            <td class="px-4 py-3">{{ $map->longitude }}</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-1 items">
                                    <a href="{{ route('maps.edit', $map->id) }}"
                                        class="px-2 py-1 font-semibold text-blue-500 border border-blue-500 rounded hover:bg-blue-500 hover:text-white">
                                        Edit
                                    </a>
                                    <form action="{{ route('maps.destroy', $map->id) }}" method="POST"
                                        class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 font-semibold text-red-500 border border-red-500 rounded hover:bg-red-500 hover:text-white delete-button">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
