<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sponsorrequested extends Model
{
    use HasFactory;

    protected $fillable = [
        'sponsor_id','stu_id'
    ];
}
