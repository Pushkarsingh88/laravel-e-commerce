<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\Hasfactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 use Hasfactory;

 public function category()
 {
    return $this->belongsTo(Category::class,'category_id');
 }

 public function brand()
 {
    return $this->belongsTo(Brand::class,'brand_id');
 }
 
}
