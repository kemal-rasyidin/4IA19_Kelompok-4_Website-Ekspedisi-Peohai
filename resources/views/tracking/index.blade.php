<x-home>
<section id="beranda" class="py-8 lg:py-16 relative overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="/img/background2.png" alt="Background Ekspedisi" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-black/60 via-black/50 to-blue-900/60"></div>
    </div>
    
    <!-- Content -->
    <div class="container relative z-10">
            <div class="mb-10 flex flex-wrap text-center">
                <div class="w-full">
                    <hr class="bg-sea mb-4 h-1 w-32 border-0 md:h-2" />
                    <p class="mb-4 text-5xl lg:text-6xl font-bold leading-tight tracking-wide text-white drop-shadow-lg" style="text-shadow: 2px 2px 8px rgba(0,0,0,0.8)">
                        Lacak pengiriman Anda!
                    </p>
                </div>
                <div class="w-full">
                    <p class="mb-10 mt-7 font-medium leading-relaxed text-white text-lg drop-shadow-md">
                        Percayakan pengiriman Anda kepada kami. Layanan ekspedisi cepat, aman, dan terpercaya ke seluruh
                        Indonesia!
                    </p>
                </div>
            </div>

            <div class="w-full">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-6 items-stretch">

                    <div class="hidden lg:block lg:col-span-3">
                        <img src="https://images.unsplash.com/photo-1494412685616-a5d310fbb07d?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                            alt="Container shipping" class="w-full h-full rounded-lg object-cover" />
                    </div>

                    <div class="col-span-1 lg:col-span-3 h-full p-6 bg-white rounded-lg">

                        @if (session('error'))
                            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-medium">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tracking.search') }}" class="space-y-4">
                            @csrf

                            <div class="grid grid-cols-1 gap-x-6 gap-y-8">

                                <div class="sm:col-span-2">
                                    <label for="no_inv" class="block text-sm/6 font-medium text-gray-900">No
                                        Invoice</label>
                                    <div class="mt-2">
                                        <input type="text" id="no_inv" name="no_inv" value="{{ old('no_inv') }}"
                                            required
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    </div>
                                    @error('no_inv')
                                        <small class="text-red-600 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="no_cont" class="block text-sm/6 font-medium text-gray-900">No
                                        Container</label>
                                    <div class="mt-2">
                                        <input type="text" id="no_cont" name="no_cont" value="{{ old('no_cont') }}"
                                            required
                                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                    </div>
                                    @error('no_cont')
                                        <small class="text-red-600 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>

                                <hr class="h-px my-2 bg-gray-300 border-0">

                                <div class="sm:col-span-2">
                                    <button type="submit"
                                        class="flex items-center justify-center gap-2 px-6 py-2 border border-blue-500 bg-blue-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-md font-semibold shadow-sm w-full transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                        </svg>
                                        Lacak Paket
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
</x-home>
