<?php

namespace Modules\Clients\Http\Controllers;

use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function listService()
    {
        return view("clients::services.list");
    }
}