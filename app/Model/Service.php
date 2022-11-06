<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'logo',
        'thumbnail',
        'banner',
        'address',
        'service',
        'price',
        'hotline',
        'zalo',
        'rate',
        'total_rate',
        'province_id',
        'district_id',
        'description',
        'content',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

