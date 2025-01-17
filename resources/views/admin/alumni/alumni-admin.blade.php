<x-admin-layout>
    <div class="overflow-x-auto">
        <div class="mb-4 flex flex-wrap justify-between">
            <div class="mb-4 w-full space-y-4 md:flex md:items-center md:justify-between md:space-y-0">
                <div>
                    <a href="{{ route('alumni.create') }}"
                        class="inline-flex items-center justify-center rounded-full bg-blue-600 px-4 py-2 font-semibold text-white transition duration-300 ease-out hover:bg-blue-700">
                        Tambah Alumni
                    </a>
                </div>
                <div class="mb-2 w-full md:mb-0 md:w-auto">
                    <form action="{{ route('alumni.admin') }}" method="GET" class="w-full sm:w-auto">
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            class="w-full rounded-full border px-4 py-2 dark:bg-gray-700 dark:text-white md:w-auto"
                            placeholder="Cari berdasarkan nama...">
                        @if (request('search'))
                            <a href="{{ route('alumni.admin') }}"
                                class="inline-flex items-center justify-center rounded-full bg-black/30 px-4 py-2 font-semibold text-white transition duration-300 ease-out hover:bg-black/70 dark:bg-red-600 dark:hover:bg-red-800">
                                X
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        @if ($alumni->isEmpty())
            <div class="py-4 text-center text-gray-500">
                Tidak ada hasil yang ditemukan.
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Foto
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Nama
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Jurusan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Angkatan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Tempat Bekerja
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Pekerjaan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($alumni as $lulusan)
                        <tr>
                            <td class="whitespace-nowrap px-2 py-4">
                                @if ($lulusan->gambar && file_exists(public_path('assets/images/alumni/' . $lulusan->gambar)))
                                    <img src="{{ asset('assets/images/alumni/' . $lulusan->gambar) }}"
                                    alt="{{ $lulusan->nama }}" class="h-24 w-20 rounded-md object-cover">
                                @else
                                    <img src="{{ asset('assets/images/image.jpg') }}"
                                        alt="{{ $lulusan->nama }}" class="h-20 w-20 rounded-md object-cover">
                                @endif
                            </td>
                            <td class="text-wrap whitespace-nowrap px-6 py-4">
                                {{ $lulusan->nama }}
                            </td>
                            <td class="text-wrap whitespace-nowrap px-6 py-4">
                                {{ $lulusan->jurusan }}
                            </td>
                            <td class="text-wrap whitespace-nowrap px-6 py-4">
                                {{ $lulusan->angkatan }}
                            </td>
                            <td class="text-wrap whitespace-nowrap px-6 py-4">
                                {{ $lulusan->tempat_bekerja }}
                            </td>
                            <td class="text-wrap whitespace-nowrap px-6 py-4">
                                {{ $lulusan->pekerjaan }}
                            </td>
                            <td class="text-wrap whitespace-nowrap px-6 py-4 text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('alumni.edit', $lulusan->id) }}"
                                        class="text-indigo-600 transition-colors duration-200 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-500">Edit</a>
                                    <form action="{{ route('alumni.destroy', $lulusan->id) }}" method="POST"
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
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
</x-admin-layout>
