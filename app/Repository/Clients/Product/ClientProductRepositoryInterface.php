<?php

namespace App\Repository\Clients\Product;

interface ClientProductRepositoryInterface
{
    public function findById($_id);
    public function getListByCate($_data);
    public function getListHome($_data);
    public function getListRelated($_data);

}
