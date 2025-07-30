<x-siswa-layout>
    <div class="min-h-screen">
        <!-- Form -->
        <div class="overflow-hidden rounded-2xl bg-white shadow-xl">
            <div class="p-6">
                <div class="mb-6 flex items-center border-b-2 border-gray-300 pb-4 justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Portofolio Saya</h1>
                        <p class="mt-2 text-gray-600">Kelola informasi portofolio dan prestasi Anda</p>
                    </div>
                    <a href="{{ route('siswa.dashboard') }}"
                        class="flex items-center rounded-lg bg-gray-100 px-4 py-2 text-gray-700 transition duration-300 ease-in-out hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Kembali</span>
                    </a>
                </div>
                <form action="{{ route('siswa.portofolio.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf
                    <!-- Deskripsi Diri -->
                    <div>
                        <label for="deskripsi" class="mb-2 block text-sm font-medium text-gray-700">
                            Deskripsi Diri
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Ceritakan tentang diri Anda, minat, dan tujuan...">{{ old('deskripsi', $siswa->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sertifikat -->
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-700">Sertifikat</label>
                        <div id="sertifikat-container">
                            @if (old('sertifikat') || $siswa->sertifikat)
                                @foreach (old('sertifikat', $siswa->sertifikat ?? []) as $sertifikatIndex => $sertifikat)
                                    <div class="sertifikat-item mb-4 rounded-lg border p-4">
                                        <div class="mb-3">
                                            <label class="mb-1 block text-sm text-gray-600">Gambar Sertifikat (Max 2MB per file)</label>

                                            <!-- Container untuk multiple file inputs -->
                                            <div class="image-inputs-container mb-3">
                                                <input type="file"
                                                    name="sertifikat[{{ $sertifikatIndex }}][gambar][]" accept="image/*"
                                                    multiple
                                                    class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                                                    onchange="previewMultipleImages(this, {{ $sertifikatIndex }})">
                                            </div>

                                            <!-- Preview container untuk gambar yang sudah ada -->
                                            <div class="existing-images-preview mb-3">
                                                @if (isset($sertifikat['gambar']) && is_array($sertifikat['gambar']))
                                                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3">
                                                        @foreach ($sertifikat['gambar'] as $gambar)
                                                            <div class="relative">
                                                                <img src="{{ asset('assets/images/siswa/portofolio/' . $siswa->nis . '/' . $gambar) }}"
                                                                    alt="Sertifikat"
                                                                    class="h-44 w-full rounded-lg object-cover shadow-md">
                                                                <button type="button"
                                                                    onclick="removeExistingImage(this, '{{ $gambar }}', {{ $sertifikatIndex }})"
                                                                    class="absolute -right-2 -top-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-xs text-white hover:bg-red-600">
                                                                    ×
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Preview container untuk gambar baru -->
                                            <div class="preview-container-{{ $sertifikatIndex }} mt-3"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="sertifikat-item mb-4 rounded-lg border p-4">
                                    <div class="mb-3">
                                        <label class="mb-1 block text-sm text-gray-600">Gambar Sertifikat (Max 2MB per file)</label>
                                        <input type="file" name="sertifikat[0][gambar][]" accept="image/*" multiple
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100"
                                            onchange="previewMultipleImages(this, 0)">
                                        <div class="preview-container-0 mt-3"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="cancelForm()"
                            class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Batal
                        </button>
                        <button type="submit"
                            class="rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Simpan Portofolio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let sertifikatIndex = {{ count(old('sertifikat', $siswa->sertifikat ?? [])) }};

        function previewMultipleImages(input, index) {
            const previewContainer = document.querySelector(`.preview-container-${index}`);

            // Clear existing preview
            previewContainer.innerHTML = '';

            if (input.files && input.files.length > 0) {
                const imageGrid = document.createElement('div');
                imageGrid.className = 'grid grid-cols-2 gap-2 md:grid-cols-3';

                Array.from(input.files).forEach((file, fileIndex) => {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imageContainer = document.createElement('div');
                        imageContainer.className = 'relative';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = `Preview Sertifikat ${fileIndex + 1}`;
                        img.className = 'w-full h-32 object-cover rounded-lg shadow-md border';

                        const removeBtn = document.createElement('button');
                        removeBtn.innerHTML = '×';
                        removeBtn.type = 'button';
                        removeBtn.className =
                            'absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600';
                        removeBtn.onclick = function() {
                            imageContainer.remove();
                            // Remove file from input (this is complex, so we'll handle it differently)
                            removeFileFromInput(input, fileIndex);
                        };

                        imageContainer.appendChild(img);
                        imageContainer.appendChild(removeBtn);
                        imageGrid.appendChild(imageContainer);
                    }

                    reader.readAsDataURL(file);
                });

                previewContainer.appendChild(imageGrid);
            }
        }

        function removeFileFromInput(input, indexToRemove) {
            const dt = new DataTransfer();
            const {
                files
            } = input;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (i !== indexToRemove) {
                    dt.items.add(file);
                }
            }

            input.files = dt.files;

            // Refresh preview
            const sertifikatItem = input.closest('.sertifikat-item');
            const sertifikatIndex = Array.from(sertifikatItem.parentNode.children).indexOf(sertifikatItem);
            previewMultipleImages(input, sertifikatIndex);
        }

        function removeExistingImage(button, imageName, sertifikatIndex) {
            // Gunakan SweetAlert2 untuk konfirmasi yang lebih baik
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Hapus Gambar?',
                    text: "Gambar ini akan dihapus secara permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        performImageDeletion(button, imageName, sertifikatIndex);
                    }
                });
            } else {
                // Fallback ke confirm biasa jika SweetAlert2 tidak tersedia
                if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                    performImageDeletion(button, imageName, sertifikatIndex);
                }
            }
        }

        function performImageDeletion(button, imageName, sertifikatIndex) {
            // Add hidden input to track deleted images
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `deleted_images[${sertifikatIndex}][]`;
            hiddenInput.value = imageName;
            button.closest('form').appendChild(hiddenInput);

            // Add visual feedback
            const imageContainer = button.closest('.relative');
            imageContainer.style.transition = 'all 0.3s ease';
            imageContainer.style.transform = 'scale(0)';
            imageContainer.style.opacity = '0';

            // Remove the image preview after animation
            setTimeout(() => {
                imageContainer.remove();

                // Show success feedback if SweetAlert2 is available
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Gambar akan dihapus saat form disimpan',
                        icon: 'success',
                        showConfirmButton: true,
                    });
                }
            }, 300);
        }

        function cancelForm() {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Batalkan Perubahan?',
                    text: "Semua perubahan yang belum disimpan akan hilang",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Batalkan!',
                    cancelButtonText: 'Tetap di Halaman'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('siswa.dashboard') }}";
                    }
                });
            } else {
                // Fallback ke confirm biasa jika SweetAlert2 tidak tersedia
                if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
                    window.location.href = "{{ route('siswa.dashboard') }}";
                }
            }
        }

        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('siswa.dashboard') }}";
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('siswa.dashboard') }}";
                }
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                title: 'Periksa Kembali!',
                text: 'Ada kesalahan dalam pengisian form. Silakan perbaiki.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('siswa.dashboard') }}";
                }
            });
        @endif
    </script>
</x-siswa-layout>
