<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use RuntimeException;

class UsersExport implements FromCollection, WithColumnFormatting, WithHeadings, WithMapping
{
    use Exportable;

    protected $limit;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (User::count() === 0) {
            throw new RuntimeException('No records found to export');
        }

        return User::query()
            ->when($this->limit, function ($q) {
                $q->limit($this->limit);
            })->get();
    }

    public function limit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Email Verified At',
            'Title',
            'Catchphrase',
            'Birthday',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->email,
            Date::dateTimeToExcel($row->email_verified_at),
            $row->title,
            $row->catchphrase,
            Date::dateTimeToExcel($row->birthday),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'G' => NumberFormat::FORMAT_DATE_YYYYMMDD2,
        ];
    }
}
