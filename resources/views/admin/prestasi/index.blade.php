<x-admin-layout>
    <div class="mb-6 flex justify-end">
        <a href="{{ route('prestasi.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Prestasi
        </a>
    </div>

    @if ($prestasi->isEmpty())
        <div class="mb-5 rounded-md border-l-4 border-yellow-500 bg-yellow-100 p-4 text-yellow-700" role="alert">
            <p class="font-bold">Info</p>
            <p>Belum ada postingan prestasi.</p>
        </div>
    @endif
    <div class="container mx-auto">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($prestasi as $item)
                <div class="overflow-hidden rounded-lg bg-white shadow-lg dark:bg-gray-800">
                    <div class="relative">
                        <div class="carousel relative h-64 w-full overflow-hidden">
                            @foreach ($item->gambar as $key => $gambar)
                                @if ($gambar)
                                    <img class="{{ $key === 0 ? 'opacity-100' : 'opacity-0' }} absolute h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                                        data-carousel-item 
                                        src="{{ asset('assets/images/prestasi/' . $gambar) }}"
                                        onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';"
                                        alt="{{ $item->nama }}"
                                        loading="lazy"
                                        decoding="async">
                                @else
                                    <img class="{{ $key === 0 ? 'opacity-100' : 'opacity-0' }} absolute h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                                        data-carousel-item 
                                        src="{{ asset('assets/images/image.jpg') }}"
                                        alt="{{ $item->nama }}"
                                        loading="lazy"
                                        decoding="async">
                                @endif
                            @endforeach
                            <button onclick="nextSlide(this)"
                                class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white hover:bg-black/75">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button onclick="prevSlide(this)"
                                class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white hover:bg-black/75">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Dropdown button -->
                        <div class="absolute right-2 top-2">
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="rounded-md bg-white p-2 text-gray-600 shadow-md hover:bg-gray-100">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                        </path>
                                    </svg>
                                </button>
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 rounded-md bg-white py-1 shadow-lg">
                                    <a href="{{ route('prestasi.edit', $item->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                    <button type="button"
                                        class="block w-full px-4 py-2 text-left text-sm text-red-700 hover:bg-gray-100"
                                        onclick="openModal('{{ route('prestasi.destroy', $item->id) }}', {{ $item->id }})">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $item->nama }}</h3>
                        <p class="mt-2 text-justify text-gray-600 dark:text-gray-400">
                            {{ Str::limit($item->deskripsi, 100, '') }}
                            @if (strlen($item->deskripsi) > 100)
                                <span class="-ml-1" id="dots-{{ $loop->index }}">...</span>
                                <span id="more-{{ $loop->index }}" class="hidden">
                                    {{ Str::substr($item->deskripsi, 100) }}
                                </span>
                                <a href="#" class="text-blue-500 hover:underline" id="toggle-{{ $loop->index }}"
                                    onclick="toggleReadMore(event, {{ $loop->index }})">Baca selengkapnya</a>
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Template (single modal for all items) -->
    <div id="modalDelete" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Hapus Prestasi</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus prestasi ini?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Hapus
                        </button>
                    </form>
                    <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function openModal(deleteUrl, id) {
            document.getElementById('modalDelete').classList.remove('hidden');
            document.getElementById('deleteForm').action = deleteUrl;
        }

        function closeModal() {
            document.getElementById('modalDelete').classList.add('hidden');
        }

        // Read more toggle
        function toggleReadMore(event, index) {
            event.preventDefault();
            const dots = document.getElementById(`dots-${index}`);
            const moreText = document.getElementById(`more-${index}`);
            const toggleLink = document.getElementById(`toggle-${index}`);

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                moreText.classList.add("hidden");
                toggleLink.textContent = "Baca selengkapnya";
            } else {
                dots.style.display = "none";
                moreText.classList.remove("hidden");
                toggleLink.textContent = "Tampilkan lebih sedikit";
            }
        }

        // Carousel functions
        function nextSlide(button) {
            const carousel = button.closest('.carousel');
            const slides = carousel.querySelectorAll('[data-carousel-item]');
            let activeSlide = Array.from(slides).findIndex(slide => !slide.classList.contains('opacity-0'));

            slides[activeSlide].classList.add('opacity-0');
            activeSlide = (activeSlide + 1) % slides.length;
            slides[activeSlide].classList.remove('opacity-0');
        }

        function prevSlide(button) {
            const carousel = button.closest('.carousel');
            const slides = carousel.querySelectorAll('[data-carousel-item]');
            let activeSlide = Array.from(slides).findIndex(slide => !slide.classList.contains('opacity-0'));

            slides[activeSlide].classList.add('opacity-0');
            activeSlide = (activeSlide - 1 + slides.length) % slides.length;
            slides[activeSlide].classList.remove('opacity-0');
        }
    </script>
</x-admin-layout>
