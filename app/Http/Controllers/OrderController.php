<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class OrderController extends BaseController
{
    public function orderPaidList()
    {
       try {
          $order = Order::where('cash_status', 1)->paginate(10);
          return $this->handleResponse($order,'Order paid List');
       } catch (\Throwable $th) {
           //throw $th;
       }
    }

    public function orderUnpaidList()
    {
        try {
            $order = Order::where('cash_status', 0)->paginate(10);
            return $this->handleResponse($order,'Order paid List');
         } catch (\Throwable $th) {
             //throw $th;
         }
    }

}
