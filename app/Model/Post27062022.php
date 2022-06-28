<?php

namespace App\Model;

use App\Helpers\Helpers;
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

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id', 'id');
    }

    public static function getPostByCategoryId($categoryId)
    {
        $posts = Post::with(['category' => function($query) {
            return $query->select('id', 'title');
        }])->where('category_id', $categoryId)
            ->where('status', 1)
            ->select('id', 'title', 'slug', 'description', 'content', 'thumbnail', 'category_id')
            ->orderBy('id', 'DESC');

        return $posts;
    }

    static public function formatData($data)
    {
        foreach ($data as $item) {
            $item->thumbnail = Helpers::getUrlFile($item->thumbnail);
        }

        return $data;
    }

}
