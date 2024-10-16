<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <section class="flex flex-col items-center justify-center">
        <div class="w-11/12 sm:w-4/5">
            <div class="container mx-auto mb-10 w-full border-b-2 border-black/80 pb-3">
                <div class="mb-3 flex items-center gap-2">
                    <ion-icon class="text-4xl" name="people"></ion-icon>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-3xl" id="dokumentasi">Siswa/i</h2>
                </div>
                @php
                    $totalSiswa = $siswa->count();
                    $kelasX = $siswa->where('kelas', '10')->count();
                    $kelasXI = $siswa->where('kelas', '11')->count();
                    $kelasXII = $siswa->where('kelas', '12')->count();
                @endphp
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Terdapat {{ $totalSiswa }} peserta didik di rayon ini, terdiri dari {{ $kelasX }} kelas X, {{ $kelasXI }} kelas XI, dan {{ $kelasXII }} kelas XII dari berbagai program keahlian.
                </p>
            </div>

            <div>
                <div class="flex gap-4">
                    <div class="mb-2 w-full md:mb-0 md:w-auto">
                        <select id="kelasDropdown"
                            class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white md:w-auto">
                            <option value="all">Semua Kelas</option>
                            <option value="10">Kelas 10</option>
                            <option value="11">Kelas 11</option>
                            <option value="12">Kelas 12</option>
                        </select>
                    </div>
                    <div class="mb-2 w-full md:mb-0 md:w-auto">
                        <input type="text" id="searchInput"
                            class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white md:w-auto"
                            placeholder="Cari berdasarkan nama...">
                    </div>
                </div>
                <div class="container mx-auto py-8">
                    <div class="grid grid-cols-2 gap-4 sm:gap-6 md:grid-cols-3 lg:grid-cols-4">

                        @foreach ($siswa as $murid)
                            <div data-category="{{ $murid['kelas'] }}" data-name="{{ $murid['nama'] }}">
                                <div class="relative h-full w-full overflow-hidden rounded-lg bg-white shadow-md">
                                    <img class="h-48 w-full object-cover md:h-80"
                                        src="assets/images/siswa/{{ $murid['gambar'] }}" alt="{{ $murid['nama'] }}">
                                    <div class="p-4">
                                        <h3 id="nama" class="text-lg font-semibold text-gray-800">{{ $murid['nama'] }}</h3>
                                        <p id="identitas" class="text-gray-600">{{ $murid['nis'] }} | {{ $murid['jurusan'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
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
        document.addEventListener('DOMContentLoaded', () => {
            const dropdown = document.getElementById('kelasDropdown');
            const searchInput = document.getElementById('searchInput');
            const items = document.querySelectorAll('[data-category]');

            const defaultCategory = 'all';

            function filterItems(category, searchTerm) {
                const itemsArray = Array.from(items);

                itemsArray.sort((a, b) => {
                    const classA = a.getAttribute('data-category');
                    const classB = b.getAttribute('data-category');
                    const nameA = a.querySelector('h3').textContent.toUpperCase();
                    const nameB = b.querySelector('h3').textContent.toUpperCase();

                    if (classA < classB) {
                        return -1;
                    }
                    if (classA > classB) {
                        return 1;
                    }
                    if (nameA < nameB) {
                        return -1;
                    }
                    if (nameA > nameB) {
                        return 1;
                    }
                    return 0;
                });

                const container = document.querySelector('.grid');
                container.innerHTML = '';
                itemsArray.forEach(item => {
                    container.appendChild(item);
                });

                itemsArray.forEach(item => {
                    const itemName = item.getAttribute('data-name').toLowerCase();
                    const matchesSearch = itemName.includes(searchTerm.toLowerCase());

                    if (category === 'all' && matchesSearch) {
                        item.style.display = 'block';
                    } else if (item.getAttribute('data-category') === category && matchesSearch) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Initial filter with default category
            filterItems(defaultCategory, '');

            dropdown.addEventListener('change', () => {
                const category = dropdown.value;
                const searchTerm = searchInput.value;
                filterItems(category, searchTerm);
            });

            searchInput.addEventListener('input', () => {
                const category = dropdown.value;
                const searchTerm = searchInput.value;
                filterItems(category, searchTerm);
            });
        });
    </script>
</x-layout>
