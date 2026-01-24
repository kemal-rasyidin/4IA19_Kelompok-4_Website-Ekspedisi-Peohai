<?php

namespace App\Exports;

use App\Models\EntryMain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class MarketingExport implements FromCollection, WithHeadings, WithMapping, WithEvents, ShouldAutoSize, WithColumnFormatting
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
                'Tanggal',
                'Jatuh Tempo',
                'Muat Barang',
                'Customer',
                'Jenis Barang',
                'Tujuan',
                'Cont',
                'No Container',
                'Seal',
                'Vessel',
                'Voyage',
                'Pelayaran',
                'ETD',
                'Door Daerah',
                'Stufing Dalam',
                'Trucking',

                // HARGA PELAYARAN (R-S)
                'HARGA PELAYARAN',
                '',

                'THC',
                'Asuransi 0,2%',
                'BL',
                'OPS',
                'Total',

                // NILAI INVOICE (Y-AC)
                'NILAI INVOICE',
                '',
                '',
                '',
                '',
                '',

                'Refund',
                'Yang Diterima',

                // PROFIT (AF-AG)
                'PROFIT',
                '',

                'Presentase',

                // AGEN DAERAH (AJ)
                'AGEN DAERAH',

                'Keterangan'
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

                // Sub header Harga Pelayaran
                'Freight',
                'Tanggal Bayar',

                '',
                '',
                '',
                '',
                '',

                // Sub header Nilai Invoice
                'No Inv',
                'Asuransi 0,2%',
                'ADM',
                'Harga Jual',
                'PPH 23',
                'Invoice',

                '',
                '',

                // Sub header Profit
                "BU' LIA",
                'Nol (0)',

                '',

                // Sub header Agen Daerah
                'Daerah',

                '',
            ],
        ];
    }

    protected $rowNumber = 0;

    public function map($entry): array
    {
        return [
            ++$this->rowNumber,
            $entry->tgl_marketing,
            $entry->tgl_jatuh_tempo,
            $entry->muat_barang,
            $entry->customer,
            $entry->jenis_barang,
            $entry->tujuan,
            $entry->qty,
            $entry->no_cont,
            $entry->seal,
            $entry->nama_kapal,
            $entry->voy,
            $entry->pelayaran,
            $entry->etd,
            $entry->door_daerah,
            $entry->stufing_dalam,
            $entry->harga_trucking,

            // HARGA PELAYARAN
            $entry->freight,
            $entry->tgl_freight,

            $entry->thc,
            $entry->asuransi,
            $entry->bl,
            $entry->ops,
            $entry->total_inv,

            // NILAI INVOICE
            $entry->no_inv,
            $entry->asuransi_inv,
            $entry->adm,
            $entry->harga_jual,
            $entry->pph23,
            $entry->total_inv,

            $entry->refund,
            $entry->diterima,

            // PROFIT
            $entry->bu_lia,
            $entry->nol,

            $entry->persentase_marketing,

            // AGEN DAERAH
            $entry->agen_daerah,

            $entry->keterangan_marketing,
        ];
    }

    // ✅ TAMBAHKAN METHOD INI untuk Format Rupiah
    public function columnFormats(): array
    {
        return [
            // Format Rupiah untuk kolom yang berisi angka/uang
            'O' => '"Rp "#,##0.00',  // Door Daerah
            'P' => '"Rp "#,##0.00',  // Stufing Dalam
            'Q' => '"Rp "#,##0.00',  // Trucking
            'R' => '"Rp "#,##0.00',  // Freight
            'T' => '"Rp "#,##0.00',  // THC
            'U' => '"Rp "#,##0.00',  // Asuransi 0,2%
            'V' => '"Rp "#,##0.00',  // BL
            'W' => '"Rp "#,##0.00',  // OPS
            'X' => '"Rp "#,##0.00',  // Total

            // Nilai Invoice
            'Z' => '"Rp "#,##0.00',  // Asuransi 0,2%
            'AA' => '"Rp "#,##0.00', // ADM
            'AB' => '"Rp "#,##0.00', // Harga Jual
            'AC' => '"Rp "#,##0.00', // PPH 23
            'AD' => '"Rp "#,##0.00', // Invoice

            'AE' => '"Rp "#,##0.00', // Refund
            'AF' => '"Rp "#,##0.00', // Yang Diterima

            // Profit
            'AG' => '"Rp "#,##0.00', // BU' LIA
            'AH' => '"Rp "#,##0.00', // 0

            // Presentase (%)
            'AI' => '0.00"%"',       // Presentase
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

                // Merge main headers (B-Q) - kolom tunggal
                $singleMerge = range('B', 'Q');
                foreach ($singleMerge as $col) {
                    $sheet->mergeCells("{$col}1:{$col}2");
                }

                // HARGA PELAYARAN (R-S)
                $sheet->mergeCells('R1:S1');

                // Merge kolom tunggal (T-X)
                $singleMerge2 = ['T', 'U', 'V', 'W', 'X'];
                foreach ($singleMerge2 as $col) {
                    $sheet->mergeCells("{$col}1:{$col}2");
                }

                // NILAI INVOICE (Y-AD)
                $sheet->mergeCells('Y1:AD1');

                // Refund (AE)
                $sheet->mergeCells('AE1:AE2');

                // Yang Diterima (AF)
                $sheet->mergeCells('AF1:AF2');

                // PROFIT (AG-AH)
                $sheet->mergeCells('AG1:AH1');

                // Presentase (AI)
                $sheet->mergeCells('AI1:AI2');

                // Keterangan (AK)
                $sheet->mergeCells('AK1:AK2');

                // Styling header
                $sheet->getStyle('A1:AK2')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 10],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                // Background color HARGA PELAYARAN (Oranye)
                $sheet->getStyle('R1:S1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFC000'],
                    ]
                ]);

                $sheet->getStyle('R2:S2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFE699'],
                    ]
                ]);

                // Background color NILAI INVOICE (Hijau muda)
                $sheet->getStyle('Y1:AD1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'C6EFCE'],
                    ]
                ]);

                $sheet->getStyle('Y2:AD2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E2F0D9'],
                    ]
                ]);

                // Background color PROFIT (Kuning)
                $sheet->getStyle('AG1:AH1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFEB9C'],
                    ]
                ]);

                $sheet->getStyle('AG2:AH2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFF2CC'],
                    ]
                ]);

                // Background color AGEN DAERAH (Biru) - Pisahkan AJ1 dan AJ2
                $sheet->getStyle('AJ1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'BDD7EE'],
                    ]
                ]);

                $sheet->getStyle('AJ2')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'DAEEF3'],
                    ]
                ]);

                // Border untuk semua data
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:AK{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                // Center alignment untuk data
                $sheet->getStyle("A3:AK{$lastRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Freeze pane
                $sheet->freezePane('A3');

                // Set width untuk kolom tertentu
                $sheet->getColumnDimension('E')->setWidth(20); // Customer
                $sheet->getColumnDimension('F')->setWidth(15); // Jenis Barang
                $sheet->getColumnDimension('AK')->setWidth(25); // Keterangan
            },
        ];
    }
}
