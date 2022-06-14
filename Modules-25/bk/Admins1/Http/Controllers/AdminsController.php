<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminsController extends Controller
{
    /**
     * Dashboard
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('admins::layer.dashboard.title'), ]);
            return view('admins::dashboard.index', ['data' => $data]);
        } catch (\Exception $e) {
            abort('500');
        }
    }
}
