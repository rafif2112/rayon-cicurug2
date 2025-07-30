<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>
    
    <section class="flex flex-col items-center justify-center bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800">
        <!-- Header Section dengan animasi -->
        <div class="mt-10 w-11/12 sm:w-4/5" data-aos="fade-up">
            <div class="container mx-auto mb-10 w-full border-b-2 border-black/80 pb-3">
                <div class="mb-3 flex items-center gap-3">
                    <div class="rounded-full bg-blue-100 p-3 dark:bg-blue-900">
                        <ion-icon class="text-3xl" name="stats-chart-outline"></ion-icon>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">
                            Kegiatan Rayon
                        </h2>
                    </div>
                </div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Dokumentasi lengkap aktivitas dan pencapaian Rayon Cicurug 2
                </p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="w-11/12 sm:w-4/5 pb-16">
            @if ($kegiatan->isEmpty())
                <!-- Empty State yang lebih menarik -->
                <div class="flex flex-col items-center justify-center py-20" data-aos="fade-up">
                    <div class="relative mb-8">
                        <div class="absolute inset-0 animate-pulse rounded-full bg-blue-200 opacity-30"></div>
                        <ion-icon class="relative text-[120px] text-gray-400 dark:text-gray-500" 
                                  src="{{ asset('assets/images/icon/camera-outline.svg') }}"></ion-icon>
                    </div>
                    <h3 class="mb-4 text-3xl font-bold text-gray-600 dark:text-gray-300">
                        Belum Ada Kegiatan
                    </h3>
                    <p class="max-w-md text-center text-gray-500 dark:text-gray-400">
                        Kegiatan menarik akan segera hadir. Pantau terus untuk update terbaru!
                    </p>
                    <div class="mt-8 flex space-x-2">
                        <div class="h-2 w-2 animate-bounce rounded-full bg-blue-400 [animation-delay:-0.3s]"></div>
                        <div class="h-2 w-2 animate-bounce rounded-full bg-blue-400 [animation-delay:-0.15s]"></div>
                        <div class="h-2 w-2 animate-bounce rounded-full bg-blue-400"></div>
                    </div>
                </div>
            @else
                @foreach ($kegiatan as $index => $item)
                    <div class="mb-16 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        @if ($index % 2 == 0)
                            <!-- Layout kiri ke kanan -->
                            <div class="flex flex-col items-center overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-500 dark:bg-gray-800 md:flex-row">
                                <!-- Image Carousel -->
                                <div class="relative h-80 w-full overflow-hidden md:w-2/5">
                                    <div class="carousel-container relative h-full">
                                        @foreach (json_decode($item->gambar) as $key => $gambar)
                                            @if ($gambar && file_exists(public_path('assets/images/kegiatan/' . $gambar)))
                                                <div class="carousel-slide absolute inset-0 transition-all duration-700 ease-in-out {{ $key === 0 ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}"
                                                     data-slide="{{ $key }}">
                                                    <!-- Loading skeleton -->
                                                    <div class="absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse"></div>
                                                    <img class="absolute h-full w-full object-cover transition-transform duration-700"
                                                         data-carousel-item 
                                                         data-src="{{ asset('assets/images/kegiatan/' . $gambar) }}"
                                                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                                         alt="Kegiatan {{ $item->judul }}" 
                                                         loading="lazy"
                                                         onload="this.previousElementSibling.style.display='none'"
                                                         onclick="openModal(this, {{ $index }})">
                                                </div>
                                            @else
                                                <div class="carousel-slide absolute inset-0 transition-all duration-700 ease-in-out {{ $key === 0 ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}"
                                                     data-slide="{{ $key }}">
                                                    <img class="absolute h-full w-full object-cover"
                                                         data-carousel-item 
                                                         src="{{ asset('assets/images/image.jpg') }}"
                                                         alt="Kegiatan {{ $item->judul }}"
                                                         onclick="openModal(this, {{ $index }})">
                                                </div>
                                            @endif
                                        @endforeach
                                        
                                        <!-- Navigation dengan animasi hover yang lebih smooth -->
                                        @if (count(json_decode($item->gambar)) > 1)
                                            <button onclick="navigateSlide(this, 'prev')"
                                                    class="absolute left-4 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-black/30 p-3 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <button onclick="navigateSlide(this, 'next')"
                                                    class="absolute right-4 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-black/30 p-3 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                            
                                            <!-- Dots indicator -->
                                            <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 space-x-2">
                                                @foreach (json_decode($item->gambar) as $key => $gambar)
                                                    <button onclick="goToSlide(this, {{ $key }})"
                                                            class="dot h-2 w-2 rounded-full transition-all duration-300 {{ $key === 0 ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75' }}"
                                                            data-slide="{{ $key }}"></button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="flex-1 p-8 md:p-10">
                                    <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">
                                        {{ $item->judul }}
                                    </h1>
                                    <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                        <p class="leading-relaxed">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Layout kanan ke kiri -->
                            <div class="flex flex-col-reverse items-center overflow-hidden rounded-2xl bg-white shadow-lg transition-all duration-500 dark:bg-gray-800 md:flex-row">
                                <!-- Content -->
                                <div class="flex-1 p-8 md:p-10">
                                    <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">
                                        {{ $item->judul }}
                                    </h1>
                                    <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                                        <p class="leading-relaxed">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                                
                                <!-- Image Carousel -->
                                <div class="relative h-80 w-full overflow-hidden md:w-2/5">
                                    <div class="carousel-container relative h-full">
                                        @foreach (json_decode($item->gambar) as $key => $gambar)
                                            @if ($gambar && file_exists(public_path('assets/images/kegiatan/' . $gambar)))
                                                <div class="carousel-slide absolute inset-0 transition-all duration-700 ease-in-out {{ $key === 0 ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}"
                                                     data-slide="{{ $key }}">
                                                    <!-- Loading skeleton -->
                                                    <div class="absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse"></div>
                                                    <img class="absolute h-full w-full object-cover transition-transform duration-700"
                                                         data-carousel-item 
                                                         data-src="{{ asset('assets/images/kegiatan/' . $gambar) }}"
                                                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                                         alt="Kegiatan {{ $item->judul }}" 
                                                         loading="lazy"
                                                         onload="this.previousElementSibling.style.display='none'"
                                                         onclick="openModal(this, {{ $index }})">
                                                </div>
                                            @else
                                                <div class="carousel-slide absolute inset-0 transition-all duration-700 ease-in-out {{ $key === 0 ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full' }}"
                                                     data-slide="{{ $key }}">
                                                    <img class="absolute h-full w-full object-cover"
                                                         data-carousel-item 
                                                         src="{{ asset('assets/images/image.jpg') }}"
                                                         alt="Kegiatan {{ $item->judul }}"
                                                         onclick="openModal(this, {{ $index }})">
                                                </div>
                                            @endif
                                        @endforeach
                                        
                                        <!-- Navigation dengan animasi hover yang lebih smooth -->
                                        @if (count(json_decode($item->gambar)) > 1)
                                            <button onclick="navigateSlide(this, 'prev')"
                                                    class="absolute left-4 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-black/30 p-3 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <button onclick="navigateSlide(this, 'next')"
                                                    class="absolute right-4 top-1/2 z-10 -translate-y-1/2 transform rounded-full bg-black/30 p-3 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                            
                                            <!-- Dots indicator -->
                                            <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 space-x-2">
                                                @foreach (json_decode($item->gambar) as $key => $gambar)
                                                    <button onclick="goToSlide(this, {{ $key }})"
                                                            class="dot h-2 w-2 rounded-full transition-all duration-300 {{ $key === 0 ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75' }}"
                                                            data-slide="{{ $key }}"></button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Enhanced Modal dengan fitur lengkap -->
        <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/95 backdrop-blur-sm">
            <!-- Header modal -->
            <div class="absolute top-0 left-0 right-0 z-60 flex items-center justify-between p-6">
                <div class="text-white">
                    <h3 id="modalTitle" class="text-xl font-semibold"></h3>
                    <p id="modalCounter" class="text-sm text-gray-300"></p>
                </div>
                <button onclick="closeModal()" 
                        class="rounded-full bg-black/30 p-2 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Image container dengan loading state -->
            <div class="relative max-h-[80vh] max-w-[90vw] flex items-center justify-center">
                <!-- Loading spinner -->
                <div id="modalLoader" class="absolute inset-0 flex items-center justify-center">
                    <div class="relative">
                        <div class="h-16 w-16 animate-spin rounded-full border-4 border-white/20 border-t-white"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="h-8 w-8 animate-pulse rounded-full bg-white/20"></div>
                        </div>
                    </div>
                </div>
                
                <img id="modalImage"
                     class="max-h-[80vh] max-w-[90vw] rounded-lg object-contain opacity-0 transition-all duration-500 transform scale-95"
                     alt="Kegiatan Image">
            </div>

            <!-- Navigation arrows -->
            <div class="absolute inset-0 flex items-center justify-between px-8 pointer-events-none">
                <button id="modalPrevBtn" 
                        onclick="modalNavigate('prev')"
                        class="pointer-events-auto rounded-full bg-black/30 p-4 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="modalNextBtn" 
                        onclick="modalNavigate('next')"
                        class="pointer-events-auto rounded-full bg-black/30 p-4 text-white backdrop-blur-sm transition-all duration-300 hover:bg-black/60 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-white/50">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Bottom controls -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center space-x-4">
                <div id="modalDots" class="flex space-x-2"></div>
            </div>
        </div>
    </section>

    <!-- Enhanced JavaScript -->
    <script>
        let currentCarousel = null;
        let currentModalIndex = 0;
        let currentImages = [];
        let kegiatanData = @json($kegiatan);

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            initializeLazyLoading();
            initializeCarousels();
            
            // Add AOS animation library
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out-cubic',
                    once: true,
                    offset: 100
                });
            }
        });

        // Lazy loading dengan Intersection Observer
        function initializeLazyLoading() {
            const lazyImages = document.querySelectorAll('[data-src]');
            
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                                img.addEventListener('load', () => {
                                    img.style.opacity = '1';
                                });
                            }
                            imageObserver.unobserve(img);
                        }
                    });
                }, {
                    rootMargin: '50px 0px',
                    threshold: 0.1
                });
                
                lazyImages.forEach(img => {
                    imageObserver.observe(img);
                });
            }
        }

        // Initialize carousel auto-play
        function initializeCarousels() {
            document.querySelectorAll('.carousel-container').forEach(carousel => {
                const slides = carousel.querySelectorAll('.carousel-slide');
                if (slides.length > 1) {
                    let currentSlide = 0;
                    
                    setInterval(() => {
                        if (!carousel.closest('.group:hover')) {
                            navigateSlide(carousel.querySelector('button'), 'next');
                        }
                    }, 5000);
                }
            });
        }

        // Enhanced slide navigation
        function navigateSlide(button, direction) {
            const carousel = button.closest('.carousel-container');
            const slides = carousel.querySelectorAll('.carousel-slide');
            const dots = carousel.querySelectorAll('.dot');
            const currentIndex = Array.from(slides).findIndex(slide => 
                slide.classList.contains('opacity-100')
            );
            
            let newIndex;
            if (direction === 'prev') {
                newIndex = (currentIndex - 1 + slides.length) % slides.length;
            } else {
                newIndex = (currentIndex + 1) % slides.length;
            }
            
            // Hide current slide
            slides[currentIndex].classList.remove('opacity-100', 'translate-x-0');
            slides[currentIndex].classList.add('opacity-0', 
                direction === 'next' ? '-translate-x-full' : 'translate-x-full'
            );
            
            // Show new slide
            setTimeout(() => {
                slides[newIndex].classList.remove('opacity-0', 'translate-x-full', '-translate-x-full');
                slides[newIndex].classList.add('opacity-100', 'translate-x-0');
            }, 100);
            
            // Update dots
            if (dots.length > 0) {
                dots[currentIndex].classList.remove('bg-white', 'scale-125');
                dots[currentIndex].classList.add('bg-white/50');
                dots[newIndex].classList.remove('bg-white/50');
                dots[newIndex].classList.add('bg-white', 'scale-125');
            }
        }

        // Go to specific slide
        function goToSlide(button, slideIndex) {
            const carousel = button.closest('.carousel-container');
            const slides = carousel.querySelectorAll('.carousel-slide');
            const dots = carousel.querySelectorAll('.dot');
            const currentIndex = Array.from(slides).findIndex(slide => 
                slide.classList.contains('opacity-100')
            );
            
            if (currentIndex === slideIndex) return;
            
            // Hide current slide
            slides[currentIndex].classList.remove('opacity-100', 'translate-x-0');
            slides[currentIndex].classList.add('opacity-0', 'translate-x-full');
            
            // Show target slide
            setTimeout(() => {
                slides[slideIndex].classList.remove('opacity-0', 'translate-x-full', '-translate-x-full');
                slides[slideIndex].classList.add('opacity-100', 'translate-x-0');
            }, 100);
            
            // Update dots
            dots[currentIndex].classList.remove('bg-white', 'scale-125');
            dots[currentIndex].classList.add('bg-white/50');
            dots[slideIndex].classList.remove('bg-white/50');
            dots[slideIndex].classList.add('bg-white', 'scale-125');
        }

        // Enhanced modal functionality
        function openModal(img, kegiatanIndex) {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');
            const modalCounter = document.getElementById('modalCounter');
            const modalLoader = document.getElementById('modalLoader');
            const modalDots = document.getElementById('modalDots');
            
            // Get current kegiatan data
            const kegiatan = kegiatanData[kegiatanIndex];
            currentImages = JSON.parse(kegiatan.gambar);
            currentModalIndex = Array.from(img.closest('.carousel-container').querySelectorAll('[data-carousel-item]'))
                .indexOf(img);
            
            // Set modal title
            modalTitle.textContent = kegiatan.judul;
            modalCounter.textContent = `${currentModalIndex + 1} dari ${currentImages.length}`;
            
            // Create dots for modal
            modalDots.innerHTML = '';
            currentImages.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.className = `h-2 w-2 rounded-full transition-all duration-300 ${
                    index === currentModalIndex ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/75'
                }`;
                dot.onclick = () => goToModalSlide(index);
                modalDots.appendChild(dot);
            });
            
            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            
            // Show loader
            modalLoader.style.display = 'flex';
            modalImg.style.opacity = '0';
            modalImg.style.transform = 'scale(0.95)';
            
            // Load image
            const imgSrc = img.dataset.src || img.src;
            modalImg.onload = function() {
                modalLoader.style.display = 'none';
                modalImg.style.opacity = '1';
                modalImg.style.transform = 'scale(1)';
            };
            modalImg.src = imgSrc;
            
            // Add keyboard listeners
            document.addEventListener('keydown', handleModalKeyPress);
        }

        function modalNavigate(direction) {
            const modalImg = document.getElementById('modalImage');
            const modalCounter = document.getElementById('modalCounter');
            const modalLoader = document.getElementById('modalLoader');
            const modalDots = document.getElementById('modalDots');
            
            const oldIndex = currentModalIndex;
            
            if (direction === 'prev') {
                currentModalIndex = (currentModalIndex - 1 + currentImages.length) % currentImages.length;
            } else {
                currentModalIndex = (currentModalIndex + 1) % currentImages.length;
            }
            
            // Update counter
            modalCounter.textContent = `${currentModalIndex + 1} dari ${currentImages.length}`;
            
            // Update dots
            const dots = modalDots.querySelectorAll('button');
            dots[oldIndex].className = 'h-2 w-2 rounded-full transition-all duration-300 bg-white/50 hover:bg-white/75';
            dots[currentModalIndex].className = 'h-2 w-2 rounded-full transition-all duration-300 bg-white scale-125';
            
            // Show loader and fade out current image
            modalLoader.style.display = 'flex';
            modalImg.style.opacity = '0';
            modalImg.style.transform = 'scale(0.95)';
            
            // Load new image
            const newImageSrc = `{{ asset('assets/images/kegiatan/') }}/${currentImages[currentModalIndex]}`;
            modalImg.onload = function() {
                modalLoader.style.display = 'none';
                modalImg.style.opacity = '1';
                modalImg.style.transform = 'scale(1)';
            };
            modalImg.src = newImageSrc;
        }

        function goToModalSlide(index) {
            if (index === currentModalIndex) return;
            
            const oldIndex = currentModalIndex;
            currentModalIndex = index;
            
            const modalImg = document.getElementById('modalImage');
            const modalCounter = document.getElementById('modalCounter');
            const modalLoader = document.getElementById('modalLoader');
            const modalDots = document.getElementById('modalDots');
            
            // Update counter
            modalCounter.textContent = `${currentModalIndex + 1} dari ${currentImages.length}`;
            
            // Update dots
            const dots = modalDots.querySelectorAll('button');
            dots[oldIndex].className = 'h-2 w-2 rounded-full transition-all duration-300 bg-white/50 hover:bg-white/75';
            dots[currentModalIndex].className = 'h-2 w-2 rounded-full transition-all duration-300 bg-white scale-125';
            
            // Show loader and fade out current image
            modalLoader.style.display = 'flex';
            modalImg.style.opacity = '0';
            modalImg.style.transform = 'scale(0.95)';
            
            // Load new image
            const newImageSrc = `{{ asset('assets/images/kegiatan/') }}/${currentImages[currentModalIndex]}`;
            modalImg.onload = function() {
                modalLoader.style.display = 'none';
                modalImg.style.opacity = '1';
                modalImg.style.transform = 'scale(1)';
            };
            modalImg.src = newImageSrc;
        }

        function closeModal() {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            
            modalImg.style.opacity = '0';
            modalImg.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
            
            // Remove keyboard listeners
            document.removeEventListener('keydown', handleModalKeyPress);
        }

        function handleModalKeyPress(e) {
            switch(e.key) {
                case 'Escape':
                    closeModal();
                    break;
                case 'ArrowLeft':
                    modalNavigate('prev');
                    break;
                case 'ArrowRight':
                    modalNavigate('next');
                    break;
            }
        }

        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const difference = touchStartX - touchEndX;
            
            if (Math.abs(difference) > swipeThreshold) {
                if (document.getElementById('lightboxModal').classList.contains('flex')) {
                    if (difference > 0) {
                        modalNavigate('next');
                    } else {
                        modalNavigate('prev');
                    }
                }
            }
        }
    </script>
</x-layout>