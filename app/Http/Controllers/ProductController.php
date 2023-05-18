<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
  public function index(){
    //Eloquent
    // $products = Product::when(request('search'), function($query){
    //   $query->where('name','like','%'.request('search').'%')
    //   ->orWhere('description','like','%'.request('search').'%')
    //   ->orWhereHas('category',function($qurey){
    //     $qurey->where('name',request('search'));
    //   });
    // })
    // ->orderBy('id','desc')->paginate(3);

    //Raw Query
    $products = Product::select('products.*','categories.name as category_name')
    ->leftJoin('categories','products.category_id','categories.id')
      ->when(request('search'), function($query){
      $query->where('products.name','like','%'.request('search').'%')
      ->orWhere('products.description','like','%'.request('search').'%')
      ->orWhereHas('category',function($qurey){
        $qurey->where('name',request('search'));
      });
    })
    ->orderBy('products.id','desc')->paginate(2);
    // dd($products->toArray());

   return view('dashboard.products.index',compact('products'));
  }

  public function create(){
    $categories = Category::orderBy('created_at','desc')->get();
    return view('dashboard.products.create',compact('categories'));
  }

  public function store(Request $req){
    $this->checkProductValidation($req,null,'create');

    $data = $this->productData($req);
    
    if($req->hasFile('image')){
      $file_name = fileUpload($req->file('image'));
      $data['image'] = $file_name;
    }

    Product::create($data);
    return redirect()->route('productList')->with('message','Successfully created!');
  }

  public function delete($id){
    Product::findOrFail($id)->delete();
    return redirect()->route('productList')->with('message','Successfully Deleted!');
  }

  public function edit($id){
    $categories = Category::get();
    $product = Product::findOrFail($id);
    return view('dashboard.products.edit',compact('product','categories'));

  }

  public function show($id){
    $product = Product::findOrFail($id);
    return view('dashboard.products.show',compact('product'));

  }


  public function update(Request $req,$id){

    $this->checkProductValidation($req,$id,'update');

    $data = $this->productData($req);
    
    if($req->hasFile('image')){
       //Delete Image
       $old_image = Product::where('id',$id)->value('image');
       fileDelete($old_image);
       
       //Upload Image
      $file_name = fileUpload($req->file('image'));
      $data['image'] = $file_name;
    }

    Product::findOrFail($id)->update($data);
    return redirect()->route('productList')->with('message','Successfully Updated!');
  }


  private function checkProductValidation($req,$id,$method){
    $validationRules=[
      'name' => 'required|unique:products,name,'.$id,
      'description' => 'required',
      'price' => 'required|integer',
      'category' => 'required|integer',
      'waiting_time' => 'nullable',

    ];

    $validationRules['image'] = $method == 'create' ? 'required|mimes:jpg,jpeg,png' : '';
    Validator::make($req->all(),$validationRules
      )->validate();
  }

  private function productData($req){
    return [
      'name' => $req->name,
      'description' => $req->description,
      'category_id' => $req->category,
      'price' => $req->price,
      'waiting_time' => $req->waiting_time,
    ];
  }
}
