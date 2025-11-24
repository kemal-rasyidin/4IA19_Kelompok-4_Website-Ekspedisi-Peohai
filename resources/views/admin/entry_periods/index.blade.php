<x-admin.layout>
    <div class="space-y-6">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold text-white">
            <div class="p-6 text-gray-100">
                {{ __('Data Periode Entry') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="p-6">
                <form method="GET" action="{{ route('entry_periods.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_1fr_auto] gap-3 items-end">

                        <div>
                            <label for="filter_tahun" class="block text-sm font-medium text-gray-700 mb-1">
                                Filter Tahun
                            </label>
                            <select name="filter_tahun" id="filter_tahun"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="">Semua Tahun</option>
                                @foreach ($years ?? [] as $year)
                                    <option value="{{ $year }}"
                                        {{ request('filter_tahun') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="filter_bulan" class="block text-sm font-medium text-gray-700 mb-1">
                                Filter Bulan
                            </label>
                            <select name="filter_bulan" id="filter_bulan"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="">Semua Bulan</option>
                                @php
                                    $bulanList = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];
                                @endphp
                                @foreach ($bulanList as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ request('filter_bulan') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-6 py-2 border border-blue-500 bg-blue-50 text-blue-600 hover:text-white hover:bg-blue-500 rounded-md font-semibold shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M9.5 16q-2.725 0-4.612-1.888T3 9.5t1.888-4.612T9.5 3t4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7t-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5t-1.312-3.187T9.5 5T6.313 6.313T5 9.5t1.313 3.188T9.5 14" />
                                </svg>
                            </button>
                            <a href="{{ route('entry_periods.index') }}"
                                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md font-semibold shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M12 20q-3.35 0-5.675-2.325T4 12t2.325-5.675T12 4q1.725 0 3.3.712T18 6.75V4h2v7h-7V9h4.2q-.8-1.4-2.187-2.2T12 6Q9.5 6 7.75 7.75T6 12t1.75 4.25T12 18q1.925 0 3.475-1.1T17.65 14h2.1q-.7 2.65-2.85 4.325T12 20" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    @if (request()->hasAny(['filter_tahun', 'filter_bulan']))
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-sm text-gray-600">Filter aktif:</span>

                            @if (request('filter_tahun'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Tahun: {{ request('filter_tahun') }}
                                    <a href="{{ route('entry_periods.index', array_filter(request()->except('filter_tahun'))) }}"
                                        class="ml-2 text-blue-600 hover:text-blue-800">×</a>
                                </span>
                            @endif

                            @if (request('filter_bulan'))
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Bulan: {{ $bulanList[request('filter_bulan')] }}
                                    <a href="{{ route('entry_periods.index', array_filter(request()->except('filter_bulan'))) }}"
                                        class="ml-2 text-purple-600 hover:text-purple-800">×</a>
                                </span>
                            @endif
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('entry_periods.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Bulan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tahun</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Data</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($periods as $index => $period)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $periods->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $bulanList[$period->bulan] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $period->tahun }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $period->entries_count ?? 0 }} data
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.entries.index', ['entry_period' => $period->id]) }}"
                                        class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M3 8h18V4H3zm0 6h18v-4H3zm0 6h18v-4H3zM4 7V5h2v2zm0 6v-2h2v2zm0 6v-2h2v2z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('finance.entries.index', ['entry_period' => $period->id]) }}"
                                        class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5 21q-.825 0-1.412-.587T3 19V3h2v16h16v2zm1-3V9h4v9zm5 0V4h4v14zm5 0v-5h4v5z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('status.entries.index', ['entry_period' => $period->id]) }}"
                                        class="bg-purple-600 hover:bg-purple-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M7 20q-1.25 0-2.125-.875T4 17H2.725q-.425 0-.713-.288T1.725 16t.288-.712t.712-.288h2.05q.425-.475 1-.737T7 14t1.225.263t1 .737H13.4l2.1-9H5.75q-.425 0-.712-.288T4.75 5t.288-.712T5.75 4h11q.5 0 .8.375t.175.85L17.075 8H19q.475 0 .9.213t.7.587l1.875 2.475q.275.35.35.763t0 .837L22.15 16.2q-.075.35-.35.575t-.625.225H20q0 1.25-.875 2.125T17 20t-2.125-.875T14 17h-4q0 1.25-.875 2.125T7 20m8.925-7h4.825l.1-.525L19 10h-2.375zm-2.475 1.825l.163-.725q.162-.725.412-1.775q.075-.325.15-.6t.125-.55l.163-.725q.162-.725.412-1.775t.413-1.775l.162-.725L15.5 6l-2.1 9zm-11.7-1.5q-.425 0-.712-.287t-.288-.713t.288-.712t.712-.288h3.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zm2-3.65q-.425 0-.712-.288t-.288-.712t.288-.712t.712-.288h4.5q.425 0 .713.288t.287.712t-.288.713t-.712.287zM7 18q.425 0 .713-.288T8 17t-.288-.712T7 16t-.712.288T6 17t.288.713T7 18m10 0q.425 0 .713-.288T18 17t-.288-.712T17 16t-.712.288T16 17t.288.713T17 18" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('entry_periods.edit', $period->id) }}"
                                        class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M5 19h1.425L16.2 9.225L14.775 7.8L5 17.575zm-1 2q-.425 0-.712-.288T3 20v-2.425q0-.4.15-.763t.425-.637L16.2 3.575q.3-.275.663-.425t.762-.15t.775.15t.65.45L20.425 5q.3.275.437.65T21 6.4q0 .4-.138.763t-.437.662l-12.6 12.6q-.275.275-.638.425t-.762.15zM19 6.4L17.6 5zm-3.525 2.125l-.7-.725L16.2 9.225z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('entry_periods.destroy', $period->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus periode ini?')">
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
                                class="bg-gradient-to-l from-white to-red-50 text-red-800 px-6 py-5 w-full text-lg font-semibold">
                                Data belum tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $periods->links() }}
            </div>
        </div>

    </div>
</x-admin.layout>
