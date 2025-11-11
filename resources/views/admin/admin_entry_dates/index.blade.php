<x-admin.layout>
    <div class="space-y-8">
        <div class="bg-blue-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                {{ __('Periode Bulan & Tahun Admin Data Entry') }}
            </div>
        </div>

        <div class="">
            <a href="{{ route('admin_entry_dates.create') }}"
                class="shadow-md rounded-md bg-green-500 hover:bg-green-600 p-4 text-white font-semibold">+ Tambah</a>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg">
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
                        @forelse ($admin_entry_dates as $admin_entry_date)
                            <tr>
                                {{-- <td class="py-4 px-6 border-b border-gray-200">{{ $admin_entry_date->id }}</td> --}}
                                <td class="py-4 px-6 border-b border-gray-200">{{ $admin_entry_date->periode }}</td>
                                <td class="py-4 px-6 border-b border-gray-200">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('admin_entry_dates.destroy', $admin_entry_date->id) }}"
                                        method="POST" class="flex flex-wrap gap-2">

                                        {{-- <a href=""
                                            class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded-md text-sm">
                                            LIHAT
                                        </a> --}}

                                        <a href="{{ route('admin_entry_dates.edit', $admin_entry_date->id) }}"
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
            {{ $admin_entry_dates->links() }}
        </div>
    </div>
</x-admin.layout>
