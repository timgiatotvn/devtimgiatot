<?php

namespace App\Repository\Clients\Category;

interface ClientCategoryRepositoryInterface
{

    public function findById($_id);

    public function getMenu();

    public function getListMenu($_data);

}
