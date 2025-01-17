<x-admin-layout>
    <a href="{{ route('galeri.create') }}"
        class="rounded-lg bg-blue-500 px-4 py-2 text-white transition hover:bg-blue-600">Tambah Gambar
    </a>
    <div class="mt-5 flex w-full items-center justify-center">
        <div class="flex flex-wrap gap-4">
            @if ($gambar->isEmpty())
                <div class="flex h-64 items-center justify-center rounded-lg">
                    <p class="text-lg text-gray-500">Belum ada data galeri yang tersedia.</p>
                </div>
            @else
                @foreach ($gambar as $image)
                    <div class="relative flex justify-center">
                        <div class="relative">
                            @if ($image->image && file_exists(public_path('assets/images/galeri/' . $image->image)))
                                <img src="{{ asset('assets/images/galeri/' . $image->gambar) }}" alt="Image"
                                class="h-80 w-96 max-w-md cursor-pointer rounded-lg object-cover duration-300"
                                onclick="openModal(this)">
                            @else
                                <img src="{{ asset('assets/images/image.jpg') }}" alt="Image"
                                class="h-80 w-96 max-w-md cursor-pointer rounded-lg object-cover duration-300"
                                onclick="openModal(this)">
                            @endif
                            <div class="absolute right-2 top-2">
                                <ion-icon class="cursor-pointer rounded-full bg-black/50 p-1 text-3xl text-white/80"
                                    src="{{ asset('assets/images/icon/ellipsis-vertical-outline.svg') }}"
                                    onclick="toggleOptions(event, this)"></ion-icon>
                                <div
                                    class="dropdown-menu absolute right-0 hidden min-w-[100px] flex-col rounded-lg bg-white p-2 shadow-lg">
                                    <a href="{{ route('galeri.edit', $image->id) }}"
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                    <form action="{{ route('galeri.destroy', $image->id) }}" method="POST"
                                        class="delete-form block w-full text-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-button w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
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

        document.addEventListener('click', function(event) {
            var isClickInsideDropdown = event.target.closest('.dropdown-menu, ion-icon');
            if (!isClickInsideDropdown) {
                var allDropdowns = document.querySelectorAll('.dropdown-menu');
                allDropdowns.forEach(function(dropdown) {
                    dropdown.classList.add('hidden');
                });
            }
        });
    </script>

    <!-- Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-75 p-5">
        <span class="absolute right-5 top-5 cursor-pointer text-4xl text-white" onclick="closeModal()">&times;</span>
        <img id="modalImage" class="max-h-full max-w-full opacity-0 transition-opacity duration-300 ease-in-out">
    </div>

    <script>
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
