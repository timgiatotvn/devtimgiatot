<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
