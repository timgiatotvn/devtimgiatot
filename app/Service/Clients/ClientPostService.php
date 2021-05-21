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

    public function getListByCategory($_data)
    {
        return $this->repository->getListByCategory(array_merge($_data, ['type' => self::TYPE[0], 'limit' => 4]));
    }

}
