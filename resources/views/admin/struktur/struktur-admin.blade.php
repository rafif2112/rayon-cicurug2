<x-admin-layout>
    <div class="overflow-x-auto">
        <div class="mb-4 flex justify-end">
            <a href="{{ route('struktur.create') }}"
                class="rounded-xl bg-blue-500 px-4 py-2 text-white transition duration-300 hover:bg-blue-700">Tambah
                Data</a>
        </div>
        <table class="min-w-full overflow-hidden rounded-lg bg-white shadow-md">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                        Foto</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                        Nama</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                        Posisi</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500 dark:text-gray-300">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @if ($data->isEmpty())
                    <tr>
                        <td colspan="4" class="py-4 text-center">Tidak ada data struktur yang tersedia.</td>
                    </tr>
                @else
                    @foreach ($data as $struktur)
                        <tr class="border-b transition duration-300 hover:bg-gray-100">
                            <td class="px-5 py-3">
                                <img src="{{ $struktur->gambar ? asset('assets/images/struktur/' . $struktur->gambar) : asset('assets/images/image.jpg') }}"
                                     alt="{{ $struktur->nama }}" 
                                     class="h-20 w-20 rounded-md object-cover"
                                     loading="lazy"
                                     onerror="this.src='{{ asset('assets/images/image.jpg') }}'">
                            </td>
                            <td class="px-5 py-3">{{ $struktur->nama }}</td>
                            <td class="px-5 py-3">{{ $struktur->jabatan }}</td>
                            <td class="flex space-x-2 px-5 py-3">
                                <a href="{{ route('struktur.edit', $struktur->id) }}"
                                    class="rounded-xl bg-blue-500 px-3 py-1 text-white transition duration-300 hover:bg-blue-700">Edit</a>
                                <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST"
                                    class="delete-form inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="delete-button rounded-xl bg-red-500 px-3 py-1 text-white transition duration-300 hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    @push('scripts')
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

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif
        });
    </script>
    @endpush
</x-admin-layout>
