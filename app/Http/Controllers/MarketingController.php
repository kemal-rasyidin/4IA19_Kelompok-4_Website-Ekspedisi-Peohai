<?php

namespace App\Http\Controllers;

use App\Models\EntryMain;
use App\Models\EntryPeriod;
use Illuminate\Http\Request;
use App\Exports\MarketingExport;
use Maatwebsite\Excel\Facades\Excel;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EntryPeriod $entry_period)
    {
        $entries = EntryMain::where('entry_period_id', $entry_period->id)->paginate(10);
        return view('admin.entry.marketing.index', compact('entries', 'entry_period'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntryPeriod $entry_period, EntryMain $entry)
    {
        return view('admin.entry.marketing.edit', compact('entry_period', 'entry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntryPeriod $entry_period, EntryMain $entry)
    {
        $validated = $request->validate([
            'harga_trucking' => 'nullable|integer',
            'tgl_marketing' => 'nullable|date',
            'tgl_jatuh_tempo' => 'nullable|date',
            'muat_barang' => 'nullable|string',
            'door_daerah' => 'nullable|integer',
            'stufing_dalam' => 'nullable|integer',
            'freight' => 'nullable|integer',
            'tgl_freight' => 'nullable|date',
            'thc' => 'nullable|integer',
            'asuransi' => 'nullable|integer',
            'bl' => 'nullable|integer',
            'ops' => 'nullable|integer',
            'asuransi_inv' => 'nullable|integer',
            'adm' => 'nullable|integer',
            'harga_jual' => 'nullable|integer',
            'pph23' => 'nullable|integer',
            'refund' => 'nullable|integer',
            'nol' => 'nullable|integer',
            'agen_daerah' => 'nullable|string',
            'keterangan_marketing' => 'nullable|string',
        ]);

        $validated['total_marketing'] =
            ($validated['door_daerah'] ?? 0) +
            ($validated['stufing_dalam'] ?? 0) +
            ($validated['harga_trucking'] ?? 0) +
            ($validated['freight'] ?? 0) +
            ($validated['thc'] ?? 0) +
            ($validated['asuransi'] ?? 0) +
            ($validated['bl'] ?? 0) +
            ($validated['ops'] ?? 0);

        $validated['total_inv'] =
            ($validated['asuransi_inv'] ?? 0) +
            ($validated['adm'] ?? 0) +
            ($validated['harga_jual'] ?? 0) -
            ($validated['pph23'] ?? 0);

        $validated['diterima'] =
            ($validated['total_inv'] ?? 0) -
            ($validated['refund'] ?? 0);

        $validated['bu_lia'] =
            ($validated['diterima'] ?? 0) -
            ($validated['total_marketing'] ?? 0);

        $validated['persentase_marketing'] =
            $validated['diterima'] > 0
            ? ($validated['bu_lia'] / $validated['diterima']) * 100
            : 0;

        $entry->update($validated);

        return redirect()
            ->route('marketing.entries.index', $entry_period->id)
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Export
     */
    public function export(EntryPeriod $entry_period)
    {
        return Excel::download(
            new MarketingExport($entry_period->id),
            'Marketing Entry-' . $entry_period->bulan . '-' . $entry_period->tahun . '.xlsx'
        );
    }
}
