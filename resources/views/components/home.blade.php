<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Peohai</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Header Section Start -->
    <header class="flex w-full items-center ">
        <div class="container">
            <div class="relative flex items-center justify-between">
                <div class="px-0">
                    <a href="index.html" class="block py-6 text-lg font-bold">
                        <p>Ekspedisi <span class="text-ginger">Peohai</span></p>
                    </a>
                </div>
                <!-- Hamburger Start -->
                <div class="flex items-center">
                    <button id="hamburger" name="hamburger" type="button" class="absolute right-4 block lg:hidden">
                        <span class="hamburger-line transation origin-top-left duration-300 ease-in-out"></span>
                        <span class="hamburger-line transation duration-300 ease-in-out"></span>
                        <span class="hamburger-line transation origin-bottom-left duration-300 ease-in-out"></span>
                    </button>

                    <nav id="nav-menu"
                        class="absolute right-4 top-full mt-1 hidden w-full max-w-[200px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none">
                        <ul class="block py-2 lg:flex lg:py-0">
                            <li class="group">
                                <a href="/"
                                    class="group mx-4 flex items-center rounded-md p-3 text-sm text-black hover:bg-gray-200 hover:text-blue-500 lg:mx-8 lg:text-base lg:hover:bg-transparent">
                                    <svg class="flex lg:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                                    </svg>
                                    <p class="ml-3 lg:ml-0">Beranda</p>
                                </a>
                            </li>
                            <li class="group">
                                <a href="/simulasi"
                                    class="group mx-4 flex items-center rounded-md p-3 text-sm text-black hover:bg-gray-200 hover:text-blue-500 lg:mx-8 lg:text-base lg:hover:bg-transparent">
                                    <svg class="flex lg:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 48 48">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-miterlimit="2" stroke-width="4"
                                            d="M44 6H28v8h16zm0 8v22c0 1.11-.89 2-2 2H8c-2.21 0-4-1.79-4-4v-6c0-4.42 3.58-8 8-8h16v-6zM14 26v-6m7 6v-6m-6 22v-4m-7 4v-4m14 4v-4m12 4v-4m7 4v-4M23 20H12" />
                                    </svg>
                                    <p class="ml-3 lg:ml-0">Simulasi</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Hamburger End -->
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <main>
        {{ $slot }}
    </main>

    <!-- Footer Section Start -->
    <button onclick="backToTop()" id="backtotopp"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            viewBox="-5 -4.5 24 24">
            <path fill="currentColor"
                d="m6 4.071l-3.95 3.95A1 1 0 0 1 .636 6.607L6.293.95a.997.997 0 0 1 1.414 0l5.657 5.657A1 1 0 0 1 11.95 8.02L8 4.07v9.586a1 1 0 1 1-2 0z" />
        </svg></button>
    <footer class="border-l-orange-100 bg-ink">
        <div class="container">
            <div class="py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <div class="mb-6 md:mb-0">
                        <a href="" class="text-lg font-bold">
                            <p class="text-white">Ekspedisi <span class="text-ginger">Peohai</span></p>
                        </a>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold uppercase text-white">
                            Tautan Navigasi
                        </h2>
                        <ul class="font-medium text-gray-400">
                            <li class="mb-4">
                                <a href="/" class="hover:underline">Beranda</a>
                            </li>
                            <li class="mb-4">
                                <a href="/simulasi" class="hover:underline">Simulasi</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr class="my-6 border-gray-700 sm:mx-auto lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-400 sm:text-center">©2025 <a href=""
                            class="hover:underline">Ekspedisi Peohai</a>
                    </span>
                    <div class="mt-4 flex space-x-5 sm:mt-0 sm:justify-center">
                        <!-- Instagram -->
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="h-4 w-4" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor">
                                <path d=" M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333
        4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0
        12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126
        1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262
        2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335
        1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319
        1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016
        4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413
        2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899
        1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211
        0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844
        0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689
        1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162
        2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162
        0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0
        .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44
        1.439z" />
                            </svg>
                            <span class="sr-only">Instagram page</span>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="h-4 w-4" role="img" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Facebook</title>
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <!-- YouTube -->
                        <a href="#" class="text-gray-400 hover:text-white">
                            <svg class="h-4 w-4" role="img" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path
                                    d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

</body>

<!-- Navbar Fixed -->
<script>
    window.onscroll = function() {
        const header = document.querySelector("header");
        const fixedNav = header.offsetTop;

        if (window.pageYOffset > fixedNav) {
            header.classList.add("navbar-fixed");
        } else {
            header.classList.remove("navbar-fixed");
        }
        fungsiscroll();
    };
</script>

<script>
    function openModal(jenisLayanan) {
        document.getElementById('inputLayanan').value = jenisLayanan;
        document.getElementById('orderModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>

<!-- Back To Top -->
<script>
    let tombol = document.getElementById("backtotopp");

    function fungsiscroll() {
        if (
            document.body.scrollTop > 30 ||
            document.documentElement.scrollTop > 30
        ) {
            tombol.style.display = "block";
        } else {
            tombol.style.display = "none";
        }
    }

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</html>
