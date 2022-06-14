<?php

namespace App\Repository\Admins\Article;

interface ArticleRepositoryInterface
{
    public function getList($_data);

    public function findByKeyword($_data);

}
