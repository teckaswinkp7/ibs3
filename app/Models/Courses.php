<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = [
        'id','name','slug','field','start_date','study_level','course_image','course_duration','course_id','price','description','institute','programme','short_description'
    ];
}
