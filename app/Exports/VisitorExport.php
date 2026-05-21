<?php

namespace App\Exports;

use App\Models\Visitor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class VisitorExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return ['ID', 'Name', 'Phone', 'Email', 'Created At', 'Updated At'];
    }

    public function collection()
    {
        return Visitor::all();
    }

    public function styles(Worksheet $sheet)
    {
        // Wrap all cells
        $sheet->getStyle('A:F')
            ->getAlignment()
            ->setWrapText(true);

        // Header styles only
        $sheet->getStyle('A1:F1')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);
            
        $sheet->getStyle('A1:F1')
            ->getFont()
            ->setBold(true);


        // Set column width
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(25);

        // Auto row height
        foreach ($sheet->getRowDimensions() as $row) {
            $row->setRowHeight(-1);
        }

        return [];
    }

}
