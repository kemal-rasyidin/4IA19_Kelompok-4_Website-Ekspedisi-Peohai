<x-admin.layout>
    <div class="space-y-8">
        <div class="bg-green-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                {{ __('Tambah Bulan & Tahun Admin Data Entry') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form action="{{ route('admin_entry_dates.store') }}" method="POST" enctype="multipart/form-data"
                class="p-5">

                @csrf

                <div class="space-y-12">
                    <div>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="periode" class="block text-sm/6 font-medium text-gray-900">Bulan &
                                    Tahun</label>
                                <div class="mt-2">
                                    <input type="month" name="periode" value="{{ old('periode') }}" required
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="reset" class="text-sm/6 font-semibold text-gray-900">Reset</button>
                    <button type="submit"
                        class="rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</x-admin.layout>
