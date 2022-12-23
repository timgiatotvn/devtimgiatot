<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'sum_price',
        'price',
        'sl',
        'product_id',
        'shop_id'
    ];

    public function productDetail()
    {
        return $this->hasOne(Product::class, 'id','product_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
