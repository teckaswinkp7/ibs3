<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $fillable = ['invoiceino','stu_id','course_id','stud_type','units','sem','additional_info'];
}
