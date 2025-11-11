<x-admin.layout>
    <div class="space-y-8">
        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Admin Data Entry Periode {{ $admin_entry_date->periode }}
            </div>
        </div>

        <div class="">
            <a href="{{ route('admin_entry_dates.admin_entry_datas.create', $admin_entry_date->id) }}"
                class="shadow-md rounded-md bg-green-500 hover:bg-green-600 p-4 text-white font-semibold">+
                Tambah</a>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr class="text-justify">
                            <th class="py-4 px-6 text-left text-gray-600">No</th>
                            <th class="py-4 px-6 text-left text-gray-600">Qty</th>
                            <th class="py-4 px-6 text-left text-gray-600">Tgl Stuffing</th>
                            <th class="py-4 px-6 text-left text-gray-600">SL/SD</th>
                            <th class="py-4 px-6 text-left text-gray-600">Customer</th>
                            <th class="py-4 px-6 text-left text-gray-600">Pengirim</th>
                            <th class="py-4 px-6 text-left text-gray-600">Penerima</th>
                            <th class="py-4 px-6 text-left text-gray-600">Jenis Barang</th>
                            <th class="py-4 px-6 text-left text-gray-600">Pelayaran</th>
                            <th class="py-4 px-6 text-left text-gray-600">Nama Kapal</th>
                            <th class="py-4 px-6 text-left text-gray-600">Voy</th>
                            <th class="py-4 px-6 text-left text-gray-600">Tujuan</th>
                            <th class="py-4 px-6 text-left text-gray-600">ETD</th>
                            <th class="py-4 px-6 text-left text-gray-600">ETA</th>
                            <th class="py-4 px-6 text-left text-gray-600">No Count</th>
                            <th class="py-4 px-6 text-left text-gray-600">Seal</th>
                            <th class="py-4 px-6 text-left text-gray-600">Agen</th>
                            <th class="py-4 px-6 text-left text-gray-600">Dooring</th>
                            <th class="py-4 px-6 text-left text-gray-600">Nopol</th>
                            <th class="py-4 px-6 text-left text-gray-600">Supir</th>
                            <th class="py-4 px-6 text-left text-gray-600">No Telp</th>
                            <th class="py-4 px-6 text-left text-gray-600">Harga</th>
                            <th class="py-4 px-6 text-left text-gray-600">SI Final</th>
                            <th class="py-4 px-6 text-left text-gray-600">BA</th>
                            <th class="py-4 px-6 text-left text-gray-600">BA Balik</th>
                            <th class="py-4 px-6 text-left text-gray-600">No Inv</th>
                            <th class="py-4 px-6 text-left text-gray-600">Alamat Penerima Barang</th>
                            <th class="py-4 px-6 text-left text-gray-600">Nama Penerima</th>
                            <th class="py-4 px-6 text-left text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($datas as $data)
                            <tr>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->id }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->qty }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->tgl_stuffing }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->sl_sd }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->customer }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->pengirim }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->penerima }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->jenis_barang }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->pelayaran }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->nama_kapal }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->voy }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->tujuan }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->etd }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->eta }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->no_count }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->seal }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->agen }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->dooring }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->nopol }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->supir }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->no_telp }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->harga }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->si_final }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->ba }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->ba_balik }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->no_inv }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->alamat_penerima_barang }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $data->nama_penerima }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('admin_entry_dates.admin_entry_datas.destroy', [$admin_entry_date->id, $data->id]) }}"
                                        method="POST" class="flex flex-wrap gap-2">

                                        {{-- <a href=""
                                            class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded-md text-sm">
                                            LIHAT
                                        </a> --}}

                                        <a href="{{ route('admin_entry_dates.admin_entry_datas.edit', [$admin_entry_date->id, $data->id]) }}"
                                            class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md">
                                            Edit
                                        </a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm shadow-md">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div
                                class="bg-gradient-to-r from-red-100 to-red-200 text-red-900 px-6 py-5 w-full text-lg font-semibold">
                                Data belum tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $datas->links() }}
        </div>
    </div>
</x-admin.layout>
