<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','sponsor_name','sponsor_email','sponsor_phone','stu_id','course_id','sponsor_id','title','middle_name','last_name','position',
        'alt_email','alt_phone','company_name','province','address','main_phone_line','alt_phone_line','selected_stu_id','sponsor_image'
    ];
}
