<?php

namespace App\Repository\Clients\Category;

interface ClientCategoryRepositoryInterface
{

    public function findById($_id);

    public function findBySlug($_slug);

    public function findListParentId($_id);

    public function getMenu();

    public function getListMenu($_data);

}
