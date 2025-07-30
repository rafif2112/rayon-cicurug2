<x-admin-layout>
    <div class="min-h-screen">
        <div class="mx-auto">
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <a href="{{ route('kegiatan.admin') }}"
                    class="group flex items-center rounded-lg bg-white px-4 py-2 text-gray-700 shadow-md transition-all duration-300 hover:bg-gray-50 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="mr-2 h-5 w-5 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>

            <!-- Main Card -->
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl">
                <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-8 p-8">
                    @csrf
                    @method('PUT')

                    <!-- Existing Images Section -->
                    @if ($kegiatan->gambar && count(json_decode($kegiatan->gambar)) > 0)
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Gambar Saat Ini</h3>
                                <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">
                                    {{ count(json_decode($kegiatan->gambar)) }} gambar
                                </span>
                            </div>

                            <div id="existing-images" class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                                @foreach (json_decode($kegiatan->gambar) as $index => $image)
                                    <div class="group relative overflow-hidden rounded-lg bg-gray-100 shadow-md transition-all duration-300 hover:shadow-lg"
                                        data-image="{{ $image }}">
                                        @if ($image && file_exists(public_path('assets/images/kegiatan/' . $image)))
                                            <img src="{{ asset('assets/images/kegiatan/' . $image) }}"
                                                alt="Gambar {{ $index + 1 }}"
                                                class="h-32 w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <img src="{{ asset('assets/images/image.jpg') }}" alt="Gambar default"
                                                class="h-32 w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @endif

                                        <!-- Overlay dengan actions -->
                                        <div
                                            class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                            <div class="flex space-x-2">
                                                <!-- Preview button -->
                                                <button type="button"
                                                    onclick="previewImage('{{ asset('assets/images/kegiatan/' . $image) }}')"
                                                    class="rounded-full bg-blue-600 p-2 text-white transition-colors hover:bg-blue-700">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>

                                                <!-- Delete button -->
                                                <button type="button"
                                                    onclick="removeExistingImage(this, '{{ $image }}')"
                                                    class="rounded-full bg-red-600 p-2 text-white transition-colors hover:bg-red-700">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Status indicator -->
                                        <div class="absolute left-2 top-2">
                                            <span
                                                class="rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                                Tersimpan
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Hidden input untuk gambar yang akan dihapus -->
                            <input type="hidden" name="deleted_images" id="deleted_images" value="">

                            <div class="rounded-lg border border-amber-200 bg-amber-50 p-4">
                                <div class="flex items-start">
                                    <svg class="mt-0.5 h-5 w-5 text-amber-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.502 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    <div class="ml-3">
                                        <p class="text-sm text-amber-800">
                                            <strong>Perhatian:</strong> Gambar yang dihapus tidak dapat dikembalikan.
                                            Jika Anda mengunggah gambar baru, semua gambar lama akan diganti.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Images Section -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-lg font-semibold text-gray-900" for="gambar">
                                {{ $kegiatan->gambar && count(json_decode($kegiatan->gambar)) > 0 ? 'Tambah Gambar Baru (Opsional)' : 'Upload Gambar Kegiatan' }}
                            </label>
                            <span class="text-sm text-gray-500">Maksimal 2MB per file</span>
                        </div>

                        <div id="drop-area"
                            class="group relative cursor-pointer overflow-hidden rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 transition-all duration-300 hover:border-blue-400 hover:bg-blue-50">
                            <div class="p-8 text-center">
                                <input id="gambar" name="gambar[]" type="file" class="sr-only" multiple
                                    accept="image/*" onchange="previewNewImages(this)">

                                <div class="space-y-4">
                                    <div
                                        class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 transition-colors group-hover:bg-blue-200">
                                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-medium text-gray-900">Upload gambar baru</p>
                                        <p class="text-sm text-gray-600">Seret & lepas file di sini atau klik untuk
                                            memilih</p>
                                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG - Maksimal 2MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview container untuk gambar baru -->
                        <div id="new-preview-container" class="hidden">
                            <h4 class="text-md mb-3 font-medium text-gray-900">Gambar Baru yang Akan Diupload</h4>
                            <div id="new-images-grid" class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                            </div>
                        </div>

                        @error('gambar')
                            <p class="flex items-center text-sm text-red-600">
                                <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Form Fields -->
                    <div class="grid gap-6 md:grid-cols-1">
                        <div class="space-y-2">
                            <label for="judul" class="block text-sm font-semibold text-gray-900">Nama
                                Kegiatan</label>
                            <input type="text" id="judul" name="judul"
                                value="{{ old('judul', $kegiatan->judul) }}" required
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            @error('judul')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-900">Deskripsi
                                Kegiatan</label>
                            <textarea id="deskripsi" name="deskripsi" required rows="4"
                                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-gray-900 shadow-sm transition-colors focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                placeholder="Deskripsikan kegiatan secara detail...">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                        <a href="{{ route('kegiatan.admin') }}"
                            class="rounded-lg border border-gray-300 bg-white px-6 py-3 text-sm font-medium text-gray-700 shadow-sm transition-colors hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="flex items-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80">
        <div class="relative max-h-[90vh] max-w-[90vw]">
            <button onclick="closePreviewModal()"
                class="absolute -right-4 -top-4 rounded-full bg-white p-2 text-gray-600 shadow-lg hover:text-gray-900">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <img id="previewImage" class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-2xl" alt="Preview">
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    <script>
        let deletedImages = [];
        let newFileArray = [];

        // Drag and drop functionality
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('gambar');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropArea.classList.add('border-blue-500', 'bg-blue-100');
        }

        function unhighlight(e) {
            dropArea.classList.remove('border-blue-500', 'bg-blue-100');
        }

        dropArea.addEventListener('drop', handleDrop, false);
        dropArea.addEventListener('click', () => fileInput.click());

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            fileInput.files = files;
            previewNewImages(fileInput);
        }

        // Remove existing image
        function removeExistingImage(button, imageName) {
            Swal.fire({
                title: 'Hapus Gambar?',
                text: "Gambar ini akan dihapus dari kegiatan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const imageContainer = button.closest('[data-image]');
                    imageContainer.style.transform = 'scale(0)';
                    imageContainer.style.opacity = '0';

                    setTimeout(() => {
                        imageContainer.remove();
                        deletedImages.push(imageName);
                        document.getElementById('deleted_images').value = JSON.stringify(deletedImages);

                        // Update counter
                        updateImageCounter();

                        // Show success message
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Gambar berhasil dihapus',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }, 300);
                }
            });
        }

        // Preview new images
        function previewNewImages(input) {
            const container = document.getElementById('new-images-grid');
            const previewContainer = document.getElementById('new-preview-container');

            container.innerHTML = '';
            newFileArray = Array.from(input.files);

            if (newFileArray.length > 0) {
                previewContainer.classList.remove('hidden');

                newFileArray.forEach((file, index) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className =
                            'group relative overflow-hidden rounded-lg bg-gray-100 shadow-md transition-all duration-300 hover:shadow-lg';

                        div.innerHTML = `
                            <img src="${e.target.result}" alt="New Image ${index + 1}" 
                                 class="h-32 w-full object-cover transition-transform duration-300 group-hover:scale-110">
                            
                            <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <button type="button" onclick="removeNewImage(this, ${index})"
                                        class="rounded-full bg-red-600 p-2 text-white transition-colors hover:bg-red-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                            <div class="absolute left-2 top-2">
                                <span class="rounded-full bg-blue-100 px-2 py-1 text-xs font-medium text-blue-800">
                                    Baru
                                </span>
                            </div>
                        `;

                        container.appendChild(div);
                    };

                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        }

        // Remove new image
        function removeNewImage(button, index) {
            const imageContainer = button.closest('.group');
            imageContainer.style.transform = 'scale(0)';
            imageContainer.style.opacity = '0';

            setTimeout(() => {
                imageContainer.remove();
                newFileArray.splice(index, 1);

                // Update file input
                const dtTransfer = new DataTransfer();
                newFileArray.forEach(file => dtTransfer.items.add(file));
                fileInput.files = dtTransfer.files;

                // Hide container if no files
                if (newFileArray.length === 0) {
                    document.getElementById('new-preview-container').classList.add('hidden');
                }
            }, 300);
        }

        // Preview image in modal
        function previewImage(src) {
            document.getElementById('previewImage').src = src;
            document.getElementById('previewModal').classList.remove('hidden');
            document.getElementById('previewModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closePreviewModal() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Update image counter
        function updateImageCounter() {
            const existingImages = document.querySelectorAll('#existing-images [data-image]').length;
            const counter = document.querySelector('.rounded-full.bg-blue-100');
            if (counter) {
                counter.textContent = `${existingImages} gambar`;
            }
        }

        // Close modal on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePreviewModal();
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const existingImages = document.querySelectorAll('#existing-images [data-image]').length;
            const newImages = newFileArray.length;

            if (existingImages === 0 && newImages === 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Harap upload minimal satu gambar untuk kegiatan',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
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
