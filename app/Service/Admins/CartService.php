<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Cart\CartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartService
{

    private $repository;
    const TYPE = ['cart'];

    public function __construct(CartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function getList($_data)
    {
        return $this->repository->getList(array_merge($_data, ['type' => self::TYPE[0]]));
    }

}
