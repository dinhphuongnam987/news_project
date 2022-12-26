<?php

namespace App\Imports;

use App\Models\ProductModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToCollection, WithValidation, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            ProductModel::insert([
                'name' => $row['name'],
                'description' => $row['description'],
                'code' => $row['code'],
                'quantity' => $row['quantity'],
                'quantity_remaining' => $row['quantity'],
                'original_price' => $row['original_price'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => 'bail|required|between:2,255|unique:product,name',
            'description' => 'required|bail|required|min:5',
            'code' => 'required',
            'quantity' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:1000|max:99000000',
        ];
    }
}
