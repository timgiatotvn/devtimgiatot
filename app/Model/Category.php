<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
<<<<<<< HEAD

    public static function getCategoryByName($name)
    {
        $category = Category::where('title', $name)->where('status', 1)->select('id', 'title')->first();
        $listCategory = [];
        if ($category) {
//            $parentCate = Category::where('parent_id', $category->id)->where('status', 1)->select('id')->get();
//            $arrayId = $parentCate->pluck('id')->toArray();
            $listCategory = Category::where('parent_id', $category->id)
                ->where('type', 'product')
                ->where('status', 1)
                ->select('id', 'title','parent_id', 'thumbnail', 'url')
                ->orderBy('sort', 'ASC')
                ->get();
        }

        return self::formatCategory($listCategory);
    }

    public static function formatCategory($data)
    {
        foreach ($data as $item)
        {
            $item->thumnail = Helpers::getUrlFile($item->thumbnail);
        }

        return $data;
    }

    public static function getCategoryById($id)
    {
        $categories = Category::where('parent_id', $id)
            ->where('type', 'product')
            ->where('status', 1)
            ->select('id', 'title','parent_id', 'thumbnail', 'url')
            ->orderBy('sort', 'ASC')
            ->get();

        return self::formatCategory($categories);
    }
=======
    
>>>>>>> 70dc6001e31333bbb582f47f8cca05075f855bdb
}
