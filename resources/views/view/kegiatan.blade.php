<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>
    <section class="flex flex-col items-center justify-center">

        <div class="mt-10 w-11/12 sm:w-4/5">
            <div class="container mx-auto mb-10 w-full border-b-2 border-black/80 pb-3">
                <div class="mb-3 flex items-center gap-2">
                    <ion-icon class="text-3xl" name="stats-chart-outline"></ion-icon>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-3xl" id="dokumentasi">Kegiatan
                    </h2>
                </div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Lihat Dokumentasi Kegiatan Rayon Cicurug 2.</p>
            </div>
        </div>

        <div class="w-11/12 sm:w-4/5">
            @if ($kegiatan->isEmpty())
                <div class="col-span-2 flex flex-col items-center justify-center p-12 text-center">
                    <ion-icon class="text-[90px] text-gray-400"
                        src="{{ asset('assets/images/icon/camera-outline.svg') }}"></ion-icon>
                    <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">belum ada postingan kegiatan saat
                        ini</h3>
                    <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir kegiatan terbaru</p>
                </div>
            @else
                @foreach ($kegiatan as $index => $item)
                    @if ($index % 2 == 0)
                        <div
                            class="mb-10 flex flex-col items-center justify-center overflow-hidden rounded-lg bg-white shadow-xl md:flex-row">
                            <div class="carousel relative h-80 w-full overflow-hidden md:w-2/5">
                                @foreach (json_decode($item->gambar) as $key => $gambar)
                                    <img class="{{ $key === 0 ? 'opacity-100' : 'opacity-0' }} absolute h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                                        data-carousel-item src="{{ asset('assets/images/kegiatan/' . $gambar) }}"
                                        alt="Kegiatan Image" onclick="openModal(this)">
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
                            <script>
                                function prevSlide(button) {
                                    const carousel = button.closest('.carousel');
                                    const items = carousel.querySelectorAll('[data-carousel-item]');
                                    let activeIndex = Array.from(items).findIndex(item => item.classList.contains('opacity-100'));
                                    items[activeIndex].classList.remove('opacity-100');
                                    items[activeIndex].classList.add('opacity-0');
                                    activeIndex = (activeIndex - 1 + items.length) % items.length;
                                    items[activeIndex].classList.remove('opacity-0');
                                    items[activeIndex].classList.add('opacity-100');
                                }

                                function nextSlide(button) {
                                    const carousel = button.closest('.carousel');
                                    const items = carousel.querySelectorAll('[data-carousel-item]');
                                    let activeIndex = Array.from(items).findIndex(item => item.classList.contains('opacity-100'));
                                    items[activeIndex].classList.remove('opacity-100');
                                    items[activeIndex].classList.add('opacity-0');
                                    activeIndex = (activeIndex + 1) % items.length;
                                    items[activeIndex].classList.remove('opacity-0');
                                    items[activeIndex].classList.add('opacity-100');
                                }
                            </script>
                            <div class="p-6 md:w-3/5">
                                <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">{{ $item->judul }}
                                </h1>
                                <p class="mb-4 break-words text-gray-700 dark:text-gray-300 sm:mb-0 sm:mr-4">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                        </div>
                    @else
                        <div
                            class="mb-10 flex flex-col-reverse items-center justify-center overflow-hidden rounded-lg bg-white shadow-xl md:flex-row">
                            <div class="p-6 md:w-3/5">
                                <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">{{ $item->judul }}
                                </h1>
                                <p class="mb-4 break-words text-wrap text-gray-700 max-w-96 md:max-w-full dark:text-gray-300 sm:mb-0 sm:mr-4">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                            <div class="carousel relative h-80 w-full overflow-hidden md:w-2/5">
                                @foreach (json_decode($item->gambar) as $key => $gambar)
                                    <img class="{{ $key === 0 ? 'opacity-100' : 'opacity-0' }} absolute h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                                        data-carousel-item src="{{ asset('assets/images/kegiatan/' . $gambar) }}"
                                        alt="Kegiatan Image" onclick="openModal(this)">
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
                            <script>
                                function prevSlide(button) {
                                    const carousel = button.closest('.carousel');
                                    const items = carousel.querySelectorAll('[data-carousel-item]');
                                    let activeIndex = Array.from(items).findIndex(item => item.classList.contains('opacity-100'));
                                    items[activeIndex].classList.remove('opacity-100');
                                    items[activeIndex].classList.add('opacity-0');
                                    activeIndex = (activeIndex - 1 + items.length) % items.length;
                                    items[activeIndex].classList.remove('opacity-0');
                                    items[activeIndex].classList.add('opacity-100');
                                }

                                function nextSlide(button) {
                                    const carousel = button.closest('.carousel');
                                    const items = carousel.querySelectorAll('[data-carousel-item]');
                                    let activeIndex = Array.from(items).findIndex(item => item.classList.contains('opacity-100'));
                                    items[activeIndex].classList.remove('opacity-100');
                                    items[activeIndex].classList.add('opacity-0');
                                    activeIndex = (activeIndex + 1) % items.length;
                                    items[activeIndex].classList.remove('opacity-0');
                                    items[activeIndex].classList.add('opacity-100');
                                }
                            </script>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <!-- Enhanced Modal -->
        <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-5">
            <button onclick="closeModal()" style="z-index: 9999" class="absolute right-6 top-6 text-white hover:text-gray-300">
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
    </section>

    <script>
        let currentCarousel = null;

        function openModal(img) {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            currentCarousel = img.closest('.carousel');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalImg.src = img.src;
            setTimeout(() => modalImg.classList.add('opacity-100'), 100);

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
</x-layout>
