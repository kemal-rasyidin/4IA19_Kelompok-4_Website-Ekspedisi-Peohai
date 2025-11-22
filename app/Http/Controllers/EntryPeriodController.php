<?php

namespace App\Http\Controllers;

use App\Models\EntryPeriod;
use Illuminate\Http\Request;

class EntryPeriodController extends Controller
{
    public function index(Request $request)
    {
        $query = EntryPeriod::query()->withCount('entries'); // Asumsi ada relasi entries()

        // Filter by tahun only
        if ($request->filled('filter_tahun')) {
            $query->where('tahun', $request->filter_tahun);
        }

        // Filter by bulan only
        if ($request->filled('filter_bulan')) {
            $query->where('bulan', $request->filter_bulan);
        }

        // Order by latest
        $query->orderBy('tahun', 'desc')->orderBy('bulan', 'desc');

        $periods = $query->paginate(10)->withQueryString();

        // Get available years for filter dropdown
        $years = EntryPeriod::distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.entry_periods.index', compact('periods', 'years'));
    }

    public function create()
    {
        return view('admin.entry_periods.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode' => 'required|date_format:Y-m',
        ], [
            'periode.required' => 'Periode wajib diisi',
            'periode.date_format' => 'Format periode tidak valid',
        ]);

        // Parse periode menjadi tahun dan bulan
        [$tahun, $bulan] = explode('-', $validated['periode']);

        // Cek duplikasi periode
        $exists = EntryPeriod::where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['periode' => 'Periode untuk bulan dan tahun ini sudah ada.'])
                ->withInput();
        }

        // Simpan data
        EntryPeriod::create([
            'tahun' => $tahun,
            'bulan' => $bulan,
        ]);

        return redirect()->route('entry_periods.index')
            ->with('success', 'Periode berhasil ditambahkan');
    }

    public function edit(EntryPeriod $entryPeriod)
    {
        return view('admin.entry_periods.edit', compact('entryPeriod'));
    }

    public function update(Request $request, EntryPeriod $entryPeriod)
    {
        $validated = $request->validate([
            'periode' => 'required|date_format:Y-m',
        ]);

        [$tahun, $bulan] = explode('-', $validated['periode']);

        // Cek duplikasi kecuali data sendiri
        $exists = EntryPeriod::where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->where('id', '!=', $entryPeriod->id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['periode' => 'Periode untuk bulan dan tahun ini sudah ada.'])
                ->withInput();
        }

        $entryPeriod->update([
            'tahun' => $tahun,
            'bulan' => $bulan,
        ]);

        return redirect()->route('entry_periods.index')
            ->with('success', 'Periode berhasil diperbarui');
    }

    public function destroy(EntryPeriod $entryPeriod)
    {
        if ($entryPeriod->entries()->count() > 0) {
            return back()->with('error', 'Periode tidak dapat dihapus karena masih memiliki data entry!');
        }

        $entryPeriod->delete();

        return redirect()->route('entry_periods.index')
            ->with('success', 'Periode berhasil dihapus');
    }
}
