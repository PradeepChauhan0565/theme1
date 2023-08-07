<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Industry;
use App\Models\Qualification;
use App\Models\Source;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ExcelFileImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $data) {
            if (isset($data['qualification']) && $data['qualification']) {
                Qualification::create([
                    'code' => $data['qualification'],
                    'qualification' => $data['qualification'],
                ]);
            }
        }
    }
    public function startRow(): int
    {
        return 2;
    }
}
