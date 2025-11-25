<?php

namespace App\Http\Controllers;

use App\Models\EntryMain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function search(Request $request)
    {
        $key = 'tracking-search:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'no_cont' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        RateLimiter::hit($key, 30);

        $validated = $request->validate([
            'no_cont' => 'required|string|max:50',
            'no_inv' => 'required|string|max:50',
        ], [
            'no_cont.required' => 'Nomor container wajib diisi',
            'no_cont.max' => 'Nomor container terlalu panjang',
            'no_inv.required' => 'Nomor invoice wajib diisi',
            'no_inv.max' => 'Nomor invoice terlalu panjang',
        ]);

        $no_cont = strip_tags($validated['no_cont']);
        $no_inv = strip_tags($validated['no_inv']);

        $entry = EntryMain::where('no_cont', $no_cont)
            ->where('no_inv', $no_inv)
            ->first();

        if (!$entry) {
            return back()
                ->withInput()
                ->with('error', 'Data tidak ditemukan. Periksa kembali nomor container dan invoice Anda.');
        }

        return view('tracking.result', compact('entry'));
    }
}
