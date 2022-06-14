<?php

namespace App\Service\Admins;

use App\Helpers\Helpers;
use App\Repository\Admins\Account\AccountRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountService
{
    private $accountRepository;
    const TYPE = ['admin'];

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function getList($_data = [])
    {
        $_data['keyword'] = request()->has('keyword') ? request()->get('keyword') : '';
        return $this->accountRepository->getList($_data);
    }

    public function findById($_id)
    {
        return $this->accountRepository->findById($_id);
    }

    public function updateStatus($_id, $_status)
    {
        return $this->accountRepository->updateStatus($_id, $_status);
    }

    public function destroy($_id)
    {
        return $this->accountRepository->destroy($_id);
    }

    public function create($_data)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        unset($_data['proengsoft_jsvalidation']);
        $_data['password'] = Hash::make($_data['password']);
        $db = array_merge($_data, [
            'type' => $this::TYPE[0],
            'created_at' => date("Y/m/d H:i:s"),
            'updated_at' => date("Y/m/d H:i:s")
        ]);

        return $this->accountRepository->create($db);
    }

    public function update($_data, $_id)
    {
        if (isset($_data['_token'])) unset($_data['_token']);
        if (isset($_data['page'])) unset($_data['page']);
        unset($_data['proengsoft_jsvalidation']);
        $_data['password'] = Hash::make($_data['password']);
        $db = array_merge($_data, [
            'updated_at' => date("Y/m/d H:i:s")
        ]);
        return $this->accountRepository->update($db, $_id);
    }

}
