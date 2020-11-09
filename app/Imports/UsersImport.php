<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return User::firstOrNew([
            'email' => $row['email'],
        ])
            ->fill([
                'name'           => $row['name'] ?? null,
                'email_verified' => $row['email_verified_at'] ?? null,
                'title'          => $row['title'] ?? null,
                'catchphrase'    => $row['catchphrase'] ?? null,
                'birthday'       => $row['birthday'] ?? null,
            ]);
    }
}
