<?php

namespace App\Repository\Clients\Advertisement;

use Illuminate\Support\Facades\DB;

class AdvertisementRepository implements AdvertisementRepositoryInterface
{
    const TABLE_NAME = 'advertisements';

    public function getListAds($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'url', 'type')->where('type', $_type)->where('status', 1)->get();
    }

    public function findByLogo($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'url', 'type')->where('type', $_type)->where('status', 1)->first();
    }

    public function getListSlideShow($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'url', 'type')->where('type', $_type)->where('status', 1)->get();
    }

    public function getListLink($_type)
    {
        return DB::table(self::TABLE_NAME)->select('id', 'title', 'thumbnail', 'description', 'url', 'url_title', 'type')->where('type', $_type)->where('status', 1)->get();
    }

}