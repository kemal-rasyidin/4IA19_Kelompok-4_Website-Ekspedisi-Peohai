<?php

namespace App\Services;

use App\Models\LogisticRate;

class LogisticCalculatorService
{
    public function calculate($originPort, $destinationPort, $containerType, $quantity = 1)
    {
        $rate = LogisticRate::where('origin_port', $originPort)
            ->where('destination_port', $destinationPort)
            ->where('container_type', $containerType)
            ->where('is_active', true)
            ->first();

        if (!$rate) {
            throw new \Exception('Hubungin kami untuk informasi tarif pengiriman dari ' . $originPort . ' ke ' . $destinationPort . ' dengan kontainer tipe ' . $containerType . '.');
        }

        $totalPerContainer = $rate->calculateTotalRate();
        $grandTotal = $totalPerContainer * $quantity;

        return [
            'origin_port' => $originPort,
            'destination_port' => $destinationPort,
            'container_type' => $containerType,
            'quantity' => $quantity,
            'base_rate' => $rate->base_rate,
            'fuel_surcharge' => $rate->fuel_surcharge,
            'handling_fee' => $rate->handling_fee,
            'total_per_container' => $totalPerContainer,
            'grand_total' => $grandTotal,
            'currency' => 'USD'
        ];
    }
}
