<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CrawlerCategory extends Model
{
    protected $table = 'crawler_categories';

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function article()
    {
        return $this->hasMany(Article::class, 'crawler_category_id', 'id')->where('type','=', "demo");
    }

    public function crawlerWebsite()
    {
        return $this->belongsTo(CrawlerWebsite::class, 'crawler_website_id', 'id');
    }
}
