<x-admin.layout>
    <div class="space-y-6">
        <div class="bg-green-600 text-white shadow-md rounded-lg">
            <div class="p-6 text-lg font-semibold">
                {{ __('Tambah Data Admin Entry') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
            <form action="{{ route('admin.entries.store', $entry_period->id) }}" method="POST"
                enctype="multipart/form-data" class="p-5">
                @csrf

                <div class="">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="qty" class="block text-sm/6 font-medium text-gray-900">Qty</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="qty" name="qty" autocomplete="qty"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="1x20" {{ old('qty') == '1x20' ? 'selected' : '' }}>1x20
                                    </option>
                                    <option value="1x40" {{ old('qty') == '1x40' ? 'selected' : '' }}>1x40
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="tgl_stuffing" class="block text-sm/6 font-medium text-gray-900">Tgl
                                Stuffing</label>
                            <div class="mt-2">
                                <input type="date" name="tgl_stuffing" value="{{ old('tgl_stuffing') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="sl_sd" class="block text-sm/6 font-medium text-gray-900">SL/SD</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="sl_sd" name="sl_sd" autocomplete="sl_sd"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="SL" {{ old('sl_sd') == 'SL' ? 'selected' : '' }}>SL</option>
                                    <option value="SD" {{ old('sl_sd') == 'SD' ? 'selected' : '' }}>SD</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="customer" class="block text-sm/6 font-medium text-gray-900">Customer</label>
                            <div class="mt-2">
                                <input type="text" name="customer" value="{{ old('customer') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="pengirim" class="block text-sm/6 font-medium text-gray-900">Pengirim</label>
                            <div class="mt-2">
                                <input type="text" name="pengirim" value="{{ old('pengirim') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="penerima" class="block text-sm/6 font-medium text-gray-900">Penerima</label>
                            <div class="mt-2">
                                <input type="text" name="penerima" value="{{ old('penerima') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="jenis_barang" class="block text-sm/6 font-medium text-gray-900">Jenis
                                Barang</label>
                            <div class="mt-2">
                                <input type="text" name="jenis_barang" value="{{ old('jenis_barang') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="pelayaran" class="block text-sm/6 font-medium text-gray-900">Pelayaran</label>
                            <div class="mt-2">
                                <input type="text" name="pelayaran" value="{{ old('pelayaran') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="nama_kapal" class="block text-sm/6 font-medium text-gray-900">Nama
                                Kapal</label>
                            <div class="mt-2">
                                <input type="text" name="nama_kapal" value="{{ old('nama_kapal') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="voy" class="block text-sm/6 font-medium text-gray-900">Voy</label>
                            <div class="mt-2">
                                <input type="text" name="voy" value="{{ old('voy') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="tujuan" class="block text-sm/6 font-medium text-gray-900">Tujuan</label>
                            <div class="mt-2">
                                <input type="text" name="tujuan" value="{{ old('tujuan') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="etd" class="block text-sm/6 font-medium text-gray-900">ETD</label>
                            <div class="mt-2">
                                <input type="date" name="etd" value="{{ old('etd') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="eta" class="block text-sm/6 font-medium text-gray-900">ETA</label>
                            <div class="mt-2">
                                <input type="date" name="eta" value="{{ old('eta') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="no_cont" class="block text-sm/6 font-medium text-gray-900">No
                                Count</label>
                            <div class="mt-2">
                                <input type="text" name="no_cont" value="{{ old('no_cont') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="seal" class="block text-sm/6 font-medium text-gray-900">Seal</label>
                            <div class="mt-2">
                                <input type="text" name="seal" value="{{ old('seal') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="agen" class="block text-sm/6 font-medium text-gray-900">Agen</label>
                            <div class="mt-2">
                                <input type="text" name="agen" value="{{ old('agen') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="dooring" class="block text-sm/6 font-medium text-gray-900">Dooring</label>
                            <div class="mt-2">
                                <input type="date" name="dooring" value="{{ old('dooring') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Trucking</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                        <div class="sm:col-span-2">
                            <label for="nopol" class="block text-sm/6 font-medium text-gray-900">Nopol</label>
                            <div class="mt-2">
                                <input type="text" name="nopol" value="{{ old('nopol') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="supir" class="block text-sm/6 font-medium text-gray-900">Supir</label>
                            <div class="mt-2">
                                <input type="text" name="supir" value="{{ old('supir') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="no_telp" class="block text-sm/6 font-medium text-gray-900">No
                                Telp</label>
                            <div class="mt-2">
                                <input type="text" name="no_telp" value="{{ old('no_telp') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="harga" class="block text-sm/6 font-medium text-gray-900">Harga</label>
                            <div class="mt-2">
                                <input type="text" name="harga" value="{{ old('harga') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">SI Final & BA Done</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                        <div class="sm:col-span-2">
                            <label for="si_final" class="block text-sm/6 font-medium text-gray-900">SI
                                Final</label>
                            <div class="mt-2">
                                <input type="text" name="si_final" value="{{ old('si_final') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="ba" class="block text-sm/6 font-medium text-gray-900">BA</label>
                            <div class="mt-2">
                                <input type="date" name="ba" value="{{ old('ba') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="ba_balik" class="block text-sm/6 font-medium text-gray-900">BA
                                Balik</label>
                            <div class="mt-2">
                                <input type="date" name="ba_balik" value="{{ old('ba_balik') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="no_inv" class="block text-sm/6 font-medium text-gray-900">No Inv</label>
                            <div class="mt-2">
                                <input type="number" min="1" name="no_inv" value="{{ old('no_inv') }}"
                                    
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Alamat & Nama Penerima</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="alamat_penerima_barang"
                                class="block text-sm/6 font-medium text-gray-900">Alamat Penerima Barang</label>
                            <div class="mt-2">
                                <input type="text" name="alamat_penerima_barang"
                                    value="{{ old('alamat_penerima_barang') }}" 
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="nama_penerima" class="block text-sm/6 font-medium text-gray-900">Nama
                                Penerima</label>
                            <div class="mt-2">
                                <input type="text" name="nama_penerima" value="{{ old('nama_penerima') }}"
                                    
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
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
                    <button type="reset"
                        class="text-sm font-semibold text-gray-700 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        Reset
                    </button>
                    <button type="submit"
                        class="rounded-md bg-green-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
