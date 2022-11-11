<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additionalfee extends Model
{
    use HasFactory;

    protected $table = 'additionalfee';
    protected $fillable = [

        'title','info','price','status'
    ];
}
