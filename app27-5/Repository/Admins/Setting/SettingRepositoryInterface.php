<?php

namespace App\Repository\Admins\Setting;

interface SettingRepositoryInterface
{

    public function update($_data, $_id);

    public function findById($_id);

}
