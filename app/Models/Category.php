<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Hasfactory;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
   return $this->hasMany(Product::class);
   
    }
}
