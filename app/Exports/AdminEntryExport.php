<?php

namespace App\Exports;

use App\Models\EntryMain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdminEntryExport implements FromCollection, WithHeadings, WithMapping
{
    protected $entry_period_id;

    public function __construct($entry_period_id)
    {
        $this->entry_period_id = $entry_period_id;
    }

    public function collection()
    {
        return EntryMain::where('entry_period_id', $this->entry_period_id)->get();
    }

    public function headings(): array
    {
        return [
            'Qty',
            'Tanggal Stuffing',
            'SL/SD',
            'Customer',
            'Pengirim',
            'Penerima',
            'Jenis Barang',
            'Pelayaran',
            'Nama Kapal',
            'VOY',
            'Tujuan',
            'ETD',
            'ETA',
            'No Container',
            'Seal',
            'Agen',
            'Dooring',
            'Nopol',
            'Supir',
            'No Telp',
            'Harga',
            'SI Final',
            'BA',
            'BA Balik',
            'No Invoice',
            'Alamat Penerima',
            'Nama Penerima',
        ];
    }

    public function map($entry): array
    {
        return [
            $entry->qty,
            $entry->tgl_stuffing,
            $entry->sl_sd,
            $entry->customer,
            $entry->pengirim,
            $entry->penerima,
            $entry->jenis_barang,
            $entry->pelayaran,
            $entry->nama_kapal,
            $entry->voy,
            $entry->tujuan,
            $entry->etd,
            $entry->eta,
            $entry->no_cont,
            $entry->seal,
            $entry->agen,
            $entry->dooring,
            $entry->nopol,
            $entry->supir,
            $entry->no_telp,
            $entry->harga,
            $entry->si_final,
            $entry->ba,
            $entry->ba_balik,
            $entry->no_inv,
            $entry->alamat_penerima_barang,
            $entry->nama_penerima,
        ];
    }
}
