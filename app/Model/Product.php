<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    use Notifiable;
    protected $fillable = [
        'shop_id',
        'images',
        'title',
        'slug',
        'category_id',
        'category_multi',
        'admin_id',
        'description',
        'content',
        'thumbnail',
        'sort',
        'view',
        'status',
        'type',
        'price',
        'price_root',
        'choose_1',
        'choose_2',
        'choose_3',
        'choose_4',
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'shop_id', 'id');
    }
}
