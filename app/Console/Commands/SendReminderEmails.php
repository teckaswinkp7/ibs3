<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Courseselection;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderEmailDigest;
use DB;
use App\Models\User;


class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification emails to customers';

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
        // Get all reminders for today 
        $reminders = courseselection::select('stu_id')->join('users','users.id','=','courseselections.stu_id')
        ->select('users.id','users.email','users.name')
        ->where('defer_course','yes')
        ->where('defer_date',now()->format('y-m-d'))
        ->orderByDesc('stu_id')
        ->get();
        // group by user

        $data = [];

        foreach ($reminders as $reminder)
{

    $data[$reminder->stu_id][] = $reminder->toArray();

}
foreach($data as $userid => $reminders){
    $this->sendEmailToUser($userid,$reminders);
}

dd($data);
    }

private function sendEmailToUser($userid, $reminders) {

    $user = User::find($userid);
    Mail::to($reminders)->send(new ReminderEmailDigest($reminders));
}

        // send email 

    
    
}
