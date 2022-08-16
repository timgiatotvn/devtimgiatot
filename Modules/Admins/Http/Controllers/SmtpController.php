<?php

namespace Modules\Admins\Http\Controllers;

use App\Model\EmailSetting;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class SmtpController extends Controller
{
    public function config()
    {
        $smtp = EmailSetting::first();

        return view('admins::smtps.index', ['smtp' => $smtp]);
    }

    public function update(Request $request)
    {
        $smtp = EmailSetting::first();

        if (empty($smtp)) {
            EmailSetting::create($request->all());
        } else {
            $smtp->update($request->all());
        }

        return back()->with('success', 'Cài đặt thành công');
    }
}
