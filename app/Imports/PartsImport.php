<?php

namespace App\Imports;

use App\Models\Part;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Part([
            'sku' => $row['sku'],
            'description' => $row['description'],
            'price' => $row['price'],
            'slug' => Str::slug($row['sku'].'-'.$row['description'])
        ]);
    }
}
