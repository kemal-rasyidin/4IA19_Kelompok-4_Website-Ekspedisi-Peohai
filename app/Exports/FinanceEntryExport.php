<?php

namespace App\Exports;

use App\Models\EntryMain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class FinanceEntryExport implements FromCollection, WithMapping, WithEvents, ShouldAutoSize
{
    protected $rowNumber = 0;
    protected $entryPeriodId;

    public function __construct($entryPeriodId)
    {
        $this->entryPeriodId = $entryPeriodId;
    }

    public function collection()
    {
        // Filter berdasarkan entry_period_id
        return EntryMain::where('entry_period_id', $this->entryPeriodId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function map($entry): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,                    // No
            $entry->qty,                         // Qty
            $entry->tgl_stuffing,                // Tgl Stuffing
            $entry->pengirim,                    // Pengirim
            $entry->nama_kapal,                  // Nama Kapal
            $entry->voy,                         // Voy
            $entry->tujuan,                      // Tujuan
            $entry->no_cont,                     // No Cont
            $entry->seal,                        // Seal
            $entry->etd,                         // ETD
            $entry->agen,                        // Agen
            $entry->dooring,                     // Dooring
            $entry->no_inv,                      // No Invoice
            $entry->pph_status,                  // Status PPH
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Insert 2 baris di awal untuk header
                $sheet->insertNewRowBefore(1, 2);

                // Set header text
                $sheet->setCellValue('A1', 'No');
                $sheet->setCellValue('B1', 'Qty');
                $sheet->setCellValue('C1', 'Tgl Stuffing');
                $sheet->setCellValue('D1', 'Pengirim');
                $sheet->setCellValue('E1', 'Nama Kapal');
                $sheet->setCellValue('F1', 'Voy');
                $sheet->setCellValue('G1', 'Tujuan');
                $sheet->setCellValue('H1', 'No Cont');
                $sheet->setCellValue('I1', 'Seal');
                $sheet->setCellValue('J1', 'ETD');
                $sheet->setCellValue('K1', 'Agen');
                $sheet->setCellValue('L1', 'Dooring');
                $sheet->setCellValue('M1', 'No Invoice');
                $sheet->setCellValue('N1', 'Status PPH');

                // Merge header menjadi 2 row
                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');
                $sheet->mergeCells('C1:C2');
                $sheet->mergeCells('D1:D2');
                $sheet->mergeCells('E1:E2');
                $sheet->mergeCells('F1:F2');
                $sheet->mergeCells('G1:G2');
                $sheet->mergeCells('H1:H2');
                $sheet->mergeCells('I1:I2');
                $sheet->mergeCells('J1:J2');
                $sheet->mergeCells('K1:K2');
                $sheet->mergeCells('L1:L2');
                $sheet->mergeCells('M1:M2');
                $sheet->mergeCells('N1:N2');

                // Styling header
                $sheet->getStyle('A1:N2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'E2E8F0'],
                    ],
                ]);

                // Set row height untuk header
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(25);

                // Freeze header
                $sheet->freezePane('A3');

                // Border untuk semua data
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:N{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                // Alignment untuk data body
                $sheet->getStyle("A3:N{$lastRow}")->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Set width kolom
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(15);
                $sheet->getColumnDimension('H')->setWidth(15);
                $sheet->getColumnDimension('J')->setWidth(12);
                $sheet->getColumnDimension('M')->setWidth(18);
            },
        ];
    }
}
