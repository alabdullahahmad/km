<?php

namespace App\Exports;

use App\Models\Staf;
use App\Models\StafLoging;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StafExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StafLoging::query()->with('staf')->get();
    }

    public function headings(): array
    {
        return ['id','name' ,'phoneNumber','gender','address','enterTime','exitTime','date']; // عناوين الأعمدة
    }

        /**
     * تنظيم البيانات لكل صف في الملف
     */
    public function map($user): array
    {
        return [
            $user->staf->id,
            $user->staf->name,
            $user->staf->phoneNumber,
            $user->staf->gender,
            $user->staf->address ?? '',
            $user->enterTime , // جلب بيانات العلاقة (Profile)
            $user->exitTime , // جلب بيانات العلاقة (Profile)
            $user->date, // جلب أسماء الأدوار (Roles)
        ];
    }
}
