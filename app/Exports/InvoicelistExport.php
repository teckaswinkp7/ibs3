<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicelistExport implements FromCollection, WithHeadings
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('users.offer_accepted','yes')
       ->join('payment','users.id','payment.stu_id')
       ->join('courseselections','users.id','courseselections.stu_id')
       ->join('courses','courseselections.studentSelCid','courses.id')
       ->select('users.id','users.name','payment.amountdue','payment.balance_due','courses.name as coursename')
       ->where('payment.amountdue','!=', NULL)
       ->get();
    }

   


    public function headings(): array
    {
        return [
            [
                'ID', 
        'Name',
        'Amount Due ',
        'Balance Due',
        'Course Name',
            ]
        ];
    }
}
