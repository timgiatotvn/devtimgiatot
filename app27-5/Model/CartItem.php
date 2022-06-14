<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    public function productDetail()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }

}
