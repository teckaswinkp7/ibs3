<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performainvoice extends Model
{
    use HasFactory;
    protected $table = 'performainvoices';
    protected $fillable = [
        'stu_id','additional_item','study_type','payment_period','course_id'
    ];
}
