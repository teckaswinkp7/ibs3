<?php

namespace App\Exports;

use App\Models\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationExport implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
        ->join('education','users.id','=','education.stu_id')
        ->join('review','users.id','=','review.stu_id')
        ->select('users.id','users.name','education.updated_at','review.cgpa')
        ->where('users.user_role',2)
        ->where('users.status',2)
        ->get();
    }
    public function headings(): array
    {
        return [
            [
                'ID', 
        'Name',
        'Date Reviewed',
        'GPA'
      
            ]
        ];
    }

    public function registerEvents(): array

    {

        return [

            AfterSheet::class => function(AfterSheet $event) {

   

                $event->sheet->getDelegate()->getStyle('A1:D1')

                                ->getFont()

                                ->setBold(true);

   

            },

        ];

    }
}
