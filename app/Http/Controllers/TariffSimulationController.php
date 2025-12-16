<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\TariffCalculator;
use Illuminate\Http\Request;

class TariffSimulationController extends Controller
{
    public function __construct(
        private TariffCalculator $calculator
    ) {}

    /**
     * Tampilkan halaman simulasi tarif
     */
    public function index()
    {
        // Ambil semua kota untuk dropdown
        $cities = City::orderBy('name', 'asc')->get();

        return view('tariff.index', compact('cities'));
    }

    /**
     * Proses simulasi tarif
     */
    public function simulate(Request $request)
    {
        $request->validate([
            'origin_id' => 'required|exists:cities,id',
            'destination_id' => 'required|exists:cities,id|different:origin_id'
        ], [
            'origin_id.required' => 'Silakan pilih kota asal',
            'destination_id.required' => 'Silakan pilih kota tujuan',
            'destination_id.different' => 'Kota tujuan harus berbeda dengan kota asal'
        ]);

        $origin = City::findOrFail($request->origin_id);
        $destination = City::findOrFail($request->destination_id);

        $result = $this->calculator->calculate($origin, $destination);

        // Ambil kembali list kota untuk form
        $cities = City::orderBy('name', 'asc')->get();

        return view('tariff.index', compact('cities', 'result', 'origin', 'destination'));
    }
}
