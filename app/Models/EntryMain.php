<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EntryMain extends Model
{
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Nama tabel yang digunakan.
     */
    protected $table = 'entry_mains';

    /**
     * Kolom yang boleh diisi (mass assignable).
     */
    protected $fillable = [
        'entry_period_id',
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
        'no_cont',
        'seal',
        'agen',
        'dooring',
        'nopol',
        'supir',
        'no_telp',
        'harga_trucking',
        'si_final',
        'ba',
        'ba_balik',
        'no_inv',
        'alamat_penerima_barang',
        'nama_penerima',
        'pph_status',
        'tgl_marketing',
        'tgl_jatuh_tempo',
        'muat_barang',
        'door_daerah',
        'stufing_dalam',
        'freight',
        'tgl_freight',
        'thc',
        'asuransi',
        'bl',
        'total_marketing',
        'asuransi_inv',
        'adm',
        'ops',
        'harga_jual',
        'pph23',
        'total_inv',
        'refund',
        'diterima',
        'bu_lia',
        'nol',
        'persentase_marketing',
        'agen_daerah',
        'keterangan_marketing',
    ];

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function entryPeriod()
    {
        return $this->belongsTo(EntryPeriod::class);
    }

    /**
     * Stasus Paket
     */
    protected $appends = ['status_paket'];
    public function getStatusPaketAttribute()
    {
        if (!is_null($this->dooring)) return 'Sampai Di Tujuan';
        if (!is_null($this->etd)) return 'Dalam Perjalanan';
        return 'Dikemas';
    }
}
