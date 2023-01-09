<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Courseselection;
use Illuminate\Support\Facades\Mail;
use App\Mail\courseselectReminderEmail;
use DB;
use App\Models\User;

class SendcourseselectreminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coursereminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to users about course selection';

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
        $docreminders = User::select('id')
        ->where('offer_accepted',NULL)
        ->where('reminderdate',now()->format('y-m-d'))
        ->orderBy('id')
        ->get();
    
       // dd($docreminders);
    
       $data = [];
    
       foreach($docreminders as $docreminder){
    
        $data[$docreminder->id][]= $docreminder->toArray();
    
       }
    
       foreach($data as $id => $docreminders ){
    
        $this->courseselectReminderEmail($id, $docreminders);
       }
    }
    
       private function courseselectReminderEmail($id,$docreminders){
    
        $user = User::findOrFail($id);
    
        Mail::to($user)->send(new courseselectReminderEmail($docreminders));
    
       }
}
