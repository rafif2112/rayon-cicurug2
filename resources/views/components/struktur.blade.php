<section class="bg-gray-50 text-gray-900">
    <div class="py-16 text-gray-900 w-full">
        <div class="container mx-auto w-11/12 sm:w-4/5 mb-10 border-b-2 border-black pb-3">
            <div class="flex items-center gap-4 mb-3">
                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/></svg>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">Struktur Rayon</h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Struktur Rayon Cicurug 2 terdiri dari berbagai posisi penting yang mendukung kegiatan dan perkembangan siswa.</p>
        </div>
        
        <div class="container mx-auto flex flex-col justify-center items-center">
            <div class="flex justify-center mb-6">
                @foreach ($data as $struktur)
                    @if ($struktur['jabatan'] === 'Pembimbing Siswa')
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <img src="assets/images/struktur/{{ $struktur['gambar'] }}" alt="{{$struktur['jabatan']}}" class="w-full h-64 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-semibold mb-1">{{$struktur['jabatan']}}</h3>
                            <p class="text-gray-700">{{$struktur['nama']}}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-4 md:gap-x-20">
                @foreach ($data as $struktur)
                    @if ($struktur['jabatan'] !== 'Pembimbing Siswa')
                        <div class="bg-white p-4 rounded-lg shadow-lg">
                            <img src="assets/images/struktur/{{ $struktur['gambar'] }}" alt="{{$struktur['jabatan']}}" class="w-full h-64 object-cover rounded-t-lg mb-4">
                            <h3 class="text-xl font-semibold mb-1">{{$struktur['jabatan']}}</h3>
                            <p class="text-gray-700">{{$struktur['nama']}}</p>
                        </div>
                    @endif
                @endforeach
            </div>
            
        </div>
    </div>
</section>