<?php

namespace App\Exports;

use App\Models\EntryMain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class AdminEntryExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize
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
            // ROW 1 – MAIN HEADER
            [
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

                // TRUCKING (R–U)
                'TRUCKING',
                '',
                '',
                '',

                // SI FINAL (V–Y)
                'SI FINAL & BA DONE',
                '',
                '',
                '',

                'Nama Penerima',
                'Alamat Penerima'
            ],

            // ROW 2 – SUB HEADERS
            [
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',

                // TRUCKING
                'Nopol',
                'Supir',
                'No Telp',
                'Harga Trucking',

                // SI FINAL
                'SI Final',
                'BA',
                'BA Balik',
                'No Invoice',

                '', // Nama penerima
                '', // Alamat penerima
            ],
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

            // TRUCKING
            $entry->nopol,
            $entry->supir,
            $entry->no_telp,
            $entry->harga_trucking,

            // SI FINAL
            $entry->si_final,
            $entry->ba,
            $entry->ba_balik,
            $entry->no_inv,

            // Alamat penerima
            $entry->alamat_penerima_barang,

            // Nama penerima
            $entry->nama_penerima,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Merge main headers (A–Q)
                $singleMerge = range('A', 'Q');
                foreach ($singleMerge as $col) {
                    $sheet->mergeCells("{$col}1:{$col}2");
                }

                // TRUCKING (R–U)
                $sheet->mergeCells('R1:U1');

                // SI FINAL (V–Y)
                $sheet->mergeCells('V1:Y1');

                // Nama Penerima (Z)
                $sheet->mergeCells('Z1:Z2');

                // Alamat Penerima (AA)
                $sheet->mergeCells('AA1:AA2');

                // Styling
                $sheet->getStyle('A1:AA2')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                // TRUCKING color
                $sheet->getStyle('R1:U1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFC0CB'],
                    ]
                ]);

                // TRUCKING sub headers
                $sheet->getStyle('R2:U2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFE4E6'],
                    ]
                ]);

                // SI FINAL color
                $sheet->getStyle('V1:Y1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'ADD8E6'],
                    ]
                ]);

                // SI FINAL sub headers
                $sheet->getStyle('V2:Y2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E0F2FE'],
                    ]
                ]);

                // Freeze top headers
                $sheet->freezePane('A3');
            },
        ];
    }
}
