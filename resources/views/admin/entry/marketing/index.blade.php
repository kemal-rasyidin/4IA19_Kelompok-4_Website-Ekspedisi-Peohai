<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Marketing Periode {{ $entry_period->periode }}
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <form method="GET" action="{{ route('marketing.entries.index', $entry_period->id) }}">
                <div class="flex gap-2">
                    <input type="text" name="search" placeholder="Cari?" value="{{ request('search') }}"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button type="submit"
                        class="px-6 py-2 border border-blue-500 bg-blue-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-md font-semibold shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                        </svg>
                    </button>
                    @if (request('search'))
                        <a href="{{ route('marketing.entries.index', $entry_period->id) }}"
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

        {{-- <div class="flex justify-end space-x-2">
            <a href="{{ route('marketing.entries.export', $entry_period) }}"
                class="inline-flex items-center px-4 py-2 border border-green-500 bg-blue-50 text-green-600 hover:text-white hover:bg-green-500 font-medium rounded-md shadow-md">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m16 8.4l-8.9 8.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7L14.6 7H7q-.425 0-.712-.288T6 6t.288-.712T7 5h10q.425 0 .713.288T18 6v10q0 .425-.288.713T17 17t-.712-.288T16 16z" />
                </svg>
                Ekspor
            </a>
        </div> --}}

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th colspan="17"></th>

                            <th colspan="2"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                Harga Pelayaran
                            </th>

                            <th colspan="5"></th>

                            <th colspan="6"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                Nilai Invoice
                            </th>

                            <th colspan="2"></th>

                            <th colspan="2"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider bg-green-50">
                                Profit
                            </th>

                            <th colspan="1"></th>

                            <th colspan="1"
                                class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider bg-cyan-50">
                                Agen Daerah
                            </th>

                            <th colspan="1"></th>

                            <th rowspan="2"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jatuh Tempo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Muat Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tujuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cont</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No Container</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Seal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Vessel</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Voyage</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pelayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ETD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Door Daerah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stufing Dalam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trucking</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                Freight</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                Tanggal Bayar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                THC</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Asuransi 0,2%</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                BL</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                OPS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                No Inv</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                Asuransi 0,2%</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                ADM</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                Harga Jual</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                PPH 23</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                Invoice</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Refund</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Yang Diterima</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-green-50">
                                BU' LIA</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-green-50">
                                0</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Presentase</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-cyan-50">
                                Daerah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($entries as $entry)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->tanggal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $entry->jatuh_tempo }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->muat_barang }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->customer }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $entry->jenis_barang }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->tujuan }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $entry->qty }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->no_cont }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->seal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->nama_kapal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->voy }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->pelayaran }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->etd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->door_daerah, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->stufing_dalam, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->harga_trucking, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->freight, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $entry->tgl_freight }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->thc, 2, ',', '.') }}</td>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->asuransi, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->bl, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->ops, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->total_marketing, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->no_inv }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->asuransi_inv, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->adm, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->harga_jual, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->pph23, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->total_inv, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->refund, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->diterima, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->bu_lia, 2, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ 'Rp ' . number_format($entry->nol, 2, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ number_format($entry->persentase_marketing, 2) }} %
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $entry->agen_daerah }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $entry->keterangan_marketing }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        class="flex flex-wrap gap-2">
                                        <a href="{{ route('marketing.entries.edit', [$entry->entry_period_id, $entry->id]) }}"
                                            class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-1 2q-.425 0-.712-.288T3 20v-2.425q0-.4.15-.763t.425-.637L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.437.65T21 6.4q0 .4-.138.763t-.437.662l-12.6 12.6q-.275.275-.638.425t-.762.15zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                            </svg>
                                        </a>

                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div
                                class="bg-gradient-to-l from-white to-red-50 text-red-800 px-6 py-5 w-full text-lg font-semibold">
                                Data belum tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $entries->links() }}
            </div>
        </div>

    </div>
</x-admin.layout>
