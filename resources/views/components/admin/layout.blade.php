<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Peohai</title>

    <!--Icons -->
    <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
        }

        .navbar-gradient {
            background: linear-gradient(90deg, #ffffff 0%, #f8fafc 100%);
        }

        .sidebar-toggle {
            transition: all 0.3s ease;
        }

        .sidebar-hidden {
            transform: translateX(-100%);
        }

        .main-content-expanded {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            .sidebar-toggle {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 16rem;
            }
        }

        /* Modern Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .animate-slideInRight {
            animation: slideInRight 0.4s ease-out;
        }

        /* Glassmorphism Effects */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Modern Shadow Effects */
        .shadow-modern {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .shadow-modern-lg {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Hover Glow Effects */
        .hover-glow {
            transition: all 0.3s ease;
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.4);
        }

        /* Modern Loading Spinner */
        .spinner {
            width: 20px;
            height: 20px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a4190);
        }
    </style>
</head>

<body>
    <div class="min-h-screen">

        <!-- Sidebar -->
        <x-admin.sidebar></x-admin.sidebar>

        <!-- Main Content -->
        <div id="main-content" class="main-content transition-all duration-300 ease-in-out">
            <!-- Top Navigation Bar -->
            <nav class="navbar-gradient shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button id="sidebar-toggle" type="button"
                                class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                            <!-- Breadcrumb -->
                            <nav class="ml-4 md:ml-0">
                                <ol class="flex items-center space-x-2 text-sm">
                                    <li>
                                        <div class="flex items-center">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z">
                                                </path>
                                            </svg>
                                            <a href="{{ route('analytics_dashboard') }}"
                                                class="ml-2 text-gray-500 hover:text-gray-700">Dashboard
                                                {{ Auth::user()->role }}</a>
                                        </div>
                                    </li>

                                </ol>
                            </nav>
                        </div>

                        <!-- Right side items -->
                        <div class="flex items-center space-x-4">
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-6 min-h-screen bg-gradient-to-br from-gray-50 via-blue-50/30 to-purple-50/30">
                <!-- Modern Flash Messages -->
                @if (session('message'))
                    <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl shadow-lg backdrop-blur-sm"
                        role="alert">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="font-medium">{{ session('message') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 px-6 py-4 rounded-md mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m11.95 13.15l2.475 3.75q.225.35.538.375t.562-.15t.35-.475t-.125-.65l-2.775-4.2L15.5 7.95q.2-.325.113-.612t-.338-.463t-.562-.15t-.513.375l-2.225 3.45L9.75 7.1q-.225-.35-.525-.375t-.575.15t-.362.475t.137.65l2.55 3.825L8.2 16.05q-.2.325-.112.613t.337.462t.563.138t.512-.363zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 px-6 py-4 rounded-md mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m10.6 16.6l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4zM12 22q-2.075 0-3.9-.788t-3.175-2.137T2.788 15.9T2 12t.788-3.9t2.137-3.175T8.1 2.788T12 2t3.9.788t3.175 2.137T21.213 8.1T22 12t-.788 3.9t-2.137 3.175t-3.175 2.138T12 22" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{ $slot }}
                {{-- @yield('success') --}}
            </main>

            <!-- Footer -->
            <x-admin.footer></x-admin.footer>

        </div>
    </div>

    <!-- Mobile sidebar -->
    <x-admin.m-sidebar></x-admin.m-sidebar>

</body>

<script>
    // Sidebar toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const mainContent = document.getElementById('main-content');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('opacity-0');
            sidebarOverlay.classList.toggle('pointer-events-none');
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', toggleSidebar);
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', toggleSidebar);
        }
    });
</script>

</html>
