<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\raiseReminderEmail;
use Illuminate\Support\Facades\Mail;
use DB;
use App\Models\User;

class SendraisinvoiceReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raisinvoice:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a notification for raising the invoice.';

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
        
        $raisereminders = User::select('id')
        ->where('reminderdate',now()->format('y-m-d'))
        ->where('offer_accepted','yes')
        ->get();

        $data = [];

        foreach($raisereminders as $raisereminder){

            $data[$raisereminder->id][] = $raisereminder->toArray();

        }

        foreach($data as $id => $raisereminders){

            $this->raiseReminderEmail($id,$raisereminders);
        }
    }

    private function raiseReminderEmail($id,$raisereminders){

        $user = User::findOrFail($id);
        Mail::to($user)->send(new raiseReminderEmail($raisereminders));

    }
}
