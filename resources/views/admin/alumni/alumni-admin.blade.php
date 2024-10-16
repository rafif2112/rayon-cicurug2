<x-admin-layout>
    <div class="min-h-screen bg-gray-100">
        <div class="container mx-auto">
            <div class="flex items-center justify-between mb-6">
                <a href="{{ route('alumni.create') }}"
                    class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-700">
                    + Add Alumni
                </a>
                <div class="w-full mb-2 md:mb-0 md:w-auto">
                    <input type="text" id="searchInput"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white md:w-auto"
                        placeholder="Cari berdasarkan nama..." oninput="search()">
                </div>
            </div>

            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <table class="w-full">
                    <thead>
                        <tr class="text-gray-700 bg-gray-200">
                            <th class="px-4 py-3 text-left">Gambar</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Jurusan</th>
                            <th class="px-4 py-3 text-left">Angkatan</th>
                            <th class="px-4 py-3 text-left">Tempat Bekerja</th>
                            <th class="px-4 py-3 text-left">Pekerjaan</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($alumni->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada data alumni.</td>
                            </tr>
                        @else
                        @foreach ($alumni as $lulusan)
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-3">
                                    <img src="{{ asset('assets/images/alumni/' . $lulusan->gambar) }}" alt="Gambar"
                                        class="object-cover w-20 h-20">
                                </td>
                                <td class="px-4 py-3">{{ $lulusan->nama }}</td>
                                <td class="px-4 py-3">{{ $lulusan->jurusan }}</td>
                                <td class="px-4 py-3">{{ $lulusan->angkatan }}</td>
                                <td class="px-4 py-3">{{ $lulusan->tempat_bekerja }}</td>
                                <td class="px-4 py-3">{{ $lulusan->pekerjaan }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('alumni.edit', $lulusan->id) }}"
                                            class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out transform bg-blue-500 rounded-full shadow-lg hover:bg-blue-600 hover:scale-105">
                                            Edit
                                        </a>
                                        <form action="{{ route('alumni.destroy', $lulusan->id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 font-bold text-white transition duration-300 ease-in-out transform bg-red-500 rounded-full shadow-lg hover:bg-red-600 hover:scale-105 delete-button">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function search() {
            let input, filter, table, tr, td, i, txtValue, noResult;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");
            noResult = true;
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        noResult = false;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
            if (noResult) {
                if (!document.getElementById("noResultMessage")) {
                    let noResultMessage = document.createElement("div");
                    noResultMessage.id = "noResultMessage";
                    noResultMessage.className = "text-center py-4 text-gray-500";
                    noResultMessage.innerText = "Tidak ada hasil yang ditemukan.";
                    table.parentNode.insertBefore(noResultMessage, table.nextSibling);
                }
            } else {
                let noResultMessage = document.getElementById("noResultMessage");
                if (noResultMessage) {
                    noResultMessage.remove();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function (event) {
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
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-admin-layout>
