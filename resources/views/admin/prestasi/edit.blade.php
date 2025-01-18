<x-admin-layout>
    <div class="container mx-auto">
        <div class="rounded bg-white p-6 shadow-md">
            <h2 class="mb-6 text-2xl font-bold">Edit Prestasi</h2>
            <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ $prestasi->nama }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    @error('nama')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ $prestasi->deskripsi }}</textarea>
                    @error('deskripsi')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Tahun</label>
                    <input type="number" name="tahun" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $prestasi->tahun }}" min="2024" max="{{ date('Y') }}" required>
                    @error('tahun')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <div class="mt-1" id="image-container">
                        <div class="mb-4 flex gap-10">
                            @foreach ($prestasi->gambar as $image)
                                <div class="mb-2 flex items-start">
                                    <img src="{{ asset('assets/images/prestasi/' . $image) }}" alt="Gambar Prestasi"
                                        class="w-30 mr-2 h-24 object-cover">
                                    <button type="button" class="ml-2 rounded bg-red-500 px-2 py-1 text-white"
                                        onclick="removeImage(this, '{{ $image }}')">Hapus</button>
                                </div>
                            @endforeach
                            <input type="hidden" name="deleted_images" id="deleted_images" value="">
                        </div>
                        <div class="mb-2 flex items-center">
                            <input type="file" name="gambar[]" class="block" accept="image/*">
                            <button type="button" class="ml-2 rounded bg-blue-500 px-2 py-1 text-white"
                                onclick="addImageField()">+</button>
                        </div>
                    </div>
                    @error('gambar.*')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="rounded bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function removeImage(button, imageName) {
            const parentDiv = button.parentElement;
            parentDiv.remove();

            const deletedImagesInput = document.getElementById('deleted_images');
            let deletedImages = deletedImagesInput.value ? JSON.parse(deletedImagesInput.value) : [];
            deletedImages.push(imageName);
            deletedImagesInput.value = JSON.stringify(deletedImages);
        }

        function addImageField() {
            const container = document.getElementById('image-container');
            const div = document.createElement('div');
            div.className = 'mb-2 flex items-center';

            const input = document.createElement('input');
            input.type = 'file';
            input.name = 'gambar[]';
            input.className = 'block';
            input.accept = 'image/*';
            div.appendChild(input);

            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'ml-2 rounded bg-red-500 px-2 py-1 text-white';
            button.textContent = '-';
            button.onclick = function() {
                div.remove();
            };
            div.appendChild(button);

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
