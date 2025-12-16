<?php

namespace App\Exports;

use App\Models\Partner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PartnerExport implements FromCollection, WithMapping, WithEvents, ShouldAutoSize
{
    protected $rowNumber = 0;

    public function collection()
    {
        return Partner::all();
    }

    public function map($partner): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $partner->nama_partner,
            $partner->nama,
            $partner->alamat,
            $partner->no_hp,
            $partner->email,
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
                $sheet->setCellValue('B1', 'Nama Partner');
                $sheet->setCellValue('C1', 'Nama');
                $sheet->setCellValue('D1', 'Alamat');
                $sheet->setCellValue('E1', 'No HP');
                $sheet->setCellValue('F1', 'Email');

                // Merge header menjadi 2 row
                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');
                $sheet->mergeCells('C1:C2');
                $sheet->mergeCells('D1:D2');
                $sheet->mergeCells('E1:E2');
                $sheet->mergeCells('F1:F2');

                // Styling header
                $sheet->getStyle('A1:F2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);

                // Set row height untuk header
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(25);

                // Freeze header
                $sheet->freezePane('A3');

                // Border untuk semua data
                $lastRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:F{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                    ],
                ]);
            },
        ];
    }
}
