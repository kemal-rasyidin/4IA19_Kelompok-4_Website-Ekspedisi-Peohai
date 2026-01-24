<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-yellow-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                {{ __('Edit Periode Admin Data Entry') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form action="{{ route('entry_periods.update', $entryPeriod) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="periode" class="block text-sm font-medium text-gray-900 mb-2">
                            Pilih Periode (Bulan & Tahun) <span class="text-red-500">*</span>
                        </label>
                        <input type="month" name="periode" id="periode"
                            value="{{ old('periode', sprintf('%04d-%02d', $entryPeriod->tahun, $entryPeriod->bulan)) }}"
                            required
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm @error('periode') border-red-500 @enderror">
                        @error('periode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('tahun')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('bulan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Format: Bulan/Tahun (contoh: Januari 2025)</p>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Periode ini akan digunakan untuk mengelompokkan data entry.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="h-px my-8 bg-gray-300 border-0">

                <div class="mt-8 flex items-center justify-end gap-x-4">
                    <a href="{{ route('entry_periods.index') }}"
                        class="text-sm font-semibold text-gray-700 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        Kembali
                    </a>
                    <button type="submit"
                        class="rounded-md bg-yellow-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-admin.layout>
