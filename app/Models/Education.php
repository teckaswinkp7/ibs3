<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $fillable = [
        'stu_id','board','percentage','id_image','highest_qualification','course_syopsiy','university','field','semester','batch'
    ];
}
