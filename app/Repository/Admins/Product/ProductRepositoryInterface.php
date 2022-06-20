<?php

namespace App\Repository\Admins\Product;

interface ProductRepositoryInterface
{
    public function getList($_data);

    public function listAllCrawler();

    public function create($_data);

    public function update($_data, $_id);

    public function updateCrawler($_data, $_id);

    public function findById($_id);

    public function updateStatus($_id, $_field, $_status);

    public function destroyAll($_data);

    public function destroy($_id);

}
