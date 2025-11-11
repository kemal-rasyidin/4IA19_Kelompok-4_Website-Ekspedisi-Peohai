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
            'customer' => 'required|string',
            'qty' => 'required|integer',
            'tgl_stuffing' => 'required|date',
            'sl_sd' => 'required|string',
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
            'customer' => 'required|string',
            'qty' => 'required|integer',
            'tgl_stuffing' => 'required|date',
            'sl_sd' => 'required|string',
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
