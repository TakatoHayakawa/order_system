<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderListController extends Controller
{
    public function index()
    {
        
        //Orderを取得
        $Orders = Order::fetch_info(); 

        $data = [
            'Orders' => $Orders
        ];

        return view('OA/Order/OrderList', $data);
    }

    public function detailt($id)
    {
        
        //Orderを取得
        $Order = Order::fetch_info_where_id($id); 

        if($Order == null){
            return redirect('/OA/orderList');
        }

        //OrderDetailt
        $orderDetailts = OrderDetail::fetch_info_where_order_id($id);

        $data = [
            'Order'         => $Order,
            'orderDetailts' => $orderDetailts,
        ];

        return view('OA/Order/OrderList/OrderDetailt', $data);
    }

}
