<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\outstandingpaymentReminderEmail;
use DB;
use App\Models\User;

class SendoutstandingduedateReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'outstandingpayment:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a Reminder for outstanding payment';

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
        $outstandingpaymentreminders = User::select('users.id')
        ->join('payment','payment.stu_id','=','users.id')
        ->where('users.paymentduedate',now()->format('y-m-d'))
        ->where('payment.balance_due','!=','0')
        ->get();

        $data = [];

        foreach($outstandingpaymentreminders as $outstandingpaymentreminder){

            $data[$outstandingpaymentreminder->id][] = $outstandingpaymentreminder->toArray();


        }

        foreach($data as $id => $outstandingpaymentreminders){


            $this->outstandingpaymentReminderEmail($id,$outstandingpaymentreminders);

        }
    }

    private function outstandingpaymentReminderEmail($id,$outstandingpaymentreminders){

        $user = User::findOrFail($id);

        Mail::to($user)->send(new outstandingpaymentReminderEmail($outstandingpaymentreminders));
    }
}
