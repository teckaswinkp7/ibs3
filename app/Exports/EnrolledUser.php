<?php

namespace App\Exports;
use DB;
use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnrolledUser implements FromCollection,WithHeadings,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return  User::where('users.offer_accepted','yes')
        ->join('payment','users.id','payment.stu_id')
        ->join('courseselections','users.id','courseselections.stu_id')
        ->join('courses','courseselections.studentSelCid','courses.id')
        ->select('users.id','users.name','payment.amountdue','payment.balance_due','courses.name as coursename')
        ->get();

    }
    public function headings(): array
    {
        return [
            [
                'ID', 
        'Name',
        'Total Amount',
        'Amount Due',
        'Course Name'
      
            ]
        ];
    }

    public function registerEvents(): array

    {

        return [

            AfterSheet::class    => function(AfterSheet $event) {

   

                $event->sheet->getDelegate()->getStyle('A1:E1')

                                ->getFont()

                                ->setBold(true);

   

            },

        ];

    }
}
