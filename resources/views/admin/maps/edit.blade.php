<x-admin-layout>
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8 sm:p-12">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-8">Edit Map</h2>
                    <div class="mb-4 alert hidden rounded-lg border border-red-500 bg-red-50 p-4 text-red-800 relative shadow-md">
                        <h2 class="text-lg font-semibold mb-2 flex items-center">
                            Error: Invalid Google Maps Link
                        </h2>
                        <p>Please provide a valid Google Maps link.</p>
                        <button type="button" class="absolute top-0 right-0 mt-2 mr-3 text-red-800 hover:text-red-900 focus:outline-none" onclick="this.parentElement.classList.add('hidden');">
                            &times;
                        </button>
                    </div>
                    <form id="mapsForm" action="{{ route('maps.update', $rumah->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama:</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama', $rumah->nama) }}" required
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('nama')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan:</label>
                                <input type="text" id="angkatan" name="angkatan" value="{{ old('angkatan', $rumah->angkatan) }}" required
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('angkatan')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="google_maps_link" class="block text-sm font-medium text-gray-700">Google Maps Link:</label>
                                <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude', $rumah->latitude) }}">
                                <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude', $rumah->longitude) }}">
                                <input type="text" id="google_maps_link" name="google_maps_link" value="{{ old('google_maps_link', $rumah->google_maps_link) }}"
                                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @error('google_maps_link')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="flex justify-end">
                                <a href="{{ route('maps.admin') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Batal
                                </a>
                                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mapsForm').addEventListener('submit', function(event) {
            const link = document.getElementById('google_maps_link').value;
            if (link.trim() === '') {
                return; // Do nothing if the link is empty
            }
            const regex = /@(-?\d+\.\d+),(-?\d+\.\d+)/;
            const match = link.match(regex);
            if (match) {
                document.getElementById('latitude').value = match[1];
                document.getElementById('longitude').value = match[2];
            } else {
                event.preventDefault();
                document.querySelector('.alert').classList.remove('hidden');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('maps.admin') }}";
                }
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</x-admin-layout>