<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            // Jawa
            ['name' => 'Jakarta', 'province' => 'DKI Jakarta', 'latitude' => -6.2088, 'longitude' => 106.8456],
            ['name' => 'Bandung', 'province' => 'Jawa Barat', 'latitude' => -6.9175, 'longitude' => 107.6191],
            ['name' => 'Surabaya', 'province' => 'Jawa Timur', 'latitude' => -7.2575, 'longitude' => 112.7521],
            ['name' => 'Semarang', 'province' => 'Jawa Tengah', 'latitude' => -6.9932, 'longitude' => 110.4203],
            ['name' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'latitude' => -7.7956, 'longitude' => 110.3695],
            ['name' => 'Malang', 'province' => 'Jawa Timur', 'latitude' => -7.9797, 'longitude' => 112.6304],
            ['name' => 'Solo', 'province' => 'Jawa Tengah', 'latitude' => -7.5755, 'longitude' => 110.8243],

            // Sumatra
            ['name' => 'Medan', 'province' => 'Sumatera Utara', 'latitude' => 3.5952, 'longitude' => 98.6722],
            ['name' => 'Palembang', 'province' => 'Sumatera Selatan', 'latitude' => -2.9761, 'longitude' => 104.7754],
            ['name' => 'Padang', 'province' => 'Sumatera Barat', 'latitude' => -0.9471, 'longitude' => 100.4172],
            ['name' => 'Pekanbaru', 'province' => 'Riau', 'latitude' => 0.5071, 'longitude' => 101.4478],
            ['name' => 'Bandar Lampung', 'province' => 'Lampung', 'latitude' => -5.4292, 'longitude' => 105.2625],
            ['name' => 'Banda Aceh', 'province' => 'Aceh', 'latitude' => 5.5483, 'longitude' => 95.3238],

            // Kalimantan
            ['name' => 'Balikpapan', 'province' => 'Kalimantan Timur', 'latitude' => -1.2379, 'longitude' => 116.8529],
            ['name' => 'Banjarmasin', 'province' => 'Kalimantan Selatan', 'latitude' => -3.3194, 'longitude' => 114.5908],
            ['name' => 'Pontianak', 'province' => 'Kalimantan Barat', 'latitude' => -0.0263, 'longitude' => 109.3425],
            ['name' => 'Samarinda', 'province' => 'Kalimantan Timur', 'latitude' => -0.5022, 'longitude' => 117.1536],

            // Sulawesi
            ['name' => 'Makassar', 'province' => 'Sulawesi Selatan', 'latitude' => -5.1477, 'longitude' => 119.4327],
            ['name' => 'Manado', 'province' => 'Sulawesi Utara', 'latitude' => 1.4748, 'longitude' => 124.8421],
            ['name' => 'Palu', 'province' => 'Sulawesi Tengah', 'latitude' => -0.8999, 'longitude' => 119.8707],

            // Bali & Nusa Tenggara
            ['name' => 'Denpasar', 'province' => 'Bali', 'latitude' => -8.6705, 'longitude' => 115.2126],
            ['name' => 'Mataram', 'province' => 'Nusa Tenggara Barat', 'latitude' => -8.5833, 'longitude' => 116.1167],

            // Maluku & Papua
            ['name' => 'Ambon', 'province' => 'Maluku', 'latitude' => -3.6954, 'longitude' => 128.1814],
            ['name' => 'Jayapura', 'province' => 'Papua', 'latitude' => -2.5333, 'longitude' => 140.7167],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert([
                'id' => Str::uuid(),
                'name' => $city['name'],
                'province' => $city['province'],
                'latitude' => $city['latitude'],
                'longitude' => $city['longitude'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
