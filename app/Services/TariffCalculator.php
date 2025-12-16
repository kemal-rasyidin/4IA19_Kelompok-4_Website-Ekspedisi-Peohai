<?php

namespace App\Services;

use App\Models\City;

class TariffCalculator
{
    // Konfigurasi tarif (bisa dipindah ke config atau database)
    private const BASE_FARE = 15000; // Biaya dasar
    private const RATE_PER_KM = 2000; // Tarif per kilometer
    private const ADMIN_FEE = 5000; // Biaya admin
    private const INTER_ISLAND_MULTIPLIER = 1.5; // Markup antar pulau

    // Range tarif (variasi harga)
    private const LOWER_RANGE_MULTIPLIER = 0.85; // -15% untuk harga bawah
    private const UPPER_RANGE_MULTIPLIER = 1.15; // +15% untuk harga atas

    // Multiplier kontainer
    private const CONTAINER_20FT_MULTIPLIER = 1.0; // Base price
    private const CONTAINER_40FT_MULTIPLIER = 1.3; // +30% untuk kontainer 40ft

    /**
     * Calculate tariff between two cities
     */
    public function calculate(City $origin, City $destination, string $containerType = '20ft'): array
    {
        $distance = $origin->distanceTo($destination);

        $baseTariff = self::BASE_FARE + ($distance * self::RATE_PER_KM);

        // Tambah markup jika beda pulau
        $isInterIsland = $this->isInterIsland($origin, $destination);
        if ($isInterIsland) {
            $baseTariff *= self::INTER_ISLAND_MULTIPLIER;
        }

        $totalTariff = $baseTariff + self::ADMIN_FEE;

        // Hitung range tarif (bawah dan atas)
        $lowerTariff = $totalTariff * self::LOWER_RANGE_MULTIPLIER;
        $upperTariff = $totalTariff * self::UPPER_RANGE_MULTIPLIER;

        // Apply container multiplier
        $containerMultiplier = $containerType === '40ft'
            ? self::CONTAINER_40FT_MULTIPLIER
            : self::CONTAINER_20FT_MULTIPLIER;

        $lowerTariff *= $containerMultiplier;
        $upperTariff *= $containerMultiplier;

        // Estimasi waktu tempuh (asumsi 60 km/jam)
        $estimatedHours = round($distance / 60, 1);

        return [
            'origin' => [
                'id' => $origin->id,
                'name' => $origin->name,
                'province' => $origin->province
            ],
            'destination' => [
                'id' => $destination->id,
                'name' => $destination->name,
                'province' => $destination->province
            ],
            'distance_km' => $distance,
            'estimated_hours' => $estimatedHours,
            'container_type' => $containerType,
            'container_size' => $containerType === '40ft' ? '1x40ft' : '1x20ft',
            'tariff_range' => [
                'lower' => (int) round($lowerTariff),
                'upper' => (int) round($upperTariff),
                'average' => (int) round(($lowerTariff + $upperTariff) / 2)
            ],
            'tariff_breakdown' => [
                'base_fare' => self::BASE_FARE,
                'distance_fare' => $distance * self::RATE_PER_KM,
                'admin_fee' => self::ADMIN_FEE,
                'inter_island_markup' => $isInterIsland ? ($baseTariff - ($baseTariff / self::INTER_ISLAND_MULTIPLIER)) : 0,
                'container_markup' => $containerType === '40ft' ? '+30%' : 'Base',
                'range_info' => 'Range ±15% dari harga dasar'
            ],
            'is_inter_island' => $isInterIsland,
            'price_comparison' => $this->getContainerComparison($lowerTariff, $upperTariff, $containerType)
        ];
    }

    /**
     * Get price comparison between container types
     */
    private function getContainerComparison($currentLower, $currentUpper, $currentType): array
    {
        if ($currentType === '20ft') {
            return [
                '20ft' => [
                    'lower' => (int) round($currentLower),
                    'upper' => (int) round($currentUpper)
                ],
                '40ft' => [
                    'lower' => (int) round($currentLower * 1.3),
                    'upper' => (int) round($currentUpper * 1.3)
                ]
            ];
        } else {
            return [
                '20ft' => [
                    'lower' => (int) round($currentLower / 1.3),
                    'upper' => (int) round($currentUpper / 1.3)
                ],
                '40ft' => [
                    'lower' => (int) round($currentLower),
                    'upper' => (int) round($currentUpper)
                ]
            ];
        }
    }

    /**
     * Simple check for inter-island routes
     */
    private function isInterIsland(City $origin, City $destination): bool
    {
        // Definisi sederhana pulau besar
        $islands = [
            'Sumatra' => ['Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Jambi', 'Sumatera Selatan', 'Bengkulu', 'Lampung', 'Kepulauan Riau', 'Kepulauan Bangka Belitung'],
            'Jawa' => ['Banten', 'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur'],
            'Kalimantan' => ['Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara'],
            'Sulawesi' => ['Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat'],
            'Papua' => ['Papua', 'Papua Barat', 'Papua Tengah', 'Papua Pegunungan', 'Papua Selatan', 'Papua Barat Daya']
        ];

        $originIsland = null;
        $destIsland = null;

        foreach ($islands as $island => $provinces) {
            if (in_array($origin->province, $provinces)) {
                $originIsland = $island;
            }
            if (in_array($destination->province, $provinces)) {
                $destIsland = $island;
            }
        }

        return $originIsland !== $destIsland;
    }
}
