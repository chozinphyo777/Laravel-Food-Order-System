<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $req)
    {
        $categories = Category::when( $req->search, function($query){
            $query->where('name','like','%'.request('search').'%');
        })
        ->orderBy('id','desc')  
        ->paginate('2');

        $categories->appends($req->all()); //  $categories->appends(request()->all());
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }
    public function store(Request $req){
       $this->checkValidation($req);
        $data = [
            'name' => $req->categoryName,
        ];
        Category::create($data);
       return redirect()->route('categoryList')->with(['message' => 'Successfully Created!']);
    }

    public function delete($id){
        Category::findOrFail($id)->delete();
        return redirect('categories/')->with(['message'=>'Successfully Deleted!'] );
     }
 
     public function edit($id){
         $category = Category::findOrFail($id);
         return view('dashboard.categories.edit',compact('category'));
     }
    
     public function update(Request $req, $id){
        $this->checkValidation($req);
        Category::findOrFail($id)->update([
            'name' => $req->categoryName,
        ]);
        
        return redirect()->route('categoryList')->with(['message' => 'Successfully Updated!']);
     }

    private function checkValidation($req){
        $validation_rule = [
            'categoryName' => 'required|unique:categories,name,'.$req->categoryId,
        ];
        Validator::make($req->all(), $validation_rule)->validate();
    }

}