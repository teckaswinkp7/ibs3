<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class obtain extends Model
{
    use HasFactory;

    protected $table = 'obtain';
    protected $fillable = ['id','stu_id','language','english','maths','economics','accounting','business','geography','history','legal','techno','practical','home','personal','biology','chemistry','physics','appliedscience','geology','cgpa'];
}
