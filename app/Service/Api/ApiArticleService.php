<?php

namespace App\Service\Api;

use App\Helpers\Helpers;
use App\Repository\Api\Article\ApiArticleRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ApiArticleService
{
    private $repository;
    const type = "crawler";

    public function __construct(ApiArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store($_data)
    {
        if (empty($_data["name"])) return false;
        $data = [
            "crawler_category_id" => $_data["crawler_category_id"],
            "name" => $_data["name"],
            "slug" => !empty($_data['name']) ? Str::slug($_data['name'], '-') : '',
            "thumbnail" => $_data["thumb"],
            "href" => $_data["href"],
            "price" => !empty($_data["price"]) ? preg_replace("/[^0-9]/", "", $_data["price"]) : 0,
            "price_root" => !empty($_data["price_root"]) ? preg_replace("/[^0-9]/", "", $_data["price_root"]) : 0,
            "price_crawler" => $_data["price"],
            "price_root_crawler" => $_data["price_root"],
            "description" => $_data["description"],
            "content" => $_data["content"],
            "type" => $_data["type"],
            "status" => 1,
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ];
        return $this->repository->store($data);
    }
}
