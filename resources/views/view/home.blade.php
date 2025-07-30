<x-layout>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
        <style>
            #map {
                height: 400px;
            }
        </style>
    @endpush

    <x-navbar></x-navbar>

    <x-header></x-header>

    <section class="bg-white py-5">
        <div class="container mx-auto w-11/12 sm:w-[50%]">
            <div class="grid grid-cols-2 gap-8">
                <div class="flex flex-col items-center p-6 dark:bg-gray-800">
                    <img src="{{ asset('assets/images/icon/people.svg') }}" alt="Total Siswa"
                        class="mb-2 h-10 w-16 md:h-14">
                    <p class="text-xl font-bold text-gray-800 dark:text-white md:text-2xl">{{ $totalSiswa }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 md:text-lg">Total Siswa</p>
                </div>
                <div class="flex flex-col items-center p-6 dark:bg-gray-800">
                    <img src="{{ asset('assets/images/icon/ribbon-outline.svg') }}" alt="Prestasi"
                        class="mb-2 h-10 w-16 md:h-14">
                    <p class="text-xl font-bold text-gray-800 dark:text-white md:text-2xl">{{ $totalPrestasi }}</p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 md:text-lg">Prestasi</p>
                </div>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="py-16">
        <div class="container mx-auto mb-10 w-11/12 border-b-2 border-black pb-3 sm:w-4/5">
            <div class="mb-3 flex items-center gap-4">
                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                </svg>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">Galeri</h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Galeri Rayon Cicurug 2</p>
        </div>
        <div class="swiper mySwiper flex w-11/12 items-center justify-center sm:w-4/5">

            @php
                $imageCount = count($images);
                $minimumImages = 5;
            @endphp

            @if ($imageCount > 0)
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        @if ($image->gambar && asset('assets/images/galeri/' . $image->gambar))
                            <img src="{{ asset('assets/images/galeri/' . $image->gambar) }}" alt="{{ $image->judul }}"
                                class="mx-2 h-80 rounded-lg object-cover duration-300 hover:scale-105"
                                style="width: 95%" onclick="openModal(this)" data-title="{{ $image->judul }}"
                                onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';"
                                loading="lazy">
                        @else
                            <img src="{{ asset('assets/images/image.jpg') }}" alt="{{ $image->judul }}"
                                class="mx-2 h-80 rounded-lg object-cover duration-300 hover:scale-105"
                                style="width: 95%" onclick="openModal(this)" data-title="{{ $image->judul }}"
                                loading="lazy">
                        @endif
                    </div>
                @endforeach

                {{-- Tambahkan slide dengan gambar yang ada jika kurang dari minimum --}}
                @if ($imageCount < $minimumImages)
                    @for ($i = 0; $i < $minimumImages - $imageCount; $i++)
                        @php
                            $imageIndex = $i % $imageCount;
                            $image = $images[$imageIndex];
                        @endphp
                        <div class="swiper-slide">
                            @if ($image->gambar && file_exists(public_path('assets/images/galeri/' . $image->gambar)))
                                <img src="{{ asset('assets/images/galeri/' . $image->gambar) }}" alt="{{ $image->judul }}"
                                    class="mx-2 h-80 rounded-lg object-cover duration-300 hover:scale-105"
                                    style="width: 95%" onclick="openModal(this)" data-title="{{ $image->judul }}"
                                    loading="lazy">
                            @else
                                <img src="{{ asset('assets/images/image.jpg') }}" alt="{{ $image->judul }}"
                                    class="mx-2 h-80 rounded-lg object-cover duration-300 hover:scale-105"
                                    style="width: 95%" onclick="openModal(this)" data-title="{{ $image->judul }}"
                                    loading="lazy">
                            @endif
                        </div>
                    @endfor
                @endif
            </div>
            @endif

        </div>

        <!-- Modal -->
        <div id="lightboxModal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-4 backdrop-blur-sm transition-opacity duration-300"
            style="z-index: 100">
            <div class="relative overflow-hidden rounded-lg bg-white shadow-2xl">
                <div class="relative">
                    <img id="modalImage"
                        class="h-auto max-h-[80vh] w-auto max-w-[90vw] object-contain opacity-0 transition-opacity duration-300 ease-in-out">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p id="imageCaption" class="text-center text-sm text-white"></p>
                    </div>
                </div>
                <div
                    class="absolute left-0 right-0 top-0 flex items-center justify-between bg-black/40 p-4 backdrop-blur">
                    <h2 id="modalTitle" class="text-2xl font-bold text-white drop-shadow-lg">Galeri</h2>
                    <button onclick="closeModal()"
                        class="text-white transition-colors duration-200 hover:text-gray-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <script>
            // Open modal and show image
            function openModal(element) {
                var modal = document.getElementById("lightboxModal");
                var modalImage = document.getElementById("modalImage");
                var modalTitle = document.getElementById("modalTitle");
                modalImage.src = element.src;
                modalTitle.textContent = element.getAttribute("data-title");
                modal.classList.remove("hidden");
                modal.classList.add("flex");
                setTimeout(function() {
                    modalImage.classList.remove("opacity-0");
                }, 10); // Small delay to trigger the transition
            }

            // Close modal
            function closeModal() {
                var modal = document.getElementById("lightboxModal");
                var modalImage = document.getElementById("modalImage");
                modalImage.classList.add("opacity-0");
                setTimeout(function() {
                    modal.classList.add("hidden");
                    modal.classList.remove("flex");
                }, 200); // Wait for the transition to complete
            }
        </script>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                centeredSlides: true,
                grabCursor: true,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                slidesPerView: 1,
                initialSlide: 1, // Mulai dari slide kedua (index 1)
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        </script>
    </section>

    @include('components.struktur', ['data' => $data])

    <section class="py-12">
        <div data-aos="fade-up" class="container mx-auto w-11/12 border-b-2 border-gray-300 pb-5 dark:border-gray-700 sm:w-4/5">
            <div class="mb-6 flex items-center gap-4">
                <ion-icon class="text-3xl md:text-5xl" src="{{ asset('assets/images/icon/people.svg') }}"></ion-icon>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 md:text-4xl" id="dokumentasi">Alumni</h2>
            </div>
            <p class="mt-2 text-base text-gray-600 dark:text-gray-400 md:text-lg">Alumni Rayon Cicurug 2</p>
        </div>

        <div class="container mx-auto w-11/12 px-4 py-8 sm:w-4/5 md:py-16">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:gap-8">
                @if ($alumni->isEmpty())
                    <div data-aos="fade-up" class="col-span-1 flex flex-col items-center justify-center p-8 text-center md:col-span-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="mb-4 h-16 w-16 text-gray-400 dark:text-gray-600 md:h-24 md:w-24" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-400 dark:text-white md:text-2xl">Tidak ada data
                            alumni</h3>
                        <p class="mt-2 text-sm text-gray-400 dark:text-gray-400 md:text-base">Segera hadir data alumni
                            terbaru</p>
                    </div>
                @else
                    @foreach ($alumni->take(4) as $lulusan)
                        <div
                            data-aos="fade-up" class="mx-auto w-72 transform overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-xl dark:bg-gray-800 sm:w-full">
                            <div class="flex flex-col lg:flex-row">
                                <div class="h-48 w-full lg:w-48">
                                    @if ($lulusan->gambar && asset('assets/images/alumni/' . $lulusan->gambar))
                                        <img class="h-full w-full object-cover lg:w-48"
                                            src="{{ asset('assets/images/alumni/' . $lulusan->gambar) }}"
                                            alt="{{ $lulusan->nama }}">
                                    @else
                                        <img class="h-full w-full object-cover lg:w-48"
                                            src="{{ asset('assets/images/image.jpg') }}" alt="{{ $lulusan->nama }}">
                                    @endif
                                </div>
                                <div class="flex max-h-56 flex-1 flex-col justify-between p-4">
                                    <div>
                                        <div
                                            class="text-xs font-semibold uppercase tracking-wide text-indigo-500 md:text-sm">
                                            Angkatan {{ $lulusan->angkatan }}
                                        </div>
                                        <h3 class="mt-1 text-lg font-bold text-gray-900 dark:text-white md:text-xl">
                                            {{ $lulusan->nama }}
                                        </h3>
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                            Jurusan: {{ $lulusan->jurusan }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            Tempat Bekerja: {{ $lulusan->tempat_bekerja }}
                                        </p>
                                        <div class="mt-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mr-2 h-4 w-4 text-gray-400 md:h-5 md:w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ $lulusan->pekerjaan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @if ($alumni->count() > 2)
                <div class="mt-8 flex justify-center md:mt-10">
                    <a class="group text-base font-medium text-blue-500 hover:text-blue-600 md:text-lg"
                        href="/alumni">
                        <span>Lihat Semua Alumni Rayon Cicurug 2</span>
                        <ion-icon class="-mb-[3px] pl-1 transition-transform duration-300 group-hover:translate-x-1"
                            name="arrow-forward-outline"></ion-icon>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <x-accordion></x-accordion>

    @include('components.map', ['rumah' => $rumah])

</x-layout>
