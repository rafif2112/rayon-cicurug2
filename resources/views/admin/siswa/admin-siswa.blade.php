<x-admin-layout>
    <div class="overflow-x-auto">
        @if (session('success'))
            <div
                class="mb-4 w-full rounded-lg border-l-4 border-green-500 bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-100 sm:w-auto">
                <p class="font-semibold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div style="border-color: #f56565; background-color: #ffc1c1;"
                class="mb-4 w-full rounded-lg border-l-4 p-4 text-red-700 dark:bg-red-800 dark:text-red-100 sm:w-auto">
                <p class="font-semibold">Error!</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-4 p-2">
            <div class="mb-3 flex flex-col space-y-4">
                <!-- Action Buttons -->
                <div class="flex flex-col space-y-2 sm:flex-row sm:space-x-2 sm:space-y-0">
                    <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
                        id="importForm" class="flex-grow sm:flex-grow-0">
                        @csrf
                        <input type="file" name="file" id="fileInput" class="hidden"
                            onchange="document.getElementById('importForm').submit()">
                        <button type="button" onclick="document.getElementById('fileInput').click()"
                            class="w-full rounded-xl bg-green-500 px-4 py-3 font-semibold text-white transition-all duration-300 hover:bg-green-600 hover:shadow-lg dark:bg-green-600 dark:hover:bg-green-700 sm:w-auto">
                            <svg class="mr-2 inline-block h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Import Data
                        </button>
                    </form>

                    <a href="{{ route('siswa.create') }}"
                        class="flex-grow rounded-xl bg-blue-500 px-4 py-3 text-center font-semibold text-white transition-all duration-300 hover:bg-blue-600 hover:shadow-lg dark:bg-blue-600 dark:hover:bg-blue-700 sm:flex-grow-0">
                        <svg class="mr-2 inline-block h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Data
                    </a>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="flex flex-col space-y-4 lg:flex-row lg:space-x-4 lg:space-y-0">
                <!-- Dropdown Filter -->
                <div class="relative w-full lg:w-48">
                    <form action="{{ route('siswa.admin') }}" method="GET">
                        <select name="kategori" id="kelasDropdown"
                            class="w-full appearance-none rounded-xl border border-gray-200 bg-white px-4 py-3 pr-8 shadow-sm transition-all duration-300 hover:border-blue-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-blue-500"
                            onchange="this.form.submit()">
                            <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>📚 Semua Kelas
                            </option>
                            <option value="10" {{ request('kategori') == '10' ? 'selected' : '' }}>🎓 Kelas 10
                            </option>
                            <option value="11" {{ request('kategori') == '11' ? 'selected' : '' }}>🎓 Kelas 11
                            </option>
                            <option value="12" {{ request('kategori') == '12' ? 'selected' : '' }}>🎓 Kelas 12
                            </option>
                            @if ($hasAlumni)
                                <option value="alumni" {{ request('kategori') == 'alumni' ? 'selected' : '' }}>🎊 Alumni
                                </option>
                            @endif
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Search Bar -->
                <div class="relative flex-grow">
                    <form action="{{ route('siswa.admin') }}" method="GET" class="relative">
                        <input type="text" name="search" id="searchInput"
                            class="w-full rounded-xl border border-gray-200 bg-white px-4 py-3 pl-10 pr-12 shadow-sm transition-all duration-300 hover:border-blue-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:border-blue-500"
                            placeholder="Cari siswa..." value="{{ request('search') }}">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <button type="submit"
                            class="absolute inset-y-0 right-0 flex items-center rounded-r-xl bg-blue-600 px-4 text-white hover:bg-blue-500">
                            Cari
                        </button>
                        @if (request('search'))
                            <a href="{{ route('siswa.admin') }}"
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

        @if ($siswa->isEmpty())
            <div class="py-4 text-center text-gray-500">
                Data siswa tidak ada.
            </div>
        @else
            <div class="overflow-x-auto rounded-lg bg-white shadow-md dark:bg-gray-800">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Foto</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Kelas</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Nama</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                NIS</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Jurusan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Angkatan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Portofolio</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Map</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($siswa as $murid)
                            <tr data-category="{{ $murid->kelas }}"
                                class="{{ $murid->kelas !== 'alumni' || ($murid->kelas === 'alumni' && $kategori === 'alumni') ? '' : 'hidden' }} transition-colors duration-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-24 w-20 flex-shrink-0">
                                            @if ($murid['gambar'] && asset('assets/images/siswa/' . $murid['gambar']))
                                                <img class="h-24 w-20 rounded-lg object-cover lazyload" loading="lazy"
                                                    src="{{ asset('assets/images/siswa/' . $murid['gambar']) }}"
                                                    alt="{{ $murid['nama'] }}"
                                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/image.jpg') }}';">
                                            @else
                                                <img src="{{ asset('assets/images/image.jpg') }}" alt="Foto Siswa"
                                                    loading="lazy" class="h-48 w-full object-cover md:h-80">
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800 dark:bg-green-800 dark:text-green-100">
                                        {{ $murid->kelas }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $murid->nama }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-300">{{ $murid->nis }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-300">{{ $murid->jurusan }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-300">{{ $murid->angkatan }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-300">
                                        @if ($murid->link)
                                            <a href="{{ $murid->link }}" target="_blank"
                                                class="text-blue-500 hover:text-blue-700">Lihat</a>
                                        @else
                                            <span class="text-3xl">-</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-300">
                                        @if ($murid->latitude && $murid->longitude)
                                            <span class="font-semibold text-green-500">✓</span>
                                        @else
                                            <span class="text-lg font-semibold text-red-500">X</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('siswa.edit', $murid->id) }}"
                                            class="text-indigo-600 transition-colors duration-200 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-500">Edit</a>
                                        <form action="{{ route('siswa.destroy', $murid->id) }}" method="POST"
                                            class="delete-form inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-button text-red-600 transition-colors duration-200 hover:text-red-900 dark:text-red-400 dark:hover:text-red-500">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @if (request('kategori') == 'alumni')
        <div>
            {{ $siswa->links() }}
        </div>
    @endif

    <div id="loadingSpinner" class="hidden">
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-30">
            <div class="h-32 w-32 animate-spin rounded-full border-b-2 border-t-2 border-gray-900"></div>
        </div>
    </div>

    <!-- Lazy loading library -->
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize lazy loading
            const lazyLoadInstance = new LazyLoad({
                elements_selector: ".lazyload",
                threshold: 100
            });

            // Event listener for delete buttons - use event delegation
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('delete-button')) {
                    e.preventDefault();
                    const form = e.target.closest('.delete-form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });

            // Show loading spinner on form submit
            const importForm = document.getElementById('importForm');
            if (importForm) {
                importForm.addEventListener('submit', function() {
                    document.getElementById('loadingSpinner').classList.remove('hidden');
                });
            }
        });

        // Success message
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'Tutup'
                });
            });
        @endif
    </script>

    <!-- Load SweetAlert2 asynchronously -->
    <script>
        // Load SweetAlert2 only when needed
        if (!window.Swal) {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            script.async = true;
            document.head.appendChild(script);
        }
    </script>
</x-admin-layout>
