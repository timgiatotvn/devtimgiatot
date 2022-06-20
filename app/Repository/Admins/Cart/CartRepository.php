<?php

namespace App\Repository\Admins\Cart;

use App\Helpers\Helpers;
use App\Model\Cart;
use Illuminate\Support\Facades\DB;


class CartRepository implements CartRepositoryInterface
{
    const TABLE_NAME = 'carts';
    private $model;

    public function __construct()
    {
        $this->model = new Cart();
    }

    public function getList($_data)
    {
        $keyword = !empty($_data['keyword']) ? $_data['keyword'] : '';
        return $this->model

//            ->select('carts.*',
//                'cart_items.product_id',
//                'cart_items.sl',
//                'cart_items.price',
//                'cart_items.sum_price',
//                'products.title as product_title',
//                'products.thumbnail as product_thumbnail',
//                'products.slug as product_slug',
//                'products.code as product_code'
//            )
//            ->leftJoin('cart_items', 'carts.id', 'cart_items.cart_id')
//            ->leftJoin('products', 'cart_items.product_id', 'products.id')
//            ->when($keyword, function ($query, $keyword) {
//                return $query->where('title', 'LIKE', '%' . $keyword . '%');
//            })
            ->where('type', $_data['type'])
            ->orderByDesc('id')
            ->with('userDetail')
            ->with(['cartItems' => function ($query) {
                $query->with(['productDetail']);
            }])
            ->paginate($_data['limit']);
    }


}