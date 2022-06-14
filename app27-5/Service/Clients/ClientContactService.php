<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Contact\ClientContactRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientContactService
{

    const key = 'contact';

    private $repository;

    public function __construct(ClientContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function store($_data)
    {
        try {
            $user = (object)[];
            if (Auth::guard(Helpers::renderGuard(1))->check()) {
                $user = Auth::guard(Helpers::renderGuard(1))->user();
            }
            $data = [
                'user_id' => !empty($user->id) ? $user->id : '',
                'name' => !empty($_data['name']) ? $_data['name'] : '',
                'email' => !empty($_data['email']) ? $_data['email'] : '',
                'phone' => !empty($_data['phone']) ? $_data['phone'] : '',
                'address' => !empty($_data['address']) ? $_data['address'] : '',
                'content' => !empty($_data['content']) ? $_data['content'] : '',
                'type' => self::key,
                'created_at' => date("Y/m/d H:i:s"),
                'updated_at' => date("Y/m/d H:i:s")
            ];
            if ($this->repository->store($data)) return true;
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }


}
