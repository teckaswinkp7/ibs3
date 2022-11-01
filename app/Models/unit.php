<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','course_id','title','slug','embed_id','short_text','full_text','position','free_lesson','published','course_name'
    ];


   
}
