<?php

namespace App\Imports;

use App\Helpers\DebugHelpers;
use App\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeImport;

class UsersImport implements ToModel, WithEvents, WithHeadingRow
{
    use Importable, RemembersRowNumber;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        DebugHelpers::logMemory($this->getRowNumber());

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

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                DebugHelpers::logMemory('Importing ' . __CLASS__, []);
                DebugHelpers::logMemoryHeader();
            },
        ];
    }
}
