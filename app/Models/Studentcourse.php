<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentcourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id','student_course_id'
    ];
}
