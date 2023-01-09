<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\proformaReminderEmail;
use DB;
use App\Models\User;

class SendproformareminderEmais extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'proformareminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is for sending the reminder for creating Proforma invoice. ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $proformareminders = User::select('users.id')
        ->join('payment','payment.stu_id','=','users.id')
        ->where('users.reminderdate',now()->format('y-m-d'))
        ->where('payment.status','Registered')
        ->orderBy('id')
        ->get();

        

        $data = [];

        foreach($proformareminders as $proformareminder){

            $data[$proformareminder->id][]= $proformareminder->toArray();
        }

        foreach($data as $id => $proformareminders){

            $this->proformaReminderEmail($id,$proformareminders);

        }


    }

    private function proformaReminderEmail($id,$proformareminders){

        $user = User::findOrFail($id);
        Mail::to($user)->send (new proformaReminderEmail($proformareminders));
    }
}
