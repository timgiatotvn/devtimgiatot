<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;

class ClientLoginService
{
    public function login($_var)
    {
        $remember = isset($_var['remember_token']) ? 1 : 0;
        $login = Auth::guard(Helpers::renderGuard(1))
            ->attempt(['username' => $_var['username'], 'password' => $_var['password'], 'status' => 1], $remember);
        if ($login) {
            Auth::shouldUse(Helpers::renderGuard(1));
        }
        return $login;
    }

}
