<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Post\ClientPostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientPostService
{

    private $repository;
    const TYPE = ['new'];

    public function __construct(ClientPostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findById($_id)
    {
        return $this->repository->findById($_id);
    }

    public function findBySlug($_slug)
    {
        return $this->repository->findBySlug($_slug);
    }

    public function getListByCategory($_data)
    {
        return $this->repository->getListByCategory(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 4]));
    }

    public function getListByCate($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListRelated($_data)
    {
        return $this->repository->getListRelated(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 5]));
    }

}
