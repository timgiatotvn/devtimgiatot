<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\User\ClientUserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientUserService
{

    private $repository;
    const TYPE_USER = ['nornal'];

    public function __construct(ClientUserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAuthUser()
    {
        return Auth::guard(Helpers::renderGuard(1))->user();
    }

    public function store($_data)
    {
        $data = [
            'username' => !empty($_data['username']) ? $_data['username'] : '',
            'password' => !empty($_data['password']) ? Hash::make($_data['password']) : '',
            'email' => !empty($_data['email']) ? $_data['email'] : '',
            'name' => !empty($_data['name']) ? $_data['name'] : '',
            'type' => self::TYPE_USER[0],
        ];
        return $this->repository->store($data);
    }

    public function update($_data)
    {
        $user = Auth::guard(Helpers::renderGuard(1))->user();
        $data = [
            'password' => !empty($_data['password']) ? Hash::make($_data['password']) : '',
            'name' => !empty($_data['name']) ? $_data['name'] : '',
        ];
        return $this->repository->update($data, $user->id);
    }

}
