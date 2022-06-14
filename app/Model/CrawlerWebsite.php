<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CrawlerWebsite extends Model
{
    protected $table = 'crawler_websites';

    public function crawlerCategoryCount()
    {
        return $this->hasMany(CrawlerCategory::class, 'crawler_website_id')->count();
    }
}
