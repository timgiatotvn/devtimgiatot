<?php

namespace App\Repository\Clients\Cart;

interface ClientCartRepositoryInterface
{

    public function store($_data);
    public function storeItem($_data);

}
