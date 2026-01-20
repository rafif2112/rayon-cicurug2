<x-siswa-layout>
    <div class="min-h-screen">
        <!-- Header -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 p-4 shadow-sm mb-4">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -top-4 -right-4 h-24 w-24 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-4 -left-4 h-32 w-32 rounded-full bg-white/5"></div>
            <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                <h1 class="text-2xl font-bold text-white">Edit Profil</h1>
                </div>
                <a href="{{ route('siswa.dashboard') }}" 
                   class="bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-xl hover:bg-white/30 transition-all duration-300 font-semibold flex items-center space-x-2">
                <ion-icon name="arrow-back-outline"></ion-icon>
                <span>Kembali</span>
                </a>
            </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
            <!-- Form Edit Profil -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('siswa.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <!-- Form Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="person-outline" class="mr-2"></ion-icon>
                                    Nama Lengkap
                                </label>
                                <input type="text" value="{{ $data->nama }}" readonly
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-100 text-gray-500">
                            </div>

                            <!-- Username -->
                            <div class="md:col-span-2">
                                <label for="username" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="person-outline" class="mr-2"></ion-icon>
                                    Username
                                </label>
                                <input type="text" name="username" id="username" value="{{ old('username', $data->user->username) }}" required
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-gray-50 focus:bg-white">
                                @error('username')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="mail-outline" class="mr-2"></ion-icon>
                                    Email
                                </label>
                                <input type="email" name="email" id="email" value="{{ old('email', $data->user->email) }}" required
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-gray-50 focus:bg-white">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIS -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="card-outline" class="mr-2"></ion-icon>
                                    NIS
                                </label>
                                <input type="text" value="{{ $data->nis }}" readonly
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-100 text-gray-500">
                            </div>

                            <!-- Kelas -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="school-outline" class="mr-2"></ion-icon>
                                    Kelas
                                </label>
                                <input type="text" value="{{ $data->kelas }}" readonly
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-100 text-gray-500">
                            </div>

                            <!-- Jurusan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="library-outline" class="mr-2"></ion-icon>
                                    Jurusan
                                </label>
                                <input type="text" value="{{ $data->jurusan }}" readonly
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-gray-100 text-gray-500">
                            </div>

                            <!-- Link Portofolio -->
                            <div class="md:col-span-2">
                                <label for="link" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="link-outline" class="mr-2"></ion-icon>
                                    Link Portofolio
                                </label>
                                <input type="url" name="link" id="link" value="{{ old('link', $data->link) }}"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-gray-50 focus:bg-white"
                                    placeholder="https://drive.google.com/">
                                @error('link')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Google Maps Link -->
                            <div class="md:col-span-2">
                                <label for="google_maps_link" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <ion-icon name="location-outline" class="mr-2"></ion-icon>
                                    Google Maps Link
                                </label>
                                <input type="text" id="google_maps_link" name="google_maps_link"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 bg-gray-50 focus:bg-white"
                                    placeholder="Paste Google Maps link here">
                                <input type="hidden" id="latitude" name="latitude">
                                <input type="hidden" id="longitude" name="longitude">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-6 rounded-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-bold shadow-lg ">
                            <ion-icon name="save-outline" class="mr-1"></ion-icon>
                            Simpan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Form Ubah Password -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('siswa.password.change') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <ion-icon name="key-outline" class="mr-2"></ion-icon>
                                Password Lama
                            </label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password" required
                                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/20 transition-all duration-300 bg-gray-50 focus:bg-white">
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('current_password')">
                                    <ion-icon name="eye-outline" id="current_password_icon"></ion-icon>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <ion-icon name="key-outline" class="mr-2"></ion-icon>
                                Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password" id="new_password" required
                                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/20 transition-all duration-300 bg-gray-50 focus:bg-white">
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('new_password')">
                                    <ion-icon name="eye-outline" id="new_password_icon"></ion-icon>
                                </button>
                            </div>
                            @error('new_password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="new_password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <ion-icon name="checkmark-outline" class="mr-2"></ion-icon>
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                                    class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/20 transition-all duration-300 bg-gray-50 focus:bg-white">
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                        onclick="togglePassword('new_password_confirmation')">
                                    <ion-icon name="eye-outline" id="new_password_confirmation_icon"></ion-icon>
                                </button>
                            </div>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Keamanan Password:</h4>
                            <div class="space-y-2">
                                <div class="flex items-center text-xs">
                                    <div id="length-check" class="w-4 h-4 rounded-full bg-gray-300 mr-2 flex items-center justify-center">
                                        <ion-icon name="checkmark" class="text-white text-xs hidden"></ion-icon>
                                    </div>
                                    <span>Minimal 8 karakter</span>
                                </div>
                                <div class="flex items-center text-xs">
                                    <div id="uppercase-check" class="w-4 h-4 rounded-full bg-gray-300 mr-2 flex items-center justify-center">
                                        <ion-icon name="checkmark" class="text-white text-xs hidden"></ion-icon>
                                    </div>
                                    <span>Mengandung huruf besar</span>
                                </div>
                                <div class="flex items-center text-xs">
                                    <div id="number-check" class="w-4 h-4 rounded-full bg-gray-300 mr-2 flex items-center justify-center">
                                        <ion-icon name="checkmark" class="text-white text-xs hidden"></ion-icon>
                                    </div>
                                    <span>Mengandung angka</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-red-500 text-white py-3 px-6 rounded-xl hover:bg-red-600 transition-all duration-300 font-bold shadow-lg">
                            <ion-icon name="shield-checkmark-outline" class="mr-1"></ion-icon>
                            Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // SweetAlert untuk pesan sukses
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end'
            });
        @endif

        // SweetAlert untuk pesan error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ef4444'
            });
        @endif

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '_icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.name = 'eye-off-outline';
            } else {
                input.type = 'password';
                icon.name = 'eye-outline';
            }
        }

        // Password strength checker
        document.getElementById('new_password').addEventListener('input', function(e) {
            const password = e.target.value;
            
            // Length check
            const lengthCheck = document.getElementById('length-check');
            const lengthIcon = lengthCheck.querySelector('ion-icon');
            if (password.length >= 8) {
                lengthCheck.classList.remove('bg-gray-300');
                lengthCheck.classList.add('bg-green-500');
                lengthIcon.classList.remove('hidden');
            } else {
                lengthCheck.classList.remove('bg-green-500');
                lengthCheck.classList.add('bg-gray-300');
                lengthIcon.classList.add('hidden');
            }
            
            // Uppercase check
            const uppercaseCheck = document.getElementById('uppercase-check');
            const uppercaseIcon = uppercaseCheck.querySelector('ion-icon');
            if (/[A-Z]/.test(password)) {
                uppercaseCheck.classList.remove('bg-gray-300');
                uppercaseCheck.classList.add('bg-green-500');
                uppercaseIcon.classList.remove('hidden');
            } else {
                uppercaseCheck.classList.remove('bg-green-500');
                uppercaseCheck.classList.add('bg-gray-300');
                uppercaseIcon.classList.add('hidden');
            }
            
            // Number check
            const numberCheck = document.getElementById('number-check');
            const numberIcon = numberCheck.querySelector('ion-icon');
            if (/\d/.test(password)) {
                numberCheck.classList.remove('bg-gray-300');
                numberCheck.classList.add('bg-green-500');
                numberIcon.classList.remove('hidden');
            } else {
                numberCheck.classList.remove('bg-green-500');
                numberCheck.classList.add('bg-gray-300');
                numberIcon.classList.add('hidden');
            }
        });

        // Google Maps link parser
        document.querySelector('form').addEventListener('submit', function(event) {
            const link = document.getElementById('google_maps_link').value;
            if (link.trim() !== '') {
                const regex = /@(-?\d+\.\d+),(-?\d+\.\d+)/ || /q=(-?\d+\.\d+),(-?\d+\.\d+)/;
                const match = link.match(regex);
                if (match) {
                    document.getElementById('latitude').value = match[1];
                    document.getElementById('longitude').value = match[2];
                }
            }
        });
    </script>
    @endpush
</x-siswa-layout>