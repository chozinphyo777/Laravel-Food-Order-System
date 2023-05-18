<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function allProducts()
    {
       $products = Product::select('products.*','categories.name as category_name')
       ->leftJoin('categories','categories.id','products.category_id')
       ->orderBy('created_at')->get();
       return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $products,
       ]);
    }

    public function createProduct(Request $req)
    {
       $data = $this->productData($req);
       
       if($req->hasFile('image')){
        $file_name = fileUpload($req->file('image'));
        $data['image'] = $file_name;
      }
       $product = Product::create($data);
       return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $product,
       ]);
    }

    private function productData($req){
        return  [
            'category_id' => $req->category_id,
            'name' => $req->name,
            'description' => $req->description,
            'price' => $req->price,
            'view_count' => $req->view_count,
            'waiting_time' => $req->waiting_time,
        ];
    }
}
