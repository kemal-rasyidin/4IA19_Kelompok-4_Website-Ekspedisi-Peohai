<x-admin.layout>
    <div class="space-y-8">

        <div class="bg-yellow-600 text-white shadow-md rounded-lg">
            <div class="p-6 text-lg font-semibold">
                {{ __('Edit Data Finance Entry') }}
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg rounded-lg p-6">
            <form action="{{ route('finance.entries.update', [$entry_period->id, $entry->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="">
                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="no_inv" class="block text-sm/6 font-medium text-gray-900">No Invoice</label>
                            <div class="mt-2">
                                <input type="text" name="no_inv" value="{{ old('no_inv', $entry->no_inv) }}"
                                    disabled
                                    class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 cursor-not-allowed sm:text-sm/6" />
                                <input type="hidden" name="no_inv" value="{{ $entry->no_inv }}">
                            </div>
                        </div>
                        <div class="sm:col-span-3">
                            <label for="pph_status" class="block text-sm/6 font-medium text-gray-900">PPH/Non</label>
                            <div class="mt-2 grid grid-cols-1">
                                <select id="pph_status" name="pph_status" autocomplete="pph_status"
                                    class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                    <option value="PPH" {{ old('pph_status') == 'PPH' ? 'selected' : '' }}>PPH</option>
                                    <option value="Non" {{ old('pph_status') == 'Non' ? 'selected' : '' }}>Non</option>
                                </select>
                                <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                    viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <hr class="h-px my-8 bg-gray-300 border-0">
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                        class="rounded-md bg-yellow-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-yellow-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                </div>
            </form>
        </div>

    </div>
</x-admin.layout>
