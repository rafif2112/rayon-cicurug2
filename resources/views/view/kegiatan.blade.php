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
                            class="mb-10 flex flex-col items-center justify-center overflow-hidden rounded-lg bg-white shadow-xl sm:flex-row">
                            <img class="h-80 w-full object-cover sm:w-2/5"
                                src="{{ asset('assets/images/kegiatan/' . $item->gambar) }}" alt="Kegiatan Image" onclick="openModal(this)">
                            <div class="p-6 md:w-3/5">
                                <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">{{ $item->judul }}
                                </h1>
                                <p class="text-gray-700 dark:text-gray-300">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    @else
                        <div
                            class="mb-10 flex flex-col-reverse items-center justify-center overflow-hidden rounded-lg bg-white shadow-xl sm:flex-row">
                            <div class="p-6 md:w-3/5">
                                <h1 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">{{ $item->judul }}
                                </h1>
                                <p class="mb-4 text-gray-700 dark:text-gray-300 sm:mb-0 sm:mr-4">{{ $item->deskripsi }}
                                </p>
                            </div>
                            <img class="h-80 w-full object-cover sm:w-2/5"
                                src="{{ asset('assets/images/kegiatan/' . $item->gambar) }}" alt="Kegiatan Image" onclick="openModal(this)">
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <!-- Enhanced Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-5">
        <button onclick="closeModal()" class="absolute right-6 top-6 text-white hover:text-gray-300">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="modalImage" class="max-h-[90vh] max-w-[90vw] rounded-lg opacity-0 transition-opacity duration-300">
    </div>

    </section>
    <script>
        function openModal(img) {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalImg.src = img.src;
            setTimeout(() => modalImg.classList.add('opacity-100'), 100);
        }

        function closeModal() {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</x-layout>
