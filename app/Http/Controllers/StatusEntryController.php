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
    public function index(EntryPeriod $entry_period)
    {
        $entries = EntryMain::where('entry_period_id', $entry_period->id)->paginate(10);
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
