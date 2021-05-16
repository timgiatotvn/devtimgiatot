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


    public static function getListPost($limit, $cate_id, $sort)
    {
        $cate_id_multi = '|'.$cate_id.'|';
        $data = Post::where('status', '=', 1);
        $data = $data->where(function ($data) use ($cate_id,$cate_id_multi) {
            $data->orwhere('category_id',$cate_id)->orwhere('category_multi', 'LIKE', '%' . $cate_id_multi . '%');
        });

        $data = $data->orderBy('sort', $sort)
            ->with('getCategory:title,id,slug')
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return $data;
    }


    public static function listPostHome($limit, $fields, $sort)
    {
        $result = Post::orderBy('sort', $sort)
            ->with('getCategory:title,id,slug');
        if ($fields != "") {
            $result = Post::where($fields, '=', 1);
        }

        $result = $result->get()->toArray();

        return $result;
    }

    public static function fildBySlug($slug)
    {
        $result = Post::where('slug', '=', $slug)
            ->first();
        return $result;
    }

    public static function postRelated($id, $cate_id, $limit)
    {
        $result = Post::where('id', '<>', $id)
            ->where('category_id', $cate_id)
            ->with('getCategory:title,id,slug')
            ->limit($limit)
            ->get();
        return $result;
    }

    public static function findById($id)
    {
        $result = Post::where('id', '=', $id)
            ->first();
        return $result;
    }
}
