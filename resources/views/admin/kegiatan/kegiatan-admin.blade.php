<x-admin-layout>
    <div class="container mx-auto">
        <!-- Header Section -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('kegiatan.create') }}"
                class="transform rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white transition duration-200 hover:bg-blue-700 hover:shadow-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
            </a>
        </div>

        @if ($kegiatan->isEmpty())
            <div class="flex h-64 items-center justify-center rounded-lg bg-gray-50">
                <p class="text-lg text-gray-500">Belum ada data kegiatan yang tersedia.</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($kegiatan as $index => $data)
                    <div class="group relative transform overflow-hidden rounded-xl bg-white shadow-xl transition-all duration-300 hover:shadow-2xl">
                        <!-- Image Carousel Section -->
                        <div class="relative h-72">
                            @php $images = json_decode($data->gambar) @endphp
                            
                            <div class="relative h-full" x-data="{ activeSlide: 0, slides: {{ count($images) }} }">
                                @foreach ($images as $i => $image)
                                    <div x-show="activeSlide === {{ $i }}"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0"
                                         x-transition:enter-end="opacity-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100"
                                         x-transition:leave-end="opacity-0">
                                        
                                        @if ($i === 0)
                                            <!-- First image loads immediately with low quality placeholder -->
                                            <img id="img-{{ $data->id }}-{{ $i }}"
                                                class="absolute h-full w-full cursor-pointer object-cover"
                                                src="{{ $image ? asset('assets/images/kegiatan/' . $image) : asset('assets/images/image.jpg') }}"
                                                onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';"
                                                alt="Kegiatan Image {{ $i + 1 }}"
                                                loading="eager"
                                                onclick="openModal(this)">
                                        @else
                                            <!-- Other images lazy load -->
                                            <img id="img-{{ $data->id }}-{{ $i }}"
                                                class="absolute h-full w-full cursor-pointer object-cover opacity-0"
                                                onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';"
                                                data-src="{{ $image ? asset('assets/images/kegiatan/' . $image) : asset('assets/images/image.jpg') }}"
                                                alt="Kegiatan Image {{ $i + 1 }}"
                                                loading="lazy"
                                                onclick="openModal(this)">
                                        @endif
                                    </div>
                                @endforeach

                                @if(count($images) > 1)
                                <div class="absolute inset-0 flex items-center justify-between px-4">
                                    <button @click="activeSlide = (activeSlide - 1 + slides) % slides; loadSlideImage()"
                                        class="rounded-full bg-black/60 p-2 text-white backdrop-blur-sm transition-all hover:bg-black/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button @click="activeSlide = (activeSlide + 1) % slides; loadSlideImage()"
                                        class="rounded-full bg-black/60 p-2 text-white backdrop-blur-sm transition-all hover:bg-black/80">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                                @endif

                                <!-- Options Menu -->
                                <div class="absolute right-4 top-4 z-10">
                                    <button class="rounded-full bg-white/80 p-2 shadow-lg backdrop-blur-sm transition-all hover:bg-white hover:shadow-xl"
                                        onclick="toggleOptions(event, this)">
                                        <svg class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu absolute right-0 z-20 hidden min-w-[180px] rounded-lg bg-white p-2 shadow-xl ring-1 ring-black/5">
                                        <a href="{{ route('kegiatan.edit', $data->id) }}"
                                            class="flex items-center rounded-md px-4 py-2.5 text-sm text-gray-700 transition-colors hover:bg-blue-50 hover:text-blue-600">
                                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('kegiatan.destroy', $data->id) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-button flex w-full items-center rounded-md px-4 py-2.5 text-sm text-red-600 transition-colors hover:bg-red-50 hover:text-red-700">
                                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-6 h-32">
                            <h2 class="mb-3 text-xl font-bold text-gray-800 line-clamp-1">{{ $data->judul }}</h2>
                            <p class="text-gray-600 line-clamp-2">{{ $data->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Optimized Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-5">
        <button onclick="closeModal()" class="absolute right-6 top-6 text-white hover:text-gray-300">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div class="flex items-center justify-center w-full h-full">
            <img id="modalImage" class="max-h-[90vh] max-w-[90vw] rounded-lg opacity-0 transition-opacity duration-200">
        </div>
    </div>

    <!-- Optimized Scripts -->
    <script>
        // Simplified dropdown toggle
        function toggleOptions(event, button) {
            event.stopPropagation();
            const dropdownMenu = button.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdownMenu) menu.classList.add('hidden');
            });
            
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

        // Optimized modal
        function openModal(img) {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            modalImg.src = img.dataset.src || img.src;
            setTimeout(() => modalImg.style.opacity = '1', 50);
        }

        function closeModal() {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.style.opacity = '0';
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 200);
        }

        // Load images on slide change
        function loadSlideImage() {
            setTimeout(() => {
                const activeImages = document.querySelectorAll('[x-show="activeSlide === ' + window.activeSlide + '"] img[data-src]');
                activeImages.forEach(img => {
                    if (!img.src || img.src.includes('data:')) {
                        img.src = img.dataset.src;
                        img.style.opacity = '1';
                    }
                });
            }, 100);
        }

        // Optimized lazy loading
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src && !img.src) {
                            img.src = img.dataset.src;
                            img.style.opacity = '1';
                            observer.unobserve(img);
                        }
                    }
                });
            }, { rootMargin: '50px' });

            document.querySelectorAll('img[data-src]').forEach(img => observer.observe(img));
        }
    </script>

    <!-- Load SweetAlert2 async -->
    <script async src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for SweetAlert2 to load
            const checkSwal = setInterval(() => {
                if (typeof Swal !== 'undefined') {
                    clearInterval(checkSwal);
                    initDeleteButtons();
                    showSuccessMessage();
                }
            }, 100);

            function initDeleteButtons() {
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        const form = this.closest('.delete-form');
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data yang dihapus tidak dapat dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            }

            function showSuccessMessage() {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                    });
                @endif
            }
        });
    </script>
</x-admin-layout>
