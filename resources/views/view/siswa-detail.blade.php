<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <section class="">
        <div class="container mx-auto px-4 py-16">
            <div class="mx-auto max-w-4xl">
                <!-- Back Button -->
                <div class="mb-8">
                    <a href="{{ route('siswa.index') }}"
                        class="inline-flex items-center rounded-lg bg-gray-100 px-4 py-2 text-gray-700 transition duration-300 hover:bg-gray-200">
                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar Siswa
                    </a>
                </div>

                <!-- Student Profile Card -->
                <div class="overflow-hidden rounded-2xl bg-white">
                    <div class="md:flex">
                        <!-- Image Section -->
                        <div data-aos="fade-right" class="md:w-1/3">
                            @if ($siswa->gambar)
                                <img class="h-[350px] w-full rounded-2xl object-cover"
                                    src="{{ asset('assets/images/siswa/' . $siswa->gambar) }}" alt="{{ $siswa->nama }}"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';">
                            @else
                                <img src="{{ asset('assets/images/image.jpg') }}" alt="Foto Siswa"
                                    class="h-[350px] w-full rounded-2xl object-cover">
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div data-aos="fade-left" class="p-8 md:w-2/3">
                            <div class="mb-6">
                                <h1 class="mb-2 text-3xl font-bold text-gray-900">{{ $siswa->nama }}</h1>
                                <p class="mb-2 text-lg text-gray-600">{{ $siswa->jurusan }} | {{ $siswa->kelas }}</p>
                            </div>

                            <!-- Description Section -->
                            <div class="mb-8">
                                <p class="leading-relaxed text-gray-700">
                                    {{ $siswa->deskripsi ? $siswa->deskripsi : '-' }}
                                </p>
                            </div>

                            <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <h3 class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500">NIS</h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->nis }}</p>
                                </div>
                                <div>
                                    <h3 class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500">Kelas
                                    </h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->kelas }}</p>
                                </div>
                                <div>
                                    <h3 class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500">Angkatan
                                    </h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->angkatan }}</p>
                                </div>
                                <div>
                                    <h3 class="mb-2 text-sm font-medium uppercase tracking-wide text-gray-500">Jurusan
                                    </h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->jurusan }}</p>
                                </div>
                            </div>

                            @if ($siswa->link)
                                <div class="mb-8">
                                    <h3 class="mb-4 text-sm font-medium uppercase tracking-wide text-gray-500">
                                        Portofolio</h3>
                                    <a href="{{ $siswa->link }}" target="_blank"
                                        class="inline-flex items-center rounded-lg bg-blue-600 px-6 py-3 font-medium text-white transition duration-300 hover:bg-blue-700">
                                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Lihat Portofolio
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <!-- Experience Section -->
                    <div class="mt-12">
                        @if ($siswa->sertifikat && count($siswa->sertifikat) > 0)
                            <h2 class="mb-6 text-2xl font-bold text-gray-900" data-aos="fade-up">Sertifikat</h2>
                            <!-- Swiper -->
                            <div class="swiper mySwiper h-auto w-full" data-aos="fade-up">
                                <div class="swiper-wrapper">
                                    @foreach ($siswa->sertifikat as $index => $sertifikat)
                                        @if (isset($sertifikat['gambar']) && is_array($sertifikat['gambar']) && count($sertifikat['gambar']) > 0)
                                            @foreach ($sertifikat['gambar'] as $gambarIndex => $gambar)
                                                <div class="swiper-slide">
                                                    <div class="cursor-pointer">
                                                        <div class="mb-3 rounded">
                                                            <div class="h-48 overflow-hidden rounded">
                                                                <img src="{{ asset('assets/images/siswa/portofolio/' . $siswa->nis . '/' . $gambar) }}"
                                                                    alt="Sertifikat {{ $index + 1 }}"
                                                                    class="h-48 w-full rounded object-cover"
                                                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';"
                                                                    onclick="openModal(this)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                            <!-- Swiper JS -->
                            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

                            <!-- Initialize Swiper -->
                            <script>
                                var swiper = new Swiper(".mySwiper", {
                                    slidesPerView: 1,
                                    spaceBetween: 30,
                                    freeMode: true,
                                    pagination: {
                                        el: ".swiper-pagination",
                                        clickable: true,
                                    },
                                    breakpoints: {
                                        640: {
                                            slidesPerView: 2,
                                        },
                                        768: {
                                            slidesPerView: 3,
                                        },
                                    },
                                });
                            </script>

                            <style>
                                .swiper-slide img {
                                    display: block;
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                }

                                .swiper {
                                    padding-bottom: 50px;
                                }
                            </style>
                        @else
                            <div class="mt-12 py-12 text-center">
                                <div class="mb-4 text-gray-400">
                                    <svg class="mx-auto h-16 w-16" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="mb-2 text-lg font-medium text-gray-900">Belum Ada Sertifikat</h3>
                                <p class="text-gray-500">Sertifikat akan ditampilkan di sini ketika sudah diupload.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Lightbox -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-75 p-5">
        <span class="absolute right-5 top-5 cursor-pointer text-4xl text-white transition hover:text-gray-300"
            onclick="closeModal()">&times;</span>
        <img id="modalImage"
            class="max-h-full max-w-full rounded-lg opacity-0 shadow-2xl transition-opacity duration-300 ease-in-out">
    </div>

    @if ($siswa->sertifikat && count($siswa->sertifikat) > 0)
        <script>
            const carousels = {};

            @foreach ($siswa->sertifikat as $index => $sertifikat)
                @if (isset($sertifikat['gambar']) && count($sertifikat['gambar']) > 1)
                    carousels[{{ $index }}] = {
                        currentIndex: 0,
                        maxIndex: {{ count($sertifikat['gambar']) - 1 }}
                    };
                @endif
            @endforeach

            function nextImage(carouselIndex) {
                const carousel = carousels[carouselIndex];
                if (carousel) {
                    carousel.currentIndex = (carousel.currentIndex + 1) % (carousel.maxIndex + 1);
                    updateCarousel(carouselIndex);
                }
            }

            function prevImage(carouselIndex) {
                const carousel = carousels[carouselIndex];
                if (carousel) {
                    carousel.currentIndex = carousel.currentIndex === 0 ? carousel.maxIndex : carousel.currentIndex - 1;
                    updateCarousel(carouselIndex);
                }
            }

            function updateCarousel(carouselIndex) {
                const carousel = carousels[carouselIndex];
                const element = document.getElementById(`carousel-${carouselIndex}`);
                if (carousel && element) {
                    element.style.transform = `translateX(-${carousel.currentIndex * 100}%)`;
                }
            }

            // Modal functions
            function openModal(element) {
                const modal = document.getElementById("lightboxModal");
                const modalImage = document.getElementById("modalImage");
                modalImage.src = element.src;
                modal.classList.remove("hidden");
                modal.classList.add("flex");
                requestAnimationFrame(() => {
                    modalImage.classList.remove("opacity-0");
                });
                // Prevent body scroll when modal is open
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                const modal = document.getElementById("lightboxModal");
                const modalImage = document.getElementById("modalImage");
                modalImage.classList.add("opacity-0");
                setTimeout(() => {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                    // Restore body scroll
                    document.body.style.overflow = '';
                }, 200);
            }

            // Close modal when clicking outside the image
            document.getElementById('lightboxModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        </script>
    @endif
</x-layout>
