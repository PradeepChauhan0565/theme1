<?php

namespace App\Exports;

use App\Models\Subscribe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSubscribe implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Subscribe::all();
    }

    public function map($subscribe): array
    {
        return [
            $subscribe->email,
            $subscribe->status,
            // $subscribe->created_at,
            \Carbon\Carbon::parse($subscribe->created_at)->format('d/m/Y h:i a'),
        ];
    }

    public function headings(): array
    {
        return [
            'Email',
            'Subscribe/Unsubscribe',
            'Subscribe Date',
        ];
    }
}
