<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')->select('id','name','email')
        ->where('user_role', 2)
        ->groupBy('users.id')      
        ->get();
    }

    public function headings(): array
    {
        return [
            [
                'ID', 
        'Name',
        'Email ',
      
            ]
        ];
    }

    public function registerEvents(): array

    {

        return [

            AfterSheet::class    => function(AfterSheet $event) {

   

                $event->sheet->getDelegate()->getStyle('A1:C1')

                                ->getFont()

                                ->setBold(true);

   

            },

        ];

    }
}
