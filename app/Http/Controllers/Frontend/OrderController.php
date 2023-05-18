<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
   public function create(Request $req)
   {
    $order_code = 'ORD'.Auth()->user()->id.'_'.date('YmdHis');
        foreach($req->order_data as $data){
           OrderItem::create([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'price' => $data['price'],
            'qty' => $data['qty'],
            'total' => $data['total'],
            'order_code' => $order_code,
           ]);
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $req->summary_price,
            'status' => 'pending',
            'order_code' => $order_code ,
        ]);
        return response()->json([
            'message' => 'Order Success',
            'status' => 'success',
        ],201);
   }
   public function orderHistory()
   {
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(2);
        return view('frontend.orders.history',compact('orders'));
   }
}
