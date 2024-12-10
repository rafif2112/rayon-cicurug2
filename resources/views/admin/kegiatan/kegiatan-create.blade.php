<x-admin-layout>
    <div class="overflow-x-auto p-6 bg-gray-100">
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('kegiatan.admin') }}" class="flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali</span>
            </a>
        </div>
        <div class="rounded-lg bg-white p-6 shadow-md">
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="gambar">Foto</label>
                    <div id="drop-area"
                        class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pb-6 pt-5">
                        <div class="space-y-1 text-center">
                            <input id="gambar" name="gambar[]" type="file" class="sr-only" multiple accept="image/*" onchange="previewImages(this)">
                            <p class="text-sm text-gray-600">Drag & Drop your images here or click to select</p>
                            <div id="preview-container" class="mt-2 grid grid-cols-3 gap-4"></div>
                        </div>
                    </div>
                    @error('gambar')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <script>
                    function previewImages(input) {
                        const container = document.getElementById('preview-container');
                        container.innerHTML = '';

                        if (input.files) {
                            [...input.files].forEach(file => {
                                const reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    const div = document.createElement('div');
                                    div.className = 'relative';
                                    
                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.className = 'w-full h-32 object-cover rounded-md shadow-md';
                                    
                                    const removeBtn = document.createElement('button');
                                    removeBtn.innerHTML = '×';
                                    removeBtn.className = 'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center';
                                    removeBtn.onclick = function() {
                                        div.remove();
                                    };
                                    
                                    div.appendChild(img);
                                    div.appendChild(removeBtn);
                                    container.appendChild(div);
                                };

                                reader.readAsDataURL(file);
                            });
                        }
                    }
                </script>

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

                    // Make drop area clickable
                    dropArea.addEventListener('click', () => {
                        fileInput.click();
                    });
                </script>

                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('judul')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center rounded-md border border-transparent bg-blue-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700">
                        Tambah
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