<x-layout>
    <x-navbar></x-navbar>

    <x-header></x-header>

    <section class="py-16">
        <div class="container mx-auto mb-10 w-11/12 border-b-2 border-black pb-3 sm:w-4/5">
            <div class="mb-3 flex items-center gap-4">
                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                </svg>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">Galeri</h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">We offer a wide range of services to help you grow your
                business.</p>
        </div>
        <div class="swiper mySwiper flex w-11/12 items-center justify-center sm:w-4/5">

            @php
                $imageCount = count($images);
                $minimumImages = 4;
            @endphp

            @if ($imageCount > 0)
                <div class="swiper-wrapper">
                    @foreach ($images as $image)
                        <div class="swiper-slide">
                            <img src="assets/images/galeri/{{ $image->gambar }}" alt=""
                                class="mx-2 h-80 rounded-lg object-cover duration-300 hover:scale-105"
                                style="width: 95%" onclick="openModal(this)" data-title="{{ $image->judul }}">
                        </div>
                    @endforeach

                    {{-- Tambahkan slide dengan gambar yang ada jika kurang dari 4 --}}
                    @for ($i = 0; $i < $minimumImages - $imageCount; $i++)
                        @php
                            // Mengambil gambar dari urutan 0, 1, 2 jika jumlah data kurang dari 4
                            $imageIndex = $i % $imageCount;
                            $image = $images[$imageIndex];
                        @endphp
                        <div class="swiper-slide">
                            <img src="assets/images/galeri/{{ $image->gambar }}" alt=""
                                class="mx-2 h-80 rounded-lg object-cover duration-300 hover:scale-105"
                                style="width: 95%" onclick="openModal(this)" data-title="{{ $image->judul }}">
                        </div>
                    @endfor
                </div>
            @else
                <div class="col-span-2 flex flex-col items-center justify-center p-12 text-center">
                    <ion-icon class="text-[90px] text-gray-400"
                        src="{{ asset('assets/images/icon/camera-outline.svg') }}"></ion-icon>
                    <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">belum ada postingan galeri saat ini
                    </h3>
                    <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir galeri terbaru</p>
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
        <div class="container mx-auto mb-10 w-11/12 border-b-2 border-gray-300 pb-5 dark:border-gray-700 sm:w-4/5">
            <div class="mb-6 flex items-center gap-4">
                <ion-icon class="text-4xl md:text-5xl" src="{{ asset('assets/images/icon/people.svg') }}"></ion-icon>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100" id="dokumentasi">Alumni</h2>
            </div>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Alumni Rayon Cicurug 2</p>
        </div>

        <div class="container mx-auto w-11/12 px-4 py-16 sm:w-4/5">
            <div class="grid gap-8 lg:grid-cols-2">
                @if ($alumni->isEmpty())
                    <div class="col-span-2 flex flex-col items-center justify-center pb-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 h-24 w-24 text-gray-400 dark:text-gray-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">Tidak ada data alumni</h3>
                        <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir data alumni terbaru</p>
                    </div>
                @else
                    @foreach ($alumni->take(2) as $lulusan)
                        <div
                            class="transform overflow-hidden rounded-xl bg-white shadow-lg transition-shadow duration-300 hover:shadow-2xl dark:bg-gray-800">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0">
                                    <img class="h-48 w-full object-cover md:w-48"
                                        src="{{ asset('storage/images/alumni/' . $lulusan->gambar) }}"
                                        alt="{{ $lulusan->nama }}">
                                </div>
                                <div class="p-8">
                                    <div class="text-sm font-semibold uppercase tracking-wide text-indigo-500">Angkatan
                                        {{ $lulusan->angkatan }}</div>
                                    <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $lulusan->nama }}</h3>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $lulusan->jurusan }}</p>
                                    <div class="mt-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <p class="text-gray-600 dark:text-gray-300">{{ $lulusan->tempat_bekerja }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @if ($alumni->count() > 2)
                <div class="mt-10 flex justify-center">
                    <a class="group text-[18px] font-medium text-blue-500 hover:text-blue-600" href="/alumni">
                        <span>Lihat Semua Alumni Rayon Cicurug 2</span>
                        <ion-icon class="-mb-[3px] pl-1 transition-transform duration-300 group-hover:translate-x-1"
                            name="arrow-forward-outline"></ion-icon>
                    </a>
                </div>
            @endif
        </div>
    </section>


</x-layout>
