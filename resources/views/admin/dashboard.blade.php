<x-admin-layout>
    <!-- Main content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                <div class="bg-indigo-600 dark:bg-gray-800 rounded-lg shadow-lg p-6 flex items-center transition duration-300 transform">
                    <div class="p-3 rounded-full bg-white">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-2xl font-semibold text-white dark:text-gray-200">{{ $totalSiswa }}</h4>
                        <div class="text-white">Total Siswa</div>
                    </div>
                </div>

                <div class="bg-orange-500 dark:bg-gray-800 rounded-lg shadow-lg p-6 flex items-center transition duration-300 transform">
                    <div class="p-3 rounded-full bg-white">
                        <svg class="h-8 w-8 text-orange-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zm-11-1l-4-4h3V9h2v5h3l-4 4zm6-6h-2V7h2v5z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-2xl font-semibold text-white">{{ $totalGaleri }}</h4>
                        <div class="text-white">Total Galeri</div>
                    </div>
                </div>

                <div class="bg-pink-600 dark:bg-gray-800 rounded-lg shadow-lg p-6 flex items-center transition duration-300 transform">
                    <div class="p-3 rounded-full bg-white">
                        <svg class="h-8 w-8 text-pink-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-2xl font-semibold text-white">{{ $totalKegiatan }}</h4>
                        <div class="text-white">Total Kegiatan</div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-medium text-gray-700 dark:text-gray-200">Statistik Kelas</h3>
                    <form id="upgrade-form" action="{{route('upgrade')}}" method="POST" class="flex items-center">
                        @csrf
                        <button type="button" onclick="confirmUpgrade()" class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-colors duration-200">
                            Naikkan Semua Kelas
                        </button>
                    </form>
                </div>

                <div class="flex flex-col mt-8">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 dark:border-gray-700">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kelas</th>
                                        <th class="px-6 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-left text-xs leading-4 font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Siswa</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                            <div class="text-sm leading-5 font-medium text-gray-900 dark:text-white">Kelas 10</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                            <div class="text-sm leading-5 text-gray-900 dark:text-white">{{ $totalKelas10 }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                            <div class="text-sm leading-5 font-medium text-gray-900 dark:text-white">Kelas 11</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                            <div class="text-sm leading-5 text-gray-900 dark:text-white">{{ $totalKelas11 }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                            <div class="text-sm leading-5 font-medium text-gray-900 dark:text-white">Kelas 12</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                            <div class="text-sm leading-5 text-gray-900 dark:text-white">{{ $totalKelas12 }}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmUpgrade() {
            Swal.fire({
                title: 'Yakin ingin menaikkan semua kelas?',
                text: "Tindakan ini akan mempengaruhi semua data siswa.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, naikkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('upgrade-form').submit();
                }
            });
        }
    </script>
</x-admin-layout>
