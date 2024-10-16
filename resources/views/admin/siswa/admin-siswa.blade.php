<x-admin-layout>
    <div class="overflow-x-auto">
        <div class="flex flex-wrap justify-between mb-4">
            <div class="mb-4 space-y-4 md:space-y-0 md:flex md:items-center md:justify-between w-full">
                <div class="mb-2 w-full md:mb-0 md:w-auto">
                    <input type="text" id="searchInput"
                        class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white md:w-auto"
                        placeholder="Cari berdasarkan nama..." oninput="search()">
                </div>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                    <select id="kelasDropdown" class="w-full sm:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        <option value="all">Semua Kelas</option>
                        <option value="10">Kelas 10</option>
                        <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option>
                        @if ($hasAlumni)
                            <option value="alumni">Alumni</option>
                        @endif
                    </select>
                    <a href="{{ route('siswa.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out dark:bg-blue-600 dark:hover:bg-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Data
                    </a>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            NIS
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Jurusan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @foreach ($siswa as $murid)
                        <tr data-category="{{ $murid->kelas }}" class="{{ $murid->kelas !== 'alumni' || ($murid->kelas === 'alumni' && $kelasDropdown === 'alumni') ? '' : 'hidden' }} hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-24 w-20">
                                        <img class="h-24 w-20 rounded-lg object-cover" src="{{ asset('assets/images/siswa/' . $murid->gambar) }}" alt="{{ $murid->nama }}">
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                                    {{ $murid->kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $murid->nama }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-300">{{ $murid->nis }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-300">{{ $murid->jurusan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('siswa.edit', $murid->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-500 transition-colors duration-200">Edit</a>
                                    <form action="{{ route('siswa.destroy', $murid->id) }}" method="POST" class="inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-500 transition-colors duration-200 delete-button">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                td = tr[i].getElementsByTagName("td")[2];
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

        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.getElementById('kelasDropdown');
            const rows = document.querySelectorAll('tbody tr');

            dropdown.addEventListener('change', function() {
                const selectedCategory = dropdown.value;
                rows.forEach(row => {
                    if (selectedCategory === 'all' || row.getAttribute('data-category') === selectedCategory) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            const groupedRows = {};
            rows.forEach(row => {
                const category = row.getAttribute('data-category');
                if (!groupedRows[category]) {
                    groupedRows[category] = [];
                }
                groupedRows[category].push(row);
            });

            Object.keys(groupedRows).forEach(category => {
                groupedRows[category].sort((a, b) => {
                    const nameA = a.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const nameB = b.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            });

            const tbody = document.querySelector('tbody');
            tbody.innerHTML = ''; // Clear existing rows
            Object.keys(groupedRows).forEach(category => {
                groupedRows[category].forEach(row => tbody.appendChild(row));
            });

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
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-admin-layout>
