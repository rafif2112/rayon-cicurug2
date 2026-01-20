<x-layout>
    <x-navbar></x-navbar>

    <x-header></x-header>

    <section class="py-12">
        <div data-aos="fade-up" class="container mx-auto mb-10 w-11/12 border-b-2 border-gray-300 pb-5 dark:border-gray-700 sm:w-4/5">
            <div class="mb-6 flex items-center gap-4">
                <ion-icon class="text-3xl md:text-5xl" src="{{ asset('assets/images/icon/people.svg') }}"></ion-icon>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 md:text-4xl" id="dokumentasi">Prestasi</h2>
            </div>
            <p class="mt-2 text-base text-gray-600 dark:text-gray-400 md:text-lg">Prestasi Siswa Rayon Cicurug 2</p>
        </div>

        <div data-aos="fade-up" class="container mx-auto flex gap-4 mb-6 w-11/12 sm:w-4/5">
            <div class="relative w-full md:w-72">
                <form action="{{ route('prestasi') }}" method="GET">
                    @php
                        $currentYear = date('Y');
                        $startYear = 2024;
                    @endphp
                    <select name="kategori" id="kelasDropdown"
                        class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-3 pr-8 shadow-sm transition-all duration-300 hover:border-blue-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-blue-500"
                        onchange="this.form.submit()">
                        <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua</option>
                        @for ($year = $startYear; $year <= $currentYear; $year++)
                            <option value="{{ $year }}" {{ request('kategori') == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endfor
                    </select>
                </form>
            </div>
            @if (request('kategori'))
                <a href="{{ route('prestasi') }}" class="inline-block rounded bg-red-500 px-4 py-2 text-white hover:bg-red-600">
                    Hapus Filter
                </a>
            @endif
        </div>


        @if ($prestasi->isEmpty())
            <div data-aos="fade-up" class="container mx-auto w-11/12 px-4 py-8 sm:w-4/5 md:py-16">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:gap-8">
                    <div class="col-span-1 flex flex-col items-center justify-center p-8 text-center md:col-span-2">
                        <ion-icon class="mb-3 text-[70px] text-gray-400"
                            src="{{ asset('assets/images/icon/ribbon-outline.svg') }}"></ion-icon>
                        <h3 class="text-xl font-semibold text-gray-400 dark:text-white md:text-2xl">Belum ada postingan
                            prestasi</h3>
                        </h3>
                        <p class="mt-2 text-sm text-gray-400 dark:text-gray-400 md:text-base">Segera hadir data alumni
                            terbaru</p>
                    </div>
                </div>
            </div>
        @else
            <div class="container mx-auto w-11/12 py-8 sm:w-4/5 md:py-14">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                    @foreach ($prestasi as $item)
                        <div data-aos="fade-up" class="overflow-hidden rounded-lg bg-white shadow-lg dark:bg-gray-800">
                            <div class="relative">
                                <div id="prestasi" class="carousel relative h-64 w-full overflow-hidden">
                                    @foreach ($item->gambar as $key => $gambar)
                                        @if ($gambar && asset('assets/images/prestasi/' . $gambar))
                                            <img class="{{ $key === 0 ? 'opacity-100' : 'opacity-0' }} absolute h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                                                data-carousel-item
                                                onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';"
                                                src="{{ asset('assets/images/prestasi/' . $gambar) }}"
                                                alt="{{ $item->nama }}" onclick="openModal(this)">
                                        @else
                                            <img class="{{ $key === 0 ? 'opacity-100' : 'opacity-0' }} absolute h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                                                data-carousel-item src="{{ asset('assets/images/image.jpg') }}"
                                                alt="{{ $item->nama }}">
                                        @endif
                                    @endforeach
                                    <button onclick="prevSlide(this)"
                                        class="absolute left-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white hover:bg-black/75">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button onclick="nextSlide(this)"
                                        class="absolute right-2 top-1/2 -translate-y-1/2 rounded-full bg-black/50 p-2 text-white hover:bg-black/75">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">{{ $item->nama }}
                                </h3>
                                <p class="mt-2 text-justify text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($item->deskripsi, 100, '') }}
                                    @if (strlen($item->deskripsi) > 100)
                                        <span class="-ml-1" id="dots-{{ $loop->index }}">...</span>
                                        <span id="more-{{ $loop->index }}" class="hidden">
                                            {{ Str::substr($item->deskripsi, 100) }}
                                        </span>
                                        <a href="#" class="text-blue-500 hover:underline"
                                            id="toggle-{{ $loop->index }}"
                                            onclick="toggleReadMore(event, {{ $loop->index }})">Baca selengkapnya</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <script>
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

            function nextSlide(button) {
                const carousel = button.closest('.carousel');
                const slides = carousel.querySelectorAll('[data-carousel-item]');
                let activeSlide = Array.from(slides).findIndex(slide => slide.classList.contains('opacity-100'));

                slides[activeSlide].classList.remove('opacity-100');
                slides[activeSlide].classList.add('opacity-0');
                activeSlide = (activeSlide + 1) % slides.length;
                slides[activeSlide].classList.remove('opacity-0');
                slides[activeSlide].classList.add('opacity-100');
            }

            function prevSlide(button) {
                const carousel = button.closest('.carousel');
                const slides = carousel.querySelectorAll('[data-carousel-item]');
                let activeSlide = Array.from(slides).findIndex(slide => slide.classList.contains('opacity-100'));

                slides[activeSlide].classList.remove('opacity-100');
                slides[activeSlide].classList.add('opacity-0');
                activeSlide = (activeSlide - 1 + slides.length) % slides.length;
                slides[activeSlide].classList.remove('opacity-0');
                slides[activeSlide].classList.add('opacity-100');
            }
        </script>

    </section>

    <!-- Enhanced Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-5">
        <button onclick="closeModal()" style="z-index: 9999"
            class="absolute right-6 top-6 text-white hover:text-gray-300">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="modalImage"
            class="max-h-[90vh] max-w-[90vw] rounded-lg object-contain opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 flex items-center justify-between px-4">
            <button id="modalPrevBtn" class="rounded-full bg-black/50 p-2 text-white hover:bg-black/75">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="modalNextBtn" class="rounded-full bg-black/50 p-2 text-white hover:bg-black/75">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <style>
        .lazy-load {
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .lazy-load.loaded {
            opacity: 1;
        }
    </style>

    <script>
        let currentCarousel = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Implement intersection observer for lazy loading
            const lazyImages = document.querySelectorAll('.lazy-load');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                            }
                            imageObserver.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px'
                });
                
                lazyImages.forEach(img => {
                    imageObserver.observe(img);
                });
            } else {
                // Fallback for browsers that don't support IntersectionObserver
                lazyImages.forEach(img => {
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                    }
                });
            }
            
            // Rest of your existing DOMContentLoaded code
            if (window.location.search.includes('kategori=')) {
                document.getElementById('prestasi').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
        
        function openModal(img) {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            currentCarousel = img.closest('.carousel');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Show loading spinner in modal while image loads
            modalImg.style.opacity = '0';
            modalImg.onload = function() {
                modalImg.style.opacity = '1';
            }
            
            // Use the full src if it has been loaded, otherwise use data-src
            modalImg.src = img.src !== 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1 1\'%3E%3C/svg%3E' 
                ? img.src 
                : img.dataset.src;
            
            document.getElementById('modalPrevBtn').onclick = () => modalNavigate('prev');
            document.getElementById('modalNextBtn').onclick = () => modalNavigate('next');

            // Close on escape key
            document.addEventListener('keydown', handleKeyPress);
        }

        function modalNavigate(direction) {
            const images = currentCarousel.querySelectorAll('[data-carousel-item]');
            let currentIndex = Array.from(images).findIndex(img => img.src === document.getElementById('modalImage').src);
            let newIndex = direction === 'prev' ?
                (currentIndex - 1 + images.length) % images.length :
                (currentIndex + 1) % images.length;

            const modalImg = document.getElementById('modalImage');
            modalImg.classList.remove('opacity-100');
            setTimeout(() => {
                modalImg.src = images[newIndex].src;
                modalImg.classList.add('opacity-100');
            }, 300);

            images[currentIndex].classList.remove('opacity-100');
            images[currentIndex].classList.add('opacity-0');
            images[newIndex].classList.remove('opacity-0');
            images[newIndex].classList.add('opacity-100');
        }

        function closeModal() {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
            currentCarousel = null;
            document.removeEventListener('keydown', handleKeyPress);
        }

        function handleKeyPress(e) {
            if (e.key === 'Escape') closeModal();
            if (e.key === 'ArrowLeft' && currentCarousel) modalNavigate('prev');
            if (e.key === 'ArrowRight' && currentCarousel) modalNavigate('next');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // if (window.location.search.includes('search=')) {
            //     document.getElementById('prestasi').scrollIntoView({
            //         behavior: 'smooth'
            //     });
            // }

            if (window.location.search.includes('kategori=')) {
                document.getElementById('prestasi').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
</x-layout>
