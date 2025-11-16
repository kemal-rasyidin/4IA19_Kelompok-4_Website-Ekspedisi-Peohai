<x-admin.layout>
    <div class="space-y-8">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Admin Data Entry Periode {{ $entry_period->periode }}
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <form method="GET" action="{{ route('admin.entries.index', $entry_period->id) }}">
                <div class="flex gap-2">
                    <input type="text" name="search" placeholder="Cari?"
                        value="{{ request('search') }}"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-semibold shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                        </svg>
                    </button>
                    @if (request('search'))
                        <a href="{{ route('admin.entries.index', $entry_period->id) }}"
                            class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md font-semibold shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
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
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->alamat_penerima_barang }}
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200">{{ $entry->nama_penerima }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('admin.entries.destroy', [$entry_period->id, $entry->id]) }}"
                                        method="POST" class="flex flex-wrap gap-2">

                                        <a href="{{ route('admin.entries.edit', [$entry_period->id, $entry->id]) }}"
                                            class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-1 2q-.425 0-.712-.288T3 20v-2.425q0-.4.15-.763t.425-.637L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.437.65T21 6.4q0 .4-.138.763t-.437.662l-12.6 12.6q-.275.275-.638.425t-.762.15zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                            </svg>
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
            {{ $entries->links() }}
        </div>

    </div>
</x-admin.layout>
