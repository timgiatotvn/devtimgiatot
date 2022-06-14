<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Article\ClientArticleRepositoryInterface;

class ClientArticleService
{
    private $repository;
    const TYPE = ['crawler'];

    public function __construct(ClientArticleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getList($_data = [])
    {
        return $this->repository->getList($_data);
    }

}
