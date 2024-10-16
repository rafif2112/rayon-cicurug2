<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>
    <section class="flex flex-col items-center justify-center">

        <div class="w-11/12 sm:w-4/5 mt-10">
            <div class="container mx-auto mb-10 w-full border-b-2 border-black/80 pb-3">
                <div class="mb-3 flex items-center gap-2">
                    <ion-icon class="text-3xl" name="stats-chart-outline"></ion-icon>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-3xl" id="dokumentasi">Kegiatan</h2>
                </div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Lihat Dokumentasi Kegiatan Rayon Cicurug 2.</p>
            </div>
        </div>

        <div class="w-11/12 sm:w-4/5">
            @if ($kegiatan->isEmpty())
                <div class="col-span-2 flex flex-col items-center justify-center p-12 text-center">
                    <ion-icon class="text-[90px] text-gray-400" src="{{asset('assets/images/icon/camera-outline.svg')}}"></ion-icon>
                    <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">belum ada postingan kegiatan saat ini</h3>
                    <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir kegiatan terbaru</p>
                </div>
            @else
            @foreach ($kegiatan as $index => $item)
                @if ($index % 2 == 0)
                    <div class="flex flex-col sm:flex-row justify-center items-center mb-10 bg-white shadow-xl rounded-lg overflow-hidden">
                        <img class="w-full sm:w-2/5 h-80 object-cover" src="{{ asset('assets/images/kegiatan/' . $item->gambar) }}" alt="Kegiatan Image">
                        <div class="p-6 md:w-3/5">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{$item->judul}}</h1>
                            <p class="text-gray-700 dark:text-gray-300">{{$item->deskripsi}}</p>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col-reverse sm:flex-row justify-center items-center mb-10 bg-white shadow-xl rounded-lg overflow-hidden">
                        <div class="p-6 md:w-3/5">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{$item->judul}}</h1>
                            <p class="text-gray-700 dark:text-gray-300 mb-4 sm:mb-0 sm:mr-4">{{$item->deskripsi}}</p>
                        </div>
                        <img class="w-full sm:w-2/5 h-80 object-cover" src="{{ asset('assets/images/kegiatan/'.$item->gambar) }}" alt="Kegiatan Image">
                    </div>
                @endif
            @endforeach
            @endif
        </div>

    </section>
</x-layout>