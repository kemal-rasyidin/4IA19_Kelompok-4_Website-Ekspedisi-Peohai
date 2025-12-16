<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-yellow-600 text-white shadow-md rounded-lg">
            <div class="p-6 text-lg font-semibold">
                {{ __('Edit Data Marketing') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
            <form action="{{ route('marketing.entries.update', [$entry_period->id, $entry->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="customer" class="block text-sm/6 font-medium text-gray-900">Customer</label>
                            <div class="mt-2">
                                <input type="text" name="customer" value="{{ old('customer', $entry->customer) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="customer" value="{{ $entry->customer }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="jenis_barang" class="block text-sm/6 font-medium text-gray-900">Jenis
                                Barang</label>
                            <div class="mt-2">
                                <input type="text" name="jenis_barang"
                                    value="{{ old('jenis_barang', $entry->jenis_barang) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="jenis_barang" value="{{ $entry->jenis_barang }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="tujuan" class="block text-sm/6 font-medium text-gray-900">Tujuan</label>
                            <div class="mt-2">
                                <input type="text" name="tujuan" value="{{ old('tujuan', $entry->tujuan) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="tujuan" value="{{ $entry->tujuan }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="qty" class="block text-sm/6 font-medium text-gray-900">Cont</label>
                            <div class="mt-2">
                                <input type="text" name="qty" value="{{ old('qty', $entry->qty) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="qty" value="{{ $entry->qty }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="no_cont" class="block text-sm/6 font-medium text-gray-900">No Cont</label>
                            <div class="mt-2">
                                <input type="text" name="no_cont" value="{{ old('no_cont', $entry->no_cont) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="no_cont" value="{{ $entry->no_cont }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="seal" class="block text-sm/6 font-medium text-gray-900">Seal</label>
                            <div class="mt-2">
                                <input type="text" name="seal" value="{{ old('seal', $entry->seal) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="seal" value="{{ $entry->seal }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="nama_kapal" class="block text-sm/6 font-medium text-gray-900">Vessel</label>
                            <div class="mt-2">
                                <input type="text" name="nama_kapal"
                                    value="{{ old('nama_kapal', $entry->nama_kapal) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="nama_kapal" value="{{ $entry->nama_kapal }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="voy" class="block text-sm/6 font-medium text-gray-900">Voyage</label>
                            <div class="mt-2">
                                <input type="text" name="voy" value="{{ old('voy', $entry->voy) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="voy" value="{{ $entry->voy }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="pelayaran" class="block text-sm/6 font-medium text-gray-900">Pelayaran</label>
                            <div class="mt-2">
                                <input type="text" name="pelayaran"
                                    value="{{ old('pelayaran', $entry->pelayaran) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="pelayaran" value="{{ $entry->pelayaran }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="etd" class="block text-sm/6 font-medium text-gray-900">ETD</label>
                            <div class="mt-2">
                                <input type="text" name="etd" value="{{ old('etd', $entry->etd) }}" disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="etd" value="{{ $entry->etd }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="door_daerah" class="block text-sm/6 font-medium text-gray-900">Door
                                Daerah</label>
                            <div class="mt-2">
                                <input type="number" name="door_daerah"
                                    value="{{ old('door_daerah', $entry->door_daerah) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="stufing_dalam" class="block text-sm/6 font-medium text-gray-900">Stufing
                                Dalam</label>
                            <div class="mt-2">
                                <input type="number" name="stufing_dalam"
                                    value="{{ old('stufing_dalam', $entry->stufing_dalam) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="harga_trucking" class="block text-sm/6 font-medium text-gray-900">Harga
                                Trucking</label>
                            <div class="mt-2">
                                <input type="text" name="harga_trucking"
                                    value="{{ old('harga_trucking', 'Rp ' . number_format($entry->harga_trucking, 2, ',', '.')) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="harga_trucking" value="{{ $entry->harga_trucking }}">

                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Harga Pelayaran</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="freight" class="block text-sm/6 font-medium text-gray-900">Freight</label>
                            <div class="mt-2">
                                <input type="number" name="freight" value="{{ old('freight', $entry->freight) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="tgl_freight" class="block text-sm/6 font-medium text-gray-900">Tanggal
                                Bayar</label>
                            <div class="mt-2">
                                <input type="date" name="tgl_freight"
                                    value="{{ old('tgl_freight', $entry->tgl_freight) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="thc" class="block text-sm/6 font-medium text-gray-900">THC</label>
                            <div class="mt-2">
                                <input type="number" name="thc" value="{{ old('thc', $entry->thc) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="asuransi" class="block text-sm/6 font-medium text-gray-900">Asuransi
                                0,2%</label>
                            <div class="mt-2">
                                <input type="number" name="asuransi"
                                    value="{{ old('asuransi', $entry->asuransi) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="bl" class="block text-sm/6 font-medium text-gray-900">BL</label>
                            <div class="mt-2">
                                <input type="number" name="bl" value="{{ old('bl', $entry->bl) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="ops" class="block text-sm/6 font-medium text-gray-900">OPS</label>
                            <div class="mt-2">
                                <input type="number" name="ops" value="{{ old('ops', $entry->ops) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Nilai Invoice</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="no_inv" class="block text-sm/6 font-medium text-gray-900">No Invoice</label>
                            <div class="mt-2">
                                <input type="text" name="no_inv" value="{{ old('no_inv', $entry->no_inv) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="no_inv" value="{{ $entry->no_inv }}">
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="asuransi_inv" class="block text-sm/6 font-medium text-gray-900">Asuransi
                                0,2%</label>
                            <div class="mt-2">
                                <input type="number" name="asuransi_inv"
                                    value="{{ old('asuransi_inv', $entry->asuransi_inv) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="adm" class="block text-sm/6 font-medium text-gray-900">ADM</label>
                            <div class="mt-2">
                                <input type="number" name="adm" value="{{ old('adm', $entry->adm) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="harga_jual" class="block text-sm/6 font-medium text-gray-900">Harga
                                Jual</label>
                            <div class="mt-2">
                                <input type="number" name="harga_jual"
                                    value="{{ old('harga_jual', $entry->harga_jual) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="pph23" class="block text-sm/6 font-medium text-gray-900">PPH 23
                            </label>
                            <div class="mt-2">
                                <input type="number" name="pph23" value="{{ old('pph23', $entry->pph23) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="refund" class="block text-sm/6 font-medium text-gray-900">Refund
                            </label>
                            <div class="mt-2">
                                <input type="number" name="refund" value="{{ old('refund', $entry->refund) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Profit</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="nol" class="block text-sm/6 font-medium text-gray-900">0</label>
                            <div class="mt-2">
                                <input type="number" name="nol" value="{{ old('nol', $entry->nol) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Agen Daerah</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="agen_daerah" class="block text-sm/6 font-medium text-gray-900">Daerah</label>
                            <div class="mt-2">
                                <input type="text" name="agen_daerah"
                                    value="{{ old('agen_daerah', $entry->agen_daerah) }}"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-full">
                            <label for="keterangan_marketing"
                                class="block text-sm/6 font-medium text-gray-900">Keterangan</label>
                            <div class="mt-2">
                                <textarea name="keterangan_marketing" class="block w-full rounded-md bg-white px-3 py-1.5">
{{ old('keterangan_marketing', $entry->keterangan_marketing) }}
</textarea>

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
