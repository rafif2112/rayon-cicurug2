<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Kegiatan</h1>
            <a href="{{ route('kegiatan.create') }}"
                class="transform rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white transition duration-200 hover:bg-blue-700 hover:shadow-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
            </a>
        </div>

        @if ($kegiatan->isEmpty())
            <div class="flex h-64 items-center justify-center rounded-lg bg-gray-50">
                <p class="text-lg text-gray-500">Belum ada data kegiatan yang tersedia.</p>
            </div>
        @else
            <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($kegiatan as $index => $data)
                    <div
                        class="transform overflow-hidden rounded-xl bg-white shadow-lg transition duration-300 hover:shadow-xl">
                        <div class="relative">
                            <img class="h-64 w-full cursor-pointer object-cover"
                                src="{{ asset('assets/images/kegiatan/' . $data->gambar) }}" alt="Kegiatan Image"
                                onclick="openModal(this)">
                            <!-- Options Button -->
                            <div class="absolute right-4 top-4">
                                <button
                                    class="rounded-full bg-white/80 p-2 backdrop-blur-sm transition duration-200 hover:bg-white"
                                    onclick="toggleOptions(event, this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-700" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                                <div
                                    class="dropdown-menu absolute right-0 z-10 hidden min-w-[160px] rounded-lg bg-white p-2 shadow-xl">
                                    <a href="{{ route('kegiatan.edit', $data->id) }}"
                                        class="flex items-center rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('kegiatan.destroy', $data->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="delete-button flex w-full items-center rounded-md px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h2 class="mb-3 text-xl font-bold text-gray-800">{{ $data->judul }}</h2>
                            <p class="text-gray-600">{{ Str::limit($data->deskripsi, 150) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Enhanced Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 p-5">
        <button onclick="closeModal()" class="absolute right-6 top-6 text-white hover:text-gray-300">
            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img id="modalImage" class="max-h-[90vh] max-w-[90vw] rounded-lg opacity-0 transition-opacity duration-300">
    </div>

    <script>
        function toggleOptions(event, button) {
            event.stopPropagation();
            const dropdownMenu = button.nextElementSibling;
            dropdownMenu.classList.toggle('hidden');

            // Close other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.add('hidden');
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

        function openModal(img) {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modalImg.src = img.src;
            setTimeout(() => modalImg.classList.add('opacity-100'), 100);
        }

        function closeModal() {
            const modal = document.getElementById('lightboxModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
    </script>

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
