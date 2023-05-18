<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $categories,
        ], 200);
    }
    public function createCategory(Request $req)
    {
        $category = Category::create([
            'name' => $req->name,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $category,
        ], 201);
    }

    public function deleteCategory($category_id)
    {
        $category = Category::where('id', $category_id)->first();
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'There is no category!',
            ], 404);
        } 
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $category,
        ], 201);
    }
    public function detailCategory($category_id)
    {
        $category = Category::where('id', $category_id)->first();
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'There is no category!',
            ], 404);
        } 
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $category,
        ], 201);
    }

    public function updateCategory(Request $req, $category_id)
    {
        $category = Category::where('id', $category_id)->first();
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'There is no category!',
            ], 404);
        } 
        $category->update([
            'name' => $req->name,
        ]);
        $category = Category::findOrFail($category->id);
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $category,
        ], 201);
       
    }


}