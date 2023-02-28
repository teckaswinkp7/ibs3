<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EnrolledusersExport implements FromCollection, WithHeadings,WithEvents

{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) {
   
       $this->id = $id;
   
   
    }
         
   
       public function collection()
       {
           return  User::where('users.offer_accepted','yes')
           ->leftjoin('courseselections','users.id','=','courseselections.stu_id')
           ->leftjoin('courses','courseselections.studentSelCid','=','courses.id')
           ->join('payment','users.id','=','payment.stu_id')
           ->where('courses.id',$this->id)
           ->where('users.user_role', 2)
           ->where('payment.balance_due','=','0')
           ->groupBy('users.id')  
           ->select('users.id','users.name','courses.name as coursename') 
           ->get();
       }
       public function headings(): array
       {
           return [
               [
                   'ID', 
           'Name',
           'Course Name ',
          
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
