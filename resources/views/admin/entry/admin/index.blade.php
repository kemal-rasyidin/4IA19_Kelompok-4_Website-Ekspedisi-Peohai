<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Admin Data Entry Periode {{ $entry_period->periode }}
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mb-4">
            <form method="GET" action="{{ route('admin.entries.index', $entry_period->id) }}">
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

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.entries.create', $entry_period->id) }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah
            </a>
            <a href="{{ route('admin.entries.export', $entry_period) }}"
                class="inline-flex items-center px-4 py-2 border border-green-500 bg-blue-50 text-green-600 hover:text-white hover:bg-green-500 font-medium rounded-md shadow-md">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m16 8.4l-8.9 8.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7L14.6 7H7q-.425 0-.712-.288T6 6t.288-.712T7 5h10q.425 0 .713.288T18 6v10q0 .425-.288.713T17 17t-.712-.288T16 16z" />
                </svg>
                Ekspor
            </a>
            <a href="{{ route('admin.entries.import.form', $entry_period) }}"
                class="inline-flex items-center px-4 py-2 border border-yellow-500 bg-blue-50 text-yellow-600 hover:text-white hover:bg-yellow-500 font-medium rounded-md shadow-md">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <g transform="rotate(180 12 12)">
                        <path fill="currentColor"
                            d="m16 8.4l-8.9 8.9q-.275.275-.7.275t-.7-.275t-.275-.7t.275-.7L14.6 7H7q-.425 0-.712-.288T6 6t.288-.712T7 5h10q.425 0 .713.288T18 6v10q0 .425-.288.713T17 17t-.712-.288T16 16z" />
                    </g>
                </svg>
                Impor
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form id="bulkDeleteForm" action="{{ route('admin.entries.bulkDestroy', $entry_period->id) }}"
                method="POST">
                @csrf
                @method('DELETE')

                <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="selectAll" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                        <label for="selectAll" class="text-sm font-medium text-gray-700">
                            Pilih Semua
                        </label>
                    </div>
                    <button type="submit" id="deleteSelectedBtn"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow-md inline-flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled onclick="return confirm('Apakah Anda yakin ingin menghapus data yang dipilih?');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                        </svg>
                        Hapus <span id="selectedCount">0</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th colspan="19"></th>
                                <th colspan="4"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                    TRUCKING
                                </th>
                                <th colspan="4"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                    SI FINAL &amp; BA DONE
                                </th>
                                <th colspan="2"></th>
                                <th rowspan="2"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Qty</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tgl Stuffing</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    SL/SD</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Customer</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengirim</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Penerima</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis Barang</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pelayaran</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Kapal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Voy</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tujuan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ETD</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ETA</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No Cont</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Seal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Agen</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dooring</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                    Nopol</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                    Supir</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                    No Telp</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-yellow-50">
                                    Harga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                    SI Final</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                    BA</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                    BA Balik</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bg-blue-50">
                                    No Inv</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat Penerima Barang</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Penerima</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($entries as $entry)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" name="admin_ids[]" value="{{ $entry->id }}"
                                            class="admin-checkbox w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->qty }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->tgl_stuffing }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->sl_sd }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->customer }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->pengirim }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->penerima }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->jenis_barang }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->pelayaran }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->nama_kapal }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->voy }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->tujuan }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->etd }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->eta }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->no_cont }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->seal }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->agen }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->dooring }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->nopol }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->supir }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->no_telp }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->harga_trucking }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->si_final }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->ba }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->ba_balik }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry->no_inv }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->alamat_penerima_barang }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $entry->nama_penerima }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('admin.entries.edit', [$entry_period->id, $entry->id]) }}"
                                                class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-1 2q-.425 0-.712-.288T3 20v-2.425q0-.4.15-.763t.425-.637L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.437.65T21 6.4q0 .4-.138.763t-.437.662l-12.6 12.6q-.275.275-.638.425t-.762.15zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                                </svg>
                                            </a>
                                        </div>
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
            </form>

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $entries->links() }}
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAllCheckbox = document.getElementById('selectAll');
                const adminCheckboxes = document.querySelectorAll('.admin-checkbox');
                const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
                const selectedCountSpan = document.getElementById('selectedCount');

                function updateSelectedCount() {
                    const checkedBoxes = document.querySelectorAll('.admin-checkbox:checked');
                    const count = checkedBoxes.length;

                    selectedCountSpan.textContent = count;
                    deleteSelectedBtn.disabled = count === 0;
                }

                selectAllCheckbox.addEventListener('change', function() {
                    adminCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateSelectedCount();
                });

                adminCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const allChecked = Array.from(adminCheckboxes).every(cb => cb.checked);
                        const someChecked = Array.from(adminCheckboxes).some(cb => cb.checked);

                        selectAllCheckbox.checked = allChecked;
                        selectAllCheckbox.indeterminate = someChecked && !allChecked;

                        updateSelectedCount();
                    });
                });

                updateSelectedCount();
            });
        </script>

    </div>
</x-admin.layout>
