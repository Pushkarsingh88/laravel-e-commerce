<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    public function product()
    {
              return $this->belongsTo(product::class);
    }

    public function order()
    {
              return $this->belongsTo(order::class);
    }
}
