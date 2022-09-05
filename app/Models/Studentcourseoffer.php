<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentcourseoffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id','offer_course_id','course_offer_description'
    ];
}
