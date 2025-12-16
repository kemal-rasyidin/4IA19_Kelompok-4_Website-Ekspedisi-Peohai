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

            // Data Utama - PERHATIKAN: index bergeser +1 karena ada kolom No di awal
            'qty'           => $row[1] ?? null,  // berubah dari $row[0]
            'tgl_stuffing'  => $this->transformDate($row[2] ?? null),  // berubah dari $row[1]
            'sl_sd'         => $row[3] ?? null,  // berubah dari $row[2]
            'customer'      => $row[4] ?? null,  // berubah dari $row[3]
            'pengirim'      => $row[5] ?? null,  // berubah dari $row[4]
            'penerima'      => $row[6] ?? null,  // berubah dari $row[5]
            'jenis_barang'  => $row[7] ?? null,  // berubah dari $row[6]

            // Shipping Info
            'pelayaran'     => $row[8] ?? null,  // berubah dari $row[7]
            'nama_kapal'    => $row[9] ?? null,  // berubah dari $row[8]
            'voy'           => $row[10] ?? null, // berubah dari $row[9]
            'tujuan'        => $row[11] ?? null, // berubah dari $row[10]
            'etd'           => $this->transformDate($row[12] ?? null), // berubah dari $row[11]
            'eta'           => $this->transformDate($row[13] ?? null), // berubah dari $row[12]

            // Container Info
            'no_cont'       => $row[14] ?? null, // berubah dari $row[13]
            'seal'          => $row[15] ?? null, // berubah dari $row[14]
            'agen'          => $row[16] ?? null, // berubah dari $row[15]
            'dooring'       => $this->transformDate($row[17] ?? null), // berubah dari $row[16]

            // Trucking
            'nopol'         => $row[18] ?? null, // berubah dari $row[17]
            'supir'         => $row[19] ?? null, // berubah dari $row[18]
            'no_telp'       => $row[20] ?? null, // berubah dari $row[19]
            'harga_trucking' => $row[21] ?? null, // berubah dari $row[20]

            // SI Final & BA Done
            'si_final'      => $this->transformDate($row[22] ?? null), // berubah dari $row[21]
            'ba'            => $this->transformDate($row[23] ?? null), // berubah dari $row[22]
            'ba_balik'      => $this->transformDate($row[24] ?? null), // berubah dari $row[23]
            'no_inv'        => $row[25] ?? null, // berubah dari $row[24]

            // Penerima
            'alamat_penerima_barang' => $row[26] ?? null, // berubah dari $row[25]
            'nama_penerima'          => $row[27] ?? null, // berubah dari $row[26]
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
