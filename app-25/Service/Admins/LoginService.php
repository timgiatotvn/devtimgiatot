<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function login($_var)
    {
        $remember = isset($_var['remember_token']);
        $login = Auth::guard(Helpers::renderGuard())
            ->attempt(['username' => $_var['username'], 'password' => $_var['password'], 'status' => 1], $remember);
        if ($login) {
            Auth::shouldUse(Helpers::renderGuard());
        }
        return $login;
    }

}
