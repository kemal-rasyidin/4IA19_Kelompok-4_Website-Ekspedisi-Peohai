<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of cities
     */
    public function index(Request $request)
    {
        $query = City::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('province', 'like', "%{$search}%");
            });
        }

        $cities = $query->orderBy('name', 'asc')->paginate(10);

        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new city
     */
    public function create()
    {
        $provinces = [
            'Aceh',
            'Sumatera Utara',
            'Sumatera Barat',
            'Riau',
            'Jambi',
            'Sumatera Selatan',
            'Bengkulu',
            'Lampung',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'DKI Jakarta',
            'Jawa Barat',
            'Jawa Tengah',
            'DI Yogyakarta',
            'Jawa Timur',
            'Banten',
            'Bali',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Kalimantan Barat',
            'Kalimantan Tengah',
            'Kalimantan Selatan',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Sulawesi Utara',
            'Sulawesi Tengah',
            'Sulawesi Selatan',
            'Sulawesi Tenggara',
            'Gorontalo',
            'Sulawesi Barat',
            'Maluku',
            'Maluku Utara',
            'Papua',
            'Papua Barat',
            'Papua Selatan',
            'Papua Tengah',
            'Papua Pegunungan',
            'Papua Barat Daya'
        ];

        return view('admin.city.create', compact('provinces'));
    }

    /**
     * Store a newly created city
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ], [
            'name.required' => 'Nama kota/kabupaten harus diisi',
            'province.required' => 'Provinsi harus dipilih',
            'latitude.required' => 'Latitude harus diisi',
            'latitude.between' => 'Latitude harus antara -90 sampai 90',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.between' => 'Longitude harus antara -180 sampai 180'
        ]);

        try {
            City::create($validated);

            return redirect()
                ->route('cities.index')
                ->with('success', 'Data kota/kabupaten berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified city
     */
    public function edit(City $city)
    {
        $provinces = [
            'Aceh',
            'Sumatera Utara',
            'Sumatera Barat',
            'Riau',
            'Jambi',
            'Sumatera Selatan',
            'Bengkulu',
            'Lampung',
            'Kepulauan Bangka Belitung',
            'Kepulauan Riau',
            'DKI Jakarta',
            'Jawa Barat',
            'Jawa Tengah',
            'DI Yogyakarta',
            'Jawa Timur',
            'Banten',
            'Bali',
            'Nusa Tenggara Barat',
            'Nusa Tenggara Timur',
            'Kalimantan Barat',
            'Kalimantan Tengah',
            'Kalimantan Selatan',
            'Kalimantan Timur',
            'Kalimantan Utara',
            'Sulawesi Utara',
            'Sulawesi Tengah',
            'Sulawesi Selatan',
            'Sulawesi Tenggara',
            'Gorontalo',
            'Sulawesi Barat',
            'Maluku',
            'Maluku Utara',
            'Papua',
            'Papua Barat',
            'Papua Selatan',
            'Papua Tengah',
            'Papua Pegunungan',
            'Papua Barat Daya'
        ];

        return view('admin.city.edit', compact('city', 'provinces'));
    }

    /**
     * Update the specified city
     */
    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ], [
            'name.required' => 'Nama kota/kabupaten harus diisi',
            'province.required' => 'Provinsi harus dipilih',
            'latitude.required' => 'Latitude harus diisi',
            'latitude.between' => 'Latitude harus antara -90 sampai 90',
            'longitude.required' => 'Longitude harus diisi',
            'longitude.between' => 'Longitude harus antara -180 sampai 180'
        ]);

        try {
            $city->update($validated);

            return redirect()
                ->route('cities.index')
                ->with('success', 'Data kota/kabupaten berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Bulk delete cities
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'city_ids' => 'required|array|min:1',
            'city_ids.*' => 'exists:cities,id'
        ]);

        try {
            DB::transaction(function () use ($request, &$deleted) {
                $deleted = City::whereIn('id', $request->city_ids)->delete();
            });

            return redirect()
                ->route('cities.index')
                ->with('success', "Berhasil menghapus {$deleted} data kota/kabupaten!");
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
