<x-home>
    <section id="lacak_cari" class="py-8 mb-8 lg:py-16 bg-gray-200 rounded-xl md:mx-4">
        <div class="container">

            <div class="mb-10 flex flex-wrap text-center">
                <div class="w-full">
                    <hr class="bg-sea mb-4 h-1 w-32 border-0 md:h-2" />
                    <p class="mb-4 text-6xl font-bold leading-none tracking-wide text-blue-500">
                        Status pengiriman Anda!
                    </p>
                </div>
                <div class="w-full">
                    <p class="mb-10 mt-7 font-medium leading-relaxed ">
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
                    <div class="col-span-1 lg:col-span-3 space-y-6">
                        <div class="p-6 bg-white rounded-lg">
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
                            <div class="">
                                @switch($entry->status_paket)
                                    @case('Dikemas')
                                        <span
                                            class="px-3 py-2 inline-flex leading-5 font-bold text-xl rounded-md bg-gray-200 text-gray-800">
                                            {{ $entry->status_paket }}
                                        </span>
                                    @break

                                    @case('Dalam Perjalanan')
                                        <span
                                            class="px-3 py-2 inline-flex leading-5 font-bold text-xl rounded-md bg-yellow-200 text-yellow-800">
                                            {{ $entry->status_paket }}
                                        </span>
                                    @break

                                    @case('Sampai Di Tujuan')
                                        <span
                                            class="px-3 py-2 inline-flex leading-5 font-bold text-xl rounded-md bg-green-200 text-green-800">
                                            {{ $entry->status_paket }}
                                        </span>
                                    @break

                                    @default
                                        <span
                                            class="px-3 py-2 inline-flex leading-5 font-bold text-xl rounded-md bg-gray-100 text-gray-600">
                                            -
                                        </span>
                                @endswitch
                            </div>
                            <div class="text-sm text-wolf mt-2">
                                Lorem ipsum dolor sit amet.
                            </div>
                            <hr class="h-px my-8 bg-gray-300 border-0">
                            <div class="grid grid-cols-2">
                                <div class="col-span-1">
                                    <p class="font-semibold">No Container:</p>
                                    <p class="text-wolf">{{ $entry->no_cont }}</p>
                                </div>
                                <div class="col-span-1">
                                    <p class="font-semibold">No Invoice:</p>
                                    <p class="text-wolf">{{ $entry->no_inv }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white rounded-lg space-y-6">
                            <p class="font-bold">Butuh bantuan?</p>
                            <a href=""
                                class="flex items-center justify-center gap-2 px-6 py-2 border border-blue-500 bg-blue-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-md font-semibold shadow-sm w-full transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M5 20q-.825 0-1.412-.587T3 18v-7q0-1.85.713-3.488T5.65 4.65t2.863-1.937T12 2t3.488.713T18.35 4.65t1.938 2.863T21 11v10q0 .825-.587 1.413T19 23h-6q-.425 0-.712-.288T12 22t.288-.712T13 21h6v-1h-2q-.825 0-1.412-.587T15 18v-4q0-.825.588-1.412T17 12h2v-1q0-2.9-2.05-4.95T12 4T7.05 6.05T5 11v1h2q.825 0 1.413.588T9 14v4q0 .825-.587 1.413T7 20z" />
                                </svg>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-home>
