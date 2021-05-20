<?php

namespace App\Repository\Clients\Category;

interface ClientCategoryRepositoryInterface
{

    public function getMenu();

    public function getListMenu($_data);

}
