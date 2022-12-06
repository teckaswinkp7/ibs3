<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentsession extends Model
{
    use HasFactory;

    protected $table = 'paymentsession';
    protected $fillable = ['sponsor_id','paid_stu_id','paid_reciept'];
}
