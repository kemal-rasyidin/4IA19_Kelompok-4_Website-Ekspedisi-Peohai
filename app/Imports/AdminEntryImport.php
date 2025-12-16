<?php

namespace App\Imports;

use App\Models\EntryMain;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AdminEntryImport implements ToModel, SkipsOnError
{
    use SkipsErrors;

    protected $entry_period_id;
    private $rowNumber = 0;

    public function __construct($entry_period_id)
    {
        $this->entry_period_id = $entry_period_id;
    }

    public function model(array $row)
    {
        $this->rowNumber++;

        // Skip 2 baris pertama (header)
        if ($this->rowNumber <= 2) {
            return null;
        }

        // Skip row kosong
        if (empty($row[0]) && empty($row[1])) {
            return null;
        }

        return new EntryMain([
            'entry_period_id' => $this->entry_period_id,

            // Data Utama
            'qty'           => $row[0] ?? null,
            'tgl_stuffing'  => $this->transformDate($row[1] ?? null),
            'sl_sd'         => $row[2] ?? null,
            'customer'      => $row[3] ?? null,
            'pengirim'      => $row[4] ?? null,
            'penerima'      => $row[5] ?? null,
            'jenis_barang'  => $row[6] ?? null,

            // Shipping Info
            'pelayaran'     => $row[7] ?? null,
            'nama_kapal'    => $row[8] ?? null,
            'voy'           => $row[9] ?? null,
            'tujuan'        => $row[10] ?? null,
            'etd'           => $this->transformDate($row[11] ?? null),
            'eta'           => $this->transformDate($row[12] ?? null),

            // Container Info
            'no_cont'       => $row[13] ?? null,
            'seal'          => $row[14] ?? null,
            'agen'          => $row[15] ?? null,
            'dooring'       => $this->transformDate($row[16] ?? null),

            // Trucking
            'nopol'         => $row[17] ?? null,
            'supir'         => $row[18] ?? null,
            'no_telp'       => $row[19] ?? null,
            'harga_trucking'=> $row[20] ?? null,

            // SI Final & BA Done
            'si_final'      => $this->transformDate($row[21] ?? null),
            'ba'            => $this->transformDate($row[22] ?? null),
            'ba_balik'      => $this->transformDate($row[23] ?? null),
            'no_inv'        => $row[24] ?? null,

            // Penerima
            'alamat_penerima_barang' => $row[25] ?? null,
            'nama_penerima'          => $row[26] ?? null,
        ]);
    }

    private function transformDate($value)
    {
        if (empty($value)) return null;

        try {
            // Handle Excel numeric date
            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)->format('Y-m-d');
            }

            // Handle string date
            if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
                return $value;
            }

            // Try other date formats
            if (is_string($value)) {
                $formats = ['d/m/Y', 'm/d/Y', 'd-m-Y', 'Y/m/d'];
                foreach ($formats as $format) {
                    $date = \DateTime::createFromFormat($format, $value);
                    if ($date) {
                        return $date->format('Y-m-d');
                    }
                }
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
