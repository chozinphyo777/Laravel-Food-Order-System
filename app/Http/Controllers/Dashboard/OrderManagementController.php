<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
   public function index(Request $req)
   {
      $orders = Order::select('orders.*', 'users.name as user_name')
         ->leftJoin('users', 'users.id', 'orders.user_id')
         ->paginate(2);
      return view('dashboard.orders.index', compact('orders'));
   }

   //Fetch order data by order status and search
   function fetch_data(Request $request)
   {
      logger($request);
      if ($request->ajax()) {
         $orders = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->when($request->search, function($query) use ($request){
               $query->where('orders.order_code','like','%'.$request->search.'%')
               ->orWhere('users.name','like','%'.$request->search.'%');
            })
            ->when($request->filterby, function ($query) use ($request) {
               $query->where('status', $request->filterby);
            })
            ->paginate(2);
          return view('dashboard.orders.data-list', compact('orders'))->render();
      }
   }

   public function changeOrderStatus(Request $req)
   {
      // logger(" New status" + $req->orderStatus);
      $order = Order::findOrFail($req->orderId);
      $order->update([
         'status' => $req->orderStatus,
      ]);
      return response()->json([
         'status' => true,
         'message' => 'success',
         'data' => $order,
      ], 200);
   }

   public function orderDetail($order_code)
   {
     $order = Order::where('order_code',$order_code)->first();
     $order_items = OrderItem::select('order_items.*','products.name as product_name','products.image')
     ->leftJoin('products','products.id','order_items.product_id')
     ->where('order_code',$order_code)->get();
     return view("dashboard.orders.detail",compact('order_items','order'));
   }
}