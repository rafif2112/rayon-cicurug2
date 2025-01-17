<x-admin-layout>
    <div class="container mx-auto">

        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('galeri.admin') }}"
                class="flex items-center rounded-lg bg-gray-100 px-4 py-2 text-gray-700 transition duration-300 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <div class="overflow-hidden rounded-xl bg-white shadow-lg dark:bg-gray-800">
            <form action="{{ route('galeri.update', $image->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label for="judul"
                                class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Activity
                                Name</label>
                            <input type="text" id="judul" name="judul"
                                value="{{ old('judul', $image->judul) }}" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 transition duration-300 ease-in-out focus:border-transparent focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <label for="gambar"
                            class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Profile
                            Picture</label>
                        <div id="drop-area"
                            class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pb-6 pt-5">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar"
                                        class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="gambar" name="gambar" type="file" accept="image/*"
                                            class="sr-only" required>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                        <div id="image-preview" class="mt-4">
                            <img id="preview" class="h-96 max-w-full rounded-lg shadow-md"
                                src="{{ asset('assets/images/galeri/' . $image->gambar) }}" alt="Image preview">
                        </div>
                        @error('gambar')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit"
                        class="transform rounded-lg bg-blue-600 px-6 py-3 text-white transition duration-300 ease-in-out hover:-translate-y-1 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('gambar');
        const imagePreview = document.getElementById('image-preview');
        const preview = document.getElementById('preview');

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
            dropArea.classList.add('border-blue-500', 'bg-blue-100', 'dark:bg-blue-900');
        }

        function unhighlight() {
            dropArea.classList.remove('border-blue-500', 'bg-blue-100', 'dark:bg-blue-900');
        }

        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            if (files.length) {
                fileInput.files = files;
                previewImage({
                    target: {
                        files: files
                    }
                });
            }
        }

        dropArea.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', previewImage);

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('galeri.admin') }}";
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2'
                }
            });
        @endif
    </script>
</x-admin-layout>
