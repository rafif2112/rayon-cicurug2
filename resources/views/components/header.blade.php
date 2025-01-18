<section class="bg-white lg:py-20 bg-no-repeat bg-cover bg-center relative" style="background-image: url('{{ asset('assets/images/other/background1.jpg') }}')">    <!-- Tambahkan div overlay untuk gradasi -->
    <div class="absolute inset-0 bg-gradient-to-t from-white to-white/30"></div>
    
    <!-- Tambahkan z-index pada konten agar berada di atas overlay -->
    <div class="mx-auto flex max-w-screen-xl flex-col items-center justify-center px-4 py-8 text-center relative z-10"
        style="height: 400px">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
            @if (Request::is('siswa'))
                Siswa
            @elseif (Request::is('tentang'))
                Tentang
            @elseif (Request::is('alumni'))
                Alumni
            @else
                Rayon
            @endif
            <span class="text-blue-700">Cicurug 2</span>
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-900 dark:text-gray-400 sm:px-16 lg:px-48 lg:text-xl">
            Menjadi rayon yang menginspirasi dengan semangat kebersamaan, keberagaman, dan keunggulan, tempat peserta didik berkembang menjadi individu yang inovatif dan kompetitif.
        </p>
    </div>
</section>