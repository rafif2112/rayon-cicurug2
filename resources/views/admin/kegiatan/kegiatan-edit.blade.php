<x-admin-layout>
    <div class="overflow-x-auto bg-gray-100 p-6">
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('kegiatan.admin') }}"
                class="flex items-center rounded-lg bg-gray-100 px-4 py-2 text-gray-700 transition duration-300 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        <div class="rounded-lg bg-white p-6 shadow-md">
            <h2 class="mb-6 text-2xl font-semibold">Edit Kegiatan</h2>
            <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="gambar">Foto</label>
                    <div id="drop-area"
                        class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pb-6 pt-5">
                        <div class="space-y-1 text-center">
                            <input id="gambar" name="gambar" type="file" class="sr-only"
                                onchange="previewImage(event)">
                            <p class="text-sm text-gray-600">Drag & Drop your image here or click to select</p>
                            <img id="preview" src="{{ asset('storage/images/kegiatan/' . $kegiatan->gambar) }}"
                                alt="Image" class="mt-2 h-48 w-48 rounded-md object-cover shadow-md"
                                style="{{ $kegiatan->gambar ? '' : 'display: none;' }}">
                        </div>
                    </div>
                    @error('gambar')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <script>
                    const dropArea = document.getElementById('drop-area');
                    const preview = document.getElementById('preview');
                    const fileInput = document.getElementById('gambar');

                    // Highlight drop area when item is dragged over it
                    dropArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        dropArea.classList.add('border-blue-500');
                    });

                    // Remove highlight when item is dragged out of drop area
                    dropArea.addEventListener('dragleave', () => {
                        dropArea.classList.remove('border-blue-500');
                    });

                    // Handle file drop
                    dropArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        dropArea.classList.remove('border-blue-500');
                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            fileInput.files = files;
                            previewImage({
                                target: {
                                    files: files
                                }
                            });
                        }
                    });

                    // Make drop area clickable
                    dropArea.addEventListener('click', () => {
                        fileInput.click();
                    });

                    // Preview the selected image
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            preview.src = reader.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>

                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $kegiatan->judul) }}"
                        required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('judul')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const dropArea = document.getElementById('drop-area');
        const preview = document.getElementById('preview');
        const fileInput = document.getElementById('gambar');

        // Highlight drop area when item is dragged over it
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('border-blue-500');
        });

        // Remove highlight when item is dragged out of drop area
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-blue-500');
        });

        // Handle file drop
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('border-blue-500');
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                previewImage({
                    target: {
                        files: files
                    }
                });
            }
        });

        // Preview the selected image
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                        "{{ route('kegiatan.admin') }}"; // Redirect ke halaman kegiatan.admin
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
        });
    </script>
</x-admin-layout>
