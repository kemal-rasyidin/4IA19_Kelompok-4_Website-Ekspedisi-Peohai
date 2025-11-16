<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryMain extends Model
{
    use HasFactory;

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
        'harga',
        'pph_status',
        'si_final',
        'ba',
        'ba_balik',
        'no_inv',
        'alamat_penerima_barang',
        'nama_penerima',
        'status',
    ];

    /**
     * Scope untuk filter berdasarkan status (opsional, biar mudah dipakai di controller)
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
     * Contoh relasi (jika nanti kamu mau menambahkan user input)
     * Misal: satu entry dibuat oleh user tertentu
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
