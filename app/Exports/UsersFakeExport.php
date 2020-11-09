<?php

namespace App\Exports;

use App\User;

class UsersFakeExport extends UsersExport
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return factory(User::class, $this->limit)->make();
    }
}
