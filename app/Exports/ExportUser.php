<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use App\Models\User;

class ExportUser implements FromCollection
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
}
