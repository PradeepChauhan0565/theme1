<?php

namespace App\Exports;

use App\Models\MstMaterial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GridExport implements FromCollection, WithHeadings, WithMapping //, WithEvents //, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public $records;
    public $headings;
    public $export_type;
    public $columns = [];
    public $url;

    public function __construct($records, $headings, $export_type)
    {
        $this->records = $records;
        $this->headings = $headings;
        $this->export_type = $export_type;
        foreach ($headings as $heading) {
            $this->columns[] = $heading['column'];
        }
    }
    public function collection()
    {
        if ($this->export_type == 1) {
            return $this->records;
        }
        return $this->records;
    }

    public function map($records): array
    {
        $columns = [];
        foreach ($this->headings as $heading) {
            $field = $heading['field'];
            if ($heading['field_type'] == 'date') {
                $columns[] = Carbon::parse($records->$field)->format('d-m-Y');
            } elseif ($heading['field_type'] == 'image') {
                $columns[] = Storage::url($records->$field);
            } elseif (isset($heading['fixed_value']) && $heading['field_type'] == 'bit') {
                $columns[] = $heading['fixed_value'][$records->$field];
            } elseif ($heading['field_type'] == 'number') {
                $columns[] = number_format($records->$field, 2);
            } else {
                $columns[] = $records->$field;
            }
        }
        return $columns;
    }



    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
    //             $event->sheet->getDelegate()->getStyle('H2:H' . ($event->sheet->getHighestRow()))
    //                 ->getAlignment()
    //                 ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //             $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(40);
    //             $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(40);
    //             $event->sheet->getDelegate()->setCellValue('H1', 'Image');
    //             $event->sheet->getDelegate()->getStyle('H1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    //             $event->sheet->getDelegate()->getStyle('H1')->getFont()->setBold(true)->setSize(16);
    //         },
    //     ];
    // }

    public function headings(): array
    {
        return $this->columns;
    }
}
