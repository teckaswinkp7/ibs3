<?php

namespace App\Exports;
use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

class PaymentlistExport implements FromCollection
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
}
