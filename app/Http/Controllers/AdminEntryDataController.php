<?php

namespace App\Http\Controllers;

use App\Models\AdminEntryDate;
use App\Models\AdminEntryData;
use Illuminate\Http\Request;

class AdminEntryDataController extends Controller
{
    public function index(AdminEntryDate $admin_entry_date)
    {
        $datas = $admin_entry_date->adminEntryDatas()->latest()->paginate(10);
        return view('admin/admin_entry_datas.index', compact('admin_entry_date', 'datas'));
    }

    public function create(AdminEntryDate $admin_entry_date)
    {
        return view('admin/admin_entry_datas.create', compact('admin_entry_date'));
    }

    public function store(Request $request, AdminEntryDate $admin_entry_date)
    {
        $request->validate([
            'qty' => 'required|integer',
            'tgl_stuffing' => 'required|date',
            'sl_sd' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'pelayaran' => 'required|string|max:255',
            'nama_kapal' => 'required|string|max:255',
            'voy' => 'required|string|max:100',
            'tujuan' => 'required|string|max:255',
            'etd' => 'required|date',
            'eta' => 'required|date',
            'no_cont' => 'required|string|max:100',
            'seal' => 'required|string|max:100',
            'agen' => 'required|string|max:255',
            'dooring' => 'required|date',
            'nopol' => 'required|string|max:50',
            'supir' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'harga' => 'required|numeric',
            'si_final' => 'required|string|max:255',
            'ba' => 'required|date',
            'ba_balik' => 'required|date',
            'no_inv' => 'required|string|max:255',
            'alamat_penerima_barang' => 'required|string|max:255',
            'nama_penerima' => 'required|string|max:255',
        ]);

        $admin_entry_date->adminEntryDatas()->create($request->all());

        return redirect()->route('admin_entry_dates.admin_entry_datas.index', $admin_entry_date)
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(AdminEntryDate $admin_entry_date, AdminEntryData $admin_entry_data)
    {
        return view('admin/admin_entry_datas.edit', compact('admin_entry_date', 'admin_entry_data'));
    }

    public function update(Request $request, AdminEntryDate $admin_entry_date, AdminEntryData $admin_entry_data)
    {
        $request->validate([
            'qty' => 'required|integer',
            'tgl_stuffing' => 'required|date',
            'sl_sd' => 'required|string|max:255',
            'customer' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'pelayaran' => 'required|string|max:255',
            'nama_kapal' => 'required|string|max:255',
            'voy' => 'required|string|max:100',
            'tujuan' => 'required|string|max:255',
            'etd' => 'required|date',
            'eta' => 'required|date',
            'no_cont' => 'required|string|max:100',
            'seal' => 'required|string|max:100',
            'agen' => 'required|string|max:255',
            'dooring' => 'required|date',
            'nopol' => 'required|string|max:50',
            'supir' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'harga' => 'required|numeric',
            'si_final' => 'required|string|max:255',
            'ba' => 'required|date',
            'ba_balik' => 'required|date',
            'no_inv' => 'required|string|max:255',
            'alamat_penerima_barang' => 'required|string|max:255',
            'nama_penerima' => 'required|string|max:255',
        ]);

        $admin_entry_data->update($request->all());

        return redirect()->route('admin_entry_dates.admin_entry_datas.index', $admin_entry_date)
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(AdminEntryDate $admin_entry_date, AdminEntryData $admin_entry_data)
    {
        $admin_entry_data->delete();

        return redirect()->route('admin_entry_dates.admin_entry_datas.index', $admin_entry_date)
            ->with('success', 'Data berhasil dihapus.');
    }
}
