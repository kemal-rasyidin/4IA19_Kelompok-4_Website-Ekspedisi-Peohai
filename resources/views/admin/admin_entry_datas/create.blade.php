<x-admin.layout>
    <div class="space-y-8">
        <div class="bg-green-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                {{ __('Tambah Admin Data Entry') }} Periode {{ $admin_entry_date->periode }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form action="" method="POST" enctype="multipart/form-data" class="p-5">

                @csrf

                <div class="">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="pilihan_layanan" class="block text-sm/6 font-medium text-gray-900">Qty</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="pilihan_layanan" name="pilihan_layanan" autocomplete="pilihan_layanan"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Tgl Stuffing</label>
                            <div class="mt-2">
                                <input type="date" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="pilihan_layanan" class="block text-sm/6 font-medium text-gray-900">SL/SD</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="pilihan_layanan" name="pilihan_layanan" autocomplete="pilihan_layanan"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option>SL</option>
                                    <option>SD</option>
                                </select>
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Customer</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Pengirim</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Penerima</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Jenis Barang</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Pelayaran</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Nama Kapal</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Voy</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Tujuan</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">ETD</label>
                            <div class="mt-2">
                                <input type="date" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">ETA</label>
                            <div class="mt-2">
                                <input type="date" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">No Count</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Seal</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Agen</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-1">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Dooring</label>
                            <div class="mt-2">
                                <input type="date" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Trucking</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Nopol</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Supir</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">No Telp</label>
                            <div class="mt-2">
                                <input type="text" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Harga</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">SI Final & BA Done</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">SI Final</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">BA</label>
                            <div class="mt-2">
                                <input type="date" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">BA Balik</label>
                            <div class="mt-2">
                                <input type="date" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">No Inv</label>
                            <div class="mt-2">
                                <input type="number" min="1" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                    <p class="my-4">Alamat & Nama Penerima</p>
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Alamat</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="" class="block text-sm/6 font-medium text-gray-900">Nama Penerima</label>
                            <div class="mt-2">
                                <input type="text" name="" value="" required
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
