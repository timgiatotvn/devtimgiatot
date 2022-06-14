<?php

namespace App\Repository\Clients\User;

interface ClientUserRepositoryInterface
{

    public function store($_data);
    public function update($_data, $_id);

}
