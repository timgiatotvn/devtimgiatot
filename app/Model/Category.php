<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';





    public static function listCate($limit, $fields, $sort)
    {
        $result = Category::orderBy('sort', $sort);
        if ($fields != "") {
            $result = Category::where($fields, '=', 1);
        }
        $result = $result->get()->toArray();
        return $result;
    }

    public static  function listCategory($limit){

        $result = Category::orderBy('sort', 'DESC');
        $result = $result->orderBy('id','DESC');
        $result->where('parent_id',NULL);

        if ($limit > 0){
            // Phân trang
            $result = $result->paginate($limit);
        }else{
            // List toàn bộ
            $result = $result->get()->toArray();
        }
        return $result;
    }

    public static  function listSubCategory($limit,$parent){

        $result = Category::orderBy('sort', 'DESC');
        $result = $result->orderBy('id','DESC');
        $result->where('parent_id',$parent);

        if ($limit > 0){
            // Phân trang
            $result = $result->paginate($limit);
        }else{
            // List toàn bộ
            $result = $result->get()->toArray();
        }
        return $result;
    }

    public static function fildBySlug($slug){
        $result = Category::where('slug', '=', $slug)
            ->first();
        return $result;
    }
    public static function findById($id){
        $result = Category::where('id', '=', $id)
            ->first();
        return $result;
    }
}
