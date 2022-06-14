<?php

namespace App\Service\Api;

use App\Helpers\Helpers;
use App\Jobs\jobCrawlerCategories;
use App\Repository\Api\CrawlerCategory\ApiCrawlerCategoryRepositoryInterface;

class ApiCrawlerCategoryService
{

    private $repository;

    public function __construct(ApiCrawlerCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function pushQueue()
    {
        $data = $this->getList();
        foreach ($data as $row) {
            Helpers::queueWriteJson($row->id, "all");
            //jobCrawlerCategories::dispatch($row)->delay(now()->addSeconds(2));
        }
    }

    public function getList()
    {
        return $this->repository->getList();
    }
}
