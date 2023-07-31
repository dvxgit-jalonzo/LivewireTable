<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Created At',
        ];
    }

    public function collection()
    {
        return $this->users;
    }


    public function map($user): array
    {
        return [
            $user->name,
            $user->email,
            $user->created_at,
        ];
    }
}
