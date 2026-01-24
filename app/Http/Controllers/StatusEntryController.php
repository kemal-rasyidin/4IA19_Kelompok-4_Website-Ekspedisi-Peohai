<?php

namespace App\Http\Controllers;

use App\Models\EntryMain;
use App\Models\EntryPeriod;
use Illuminate\Http\Request;

class StatusEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, EntryPeriod $entry_period)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = EntryMain::where('entry_period_id', $entry_period->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('qty', 'like', "%{$search}%")
                        ->orWhere('tgl_stuffing', 'like', "%{$search}%")
                        ->orWhere('pengirim', 'like', "%{$search}%")
                        ->orWhere('nama_kapal', 'like', "%{$search}%")
                        ->orWhere('voy', 'like', "%{$search}%")
                        ->orWhere('tujuan', 'like', "%{$search}%")
                        ->orWhere('no_cont', 'like', "%{$search}%")
                        ->orWhere('seal', 'like', "%{$search}%")
                        ->orWhere('etd', 'like', "%{$search}%")
                        ->orWhere('agen', 'like', "%{$search}%")
                        ->orWhere('dooring', 'like', "%{$search}%")
                        ->orWhere('no_inv', 'like', "%{$search}%");
                });
            });

        // Filter berdasarkan status paket (computed attribute)
        if ($status) {
            $query->where(function ($q) use ($status) {
                switch ($status) {
                    case 'Sampai Di Tujuan':
                        $q->whereNotNull('dooring');
                        break;
                    case 'Dalam Perjalanan':
                        $q->whereNotNull('etd')
                            ->whereNull('dooring');
                        break;
                    case 'Dikemas':
                        $q->whereNull('etd')
                            ->whereNull('dooring');
                        break;
                }
            });
        }

        $entries = $query->paginate(10)->withQueryString();

        return view('admin.entry.status.index', compact('entries', 'entry_period'));
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
    // public function edit(EntryPeriod $entry_period, EntryMain $entry)
    // {
    //     return view('admin.entry.status.edit', compact('entry_period', 'entry'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntryPeriod $entry_period, EntryMain $entry)
    {
        $validated = $request->validate([
            'ba' => 'nullable|string',
            'etd' => 'nullable|date',
        ]);

        $entry->update($validated);

        return redirect()
            ->route('status.entries.index', $entry_period->id)
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
