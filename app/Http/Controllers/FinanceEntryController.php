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
    public function index(Request $request, EntryPeriod $entry_period)
    {
        $search = $request->input('search');

        $entries = EntryMain::where('entry_period_id', $entry_period->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('qty', 'like', "%{$search}%")
                        ->orWhere('tgl_stuffing', 'like', "%{$search}%")
                        ->orWhere('pengirim', 'like', "%{$search}%")
                        ->orWhere('nama_kapal', 'like', "%{$search}%")
                        ->orWhere('nama_kapal', 'like', "%{$search}%")
                        ->orWhere('voy', 'like', "%{$search}%")
                        ->orWhere('tujuan', 'like', "%{$search}%")
                        ->orWhere('no_inv', 'like', "%{$search}%")
                        ->orWhere('no_cont', 'like', "%{$search}%")
                        ->orWhere('seal', 'like', "%{$search}%")
                        ->orWhere('etd', 'like', "%{$search}%")
                        ->orWhere('agen', 'like', "%{$search}%")
                        ->orWhere('dooring', 'like', "%{$search}%")
                        ->orWhere('no_inv', 'like', "%{$search}%")
                        ->orWhere('pph_status', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

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
