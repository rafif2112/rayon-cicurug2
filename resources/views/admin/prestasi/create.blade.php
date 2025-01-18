<x-admin-layout>
    {{-- {{$errors}} --}}
    <div class="mx-auto max-w-7xl">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('nama') }}">
                        @error('nama')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        @error('deskripsi')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Tahun</label>
                        <input type="number" name="tahun"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('tahun') }}"
                            min="2024" max="{{ date('Y') }}">
                        @error('tahun')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Gambar</label>
                        <div class="mt-1" id="image-container">
                            <div class="mb-2 flex items-center">
                                <input type="file" name="gambar[]" class="block" accept="image/*">
                                <button type="button" class="ml-2 rounded bg-blue-500 px-2 py-1 text-white"
                                    onclick="addImageField()">+</button>
                            </div>
                        </div>
                        @error('gambar')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addImageField() {
            const container = document.getElementById('image-container');
            const div = document.createElement('div');
            div.className = 'flex items-center mb-2';
            div.innerHTML = `
            <input type="file" name="gambar[]" class="block" accept="image/*">
            <button type="button" class="ml-2 px-2 py-1 bg-red-500 text-white rounded" onclick="this.parentElement.remove()">-</button>
        `;
            container.appendChild(div);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('prestasi.admin') }}";
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700'
                }
            });
        @endif
    </script>

</x-admin-layout>
