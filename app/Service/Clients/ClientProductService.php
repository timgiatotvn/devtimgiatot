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

    public function getList($_data)
    {
        return $this->repository->getList(array_merge($_data, ['type' => self::TYPE[0]]));
    }

}
