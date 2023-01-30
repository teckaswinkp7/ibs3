<?php

namespace App\Exports;

use App\Models\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApplicationExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('users')
        ->join('education','users.id','=','education.stu_id')
        ->select('users.name','education.updated_at','users.id')
        ->where('users.user_role',2)
        ->where('users.status',2)
        ->get();
    }
}
