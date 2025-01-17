<section class="bg-gray-50 text-gray-900">
    <div class="w-full py-16 text-gray-900">
        <div class="container mx-auto mb-10 w-11/12 border-b-2 border-black pb-3 sm:w-4/5">
            <div class="mb-3 flex items-center gap-4">
                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path
                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                </svg>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white md:text-4xl" id="dokumentasi">Struktur Rayon
                </h2>
            </div>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Struktur Rayon Cicurug 2 terdiri dari berbagai posisi
                penting yang mendukung kegiatan dan perkembangan siswa.</p>
        </div>

        <div class="container mx-auto flex flex-col items-center justify-center">
            @if ($data->isEmpty())
                <div class="col-span-2 flex flex-col items-center justify-center p-12 text-center">
                    <ion-icon class="text-[90px] text-gray-400" name="people-outline"></ion-icon>
                    <h3 class="text-2xl font-semibold text-gray-400 dark:text-white">belum ada struktur rayon saat ini
                    </h3>
                    <p class="mt-2 text-gray-400 dark:text-gray-400">Segera hadir struktur rayon terbaru</p>
                </div>
            @else
                <div class="mb-6 flex justify-center">
                    @foreach ($data as $struktur)
                        @if ($struktur['jabatan'] === 'Pembimbing Siswa')
                            <div class="rounded-lg bg-white p-4 shadow-lg">
                                @if ($struktur['gambar'] && file_exists(public_path('assets/images/struktur/' . $struktur['gambar'])))
                                    <img src="{{ asset('assets/images/struktur/' . $struktur['gambar']) }}"
                                        alt="{{ $struktur['jabatan'] }}"
                                        class="mb-4 h-64 w-full rounded-t-lg object-cover">
                                @else
                                    <img src="{{ asset('assets/images/image.jpg') }}" alt="{{ $struktur['jabatan'] }}"
                                        class="mb-4 h-64 w-full rounded-t-lg object-cover">
                                @endif
                                <h3 class="mb-1 text-xl font-semibold">{{ $struktur['jabatan'] }}</h3>
                                <p class="text-gray-700">{{ $struktur['nama'] }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                @php
                    $sortedData = collect($data)->sortBy(function ($item) {
                        $order = [
                            'Ketua Rayon' => 1,
                            'Wakil Ketua Rayon' => 2,
                            'Bendahara 1' => 3,
                            'Bendahara' => 3,
                            'Sekertaris 1' => 4,
                            'Sekertaris' => 4,
                            'Bendahara 2' => 5,
                            'Sekertaris 2' => 6,
                        ];
                        return $order[$item['jabatan']] ?? 999;
                    });
                @endphp

                <div class="grid grid-cols-1 gap-x-4 gap-y-6 md:grid-cols-2 md:gap-x-20 lg:grid-cols-3">
                    @foreach ($sortedData as $struktur)
                        @if ($struktur['jabatan'] !== 'Pembimbing Siswa')
                            <div class="rounded-lg bg-white p-4 shadow-lg">
                                @if ($struktur['gambar'] && file_exists(public_path('assets/images/struktur/' . $struktur['gambar'])))
                                    <img src="{{ asset('assets/images/struktur/' . $struktur['gambar']) }}"
                                        alt="{{ $struktur['jabatan'] }}"
                                        class="mb-4 h-64 w-full rounded-t-lg object-cover">
                                @else
                                    <img src="{{ asset('assets/images/image.jpg') }}" alt="{{ $struktur['jabatan'] }}"
                                        class="mb-4 h-64 w-full rounded-t-lg object-cover">
                                @endif
                                <h3 class="mb-1 text-xl font-semibold">{{ $struktur['jabatan'] }}</h3>
                                <p class="text-gray-700">{{ $struktur['nama'] }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
