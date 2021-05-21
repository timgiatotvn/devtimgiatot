<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Advertisement\AdvertisementRepositoryInterface;
use App\Repository\Clients\Product\ClientProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClientProductService
{

    private $repository;
    const TYPE = ['product'];

    public function __construct(ClientProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function findById($_id)
    {
        return $this->repository->findById($_id);
    }

    public function getListByCate($_data)
    {
        return $this->repository->getListByCate(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListHome($_data)
    {
        return $this->repository->getListHome(array_merge($_data, ['type' => self::TYPE[0]]));
    }

    public function getListRelated($_data)
    {
        return $this->repository->getListRelated(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 3]));
    }

}
