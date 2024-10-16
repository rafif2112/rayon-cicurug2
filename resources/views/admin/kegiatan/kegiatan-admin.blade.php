<x-admin-layout>
    <div class="flex justify-center items-center">
        <div class="w-full">
            <div class="mb-4">
                <a href="{{ route('kegiatan.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Tambah Data
                </a>
            </div>
            @if ($kegiatan->isEmpty())
                <p class="text-center text-gray-500">Tidak ada data kegiatan.</p>
            @else
                <!-- Your existing code for displaying kegiatan data goes here -->
                @foreach ($kegiatan as $index => $data)
                <div class="relative flex flex-col sm:flex-row justify-center items-center mb-10 bg-white shadow-lg rounded-lg overflow-hidden">
                    <img class="w-full sm:w-2/5 h-72 object-cover cursor-pointer" src="{{ asset('assets/images/kegiatan/' . $data->gambar) }}" alt="Kegiatan Image" onclick="openModal(this)">
                    <div class="p-6 md:w-3/5">
                        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{$data->judul}}</h1>
                        <p class="text-gray-700 dark:text-gray-300">{{$data->deskripsi}}</p>
                    </div>
                    <div class="absolute right-2 top-2">
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-1 px-2 rounded-full" onclick="toggleOptions(event, this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM4 12v4h4l10-10-4-4L4 12z" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-menu absolute right-0 hidden min-w-[100px] flex-col rounded-lg bg-white p-2 shadow-lg">
                            <a href="{{ route('kegiatan.edit', $data->id) }}"
                                class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                            <form action="{{ route('kegiatan.destroy', $data->id) }}" method="POST"
                                class="block w-full text-left delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 delete-button">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-75 p-5"
        style="z-index: 100">
        <span class="absolute right-5 top-5 cursor-pointer text-4xl text-white" onclick="closeModal()">&times;</span>
        <img id="modalImage" class="max-h-full max-w-full opacity-0 transition-opacity duration-300 ease-in-out">
    </div>

    <script>
        document.addEventListener('click', function(event) {
            var allDropdowns = document.querySelectorAll('.dropdown-menu');
            allDropdowns.forEach(function(dropdown) {
            dropdown.classList.add('hidden');
            });
        });

        function toggleOptions(event, button) {
            event.stopPropagation(); // Prevent event bubbling
            var options = button.nextElementSibling;
            var allDropdowns = document.querySelectorAll('.dropdown-menu');

            allDropdowns.forEach(function(dropdown) {
            if (dropdown !== options) {
                dropdown.classList.add('hidden');
            }
            });

            options.classList.toggle('hidden');
        }

        document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
            menu.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent closing when clicking inside the menu
            });
        });

        // Open modal and show image
        function openModal(element) {
            var modal = document.getElementById("lightboxModal");
            var modalImage = document.getElementById("modalImage");
            modalImage.src = element.src;
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            setTimeout(function() {
                modalImage.classList.remove("opacity-0");
            }, 10); // Small delay to trigger the transition
        }

        // Close modal
        function closeModal() {
            var modal = document.getElementById("lightboxModal");
            var modalImage = document.getElementById("modalImage");
            modalImage.classList.add("opacity-0");
            setTimeout(function() {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }, 200); // Wait for the transition to complete
        }
    </script>
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
