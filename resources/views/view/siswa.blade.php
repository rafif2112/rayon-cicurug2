<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <section id="foto-siswa" class="flex flex-col items-center justify-center">
        <div class="w-11/12 sm:w-4/5">
            <div class="container mx-auto mb-10 w-full border-b-2 border-black/80 pb-3">
                <div class="mb-3 flex items-center gap-2">
                    <ion-icon class="text-4xl" name="people"></ion-icon>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-3xl">Siswa/i</h2>
                </div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Terdapat {{ $totalSiswa }} peserta didik di rayon ini, terdiri dari {{ $kelasX }} siswa kelas X,
                    {{ $kelasXI }} siswa kelas XI, dan {{ $kelasXII }} siswa kelas XII dari berbagai program keahlian.
                </p>
            </div>

            <!-- Filter sections remain the same -->
            <div>
                <div class="mb-2">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <!-- Filters remain the same -->
                    </div>
                </div>
                
                <div class="container mx-auto py-8">
                    @if ($siswa->isEmpty())
                        <div class="col-span-2 flex flex-col items-center justify-center p-12 text-center">
                            <ion-icon class="text-[90px] text-gray-400" name="people-outline"></ion-icon>
                            <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">Belum ada siswa saat ini</h3>
                            <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir siswa terbaru</p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-4 sm:gap-6 md:grid-cols-3 lg:grid-cols-4">
                            @foreach ($siswa as $index => $murid)
                                <div data-category="{{ $murid['kelas'] }}" data-name="{{ $murid['nama'] }}">
                                    <div data-aos="fade-up" data-aos-delay="{{ min($index * 50, 300) }}"
                                        class="relative h-full w-full overflow-hidden rounded-lg bg-white shadow-md hover:shadow-xl transition-shadow duration-300">
                                        <a href="{{ route('siswa.show', $murid->slug) }}" class="block relative">
                                            <div class="h-48 md:h-80 w-full bg-gray-200 overflow-hidden">
                                                @if ($murid['gambar'] && file_exists(public_path('assets/images/siswa/' . $murid['gambar'])))
                                                    <img data-src="{{ asset('assets/images/siswa/' . $murid['gambar']) }}"
                                                        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1 1'%3E%3C/svg%3E"
                                                        alt="{{ $murid['nama'] }}"
                                                        class="lazy-img h-full w-full object-cover"
                                                        loading="lazy"
                                                        width="300" height="320"
                                                        onerror="this.src='{{ asset('assets/images/image.jpg') }}'">
                                                @else
                                                    <img src="{{ asset('assets/images/image.jpg') }}" 
                                                        alt="Foto Siswa"
                                                        class="h-full w-full object-cover"
                                                        loading="lazy"
                                                        width="300" height="320">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="p-4">
                                            <h3 class="text:sm font-semibold text-gray-800 sm:text-lg truncate">
                                                <a href="{{ route('siswa.show', $murid->slug) }}" class="hover:text-blue-600">
                                                    {{ $murid['nama'] }}
                                                </a>
                                            </h3>
                                            <div class="text-sm sm:text-lg">
                                                <p class="text-gray-600">{{ $murid['nis'] }} | {{ $murid['jurusan'] }}</p>
                                                <div class="mt-2">
                                                    <p class="text-gray-400">Portofolio :
                                                        @if ($murid['slug'])
                                                            <a class="text-blue-500 underline" href="{{ route('siswa.show', $murid->slug) }}">
                                                                Lihat Portofolio
                                                            </a>
                                                        @else
                                                            <span class="ml-1 text-gray-400">-</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if (request('kategori') === 'alumni')
                    {{ $siswa->links() }}
                @endif
            </div>
        </div>
    </section>

    <script>
        // Lazy loading images with Intersection Observer
        document.addEventListener('DOMContentLoaded', function() {
            const lazyImages = document.querySelectorAll('.lazy-img');
            
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-img');
                        imageObserver.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            lazyImages.forEach(img => imageObserver.observe(img));

            // Smooth scroll on filter/search
            if (window.location.search) {
                document.getElementById('foto-siswa').scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
</x-layout>