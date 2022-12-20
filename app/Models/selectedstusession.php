<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class selectedstusession extends Model
{
    use HasFactory;

    protected $table = 'selectedstusession';
    protected $fillable = ['sponsorid','selstu'];
}
