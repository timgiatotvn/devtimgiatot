<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public function crawlerCategory()
    {
        return $this->belongsTo(CrawlerCategory::class, 'crawler_category_id', 'id');
    }
}
