<x-layout>
    <x-navbar></x-navbar>

    <x-header></x-header>

    <section class="py-16">
        <div class="container w-11/12 pb-3 mx-auto mb-10 border-b-2 border-black sm:w-4/5">
            <div class="flex items-center gap-4 mb-3">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z" />
                </svg>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">Galeri</h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">We offer a wide range of services to help you grow your
                business.</p>
        </div>
        <div class="flex items-center justify-center w-11/12 swiper mySwiper sm:w-4/5">
            <div class="swiper-wrapper">

                @php
                    $imageCount = count($images);
                    $minimumImages = 4;
                @endphp

                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <img src="assets/images/galeri/{{ $image->gambar }}" alt=""
                            class="object-cover mx-2 duration-300 rounded-lg h-80 hover:scale-105" style="width: 95%"
                            onclick="openModal(this)" data-title="{{ $image->judul }}">
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
                            class="object-cover mx-2 duration-300 rounded-lg h-80 hover:scale-105" style="width: 95%"
                            onclick="openModal(this)" data-title="{{ $image->judul }}">
                    </div>
                @endfor

            </div>
        </div>

        <!-- Modal -->
        <div id="lightboxModal" class="fixed inset-0 z-50 items-center justify-center hidden p-4 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-300" style="z-index: 100">
            <div class="relative bg-white rounded-lg shadow-2xl overflow-hidden">
                <div class="relative">
                    <img id="modalImage" class="max-w-[90vw] max-h-[80vh] w-auto h-auto object-contain transition-opacity duration-300 ease-in-out opacity-0">
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <p id="imageCaption" class="text-sm text-white text-center"></p>
                    </div>
                </div>
                <div class="absolute top-0 left-0 right-0 flex items-center justify-between p-4 bg-black/40 backdrop-blur">
                    <h2 id="modalTitle" class="text-2xl font-bold text-white drop-shadow-lg">Galeri</h2>
                    <button onclick="closeModal()" class="text-white hover:text-gray-300 transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
        <div class="container w-11/12 pb-5 mx-auto mb-10 border-b-2 border-gray-300 dark:border-gray-700 sm:w-4/5">
            <div class="flex items-center gap-4 mb-6">
                <ion-icon class="text-4xl md:text-5xl" src="{{asset('assets/images/icon/people.svg')}}"></ion-icon>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100" id="dokumentasi">Alumni</h2>
            </div>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">We offer a wide range of services to help you grow your business.</p>
        </div>
    
        <div class="container w-11/12 px-4 mx-auto sm:w-4/5 py-16">
            <div class="grid gap-8 lg:grid-cols-2">
                @if ($alumni->isEmpty())
                    <div class="col-span-2 flex flex-col items-center justify-center pb-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-400 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">Tidak ada data alumni</h3>
                        <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir data alumni terbaru</p>
                    </div>
                @else
                    @foreach ($alumni->take(2) as $lulusan)
                        <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-1">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0">
                                    <img class="h-48 w-full object-cover md:w-48" src="{{ asset('assets/images/alumni/' . $lulusan->gambar) }}" alt="{{ $lulusan->nama }}">
                                </div>
                                <div class="p-8">
                                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Angkatan {{ $lulusan->angkatan }}</div>
                                    <h3 class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $lulusan->nama }}</h3>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $lulusan->jurusan }}</p>
                                    <div class="mt-4 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
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
                <div class="flex justify-center mt-10">
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
