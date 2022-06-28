<?php

namespace App\Model;

use App\Helpers\Helpers;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public static function getCategoryByName($name)
    {
        $category = Category::where('title', $name)->where('status', 1)->select('id', 'title')->first();
        $listCategory = [];
        if ($category) {
            $parentCate = Category::where('parent_id', $category->id)->where('status', 1)->select('id')->get();
            $arrayId = $parentCate->pluck('id')->toArray();
            $listCategory = Category::whereIn('id', $arrayId)
                ->orWhereIn('parent_id', $arrayId)
                ->where('type', 'product')
                ->where('status', 1)
                ->select('id', 'title','parent_id', 'thumbnail', 'url')
                ->orderBy('sort', 'ASC')
                ->orderBy('parent_id', 'ASC')
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
}
