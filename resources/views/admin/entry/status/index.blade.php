<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Status Data Entry Periode {{ $entry_period->periode }}
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <form method="GET" action="{{ route('status.entries.index', $entry_period->id) }}">
                <div class="flex flex-col md:flex-row gap-2">
                    <!-- Search Input -->
                    <input type="text" name="search" placeholder="Cari?" value="{{ request('search') }}"
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <!-- Dropdown Filter Status -->
                    <select name="status"
                        class="px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 md:w-48 text-sm">
                        <option value="">Semua Status</option>
                        <option value="Dikemas" {{ request('status') == 'Dikemas' ? 'selected' : '' }}>
                            Dikemas
                        </option>
                        <option value="Dalam Perjalanan"
                            {{ request('status') == 'Dalam Perjalanan' ? 'selected' : '' }}>
                            Dalam Perjalanan
                        </option>
                        <option value="Sampai Di Tujuan"
                            {{ request('status') == 'Sampai Di Tujuan' ? 'selected' : '' }}>
                            Sampai Di Tujuan
                        </option>
                    </select>

                    <!-- Button Group -->
                    <div class="flex gap-2">
                        <!-- Search Button -->
                        <button type="submit"
                            class="px-6 py-2 border border-blue-500 bg-blue-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-md font-semibold shadow-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                            </svg>
                        </button>

                        <!-- Reset Button -->
                        @if (request('search') || request('status'))
                            <a href="{{ route('status.entries.index', $entry_period->id) }}"
                                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md font-semibold shadow-md transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="text-justify">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tgl Stuffing</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengirim</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Kapal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Voy</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tujuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No Cont</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Seal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ETD</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Agen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dooring</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No Invoice</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status Paket</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($entries as $entry)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->qty }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->tgl_stuffing }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->pengirim }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->nama_kapal }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->voy }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->tujuan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->no_cont }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->seal }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->etd }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->agen }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->dooring }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->no_inv }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @switch($entry->status_paket)
                                        @case('Dikemas')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                                {{ $entry->status_paket }}
                                            </span>
                                        @break

                                        @case('Dalam Perjalanan')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-800">
                                                {{ $entry->status_paket }}
                                            </span>
                                        @break

                                        @case('Sampai Di Tujuan')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-200 text-green-800">
                                                {{ $entry->status_paket }}
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">
                                                -
                                            </span>
                                    @endswitch
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
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $entries->links() }}
                </div>
            </div>

        </div>
    </x-admin.layout>
