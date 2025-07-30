<x-admin-layout>
    <div class="mx-auto max-w-7xl">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Nama <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('nama') }}" placeholder="Masukkan Nama">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Deskripsi <span
                                class="text-red-500">*</span></label>
                        <textarea name="deskripsi" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Masukkan deskripsi prestasi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Tahun <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="tahun"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('tahun') }}" min="2024" max="{{ date('Y') }}"
                            placeholder="Masukkan tahun">
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Gambar <span
                                class="text-red-500">*</span></label>
                        <div class="mt-1" id="image-container">
                            @if (old('gambar'))
                                @foreach (old('gambar') as $index => $gambar)
                                    <div class="mb-2 flex items-center">
                                        <input type="file" name="gambar[]"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                                            accept="image/*">
                                        @if ($index > 0)
                                            <button type="button"
                                                class="ml-2 rounded bg-red-500 px-3 py-1 text-sm text-white hover:bg-red-600"
                                                onclick="this.parentElement.remove()">Hapus</button>
                                        @else
                                            <button type="button"
                                                class="ml-2 rounded bg-blue-500 px-3 py-1 text-sm text-white hover:bg-blue-600"
                                                onclick="addImageField()">Tambah</button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="mb-2 flex items-center">
                                    <input type="file" name="gambar[]"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                                        accept="image/*">
                                    <button type="button"
                                        class="ml-2 rounded bg-blue-500 px-3 py-1 text-sm text-white hover:bg-blue-600"
                                        onclick="addImageField()">Tambah</button>
                                </div>
                            @endif
                        </div>
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('gambar.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPEG, PNG, JPG. Maksimal 2MB per
                            file.</p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('prestasi.admin') }}"
                            class="rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Batal
                        </a>
                        <button type="submit"
                            class="rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan Prestasi
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
                <input type="file" name="gambar[]" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                <button type="button" class="ml-2 px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm" onclick="this.parentElement.remove()">Hapus</button>
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
