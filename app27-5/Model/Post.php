<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    use Notifiable;
    protected $fillable = [
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
        'choose_1',
        'choose_2',
        'choose_3',
        'choose_4',
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }

}
