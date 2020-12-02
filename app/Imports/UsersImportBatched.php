<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class UsersImportBatched extends UsersImport implements WithBatchInserts, WithChunkReading
{
    protected $batchSize = 300;

    public function batchSize(): int
    {
        return $this->batchSize;
    }

    public function chunkSize(): int
    {
        return $this->batchSize;
    }

    public function setBatchSize(int $size): void
    {
        $this->batchSize = $size;
    }
}
