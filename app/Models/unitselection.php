<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unitselection extends Model
{
    
    use HasFactory;
    protected $table = 'unitselection';
    protected $fillable = ['stu_id','units_id','selected_units','checked'];
}
