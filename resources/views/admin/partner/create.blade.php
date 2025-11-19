<x-admin.layout>
    <div class="space-y-8">

        <div class="bg-green-500 overflow-hidden shadow-md rounded-lg text-lg font-semibold mb-3 text-white">
            <div class="p-6 text-gray-100">
                {{ __('Tambah Data Mitra/Partner') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-md rounded-lg">
            <form action="{{ route('partners.update') }}" method="POST" enctype="multipart/form-data" class="p-5">
                @csrf

                <div class="space-y-12">
                    <div>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-3">
                                <label for="nama_partner" class="block text-sm/6 font-medium text-gray-900">Nama
                                    Partner/Mitra</label>
                                <div class="mt-2">
                                    <input type="text" name="nama_partner" value="{{ old('nama_partner') }}" required
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama</label>
                                <div class="mt-2">
                                    <input type="text" name="nama" value="{{ old('nama') }}" required
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="alamat" class="block text-sm/6 font-medium text-gray-900">Alamat</label>
                                <div class="mt-2">
                                    <textarea name="alamat" value="{{ old('alamat') }}" required
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="no_hp" class="block text-sm/6 font-medium text-gray-900">No Hp</label>
                                <div class="mt-2">
                                    <input type="text" name="no_hp" value="{{ old('no_hp') }}" required
                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>
                            <div class="col-span-3">
                                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                                <div class="mt-2">
                                    <input type="email" name="email" value="{{ old('email') }}" required
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
