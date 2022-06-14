<?php

namespace App\Repository\Admins\Category;

interface CategoryRepositoryInterface
{
    public function getList($_data);

    public function getListMenu($_data);

    public function create($_data);

    public function update($_data, $_id);

    public function findById($_id);

    public function findListParentId($_id);

    public function updateStatus($_id, $_field, $_status);

    public function destroy($_id);

}
