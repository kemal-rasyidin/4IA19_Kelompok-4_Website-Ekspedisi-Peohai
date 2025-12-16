<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EntryPeriod extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['bulan', 'tahun'];

    /**
     * Accessor untuk menampilkan periode lengkap (contoh: "November 2025")
     */
    public function getPeriodeAttribute()
    {
        return "{$this->bulan} {$this->tahun}";
    }

    public function entries()
    {
        return $this->hasMany(EntryMain::class);
    }
}
