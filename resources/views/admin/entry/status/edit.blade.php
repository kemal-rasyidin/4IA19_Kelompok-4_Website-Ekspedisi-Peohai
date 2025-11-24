<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-yellow-600 text-white shadow-md rounded-lg">
            <div class="p-6 text-lg font-semibold">
                {{ __('Edit Data Status Entry') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
            <form action="{{ route('status.entries.update', [$entry_period->id, $entry->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="no_inv" class="block text-sm/6 font-medium text-gray-900">No Invoice</label>
                            <div class="mt-2">
                                <input type="text" name="no_inv" value="{{ old('no_inv', $entry->no_inv) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="no_inv" value="{{ $entry->no_inv }}">
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="status_paket" class="block text-sm/6 font-medium text-gray-900">Status
                                Paket</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="status_paket" name="status_paket" autocomplete="status_paket"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="Dikemas"
                                        {{ old('status_paket', $entry->status_paket) == 'Dikemas' ? 'selected' : '' }}>
                                        Dikemas
                                    </option>
                                    <option value="Dalam Perjalanan"
                                        {{ old('status_paket', $entry->status_paket) == 'Dalam Perjalanan' ? 'selected' : '' }}>
                                        Dalam Perjalanan
                                    </option>
                                    <option value="Sampai Di Tujuan"
                                        {{ old('status_paket', $entry->status_paket) == 'Sampai Di Tujuan' ? 'selected' : '' }}>
                                        Sampai Di Tujuan
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                </div>
                <div class="mt-8 flex items-center justify-end gap-x-4">
                    <button onclick="history.back()"
                        class="text-sm font-semibold text-gray-700 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        Kembali
                    </button>
                    <button type="submit"
                        class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-yellow-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
