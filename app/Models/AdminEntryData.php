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
        'qty',
        'tgl_stuffing',
        'sl_sd',
        'customer',
        'pengirim',
        'penerima',
        'jenis_barang',
        'pelayaran',
        'nama_kapal',
        'voy',
        'tujuan',
        'etd',
        'eta',
        'no_count',
        'seal',
        'agen',
        'dooring',
        'nopol',
        'supir',
        'no_telp',
        'harga',
        'si_final',
        'ba',
        'ba_balik',
        'no_inv',
        'alamat_penerima_barang',
        'nama_penerima',
    ];

    public function adminEntryDate()
    {
        return $this->belongsTo(AdminEntryDate::class, 'admin_entry_date_id');
    }
}
