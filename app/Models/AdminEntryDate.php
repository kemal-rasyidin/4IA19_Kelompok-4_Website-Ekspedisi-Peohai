<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEntryDate extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'periode',
    ];

    public function adminEntryDatas()
    {
        return $this->hasMany(AdminEntryData::class, 'admin_entry_date_id');
    }
}
