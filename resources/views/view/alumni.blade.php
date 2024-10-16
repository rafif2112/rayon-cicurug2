<x-layout>
    <x-navbar></x-navbar>
    <x-header></x-header>

    <div class="container py-12 mx-auto">
        <div class="container w-11/12 pb-5 mx-auto mb-10 border-b-2 border-black dark:border-gray-700 sm:w-4/5">
            <div class="flex items-center gap-4 mb-6">
                <ion-icon class="text-4xl md:text-5xl" src="{{asset('assets/images/icon/people.svg')}}"></ion-icon>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100" id="dokumentasi">Alumni</h2>
            </div>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">We offer a wide range of services to help you grow your business.</p>
        </div>

        <div class="flex items-center justify-center">
            <div class="grid w-10/12 grid-cols-1 gap-8 sm:grid-cols-2 sm:w-3/4">

                @foreach ($alumni as $lulusan)
                <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                    <img src="{{asset('assets/images/alumni/'.$lulusan->gambar)}}" alt="Alumni 1" class="w-full h-64 lg:h-80 aspect-square">
                    <div class="p-6">
                        <h2 class="mb-2 text-2xl font-semibold text-gray-800">{{$lulusan->nama}}</h2>
                        <p class="mb-4 text-gray-600">
                            <span class="font-medium">Angkatan :</span> {{$lulusan->angkatan}}<br>
                            <span class="font-medium">Jurusan :</span> {{$lulusan->jurusan}}<br>
                            <span class="font-medium">Tempat Bekerja :</span> {{$lulusan->tempat_bekerja}}<br>
                        </p>
                        <div class="flex items-center text-blue-500">
                            <ion-icon class="mr-2" name="briefcase-outline"></ion-icon>
                            <span>{{ $lulusan->pekerjaan }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>


</x-layout>
