<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogisticRate extends Model
{
    protected $fillable = [
        'origin_port',
        'destination_port',
        'container_type',
        'base_rate',
        'fuel_surcharge',
        'handling_fee',
        'is_active'
    ];

    protected $casts = [
        'base_rate' => 'decimal:2',
        'fuel_surcharge' => 'decimal:2',
        'handling_fee' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function calculateTotalRate()
    {
        return $this->base_rate + $this->fuel_surcharge + $this->handling_fee;
    }
}
