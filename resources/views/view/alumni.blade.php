<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <div class="container mx-auto py-12">
        <div class="container mx-auto mb-10 w-11/12 border-b-2 border-black pb-5 dark:border-gray-700 sm:w-4/5">
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
                <div class="grid w-10/12 grid-cols-1 gap-8 sm:w-3/4 sm:grid-cols-2">
                    @foreach ($alumni as $lulusan)
                        <div class="overflow-hidden rounded-lg bg-white shadow-lg">
                            <img src="{{ asset('storage/images/alumni/' . $lulusan->gambar) }}" alt="Alumni 1"
                                class="h-64 w-full object-cover lg:h-80">
                            <div class="p-6">
                                <h2 class="mb-2 text-2xl font-semibold text-gray-800">{{ $lulusan->nama }}</h2>
                                <p class="mb-4 text-gray-600">
                                    <span class="font-medium">Angkatan :</span> {{ $lulusan->angkatan }}<br>
                                    <span class="font-medium">Jurusan :</span> {{ $lulusan->jurusan }}<br>
                                    <span class="font-medium">Tempat Bekerja :</span> {{ $lulusan->tempat_bekerja }}<br>
                                </p>
                                <div class="flex items-center text-blue-500">
                                    <ion-icon class="mr-2" name="briefcase-outline"></ion-icon>
                                    <span>{{ $lulusan->pekerjaan }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-layout>
