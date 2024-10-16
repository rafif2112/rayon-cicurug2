<x-admin-layout>
    <div class="overflow-x-auto">
        <div class="flex justify-end mb-4">
            <a href="{{ route('struktur.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-300">Tambah Data</a>
        </div>
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-5 text-left">Foto</th>
                    <th class="py-3 px-5 text-left">Nama</th>
                    <th class="py-3 px-5 text-left">Posisi</th>
                    <th class="py-3 px-5 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($data->sortByDesc(function($struktur) {
                    return $struktur->jabatan === 'Pembimbing Siswa';
                }) as $struktur)
                <tr class="border-b hover:bg-gray-100 transition duration-300">
                    <td class="py-3 px-5">
                        <img src="{{ asset('assets/images/struktur/'.$struktur->gambar) }}" alt="{{ $struktur->nama }}" class="w-20 h-20 object-cover rounded-full">
                    </td>
                    <td class="py-3 px-5">{{ $struktur->nama }}</td>
                    <td class="py-3 px-5">{{ $struktur->jabatan }}</td>
                    <td class="py-3 px-5 flex space-x-2">
                        <a href="{{ route('struktur.edit', $struktur->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-3 mt-5 rounded transition duration-300">Edit</a>
                        <form action="{{ route('struktur.destroy', $struktur->id) }}" method="POST" class="inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button bg-red-500 hover:bg-red-700 text-white py-1 px-3 mt-5 rounded transition duration-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
    </script>
</x-admin-layout>