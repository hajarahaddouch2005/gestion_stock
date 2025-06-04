<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Customer([
            'first_name' => $row['first_name'],  // خاصك تتأكدي هاد les noms كاينين فـ Excel Header
            'last_name'  => $row['last_name'],
            'email'      => $row['email'],
            'address'    => $row['address'],
            'phone'      => $row['phone'],
        ]);
    }
}
