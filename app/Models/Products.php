<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsToMany(\App\Models\Category::class,'products','id','cat_id');
    }
    public function parentcat()
    {
        return $this->belongsToMany(\App\Models\Category::class,'parent_id','null');
    }
    public function subcategory()
    {
        return $this->belongsToMany(\App\Models\Category::class,'products','id','subcat_id');
    }
}
