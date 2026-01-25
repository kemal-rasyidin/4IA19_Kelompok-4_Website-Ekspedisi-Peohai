<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Peohai</title>

    <!-- Fonts & Icons -->
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Header Section Start -->
    <header class="flex w-full items-center bg-ink backdrop-blur-md top-0 left-0 z-50 shadow-md">
        <div class="container">
            <div class="relative flex items-center justify-between">
                <div class="px-0">
                    <a href="/" class="py-6 text-lg font-bold flex items-center gap-1">
                        <img src="/img/logo2.png" alt="Logo Peohai" class="h-10 w-auto">
                        <div class="flex flex-col items-start">
                            <span class="text-lg font-bold text-orange-500">Ekspedisi</span>
                            <span class="text-lg font-bold text-orange-500">Peohai</span>
                        </div>
                    </a>
                </div>
                <!-- Hamburger Start -->
                <div class="flex items-center">
                    <button id="hamburger" name="hamburger" type="button" class="absolute right-4 block lg:hidden">
                        <span class="hamburger-line transition origin-top-left duration-300 ease-in-out"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out"></span>
                        <span class="hamburger-line transition origin-bottom-left duration-300 ease-in-out"></span>
                    </button>

                    <nav id="nav-menu"
                        class="absolute right-4 top-full mt-1 hidden w-full max-w-[200px] rounded-lg bg-white py-5 shadow-lg lg:static lg:block lg:max-w-full lg:rounded-none lg:bg-transparent lg:shadow-none">
                        <ul class="block py-2 lg:flex lg:py-0">
                            <li class="group">
                                <a href="/"
                                    class="group mx-4 flex items-center rounded-md p-3 text-sm {{ request()->is('/') ? 'bg-orange-500 text-white lg:bg-transparent lg:text-orange-500 font-semibold' : 'text-gray-900 md:text-white' }} hover:bg-gray-200 hover:text-orange-400 lg:mx-8 lg:text-base lg:hover:bg-transparent transition-colors">
                                    <svg class="flex lg:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M6 19h3v-5q0-.425.288-.712T10 13h4q.425 0 .713.288T15 14v5h3v-9l-6-4.5L6 10zm-2 0v-9q0-.475.213-.9t.587-.7l6-4.5q.525-.4 1.2-.4t1.2.4l6 4.5q.375.275.588.7T20 10v9q0 .825-.588 1.413T18 21h-4q-.425 0-.712-.288T13 20v-5h-2v5q0 .425-.288.713T10 21H6q-.825 0-1.412-.587T4 19m8-6.75" />
                                    </svg>
                                    <p class="ml-3 lg:ml-0">Beranda</p>
                                </a>
                            </li>
                            <li class="group">
                                <a href="/simulasi-tarif"
                                    class="group mx-4 flex items-center rounded-md p-3 text-sm {{ request()->is('simulasi-tarif') ? 'bg-orange-500 text-white lg:bg-transparent lg:text-orange-500 font-semibold' : 'text-gray-900 md:text-white' }} hover:bg-gray-200 hover:text-orange-400 lg:mx-8 lg:text-base lg:hover:bg-transparent transition-colors">
                                    <svg class="flex lg:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7 20q-1.25 0-2.125-.875T4 17H2.725q-.425 0-.713-.288T1.725 16t.288-.712t.712-.288h2.05q.425-.475 1-.737T7 14t1.225.263t1 .737H13.4l2.1-9H5.75q-.425 0-.712-.288T4.75 5t.288-.712T5.75 4h11q.5 0 .8.375t.175.85L17.075 8H19q.475 0 .9.213t.7.587l1.875 2.475q.275.35.35.763t0 .837L22.15 16.2q-.075.35-.35.575t-.625.225H20q0 1.25-.875 2.125T17 20t-2.125-.875T14 17h-4q0 1.25-.875 2.125T7 20m8.925-7h4.825l.1-.525L19 10h-2.375zm-2.475 1.825l.163-.725q.162-.725.412-1.775q.075-.325.15-.6t.125-.55l.163-.725q.162-.725.412-1.775t.413-1.775l.162-.725L15.5 6l-2.1 9zm-11.7-1.5q-.425 0-.712-.287t-.288-.713t.288-.712t.712-.288h3.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zm2-3.65q-.425 0-.712-.288t-.288-.712t.288-.712t.712-.288h4.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zM7 18q.425 0 .713-.288T8 17t-.288-.712T7 16t-.712.288T6 17t.288.713T7 18m10 0q.425 0 .713-.288T18 17t-.288-.712T17 16t-.712.288T16 17t.288.713T17 18" />
                                    </svg>
                                    <p class="ml-3 lg:ml-0">Simulasi Tarif</p>
                                </a>
                            </li>
                            <li class="group">
                                <a href="/lacak"
                                    class="group mx-4 flex items-center rounded-md p-3 text-sm {{ request()->is('lacak') ? 'bg-orange-500 text-white lg:bg-transparent lg:text-orange-500 font-semibold' : 'text-gray-900 md:text-white' }} hover:bg-gray-200 hover:text-orange-400 lg:mx-8 lg:text-base lg:hover:bg-transparent transition-colors">
                                    <svg class="flex lg:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                    </svg>
                                    <p class="ml-3 lg:ml-0">Lacak Pengiriman</p>
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
    <button onclick="backToTop()" id="backtotopp">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="-5 -4.5 24 24">
            <path fill="currentColor"
                d="m6 4.071l-3.95 3.95A1 1 0 0 1 .636 6.607L6.293.95a.997.997 0 0 1 1.414 0l5.657 5.657A1 1 0 0 1 11.95 8.02L8 4.07v9.586a1 1 0 1 1-2 0z" />
        </svg>
    </button>

    <footer class="border-l-orange-100 bg-ink">
        <div class="container">
            <div class="pt-12 pb-24">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Kolom Kiri: Informasi Kontak -->
                    <div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-300">PT. Peohai Mitra Sejati</h3>

                        <!-- Telepon -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="bg-green-500 text-white rounded-full p-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Telepon</p>
                                <p class="font-semibold text-gray-600">+62 852-8563-0337</p>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="bg-green-500 text-white rounded-full p-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">WhatsApp</p>
                                <p class="font-semibold text-gray-600">+62 852-8176-1717</p>
                            </div>
                        </div>

                        <!-- Instagram -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="bg-green-500 text-white rounded-full p-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Instagram</p>
                                <p class="font-semibold text-gray-600">peohaimitrasejati</p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="bg-green-500  text-white rounded-full p-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300">Email</p>
                                <p class="font-semibold text-gray-600">pt.peohai_mitrasejati@yahoo.com</p>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="flex items-start gap-4 mb-6">
                            <div class="bg-green-500 text-white rounded-full p-3 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-300 mb-1">Kantor Pusat</p>
                                <p class="font-semibold text-gray-600 leading-relaxed">
                                    Perumahan Ciherang Hills Residence Blok F No. 01<br>
                                    Depok, Jawa Barat 16454<br>
                                    Indonesia
                                </p>
                            </div>
                        </div>

                    </div>

                    <!-- Kolom Kanan: Business Hours -->
                    <div>
                        <h3 class="text-2xl font-bold mb-6 text-gray-300">Jam Operasional</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                                <span class="text-gray-300">Senin - Jumat</span>
                                <span class="font-semibold text-orange-400">09:00 - 17:00 WIB</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                                <span class="text-gray-300">Sabtu</span>
                                <span class="font-semibold text-orange-400">09:00 - 12:00 WIB</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-white/10 pb-3">
                                <span class="text-gray-300">Minggu & Hari Libur</span>
                                <span class="font-semibold text-orange-400">Tutup</span>
                            </div>
                        </div>
                        <div class="mt-8 p-4 bg-white/5 rounded-lg border border-white/10">
                            <p class="text-sm text-gray-300">
                                <span class="font-semibold text-white flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-400"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0
                                            1.1.9 2 2 2h16c1.1 0
                                            2-.9 2-2V6c0-1.1-.9-2-2-2zm0
                                            4-8 5-8-5V6l8 5 8-5v2z" />
                                    </svg>
                                    Support Email 24/7
                                </span>
                                Untuk pertanyaan di luar jam operasional, silakan kirim email ke
                                <span class="text-green-400">pt.peohai_mitrasejati@yahoo.com</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-t border-white/10 mt-8 pt-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <p class="text-sm text-gray-300 text-center md:text-left">
                            © {{ date('Y') }}
                            <span class="font-semibold text-white">
                                PT. Peohai Mitra Sejati
                            </span>.
                            All rights reserved.
                        </p>
                        <div class="flex flex-col md:flex-row items-center gap-6">
                            <div class="flex gap-6 text-sm">
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors">
                                    Privacy Policy
                                </a>
                                <a href="#" class="text-gray-300 hover:text-orange-400 transition-colors">
                                    Terms of Service
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </footer>
    <!-- Footer Section End -->

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6285281761717?text=Halo%20Ekspedisi%20Peohai,%20saya%20ingin%20bertanya%20tentang%20layanan%20pengiriman"
        target="_blank" class="fixed bottom-6 left-6 z-50 group">
        <!-- Pulse Animation Ring -->
        <div class="absolute bg-green-500 rounded-full opacity-75"></div>

        <!-- Button Container -->
        <div
            class="relative flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-2xl transition-all duration-300 hover:scale-110 px-4 py-3">
            <!-- Icon WhatsApp -->
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
            </div>
            <!-- Text -->
            <span class="font-semibold text-sm whitespace-nowrap">
                Chat WhatsApp
            </span>
        </div>
    </a>

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
