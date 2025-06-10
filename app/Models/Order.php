<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(user::class);
    }
     
    public function orderItem()
    {
        return $this->hasMany(orderItem::class);

    }

    public function transaction()
    {
        return $this->hasOne(transaction::class);

    }
}
