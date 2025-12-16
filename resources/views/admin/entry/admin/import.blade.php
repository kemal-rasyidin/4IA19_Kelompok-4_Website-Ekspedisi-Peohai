<x-admin.layout>
    <div class="space-y-6">
        <div class="bg-green-600 text-white shadow-md rounded-lg">
            <div class="p-6 text-lg font-semibold">
                {{ __('Tambah Data Admin Entry (Import)') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
            <form action="{{ route('admin.entries.import', $entry_period->id) }}" method="POST"
                enctype="multipart/form-data" class="p-5">
                @csrf

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">File .xlsx/.xls/.csv</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv">
                    </div>
                </div>
                <hr class="h-px my-8 bg-gray-300 border-0">

                <div class="mt-8 flex items-center justify-end gap-x-4">
                    <button onclick="history.back()"
                        class="text-sm font-semibold text-gray-700 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        Kembali
                    </button>
                    <button type="reset"
                        class="text-sm font-semibold text-gray-700 hover:text-gray-900 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        Reset
                    </button>
                    <button type="submit"
                        class="rounded-md bg-green-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
