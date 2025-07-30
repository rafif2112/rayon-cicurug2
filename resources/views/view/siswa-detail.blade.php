<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <section class="">
        <div class="container mx-auto py-16 px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Back Button -->
                <div class="mb-8">
                    <a href="{{ route('siswa.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Siswa
                    </a>
                </div>

                <!-- Student Profile Card -->
                <div class="bg-white rounded-2xl overflow-hidden">
                    <div class="md:flex">
                        <!-- Image Section -->
                        <div data-aos="fade-right" class="md:w-1/3">
                            @if ($siswa->gambar)
                                <img class="w-full rounded-2xl h-[350px] object-cover" 
                                     src="{{ asset('assets/images/siswa/' . $siswa->gambar) }}"
                                     alt="{{ $siswa->nama }}"
                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';">
                            @else
                                <img src="{{ asset('assets/images/image.jpg') }}" 
                                     alt="Foto Siswa"
                                     class="w-full rounded-2xl h-[350px] object-cover">
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div data-aos="fade-left" class="md:w-2/3 p-8">
                            <div class="mb-6">
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $siswa->nama }}</h1>
                                <p class="text-lg text-gray-600 mb-2">{{ $siswa->jurusan }} | {{ $siswa->kelas }}</p>
                            </div>

                            <!-- Description Section -->
                            <div class="mb-8">
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $siswa->deskripsi ? $siswa->deskripsi : '-' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">NIS</h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->nis }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Kelas</h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->kelas }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Angkatan</h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->angkatan }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Jurusan</h3>
                                    <p class="text-lg text-gray-900">{{ $siswa->jurusan }}</p>
                                </div>
                            </div>

                            @if ($siswa->link)
                                <div class="mb-8">
                                    <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-4">Portofolio</h3>
                                    <a href="{{ $siswa->link }}" 
                                       target="_blank"
                                       class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        Lihat Portofolio
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <!-- Experience Section -->
                    <div class="mt-12">
                        @if($siswa->sertifikat && count($siswa->sertifikat) > 0)
                            <h2 class="text-2xl font-bold text-gray-900 mb-6" data-aos="fade-up">Sertifikat</h2>
                            <!-- Swiper -->
                            <div class="swiper mySwiper w-full h-auto" data-aos="fade-up">
                                <div class="swiper-wrapper">
                                    @foreach($siswa->sertifikat as $index => $sertifikat)
                                        @if(isset($sertifikat['gambar']) && is_array($sertifikat['gambar']) && count($sertifikat['gambar']) > 0)
                                            @foreach($sertifikat['gambar'] as $gambarIndex => $gambar)
                                                <div class="swiper-slide">
                                                    <div class="cursor-pointer">
                                                        <div class="rounded mb-3">
                                                            <div class="h-48 rounded overflow-hidden">
                                                                <img src="{{ asset('assets/images/siswa/portofolio/' . $siswa->nis . '/' . $gambar) }}" 
                                                                    alt="Sertifikat {{ $index + 1 }}" 
                                                                    class="w-full h-48 object-cover rounded"
                                                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';">
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
                            <div class="mt-12 text-center py-12">
                                <div class="text-gray-400 mb-4">
                                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Sertifikat</h3>
                                <p class="text-gray-500">Sertifikat akan ditampilkan di sini ketika sudah diupload.</p>
                            </div>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </section>

        @if($siswa->sertifikat && count($siswa->sertifikat) > 0)
        <script>
            const carousels = {};
            
            @foreach($siswa->sertifikat as $index => $sertifikat)
                @if(isset($sertifikat['gambar']) && count($sertifikat['gambar']) > 1)
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
        </script>
        @endif
</x-layout>