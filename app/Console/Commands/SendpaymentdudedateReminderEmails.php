<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\paymentReminderEmail;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Models\User;

class SendpaymentdudedateReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paymentreminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is for Payment Reminder Email.';

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
        $paymentreminders = User::select('.id')
        ->where('paymentduedate',now())
        ->get();

        $data = [];

        foreach($paymentreminders as $paymentreminder ){



            $data[$paymentreminder->id][] = $paymentreminder->toArray();


        }


        foreach($data as $id => $paymentreminders){

            $this->paymentReminderEmail($id,$paymentreminders);
        }

    }

    private function paymentReminderEmail($id,$paymentreminders){

        $user = User::findOrFail($id);
        Mail::to($user)->send(new paymentReminderEmail($raisereminders));

    }
}
