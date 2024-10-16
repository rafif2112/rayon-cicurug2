<section class="bg-white bg-gradient-to-b from-[#29c6ff] to-white lg:py-16">
    <div class="mx-auto flex max-w-screen-xl flex-col items-center justify-center px-4 py-8 text-center"
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
            <span class="text-blue-600">Cicurug 2</span>
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 dark:text-gray-400 sm:px-16 lg:px-48 lg:text-xl">
            Bersama-sama membangun masa depan yang cerah dan penuh peluang bagi setiap individu, menciptakan sesuatu yang luar biasa.
        </p>
    </div>
</section>