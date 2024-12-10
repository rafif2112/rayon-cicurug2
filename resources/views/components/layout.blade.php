<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cicurug 2</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])

    {{-- <link rel="stylesheet" href="build/assets/app-BQ1Qq7jP.css">
    <script src="build/assets/app-DdQ1e7RN.js"></script> --}}
    
    <link href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('assets/images/icon/wikrama-logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        html {
            scroll-behavior: smooth;
        }
        ::-webkit-scrollbar {
            display: none
        }
    </style>
    @stack('styles')
</head>

<body>

    {{ $slot }}

    <footer class="bg-white dark:bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <hr class="my-6 border-gray-300 dark:border-gray-700 sm:mx-auto lg:my-8"/>
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-400 sm:text-center"><a href="#">© 2024 </a><a
                        href="https://muhamadrafif.vercel.app/" class="text-blue-600 font-semibold hover:underline">Muhamad Rafif</a>. All Rights Reserved.
                </span>
                <div class="mt-4 flex sm:mt-0 sm:justify-center">
                    <a href="https://instagram.com/rafiff.21" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="-mt-[1px] h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" 
                            viewBox="0 0 448 512">
                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                        </svg>
                        <span class="sr-only">Instagram page</span>
                    </a>
                    <a href="https://wa.me/6281283330396" class="ms-5 text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 32 32">
                        <path
                            d="M16 0C7.164 0 0 7.164 0 16c0 2.82.733 5.532 2.133 7.938L.047 32l8.293-2.08C11.278 31.27 13.592 32 16 32c8.836 0 16-7.164 16-16S24.836 0 16 0zm0 29.532c-2.347 0-4.606-.64-6.605-1.85l-.47-.28-4.923 1.237 1.28-4.8-.305-.488C3.74 21.364 3.113 18.709 3.113 16 3.113 8.84 8.84 3.113 16 3.113S28.887 8.84 28.887 16 23.16 28.887 16 28.887zm8.007-9.76c-.444-.222-2.63-1.304-3.04-1.45-.41-.146-.71-.222-1.007.223-.295.445-1.15 1.45-1.407 1.75-.257.296-.52.333-.963.111-.444-.222-1.87-.692-3.56-2.205-1.315-1.169-2.202-2.613-2.46-3.057-.257-.445-.03-.686.191-.908.197-.197.444-.52.667-.796.223-.297.297-.522.445-.87.15-.297.073-.666-.038-.908-.11-.223-1.006-2.421-1.374-3.308-.36-.888-.73-.758-.997-.758-.257 0-.558-.037-.853-.037-.296 0-.777.111-1.184.518C8.28 8.695 7.355 9.81 7.355 11.477c0 1.668 1.218 3.278 1.39 3.508.167.222 2.41 3.697 5.835 5.197.815.334 1.451.534 1.947.684.818.26 1.564.223 2.153.134.658-.1 2.03-.832 2.317-1.64.296-.809.296-1.502.207-1.64-.08-.147-.334-.223-.778-.445z" />
                    </svg>
                    <span class="sr-only">WhatsApp account</span>
                    </a>
                    <a href="https://linkedin.com/in/muhamad-rafif22" class="ms-5 text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0zM7.12 20.45H3.56V9h3.56v11.45zM5.34 7.5c-1.14 0-2.06-.92-2.06-2.06 0-1.14.92-2.06 2.06-2.06 1.14 0 2.06.92 2.06 2.06 0 1.14-.92 2.06-2.06 2.06zM20.45 20.45h-3.56v-5.57c0-1.33-.03-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.95v5.66h-3.56V9h3.42v1.56h.05c.48-.91 1.65-1.85 3.4-1.85 3.63 0 4.3 2.39 4.3 5.5v6.24z"/>
                        </svg>
                        <span class="sr-only">LinkedIn page</span>
                    </a>
                    <a href="https://github.com/rafif2112" class="ms-5 text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">GitHub account</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
