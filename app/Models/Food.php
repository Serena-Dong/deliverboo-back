<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';

    protected $fillable = ['name', 'price', 'image', 'description', 'is_public'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_id', 'id');
    }
}
