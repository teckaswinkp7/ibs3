<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sponsoredstudents extends Model
{
    use HasFactory;

    protected $fillable = [
        'stu_id','sponsor_id','request_accepted','confirmpay'
    ];
}
