<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class active_users extends Model
{
    use HasFactory;

    protected $table = 'active_users';
    protected $fillable = [
        'user_id'
    ];
}
