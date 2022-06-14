<?php

namespace App\Service\Clients;

use App\Helpers\Helpers;
use App\Repository\Clients\Cart\ClientCartRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientCartService
{

    const key_session_cart = 'shopping_cart';
    const key_cart = 'cart';

    private $repository;

    public function __construct(ClientCartRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function addCart($_data)
    {
        $key_session = self::key_session_cart;
        if (!isset($_SESSION[$key_session])) $_SESSION[$key_session] = [];

        if (isset($_SESSION[$key_session])) {
            $shoppingCart = $_SESSION[$key_session];
            $id = $_data->id;
            if (isset($shoppingCart[$id])) {
                $shoppingCart[$id]['sl'] = !empty($_POST['soluong']) ? $_POST['soluong'] : 1;
                $shoppingCart[$id]['detail'] = $_data;
                $_SESSION[$key_session] = $shoppingCart;
                return true;
            } else {
                //viet nam
                $shoppingCart[$id]['sl'] = !empty($_POST['soluong']) ? $_POST['soluong'] : 1;
                $shoppingCart[$id]['detail'] = $_data;
                $_SESSION[$key_session] = $shoppingCart;
                return true;
            }
        }
    }

    public function update($_id)
    {
        if (isset($_SESSION[self::key_session_cart])) {
            $cart = $_SESSION[self::key_session_cart];
            if (!empty($cart[$_id])) {
                $cart[$_id]['sl'] = !empty($_POST['soluong']) ? $_POST['soluong'] : $cart[$_id]['sl'];
                $_SESSION[self::key_session_cart] = $cart;
                return true;
            }
            return false;
        }
        return true;
    }

    public function store($_data)
    {
        DB::beginTransaction();
        try {
            if (!empty($_SESSION[self::key_session_cart])) {
                $user = [];
                if(Auth::guard(Helpers::renderGuard(1))->check()) {
                    $user = Auth::guard(Helpers::renderGuard(1))->user();
                }
                $data = [
                    'user_id' => !empty($user->id) ? $user->id : '',
                    'name' => !empty($_data['name']) ? $_data['name'] : '',
                    'email' => !empty($_data['email']) ? $_data['email'] : '',
                    'phone' => !empty($_data['phone']) ? $_data['phone'] : '',
                    'address' => !empty($_data['address']) ? $_data['address'] : '',
                    'content' => !empty($_data['content']) ? $_data['content'] : '',
                    'type' => self::key_cart,
                    'created_at' => date("Y/m/d H:i:s"),
                    'updated_at' => date("Y/m/d H:i:s")
                ];

                $cart = $this->repository->store($data);
                if (!empty($cart->id)) {
                    $listCart = $_SESSION[self::key_session_cart];
                    $data_item = [];
                    $sum_money = 0;
                    foreach ($listCart as $row) {
                        $sl = $row['sl'];
                        $row = $row['detail'];
                        $price = $row->price * $sl;
                        $sum_money += $price;
                        $data_item[] = [
                            'cart_id' => $cart->id,
                            'product_id' => $row->id,
                            'sl' => $sl,
                            'price' => $row->price,
                            'sum_price' => $price,
                            'created_at' => date("Y/m/d H:i:s"),
                            'updated_at' => date("Y/m/d H:i:s")
                        ];
                    }
                    if($this->repository->storeItem($data_item)){
                        unset($_SESSION[self::key_session_cart]);
                        DB::commit();
                        return true;
                    }
                }
            }
            DB::rollBack();
            return false;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function destroy($_id)
    {
        if (isset($_SESSION[self::key_session_cart])) {
            $cart = $_SESSION[self::key_session_cart];
            if (!empty($cart[$_id])) {
                unset($cart[$_id]);
                $_SESSION[self::key_session_cart] = $cart;
                return true;
            }
            return false;
        }
        return true;
    }

}
