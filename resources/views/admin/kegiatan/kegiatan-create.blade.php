<x-admin-layout>
    <div class="overflow-x-auto bg-gray-100">
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
            <h2 class="mb-6 text-2xl font-semibold">Tambah Kegiatan</h2>
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="gambar">Foto</label>
                    <div id="drop-area"
                        class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pb-6 pt-5">
                        <div class="space-y-1 text-center">
                            <input id="gambar" name="gambar[]" type="file" class="sr-only" multiple
                                accept="image/*" onchange="previewImages(this)">
                            <p class="text-sm text-gray-600">Drag & Drop your images here or click to select</p>
                            <div id="preview-container" class="mt-2 grid grid-cols-3 gap-4"></div>
                        </div>
                    </div>
                    @error('gambar')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <script>
                    function previewImages(input) {
                        const container = document.getElementById('preview-container');
                        container.innerHTML = '';

                        if (input.files) {
                            let fileArray = Array.from(input.files);

                            fileArray.forEach((file, index) => {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    const div = document.createElement('div');
                                    div.className = 'relative';

                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.className = 'w-full h-32 object-cover rounded-md shadow-md';

                                    const removeBtn = document.createElement('button');
                                    removeBtn.innerHTML = '×';
                                    removeBtn.className =
                                        'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center';
                                    removeBtn.onclick = function(e) {
                                        e.preventDefault();
                                        e.stopPropagation();

                                        fileArray.splice(index, 1);

                                        const dtTransfer = new DataTransfer();
                                        fileArray.forEach(file => dtTransfer.items.add(file));
                                        input.files = dtTransfer.files;

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

                    const dropArea = document.getElementById('drop-area');
                    const fileInput = document.getElementById('gambar');

                    dropArea.addEventListener('dragover', (event) => {
                        event.preventDefault();
                        dropArea.classList.add('border-blue-500');
                    });

                    dropArea.addEventListener('dragleave', () => {
                        dropArea.classList.remove('border-blue-500');
                    });

                    dropArea.addEventListener('drop', (event) => {
                        event.preventDefault();
                        dropArea.classList.remove('border-blue-500');
                        const files = event.dataTransfer.files;
                        if (files.length > 0) {
                            fileInput.files = files;
                            previewImages(fileInput);
                        }
                    });

                    dropArea.addEventListener('click', () => {
                        fileInput.click();
                    });
                </script>

                <div class="mb-4">
                    <label for="judul" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('judul')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" required
                        class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
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
                    window.location.href = "{{ route('kegiatan.admin') }}";
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

        // Tampilkan error validasi
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Validasi',
                html: '<ul style="text-align: left;">' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
                confirmButtonText: 'OK'
            });
        @endif

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('gambar');

            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Harap pilih minimal satu gambar untuk kegiatan',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            // Validasi ukuran file
            for (let i = 0; i < fileInput.files.length; i++) {
                if (fileInput.files[i].size > 2048 * 1024) { // 2MB
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: `File "${fileInput.files[i].name}" melebihi batas 2MB`,
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
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
                    window.location.href = "{{ route('kegiatan.admin') }}";
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

        // Tampilkan error validasi
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Validasi',
                html: '<ul style="text-align: left;">' +
                    @foreach ($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
                confirmButtonText: 'OK'
            });
        @endif

        // Validasi form sebelum submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('gambar');

            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Harap pilih minimal satu gambar untuk kegiatan',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            // Validasi ukuran file
            for (let i = 0; i < fileInput.files.length; i++) {
                if (fileInput.files[i].size > 2048 * 1024) { // 2MB
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: `File "${fileInput.files[i].name}" melebihi batas 2MB`,
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
            }
        });
    </script>
</x-admin-layout>
