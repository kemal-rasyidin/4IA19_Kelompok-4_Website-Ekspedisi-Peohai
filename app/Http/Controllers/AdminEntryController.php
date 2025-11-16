<?php

namespace App\Http\Controllers;

use App\Models\EntryMain;
use App\Models\EntryPeriod;
use Illuminate\Http\Request;

class AdminEntryController extends Controller
{
    /**
     * Menampilkan daftar data Entry milik Admin (bisa difilter berdasarkan periode)
     */
    public function index(Request $request, EntryPeriod $entry_period)
    {
        $search = $request->input('search');

        $entries = EntryMain::where('entry_period_id', $entry_period->id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('customer', 'like', "%{$search}%")
                        ->orWhere('pengirim', 'like', "%{$search}%")
                        ->orWhere('penerima', 'like', "%{$search}%")
                        ->orWhere('no_cont', 'like', "%{$search}%")
                        ->orWhere('nama_kapal', 'like', "%{$search}%")
                        ->orWhere('nopol', 'like', "%{$search}%")
                        ->orWhere('supir', 'like', "%{$search}%")
                        ->orWhere('no_inv', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString(); // Biar parameter search tetap ada di pagination

        return view('admin.entry.admin.index', compact('entries', 'entry_period'));
    }

    /**
     * Form tambah data entry untuk Admin.
     */
    public function create(EntryPeriod $entry_period)
    {
        return view('admin.entry.admin.create', compact('entry_period'));
    }

    /**
     * Simpan data baru hasil input Admin
     */
    public function store(Request $request, EntryPeriod $entry_period)
    {
        $validated = $request->validate([
            'qty' => 'nullable|string',
            'tgl_stuffing' => 'nullable|date',
            'sl_sd' => 'nullable|string|max:255',
            'customer' => 'nullable|string|max:255',
            'pengirim' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
            'jenis_barang' => 'nullable|string|max:255',
            'pelayaran' => 'nullable|string|max:255',
            'nama_kapal' => 'nullable|string|max:255',
            'voy' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'etd' => 'nullable|date',
            'eta' => 'nullable|date',
            'no_cont' => 'nullable|string|max:255',
            'seal' => 'nullable|string|max:255',
            'agen' => 'nullable|string|max:255',
            'dooring' => 'nullable|date',
            'nopol' => 'nullable|string|max:255',
            'supir' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:50',
            'harga' => 'nullable|string',
            'si_final' => 'nullable|string|max:255',
            'ba' => 'nullable|date',
            'ba_balik' => 'nullable|date',
            'no_inv' => 'nullable|string|max:255',
            'alamat_penerima_barang' => 'nullable|string|max:255',
            'nama_penerima' => 'nullable|string|max:255',
        ]);

        $validated['entry_period_id'] = $entry_period->id;
        // $validated['status'] = 'admin_filled';

        EntryMain::create($validated);

        return redirect()
            ->route('admin.entries.index', $entry_period->id)
            ->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Form edit data Entry (Admin)
     */
    public function edit(EntryPeriod $entry_period, EntryMain $entry)
    {
        // $periods = EntryPeriod::orderByDesc('tahun')->get();
        return view('admin/entry.admin.edit', compact('entry', 'entry_period'));
    }


    /**
     * Update data Entry (Admin)
     */
    public function update(Request $request, EntryPeriod $entry_period, EntryMain $entry)
    {
        $validated = $request->validate([
            // 'entry_period_id' => 'required|exists:entry_periods,id',
            'qty' => 'nullable|string',
            'tgl_stuffing' => 'nullable|date',
            'sl_sd' => 'nullable|string|max:255',
            'customer' => 'nullable|string|max:255',
            'pengirim' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
            'jenis_barang' => 'nullable|string|max:255',
            'pelayaran' => 'nullable|string|max:255',
            'nama_kapal' => 'nullable|string|max:255',
            'voy' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',
            'etd' => 'nullable|date',
            'eta' => 'nullable|date',
            'no_cont' => 'nullable|string|max:255',
            'seal' => 'nullable|string|max:255',
            'agen' => 'nullable|string|max:255',
            'dooring' => 'nullable|date',
            'nopol' => 'nullable|string|max:255',
            'supir' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:50',
            'harga' => 'nullable|string',
            'si_final' => 'nullable|string|max:255',
            'ba' => 'nullable|date',
            'ba_balik' => 'nullable|date',
            'no_inv' => 'nullable|string|max:255',
            'alamat_penerima_barang' => 'nullable|string|max:255',
            'nama_penerima' => 'nullable|string|max:255',
        ]);

        $entry->update($validated);

        return redirect()
            ->route('admin.entries.index', $entry_period->id)
            ->with('success', 'Data admin berhasil diperbarui.');
    }

    /**
     * Hapus data Entry (Admin)
     */
    public function destroy(EntryPeriod $entry_period, EntryMain $entry)
    {
        if ($entry->entry_period_id != $entry_period->id) {
            abort(404);
        }
        $entry->delete();
        return redirect()->route('admin.entries.index', $entry_period->id)
            ->with('success', 'Data berhasil dihapus.');
    }
}
