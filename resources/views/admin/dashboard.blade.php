<x-admin-layout>
    <!-- Main content -->
    <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
                <div
                    class="flex transform items-center rounded-lg bg-indigo-600 p-6 shadow-lg transition duration-300 dark:bg-gray-800">
                    <div class="rounded-full bg-white p-3">
                        <svg class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                                fill="currentColor" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-2xl font-semibold text-white dark:text-gray-200">{{ $totalSiswa }}</h4>
                        <div class="text-white">Total Siswa</div>
                    </div>
                </div>

                <div
                    class="flex transform items-center rounded-lg bg-orange-500 p-6 shadow-lg transition duration-300 dark:bg-gray-800">
                    <div class="rounded-full bg-white p-3">
                        <svg class="h-8 w-8 text-orange-500" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zm-11-1l-4-4h3V9h2v5h3l-4 4zm6-6h-2V7h2v5z"
                                fill="currentColor" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-2xl font-semibold text-white">{{ $totalGaleri }}</h4>
                        <div class="text-white">Total Galeri</div>
                    </div>
                </div>

                <div
                    class="flex transform items-center rounded-lg bg-pink-600 p-6 shadow-lg transition duration-300 dark:bg-gray-800">
                    <div class="rounded-full bg-white p-3">
                        <svg class="h-8 w-8 text-pink-600" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"
                                fill="currentColor" />
                        </svg>
                    </div>
                    <div class="ml-5">
                        <h4 class="text-2xl font-semibold text-white">{{ $totalKegiatan }}</h4>
                        <div class="text-white">Total Kegiatan</div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-2xl font-medium text-gray-700 dark:text-gray-200">Statistik Kelas</h3>
                    <form id="upgrade-form" action="{{ route('upgrade') }}" method="POST" class="flex items-center">
                        @csrf
                        <button type="button" onclick="confirmUpgrade()"
                            class="rounded-lg bg-blue-600 px-4 py-2 font-medium text-white transition-colors duration-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Naikkan Semua Kelas
                        </button>
                    </form>
                </div>

                <div class="mt-8 flex flex-col">
                    <div class="-my-2 overflow-x-auto py-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div
                            class="inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow dark:border-gray-700 sm:rounded-lg">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th
                                            class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                            Kelas</th>
                                        <th
                                            class="border-b border-gray-200 bg-gray-50 px-6 py-3 text-left text-xs font-medium uppercase leading-4 tracking-wider text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                            Total Siswa</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-900">
                                    <tr>
                                        <td
                                            class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                                            <div class="text-sm font-medium leading-5 text-gray-900 dark:text-white">
                                                Kelas 10</div>
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                                            <div class="text-sm leading-5 text-gray-900 dark:text-white">
                                                {{ $totalKelas10 }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                                            <div class="text-sm font-medium leading-5 text-gray-900 dark:text-white">
                                                Kelas 11</div>
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                                            <div class="text-sm leading-5 text-gray-900 dark:text-white">
                                                {{ $totalKelas11 }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                                            <div class="text-sm font-medium leading-5 text-gray-900 dark:text-white">
                                                Kelas 12</div>
                                        </td>
                                        <td
                                            class="whitespace-no-wrap border-b border-gray-200 px-6 py-4 dark:border-gray-700">
                                            <div class="text-sm leading-5 text-gray-900 dark:text-white">
                                                {{ $totalKelas12 }}</div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

</x-admin-layout>
