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
                'No',
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
                '',

                'Nopol',
                'Supir',
                'No Telp',
                'Harga Trucking',

                'SI Final',
                'BA',
                'BA Balik',
                'No Invoice',

                '',
                '',
            ],
        ];
    }

    protected $rowNumber = 0;

    public function map($entry): array
    {
        return [
            ++$this->rowNumber,
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

                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(25);

                // Merge kolom No (A)
                $sheet->mergeCells('A1:A2');

                // Merge main headers (B–R) - perhatikan bergeser dari A menjadi B
                $singleMerge = range('B', 'R');
                foreach ($singleMerge as $col) {
                    $sheet->mergeCells("{$col}1:{$col}2");
                }

                // TRUCKING (S–V) - bergeser satu kolom
                $sheet->mergeCells('S1:V1');

                // SI FINAL (W–Z)
                $sheet->mergeCells('W1:Z1');

                // Nama Penerima (AA)
                $sheet->mergeCells('AA1:AA2');

                // Alamat Penerima (AB)
                $sheet->mergeCells('AB1:AB2');

                // Styling - update range menjadi AB
                $sheet->getStyle('A1:AB2')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                // Update range TRUCKING dan SI FINAL
                $sheet->getStyle('S1:V1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFC0CB'],
                    ]
                ]);

                $sheet->getStyle('S2:V2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFE4E6'],
                    ]
                ]);

                $sheet->getStyle('W1:Z1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'ADD8E6'],
                    ]
                ]);

                $sheet->getStyle('W2:Z2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E0F2FE'],
                    ]
                ]);

                $sheet->freezePane('A3');
            },
        ];
    }
}
