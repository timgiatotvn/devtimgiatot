<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CrawlLink extends Model
{
    protected $table = 'crawl_links';

    const SO_SANH_GIA = 'sosanhgia.com';
    const WEB_SO_SANH = 'websosanh.vn';

    protected $fillable = [
        'link',
        'website_name',
        'page_number'
    ];
}
