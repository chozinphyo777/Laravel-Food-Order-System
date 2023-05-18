<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $req){
        $data = $this->getCartData($req);
        $cart = Cart::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully added',
            'data' => $cart,
        ],201);
    }
    public function cartList()
    {
        $cartlist = Cart::select('carts.*','products.name as product_name','products.price','products.image')
        ->join('products','carts.product_id','products.id')
        ->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        
        $total_price = 0;
        foreach ($cartlist as $key => $item) {
            $total_price += $item->price * $item->qty;
        }
        //  dd($cartlist);
        return view('frontend.carts.cart-list',compact('cartlist','total_price'));
    }
    public function removeProduct(Request $req){
        if($req->carId){
             Cart::findOrFail($req->cartId)->delete();
        }
        else{
            Cart::where('user_id',Auth::user()->id)->delete();
        }
       

        return response()->json([
            'status' => true,
            'message' => "Success",
        ],200);

    }
    private function getCartData($req){
        return [
            'user_id' => $req->userId,
            'product_id' => $req->productId,
            'qty' => $req->quantity,
        ];
    }
}
