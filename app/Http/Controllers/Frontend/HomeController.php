<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    //Product List
    public function home(Request $req)
    {

        $products = Product::
            // when(request('category_id'), function ($query) {
            //     $query->where('category_id', request('category_id'));
            // })
            // ->when(request('sorting_status'), function ($query) {
            //     $query->orderBy('id', request('sorting_status'));
            // })
            // ->
            paginate(2);
        if ($req->sorting_status) {
            return $products;
        }
        $categories = Category::get();
        return view('frontend.products.home', compact('products', 'categories'));
    }

    public function productFilter(Request $req)
    {
        logger($req);
        if ($req->ajax()) {
            $products = Product::
                when($req->category_id, function ($query) use ($req) {
                    $query->where('category_id', $req->category_id);
                })
                ->when($req->sorting_status, function ($query) use ($req){
                    $query->orderBy('id',$req->sorting_status );
                })
                 ->paginate(2);
            $categories = Category::get();
            logger($products);
            return view('frontend.products.data-list', compact('products', 'categories'))->render();
        }
    }

    // public function productOrder(Request $req){
    //     // logger($req->status);
    //    $products =  Product::orderBy('id',$req->status)->get();
    //    return $products;
    // }

    public function productDetail($productId)
    {
        $product = Product::findOrFail($productId);
        $products = Product::inRandomOrder()->limit(5)->get();
        return view('frontend.products.product-detail', compact('product', 'products'));
    }
}