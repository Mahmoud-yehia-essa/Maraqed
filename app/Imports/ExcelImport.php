<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;




class ExcelImport implements OnEachRow, WithHeadingRow, WithCalculatedFormulas
{
    // public function onRow(Row $row)
    // {
    //     $raw = $row->toArray();

    //     // Map raw keys (from Excel headings) to your custom keys
    //     $mapped = [
    //         'Name' => $raw['alasm_alkaml'] ?? null,
    //         'Tel'  => $raw['rkm_alnkal'] ?? null,
    //     ];

    //     print_r($mapped); // Display as you want
    // }

    public function onRow(Row $row)
    {
        $raw = $row->toArray();

        // Map Excel column headers to your table column names
        $name = $raw['alasm_alkaml'] ?? null;
        $tel  = $raw['rkm_alnkal'] ?? null;

        // Insert into the database (case-sensitive column names: Name, Tel)
        DB::table('users')->insert([
            'Name' => $name,
            'Tel'  => $tel,
        ]);
    }
}

