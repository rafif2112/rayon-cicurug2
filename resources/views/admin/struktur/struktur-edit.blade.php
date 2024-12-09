<x-admin-layout>
    <div class="min-h-screen">
        <div class="mx-auto max-w-4xl">
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('struktur.admin') }}"
                    class="flex items-center rounded-lg bg-gray-100 px-4 py-2 text-gray-700 transition duration-300 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl">
                <div class="p-8 sm:p-12">
                    <h2 class="mb-8 text-3xl font-extrabold text-gray-900">Edit Struktur</h2>
                    <form action="{{ route('struktur.update', $struktur->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <div>
                                <label for="gambar" class="mb-2 block text-sm font-medium text-gray-700">
                                    Foto Struktur
                                </label>
                                <div class="flex items-center justify-center">
                                    <img id="preview"
                                        src="{{ asset('storage/images/struktur/' . $struktur->gambar) }}"
                                        class="max-h-48 rounded-lg shadow-lg transition-all duration-300 ease-in-out"
                                        alt="Pratinjau foto struktur">
                                </div>
                                <div id="drop-area"
                                    class="mt-2 flex cursor-pointer justify-center rounded-lg border-2 border-dashed border-gray-300 px-6 pb-6 pt-5 transition-colors duration-300 ease-in-out hover:border-indigo-500">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                            fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="gambar"
                                                class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Unggah file</span>
                                                <input id="gambar" name="gambar" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">atau seret dan lepas</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB</p>
                                    </div>
                                </div>
                                @error('gambar')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama
                                        Lengkap</label>
                                    <input type="text" id="nama" name="nama" value="{{ $struktur->nama }}"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('nama')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jabatan"
                                        class="block text-sm font-medium text-gray-700">Jabatan</label>
                                    <input type="text" id="jabatan" name="jabatan" value="{{ $struktur->jabatan }}"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('jabatan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-5">
                            <div class="flex justify-end">
                                <a href="{{ route('struktur.admin') }}"
                                    class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Batal
                                </a>
                                <button type="submit"
                                    class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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
        const fileInput = document.getElementById('gambar');
        const preview = document.getElementById('preview');
        const dropArea = document.getElementById('drop-area');

        fileInput.addEventListener('change', handleFileSelect);

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    preview.classList.add('animate-fade-in');
                };
                reader.readAsDataURL(file);
            }
        }

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('border-indigo-500', 'border-2');
        }

        function unhighlight() {
            dropArea.classList.remove('border-indigo-500', 'border-2');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            handleFileSelect({
                target: {
                    files: files
                }
            });
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
                    window.location.href = "{{ route('struktur.admin') }}";
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700'
                }
            });
        @endif
    </script>
</x-admin-layout>
