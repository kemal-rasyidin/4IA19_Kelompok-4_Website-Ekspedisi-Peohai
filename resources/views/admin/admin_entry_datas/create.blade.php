<x-admin.layout>
    <div class="space-y-8">
        <div class="bg-green-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                {{ __('Tambah Admin Data Entry') }} Periode {{ $admin_entry_date->periode }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form action="{{ route('admin_entry_dates.admin_entry_datas.store', $admin_entry_date->id) }}" method="POST"
                enctype="multipart/form-data" class="p-5">

                @csrf

                <div class="">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="qty" class="block text-sm/6 font-medium text-gray-900">Qty</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="qty" name="qty" autocomplete="qty"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="1" {{ old('qty') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('qty') == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('qty') == 3 ? 'selected' : '' }}>3</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="tgl_stuffing" class="block text-sm/6 font-medium text-gray-900">Tgl
                                Stuffing</label>
                            <div class="mt-2">
                                <input type="date" name="tgl_stuffing" value="{{ old('tgl_stuffing') }}" required
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
                                <input type="text" name="customer" value="{{ old('customer') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="pengirim" class="block text-sm/6 font-medium text-gray-900">Pengirim</label>
                            <div class="mt-2">
                                <input type="text" name="pengirim" value="{{ old('pengirim') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="penerima" class="block text-sm/6 font-medium text-gray-900">Penerima</label>
                            <div class="mt-2">
                                <input type="text" name="penerima" value="{{ old('penerima') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="jenis_barang" class="block text-sm/6 font-medium text-gray-900">Jenis Barang</label>
                            <div class="mt-2">
                                <input type="text" name="jenis_barang" value="{{ old('jenis_barang') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="pelayaran" class="block text-sm/6 font-medium text-gray-900">Pelayaran</label>
                            <div class="mt-2">
                                <input type="text" name="pelayaran" value="{{ old('pelayaran') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="nama_kapal" class="block text-sm/6 font-medium text-gray-900">Nama Kapal</label>
                            <div class="mt-2">
                                <input type="text" name="nama_kapal" value="{{ old('nama_kapal') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="voy" class="block text-sm/6 font-medium text-gray-900">Voy</label>
                            <div class="mt-2">
                                <input type="text" name="voy" value="{{ old('voy') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="tujuan" class="block text-sm/6 font-medium text-gray-900">Tujuan</label>
                            <div class="mt-2">
                                <input type="text" name="tujuan" value="{{ old('tujuan') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="etd" class="block text-sm/6 font-medium text-gray-900">ETD</label>
                            <div class="mt-2">
                                <input type="date" name="etd" value="{{ old('etd') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="eta" class="block text-sm/6 font-medium text-gray-900">ETA</label>
                            <div class="mt-2">
                                <input type="date" name="eta" value="{{ old('eta') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="no_count" class="block text-sm/6 font-medium text-gray-900">No Count</label>
                            <div class="mt-2">
                                <input type="text" name="no_count" value="{{ old('no_count') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="seal" class="block text-sm/6 font-medium text-gray-900">Seal</label>
                            <div class="mt-2">
                                <input type="text" name="seal" value="{{ old('seal') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="agen" class="block text-sm/6 font-medium text-gray-900">Agen</label>
                            <div class="mt-2">
                                <input type="text" name="agen" value="{{ old('agen') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="dooring" class="block text-sm/6 font-medium text-gray-900">Dooring</label>
                            <div class="mt-2">
                                <input type="date" name="dooring" value="{{ old('dooring') }}" required
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
                                <input type="text" name="nopol" value="{{ old('nopol') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="supir" class="block text-sm/6 font-medium text-gray-900">Supir</label>
                            <div class="mt-2">
                                <input type="text" name="supir" value="{{ old('supir') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="no_telp" class="block text-sm/6 font-medium text-gray-900">No Telp</label>
                            <div class="mt-2">
                                <input type="text" name="no_telp" value="{{ old('no_telp') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="harga" class="block text-sm/6 font-medium text-gray-900">Harga</label>
                            <div class="mt-2">
                                <input type="text" name="harga" value="{{ old('harga') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">SI Final & BA Done</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                        <div class="sm:col-span-2">
                            <label for="si_final" class="block text-sm/6 font-medium text-gray-900">SI Final</label>
                            <div class="mt-2">
                                <input type="text" name="si_final" value="{{ old('si_final') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="ba" class="block text-sm/6 font-medium text-gray-900">BA</label>
                            <div class="mt-2">
                                <input type="date" name="ba" value="{{ old('ba') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="ba_balik" class="block text-sm/6 font-medium text-gray-900">BA Balik</label>
                            <div class="mt-2">
                                <input type="date" name="ba_balik" value="{{ old('ba_balik') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="no_inv" class="block text-sm/6 font-medium text-gray-900">No Inv</label>
                            <div class="mt-2">
                                <input type="number" min="1" name="no_inv" value="{{ old('no_inv') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Alamat & Nama Penerima</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="alamat_penerima_barang" class="block text-sm/6 font-medium text-gray-900">Alamat Penerima Barang</label>
                            <div class="mt-2">
                                <input type="text" name="alamat_penerima_barang" value="{{ old('alamat_penerima_barang') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="nama_penerima" class="block text-sm/6 font-medium text-gray-900">Nama
                                Penerima</label>
                            <div class="mt-2">
                                <input type="text" name="nama_penerima" value="{{ old('nama_penerima') }}" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="reset" class="text-sm/6 font-semibold text-gray-900">Reset</button>
                    <button type="submit"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
