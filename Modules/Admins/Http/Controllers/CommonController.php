<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CommonController extends Controller
{
    /**
     * @return slug
     */
    public function renderSlug(Request $request)
    {
        return "1122";
    }

}
