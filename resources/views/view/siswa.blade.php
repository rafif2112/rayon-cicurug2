<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <section id="foto-siswa" class="flex flex-col items-center justify-center">
        <div class="w-11/12 sm:w-4/5">
            <div class="container mx-auto mb-10 w-full border-b-2 border-black/80 pb-3">
                <div class="mb-3 flex items-center gap-2">
                    <ion-icon class="text-4xl" name="people"></ion-icon>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-3xl" id="dokumentasi">Siswa/i</h2>
                </div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Terdapat {{ $totalSiswa }} peserta didik di rayon ini, terdiri dari {{ $kelasX }} siswa
                    kelas X,
                    {{ $kelasXI }} siswa kelas XI, dan {{ $kelasXII }} siswa kelas XII dari berbagai program
                    keahlian.
                </p>
            </div>

            <div>
                <div class="mb-2">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="relative w-full md:w-48">
                            <form action="{{ route('siswa.index') }}" method="GET">
                                <select name="kategori" id="kelasDropdown"
                                    class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-3 pr-8 shadow-sm transition-all duration-300 hover:border-blue-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-blue-500"
                                    onchange="this.form.submit()">
                                    <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>📚 Semua
                                        Kelas</option>
                                    <option value="10" {{ request('kategori') == '10' ? 'selected' : '' }}>🎓 Kelas
                                        10</option>
                                    <option value="11" {{ request('kategori') == '11' ? 'selected' : '' }}>🎓 Kelas
                                        11</option>
                                    <option value="12" {{ request('kategori') == '12' ? 'selected' : '' }}>🎓 Kelas
                                        12</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </form>
                        </div>

                        <div class="relative w-full md:w-96">
                            <form action="{{ route('siswa.index') }}" method="GET" class="relative">
                                <input type="text" name="search" id="searchInput"
                                    class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 pl-10 pr-12 shadow-sm transition-all duration-300 hover:border-blue-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-blue-500"
                                    placeholder="Cari siswa..." value="{{ request('search') }}">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <button type="submit"
                                    class="absolute inset-y-0 right-0 flex items-center rounded-r-xl bg-blue-600 px-4 text-white hover:bg-blue-500">
                                    Cari
                                </button>
                                @if (request('search'))
                                    <a href="{{ route('siswa.index') }}"
                                        class="absolute inset-y-0 right-16 flex items-center pr-2">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container mx-auto py-8">
                    @if ($siswa->isEmpty())
                        <div class="col-span-2 flex flex-col items-center justify-center p-12 text-center">
                            <ion-icon class="text-[90px] text-gray-400" name="people-outline"></ion-icon>
                            <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">belum ada siswa saat ini
                            </h3>
                            <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir siswa terbaru</p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-4 sm:gap-6 md:grid-cols-3 lg:grid-cols-4">

                            @foreach ($siswa as $murid)
                                <div data-category="{{ $murid['kelas'] }}" data-name="{{ $murid['nama'] }}">
                                    <div class="relative h-full w-full overflow-hidden rounded-lg bg-white shadow-md">
                                        @if ($murid['gambar'] && file_exists(public_path('assets/images/siswa/' . $murid['gambar'])))
                                            <img class="h-48 w-full object-cover md:h-80"
                                                src="{{ asset('assets/images/siswa/' . $murid['gambar']) }}"
                                                alt="{{ $murid['nama'] }}">
                                        @else
                                            <img src="{{ asset('assets/images/image.jpg') }}" alt="Foto Siswa"
                                                class="h-48 w-full object-cover md:h-80">
                                        @endif
                                        <div class="p-4">
                                            <h3 id="nama" class="text-lg font-semibold text-gray-800">
                                                {{ $murid['nama'] }}</h3>
                                            <p id="identitas" class="text-gray-600">{{ $murid['nis'] }} |
                                                {{ $murid['jurusan'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
                <div class="mt-8 flex justify-center">
                    <a class="group text-[18px] font-medium text-blue-500 hover:text-blue-600" href="/alumni">
                        <span>Lihat Alumni Rayon Cicurug 2</span>
                        <ion-icon class="-mb-[3px] pl-1 transition-transform duration-300 group-hover:translate-x-1"
                            name="arrow-forward-outline"></ion-icon>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.search.includes('search=')) {
                document.getElementById('foto-siswa').scrollIntoView({
                    behavior: 'smooth'
                });
            }

            if (window.location.search.includes('kategori=')) {
                document.getElementById('foto-siswa').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
</x-layout>
