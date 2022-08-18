<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Model\EmailTemplate;
use App\Model\TokenEmail;
use App\Model\User;
use App\Repository\Clients\User\ClientUserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

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
            'phone' => $_data['phone'],
            'name' => !empty($_data['name']) ? $_data['name'] : '',
            'type' => self::TYPE_USER[0],
            'push_number' => 2
        ];
        DB::beginTransaction();
        $result = $this->repository->store($data);

        if ($result) {
            $token = md5(rand());
            $email = EmailTemplate::where('code', 'register')->first();
            $user = User::where('email', $_data['email'])->first();

            if ($email && $user) {
                TokenEmail::create([
                    'user_id' => $user->id,
                    'token' => $token
                ]);
                Mail::send([], [], function($message) use ($email, $_data, $token) {
                    $route = route('client.user.verify', ['token' => $token]);
                    $content = str_replace(['[url]', '[full_name]'], ["<a href='$route'>" . $route . "</a>", $_data['name']], $email->content);
                    $subject = str_replace('[full_name]', $_data['name'], $email->subject);
                    $message->to($_data['email'])
                        ->subject($subject)
                        ->setBody($content, 'text/html');
                });
            }
            DB::commit();

            return true;
        }
        DB::rollBack();

        return false;
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
