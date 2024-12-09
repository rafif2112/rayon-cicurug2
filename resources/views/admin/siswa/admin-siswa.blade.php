<x-admin-layout>
    <div class="overflow-x-auto">
        {{-- @if (session('success'))
            <div class="w-full mb-4 rounded-lg border-l-4 border-green-500 bg-green-100 p-4 text-green-700 dark:bg-green-800 dark:text-green-100 sm:w-auto">
                <p class="font-semibold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif --}}
        <div class="mb-4 flex flex-wrap justify-between">
            <div class="mb-4 w-full space-y-4 md:flex md:items-center md:justify-between md:space-y-0">
                <div class="mb-2 w-full md:mb-0 md:w-auto">
                    <form action="{{ route('siswa.admin') }}" method="GET" class="w-full sm:w-auto">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            class="w-full rounded-full border px-4 py-2 dark:bg-gray-700 dark:text-white md:w-auto"
                            placeholder="Cari berdasarkan nama...">
                        @if (request('search'))
                            <a href="{{ route('siswa.admin') }}"
                                class="inline-flex items-center justify-center rounded-full bg-black/30 px-4 py-2 font-semibold text-white transition duration-300 ease-out hover:bg-black/70 dark:bg-red-600 dark:hover:bg-red-800">
                                X
                            </a>
                        @endif
                    </form>
                </div>
                <div class="flex w-full flex-col space-y-4 sm:flex-row sm:space-x-4 sm:space-y-0 md:w-auto">
                    <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
                        class="w-full sm:w-auto" id="importForm">
                        @csrf
                        <input type="file" name="file" id="fileInput" class="hidden"
                            onchange="document.getElementById('importForm').submit()">
                        <button type="button" onclick="document.getElementById('fileInput').click()"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-green-500 px-4 py-2 font-semibold text-white transition duration-300 ease-out hover:bg-green-700 dark:bg-green-600 dark:hover:bg-green-800 sm:w-auto">
                            <span>Import Data Siswa</span>
                        </button>
                    </form>

                    <form action="{{ route('siswa.admin') }}" method="GET" class="w-full sm:w-auto">
                        <select name="kategori" id="kategori"
                            class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700 dark:text-white sm:w-auto"
                            onchange="this.form.submit()">
                            <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Kelas
                            </option>
                            <option value="10" {{ request('kategori') == '10' ? 'selected' : '' }}>Kelas 10</option>
                            <option value="11" {{ request('kategori') == '11' ? 'selected' : '' }}>Kelas 11</option>
                            <option value="12" {{ request('kategori') == '12' ? 'selected' : '' }}>Kelas 12</option>
                            @if ($hasAlumni)
                                <option value="alumni" {{ request('kategori') == 'alumni' ? 'selected' : '' }}>Alumni
                                </option>
                            @endif
                        </select>
                    </form>

                    <a href="{{ route('siswa.create') }}"
                        class="inline-flex w-full items-center justify-center rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-800 sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah Data
                    </a>
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
                                            @if ($murid->gambar)
                                                <img class="h-24 w-20 rounded-lg object-cover"
                                                    src="{{ asset('assets/images/siswa/' . $murid->gambar) }}"
                                                    alt="{{ $murid->nama }}">
                                            @else
                                                <img class="h-24 w-20 rounded-lg object-cover"
                                                    src="{{ asset('assets/images/image.jpg') }}"
                                                    alt="{{ $murid->nama }}">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for delete buttons
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-form');
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
                });
            });

            // Show loading spinner on form submit
            const importForm = document.getElementById('importForm');
            importForm.addEventListener('submit', function() {
                document.getElementById('loadingSpinner').classList.remove('hidden');
            });
        });
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Tutup'
            });
        @endif
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-admin-layout>
