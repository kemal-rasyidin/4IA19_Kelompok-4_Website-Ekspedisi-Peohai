<x-admin.layout>
    <div class="space-y-8">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Admin Data Entry Periode {{ $entry_period->periode }}
            </div>
        </div>

        <div>
            <a href="{{ route('admin.entries.create', $entry_period->id) }}"
                class="shadow-md rounded-md bg-green-500 hover:bg-green-600 p-4 text-white font-semibold">+ Tambah
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
        @endif

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
                        @forelse ($entries as $entry)
                            <tr>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $loop->iteration }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->qty }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->tgl_stuffing }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->sl_sd }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->customer }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->pengirim }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->penerima }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->jenis_barang }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->pelayaran }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->nama_kapal }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->voy }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->tujuan }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->etd }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->eta }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->no_cont }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->seal }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->agen }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->dooring }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->nopol }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->supir }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->no_telp }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->harga }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->si_final }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->ba }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->ba_balik }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->no_inv }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->alamat_penerima_barang }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->nama_penerima }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('admin.entries.destroy', [$entry_period->id, $entry->id]) }}"
                                        method="POST" class="flex flex-wrap gap-2">

                                        <a href="{{ route('admin.entries.edit', [$entry_period->id, $entry->id]) }}"
                                            class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md">
                                            Edit
                                        </a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div
                                class="bg-gradient-to-l from-white to-red-200 text-red-900 px-6 py-5 w-full text-lg font-semibold">
                                Data belum tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- {{ $entrys->links() }} --}}
        </div>

    </div>
</x-admin.layout>
