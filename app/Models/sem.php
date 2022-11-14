<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sem extends Model
{
    use HasFactory;

    protected $table = 'sem';
    protected $fillable = ['name','course_id','info','price'];
}

