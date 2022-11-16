<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
     protected $fillable =  ['refundpolicy','amountdue','duedate','status','payreciept','stu_id'];
}
