<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-green-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Tambah Data Kota/Kabupaten
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Terjadi kesalahan!</strong>
                <ul class="mt-2 ml-4 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form action="{{ route('cities.store') }}" method="POST" class="p-5">
                @csrf

                <div class="space-y-12">
                    <div>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-3">
                                <label for="name" class="block text-sm/6 font-medium text-gray-900">
                                    Nama Kota/Kabupaten <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        required placeholder="Contoh: Jakarta, Surabaya"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>

                            <div class="col-span-3">
                                <label for="province" class="block text-sm/6 font-medium text-gray-900">
                                    Provinsi <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <select name="province" id="province" required
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        <option value="">-- Pilih Provinsi --</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province }}"
                                                {{ old('province') == $province ? 'selected' : '' }}>
                                                {{ $province }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-3">
                                <label for="latitude" class="block text-sm/6 font-medium text-gray-900">
                                    Latitude <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="number" step="0.0000001" name="latitude" id="latitude"
                                        value="{{ old('latitude') }}" required placeholder="Contoh: -6.2088"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Rentang: -90 sampai 90</p>
                            </div>

                            <div class="col-span-3">
                                <label for="longitude" class="block text-sm/6 font-medium text-gray-900">
                                    Longitude <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-2">
                                    <input type="number" step="0.0000001" name="longitude" id="longitude"
                                        value="{{ old('longitude') }}" required placeholder="Contoh: 106.8456"
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Rentang: -180 sampai 180</p>
                            </div>

                            <div class="col-span-full">
                                <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                                    <h4 class="text-sm font-medium text-blue-900 mb-2">💡 Tips mencari koordinat:</h4>
                                    <ul class="text-sm text-blue-800 space-y-1">
                                        <li>• Buka <a href="https://www.google.com/maps" target="_blank"
                                                class="underline">Google Maps</a></li>
                                        <li>• Cari lokasi kota yang ingin ditambahkan</li>
                                        <li>• Klik kanan pada peta → Pilih koordinat (akan otomatis tercopy)</li>
                                        <li>• Paste koordinat tersebut ke form di atas</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                </div>

                <div class="mt-8 flex items-center justify-end gap-x-4">
                    <a href="{{ route('cities.index') }}"
                        class="text-sm font-semibold text-gray-700 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        Kembali
                    </a>
                    <button type="submit"
                        class="rounded-md bg-green-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-admin.layout>
