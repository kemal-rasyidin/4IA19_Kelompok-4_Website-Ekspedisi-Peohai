<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEntryData extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $table = 'admin_entry_datas';
    protected $fillable = [
        'admin_entry_date_id',
        'customer',
        'qty',
        'tgl_stuffing',
        'sl_sd',
    ];

    public function adminEntryDate()
    {
        return $this->belongsTo(AdminEntryDate::class, 'admin_entry_date_id');
    }
}
