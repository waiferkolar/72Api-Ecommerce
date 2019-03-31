<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiOrderController extends Controller
{
    public function order(Request $request)
    {
        $res = [
            'con' => true,
            'msg' => 'Success',
        ];

        $con = false;
        $orders = $request->get('orders');
        $data = rtrim($orders, ",");
        $data = explode(',', $data);
        foreach ($data as $dd) {
            $ary = explode("#", $dd);
            $con = DB::table('products')->where("id", $ary[0])->exists();
        }
        if (!$con) {
            $res["con"] = false;
            $res["msg"] = "No product with that id!";
        } else {
            $user = $request->user();
            $order = new Order();
            $order->user_id = $user->id;
            $order->orders = $orders;
            $order->save();
        }

        return response()->json($res);
    }

    public function myorders(Request $request)
    {
        $user = $request->user();
        $user_orders = Order::where('user_id', $user->id)->get();
        $userAllOrdersIds = [];
        foreach ($user_orders as $user_order) {
            $ary = explode(',', $user_order->orders);
            foreach ($ary as $orderId) {
                array_push($userAllOrdersIds, $orderId);
            }
        }

        $myOrder = [];
        foreach ($userAllOrdersIds as $orderNum) {
            $order = Product::where('id', $orderNum)->first();
            array_push($myOrder, $order);
        }
        return response()->json($myOrder);
    }
}
