<?php

namespace App\Imports;

use App\Models\EntryMain;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AdminEntryImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    protected $entry_period_id;

    public function __construct($entry_period_id)
    {
        $this->entry_period_id = $entry_period_id;
    }

    public function model(array $row)
    {
        return new EntryMain([
            'entry_period_id' => $this->entry_period_id,
            'qty' => $row['qty'] ?? null,
            'tgl_stuffing' => $this->transformDate($row['tanggal_stuffing'] ?? null),
            'sl_sd' => $row['slsd'] ?? null,
            'customer' => $row['customer'] ?? null,
            'pengirim' => $row['pengirim'] ?? null,
            'penerima' => $row['penerima'] ?? null,
            'jenis_barang' => $row['jenis_barang'] ?? null,
            'pelayaran' => $row['pelayaran'] ?? null,
            'nama_kapal' => $row['nama_kapal'] ?? null,
            'voy' => $row['voy'] ?? null,
            'tujuan' => $row['tujuan'] ?? null,
            'etd' => $this->transformDate($row['etd'] ?? null),
            'eta' => $this->transformDate($row['eta'] ?? null),
            'no_cont' => $row['no_container'] ?? null,
            'seal' => $row['seal'] ?? null,
            'agen' => $row['agen'] ?? null,
            'dooring' => $this->transformDate($row['dooring'] ?? null),
            'nopol' => $row['nopol'] ?? null,
            'supir' => $row['supir'] ?? null,
            'no_telp' => $row['no_telp'] ?? null,
            'harga' => $row['harga'] ?? null,
            'si_final' => $row['si_final'] ?? null,
            'ba' => $this->transformDate($row['ba'] ?? null),
            'ba_balik' => $this->transformDate($row['ba_balik'] ?? null),
            'no_inv' => $row['no_invoice'] ?? null,
            'alamat_penerima_barang' => $row['alamat_penerima'] ?? null,
            'nama_penerima' => $row['nama_penerima'] ?? null,
        ]);
    }

    private function transformDate($value)
    {
        if (empty($value)) {
            return null;
        }

        try {
            // Jika value adalah angka (Excel date format)
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }

            // Jika sudah string date
            return $value;
        } catch (\Exception $e) {
            return null;
        }
    }
}
