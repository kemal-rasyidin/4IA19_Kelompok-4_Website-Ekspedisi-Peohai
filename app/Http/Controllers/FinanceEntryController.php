<?php

namespace App\Http\Controllers;

use App\Models\EntryMain;
use App\Models\EntryPeriod;
use Illuminate\Http\Request;
use App\Exports\FinanceEntryExport;
use Maatwebsite\Excel\Facades\Excel;

class FinanceEntryController extends Controller
{
    /**
     * Menampilkan daftar data untuk Finance
     */
    public function index(EntryPeriod $entry_period)
    {
        $entries = EntryMain::where('entry_period_id', $entry_period->id)->paginate(10);
        return view('admin.entry.finance.index', compact('entries', 'entry_period'));
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
     * Form edit data untuk Finance
     */
    public function edit(EntryPeriod $entry_period, EntryMain $entry)
    {
        return view('admin.entry.finance.edit', compact('entry_period', 'entry'));
    }

    /**
     * Update data oleh Finance
     */
    public function update(Request $request, EntryPeriod $entry_period, EntryMain $entry)
    {
        $validated = $request->validate([
            'pph_status' => 'nullable|string',
        ]);

        $entry->update($validated);

        return redirect()
            ->route('finance.entries.index', $entry_period->id)
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
            new FinanceEntryExport($entry_period->id),
            'Finance Entry-' . $entry_period->bulan . '-' . $entry_period->tahun . '.xlsx'
        );
    }
}
