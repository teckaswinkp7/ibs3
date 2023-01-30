<?php

namespace App\Exports;
use DB;
use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

class EnrolledUser implements FromCollection
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
        ->select('users.id','users.name','users.updated_at','payment.amountdue','payment.balance_due','payment.invoice','courses.name as coursename')
        ->get();

    }
}
