<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <div class="container mx-auto py-12">
        <div class="container mx-auto mb-10 w-11/12 md:w-4/5 border-b-2 border-black pb-5 dark:border-gray-700">
            <div class="mb-6 flex items-center gap-4">
                <ion-icon class="text-4xl md:text-5xl" src="{{ asset('assets/images/icon/people.svg') }}"></ion-icon>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100" id="dokumentasi">Alumni</h2>
            </div>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Alumni Rayon Cicurug 2</p>
        </div>

        <div class="flex items-center justify-center">

            @if ($alumni->isEmpty())
                <div class="col-span-2 flex flex-col items-center justify-center pb-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 h-24 w-24 text-gray-400 dark:text-gray-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">Tidak ada data alumni</h3>
                    <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir data alumni terbaru</p>
                </div>
            @else
                <div class="grid w-3/4 sm:w-4/5 grid-cols-1 sm:grid-cols-2 gap-6 lg:grid-cols-3">
                    @foreach ($alumni as $lulusan)
                        <div class="group overflow-hidden rounded-xl bg-white shadow-lg transition-all duration-300 hover:shadow-2xl dark:bg-gray-800">
                            <div class="relative overflow-hidden">
                                @if ($lulusan->gambar && if_exists(public_path('assets/images/alumni/' . $lulusan->gambar)))
                                    <img src="{{ asset('assets/images/alumni/' . $lulusan->gambar) }}" alt="Alumni {{ $lulusan->nama }}"
                                    class="h-64 w-full transform object-cover transition-transform duration-300 group-hover:scale-105 lg:h-80">
                                @else
                                    <img src="{{ asset('assets/images/image.jpg') }}" alt="Alumni {{ $lulusan->nama }}"
                                    class="h-64 w-full transform object-cover transition-transform duration-300 group-hover:scale-105 lg:h-80">
                                @endif
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                                    <h2 class="text-2xl font-bold text-white">{{ $lulusan->nama }}</h2>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="mb-4 space-y-2">
                                    <div class="flex items-center gap-2">
                                        <ion-icon class="text-blue-500" name="school-outline"></ion-icon>
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="font-semibold">Angkatan:</span> {{ $lulusan->angkatan }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <ion-icon class="text-blue-500" name="book-outline"></ion-icon>
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="font-semibold">Jurusan:</span> {{ $lulusan->jurusan }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <ion-icon class="text-blue-500" name="business-outline"></ion-icon>
                                        <p class="text-gray-600 dark:text-gray-300">
                                            <span class="font-semibold">Tempat Bekerja:</span> {{ $lulusan->tempat_bekerja }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 rounded-lg bg-blue-50 p-2 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                                    <ion-icon name="briefcase-outline"></ion-icon>
                                    <span class="font-medium">{{ $lulusan->pekerjaan }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-layout>
