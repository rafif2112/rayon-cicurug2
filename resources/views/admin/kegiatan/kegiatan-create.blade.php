<x-admin-layout>
    <div class="overflow-x-auto p-6 bg-gray-100">
        <div class="rounded-lg bg-white p-6 shadow-md">
            <h2 class="mb-6 text-2xl font-semibold">Tambah Kegiatan</h2>
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="gambar">Foto</label>
                    <div id="drop-area"
                        class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pb-6 pt-5">
                        <div class="space-y-1 text-center">
                            <input id="gambar" name="gambar" type="file" class="sr-only"
                                onchange="previewImage(event)">
                            <p class="text-sm text-gray-600">Drag & Drop your image here or click to select</p>
                            <img id="preview" src="" alt="Image" class="mt-2 w-48 h-48 object-cover rounded-md shadow-md" style="display: none;">
                        </div>
                    </div>
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
                            previewImage({ target: { files: files } });
                        }
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
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
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
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('kegiatan.admin') }}"; // Redirect ke halaman kegiatan.admin
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