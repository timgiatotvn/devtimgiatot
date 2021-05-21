<?php

namespace App\Repository\Clients\Product;

interface ClientProductRepositoryInterface
{
    public function findById($_id);
    public function getList($_data);

}
