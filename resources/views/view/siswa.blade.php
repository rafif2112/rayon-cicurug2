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
                    Terdapat {{ $totalSiswa }} peserta didik di rayon ini, terdiri dari {{ $kelasX }} kelas X,
                    {{ $kelasXI }} kelas XI, dan {{ $kelasXII }} kelas XII dari berbagai program keahlian.
                </p>
            </div>

            <div>
                <div class="flex gap-4">
                    <div class="mb-2 w-full md:mb-0 md:w-auto">
                        <form action="{{ route('siswa.index') }}" method="GET">
                            <select name="kategori" id="kelasDropdown"
                                class="w-full rounded-full border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white md:w-auto"
                                onchange="this.form.submit()">
                                <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Kelas
                                </option>
                                <option value="10" {{ request('kategori') == '10' ? 'selected' : '' }}>Kelas 10
                                </option>
                                <option value="11" {{ request('kategori') == '11' ? 'selected' : '' }}>Kelas 11
                                </option>
                                <option value="12" {{ request('kategori') == '12' ? 'selected' : '' }}>Kelas 12
                                </option>
                            </select>
                        </form>
                    </div>
                    <div class="mb-2 w-full md:mb-0 md:w-auto">
                        <form action="{{ route('siswa.index') }}" method="GET" class="flex items-center">
                            <input type="text" name="search" id="searchInput"
                                class="w-full rounded-l-full border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white md:w-auto"
                                placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                            @if (request('search'))
                                <div class="absolute right-[66%] ml-2 inline-flex items-center justify-center ">
                                    <a href="{{ route('siswa.index') }}"
                                        class="rounded-full bg-black/40 px-1.5 text-white transition duration-300 ease-out hover:bg-black/60">
                                        X
                                    </a>
                                </div>
                            @endif
                            <button type="submit"
                                class="rounded-r-full border border-black bg-blue-500 px-4 py-2 text-white transition duration-300 ease-out hover:bg-blue-600">Cari</button>
                        </form>
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
                                        @if ($murid['gambar'])
                                            <img class="h-48 w-full object-cover md:h-80"
                                                src="{{ asset('storage/images/siswa/' . $murid['gambar']) }}"
                                                alt="{{ $murid['nama'] }}">
                                        @else
                                            <img src="{{ asset('storage/images/image.jpg') }}" alt="Foto Siswa"
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
                document.getElementById('foto-siswa').scrollIntoView({ behavior: 'smooth' });
            }

            if (window.location.search.includes('kategori=')) {
                document.getElementById('foto-siswa').scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
</x-layout>
