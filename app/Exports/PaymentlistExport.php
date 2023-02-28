<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PaymentlistExport implements FromCollection, WithHeadings,WithEvents
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
        ->select('users.id','users.name','users.email','payment.balance_due','courses.name as coursename')
        ->get();
    }

    public function headings(): array
    {
        return [
            [
                'ID', 
        'Name',
        'Email ',
        'Amount due',
        'Course Name',
            ]
        ];
    }

    public function registerEvents(): array

    {

        return [

            AfterSheet::class    => function(AfterSheet $event) {

   

                $event->sheet->getDelegate()->getStyle('A1:D1')

                                ->getFont()

                                ->setBold(true);

   

            },

        ];

    }
}
