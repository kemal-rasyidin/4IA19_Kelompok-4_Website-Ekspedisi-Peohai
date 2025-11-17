<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LogisticRate;

class LogisticRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rates = [
            ['origin_port' => 'Jakarta', 'destination_port' => 'Singapore', 'container_type' => '20ft', 'base_rate' => 800, 'fuel_surcharge' => 150, 'handling_fee' => 100],
            ['origin_port' => 'Jakarta', 'destination_port' => 'Singapore', 'container_type' => '40ft', 'base_rate' => 1500, 'fuel_surcharge' => 250, 'handling_fee' => 150],
            ['origin_port' => 'Surabaya', 'destination_port' => 'Singapore', 'container_type' => '20ft', 'base_rate' => 900, 'fuel_surcharge' => 160, 'handling_fee' => 120],
            ['origin_port' => 'Surabaya', 'destination_port' => 'Singapore', 'container_type' => '40ft', 'base_rate' => 1600, 'fuel_surcharge' => 270, 'handling_fee' => 180],
        ];

        foreach ($rates as $rate) {
            LogisticRate::create($rate);
        }
    }
}
