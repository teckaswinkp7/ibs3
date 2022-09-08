<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courseselection extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id', 'course_id', 'studentSelCid','offer_generated'
    ];
}
