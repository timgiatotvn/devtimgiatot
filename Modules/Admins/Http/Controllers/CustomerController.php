<?php

namespace Modules\Admins\Http\Controllers;

use App\Model\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = User::query();

        if (isset($request->search)) {
            $customers->where('username', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%')
                      ->orWhere('phone', 'like', '%' . $request->search . '%')
                      ->orWhere('name', 'like', '%' . $request->search . '%');
        }
        // dd($customers->with('->get());
        $data = [
            'customers' => $customers->paginate(20),
            'inputs' => $request->all()
        ];

        return view('admins::customers.index', $data);
    }

    public function updatePushNumber(Request $request, $userId)
    {
        User::whereId($userId)->update(['push_number' => $request->push_number]);

        return back()->with('success', 'Cập nhật thành công');
    }
}