<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courseselection;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','exam_name','exam_description','course_id','exam_document','exam_duration'
    ];

    public function courseselection()
    {
        return $this->hasMany(Courseselection::class);
    }

   
}
