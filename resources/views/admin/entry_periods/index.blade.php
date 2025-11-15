<x-admin.layout>
    <div class="space-y-8">

        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                Periode Data Entry
            </div>
        </div>

        <div>
            <a href="{{ route('entry_periods.create') }}"
                class="shadow-md rounded-md bg-green-500 hover:bg-green-600 p-4 text-white font-semibold">+ Tambah</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr class="text-justify">
                            {{-- <th class="py-4 px-6 text-left text-gray-600">No</th> --}}
                            <th class="py-4 px-6 text-left text-gray-600">Periode</th>
                            <th class="py-4 px-6 text-left text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse ($periods as $period)
                            <tr>
                                {{-- <td class="py-4 px-6 border-b border-gray-200">{{ $admin_entry_date->id }}</td> --}}
                                <td class="py-4 px-6 border-b border-gray-200">{{ $period->periode }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('entry_periods.destroy', $period->id) }}" method="POST"
                                        class="flex flex-wrap gap-2">
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
                                        <a href="{{ route('entry_periods.edit', $period->id) }}"
                                            class="bg-yellow-600 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-sm shadow-md inline-flex items-center gap-2">
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
            {{ $periods->links() }}
        </div>

    </div>
</x-admin.layout>
