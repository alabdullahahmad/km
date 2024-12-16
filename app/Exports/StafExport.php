<?php

namespace App\Exports;

use App\Models\Staf;
use Maatwebsite\Excel\Concerns\FromCollection;

class StafExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Staf::query()->where('isAdmin',false)->get();
    }

    public function headings(): array
    {
        return ['name', 'phoneNumber', 'address', 'personalid','gender','birthDay']; // عناوين الأعمدة
    }
}
