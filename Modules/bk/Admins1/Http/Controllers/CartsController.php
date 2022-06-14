<?php

namespace Modules\Admins\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Admins\CartService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartsController extends Controller
{

    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Cart list
     * @method GET
     */
    public function index()
    {
        try{
            $data['common'] = Helpers::titleAction([__('admins::layer.cart.index.title'), __('admins::layer.cart.index.title2')]);
            $data['list'] = $this->cartService->getList(['limit' => 15]);
            return view('admins::carts.index', ['data' => $data]);
        } catch (\Exception $e) {Helpers::pre($e->getMessage());
            abort('500');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
