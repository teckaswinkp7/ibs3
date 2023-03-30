<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class xeroapi extends Model
{
    use HasFactory;

    protected $table = ['xeroapi'];
    protected $fillable = ['refresh_token'];
}
