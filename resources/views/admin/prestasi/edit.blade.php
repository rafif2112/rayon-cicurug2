<x-admin-layout>
    <div class="container mx-auto">
        <div class="rounded-lg bg-white p-6 shadow-lg">
            <h2 class="mb-6 text-2xl font-bold text-gray-900">Edit Prestasi</h2>

            <form action="{{ route('prestasi.update', $prestasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Nama <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $prestasi->nama) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Deskripsi <span
                            class="text-red-500">*</span></label>
                    <textarea name="deskripsi" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $prestasi->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Tahun <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="tahun"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('tahun', $prestasi->tahun) }}" min="2024" max="{{ date('Y') }}">
                    @error('tahun')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="mb-2 block text-sm font-medium text-gray-700">Gambar</label>

                    {{-- Current Images --}}
                    @if ($prestasi->gambar && count($prestasi->gambar) > 0)
                        <div class="mb-4">
                            <p class="mb-2 text-sm text-gray-600">Gambar saat ini:</p>
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                                @foreach ($prestasi->gambar as $image)
                                    <div class="group relative">
                                        <img src="{{ asset('assets/images/prestasi/' . $image) }}"
                                            alt="Gambar Prestasi" class="h-32 w-full rounded-lg border object-cover">
                                        <button type="button"
                                            class="absolute right-1 top-1 rounded-full bg-red-500 p-1 text-white opacity-0 transition-opacity group-hover:opacity-100"
                                            onclick="removeImage(this, '{{ $image }}')">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="deleted_images" id="deleted_images" value="">
                        </div>
                    @endif

                    {{-- Add New Images --}}
                    <div class="mt-4" id="image-container">
                        <p class="mb-2 text-sm text-gray-600">Tambah gambar baru:</p>
                        <div class="mb-2 flex items-center">
                            <input type="file" name="gambar[]"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                                accept="image/*">
                            <button type="button"
                                class="ml-2 rounded bg-blue-500 px-3 py-1 text-sm text-white hover:bg-blue-600"
                                onclick="addImageField()">Tambah</button>
                        </div>
                    </div>

                    @error('gambar.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPEG, PNG, JPG. Maksimal 2MB per file.
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('prestasi.admin') }}"
                        class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Update Prestasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function removeImage(button, imageName) {
            const parentDiv = button.closest('.relative');
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
            div.innerHTML = `
                <input type="file" name="gambar[]" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                <button type="button" class="ml-2 rounded bg-red-500 px-3 py-1 text-white hover:bg-red-600 text-sm" onclick="this.parentElement.remove()">Hapus</button>
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
