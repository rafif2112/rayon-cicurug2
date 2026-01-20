<x-siswa-layout>
    <div class="min-h-screen">
        <!-- Welcome Header -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-8 shadow-lg mb-4">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute -top-4 -right-4 h-24 w-24 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-4 -left-4 h-32 w-32 rounded-full bg-white/5"></div>
            <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ $data->nama }}! 👋</h1>
                <p class="text-blue-100 text-lg">{{ $data->kelas }} - {{ $data->jurusan }}</p>
                </div>
                <div class="hidden md:block">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                    <ion-icon name="school" class="text-3xl text-white"></ion-icon>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-2xl shadow border overflow-hidden">
            <!-- Content -->
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Akademik</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                        <div class="flex items-center mb-2">
                            <ion-icon name="library" class="text-blue-600 text-xl mr-2"></ion-icon>
                            <label class="text-sm font-medium text-blue-700">Kelas</label>
                        </div>
                        <p class="font-bold text-black text-lg">{{ $data->kelas }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                        <div class="flex items-center mb-2">
                            <ion-icon name="code-slash" class="text-purple-600 text-xl mr-2"></ion-icon>
                            <label class="text-sm font-medium text-purple-700">Jurusan</label>
                        </div>
                        <p class="font-bold text-black text-lg">{{ $data->jurusan }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border border-green-200">
                        <div class="flex items-center mb-2">
                            <ion-icon name="calendar" class="text-green-600 text-xl mr-2"></ion-icon>
                            <label class="text-sm font-medium text-green-700">Angkatan</label>
                        </div>
                        <p class="font-bold text-black text-lg">{{ $data->angkatan }}</p>
                    </div>
                </div>

                {{-- @if($data->siswa->link)
                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 p-4 rounded-xl border border-orange-200 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <ion-icon name="briefcase" class="text-orange-600 text-xl mr-3"></ion-icon>
                            <div>
                                <label class="text-sm font-medium text-orange-700">Portofolio</label>
                                <p class="text-orange-600 text-sm">Showcase karya dan project</p>
                            </div>
                        </div>
                        <a href="{{ $data->siswa->link }}" target="_blank" 
                           class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center space-x-2">
                            <span>Lihat</span>
                            <ion-icon name="open" class="text-sm"></ion-icon>
                        </a>
                    </div>
                </div>
                @endif --}}
            </div>
        </div>
    </div>
</x-siswa-layout>