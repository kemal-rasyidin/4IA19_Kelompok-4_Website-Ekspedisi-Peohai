<?php

namespace App\Http\Controllers;

use App\Models\AdminEntryDate;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminEntryDateController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(): View
    {
        $admin_entry_dates = AdminEntryDate::latest()->paginate(10);
        return view('admin/admin_entry_dates.index', compact('admin_entry_dates'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin/admin_entry_dates.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'periode' => [
                'required',
                'string',
                Rule::unique('admin_entry_dates', 'periode'),
            ],
        ], [
            'periode.unique' => 'Periode ini sudah ada, silakan pilih bulan & tahun lain.',
        ]);

        AdminEntryDate::create([
            'periode' => $request->periode,
        ]);

        return redirect()->route('admin_entry_dates.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $admin_entry_dates = AdminEntryDate::findOrFail($id);
        return view('admin/admin_entry_dates.edit', compact('admin_entry_dates'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'periode' => [
                'required',
                'string',
                Rule::unique('admin_entry_dates', 'periode')->ignore($id),
            ],
        ], [
            'periode.unique' => 'Periode ini sudah ada, silakan pilih bulan & tahun lain.',
        ]);

        $admin_entry_dates = AdminEntryDate::findOrFail($id);

        $admin_entry_dates->update([
            'periode' => $request->periode,
        ]);

        return redirect()->route('admin_entry_dates.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $admin_entry_date = AdminEntryDate::findOrFail($id);

        // Cek apakah masih ada data anak
        if ($admin_entry_date->adminEntryDatas()->exists()) {
            return redirect()->route('admin_entry_dates.index')
                ->with('error', 'Tidak dapat menghapus periode ini karena masih terdapat data di dalamnya.');
        }

        // Jika kosong, boleh dihapus
        $admin_entry_date->delete();

        return redirect()->route('admin_entry_dates.index')
            ->with('success', 'Data Berhasil Dihapus!');
    }
}
