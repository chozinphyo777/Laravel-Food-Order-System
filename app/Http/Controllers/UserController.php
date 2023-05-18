<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $req){
       $users = User::
       when(request('role'),function ($query){
        $query->where('role',request('role'));
       })
       ->when(request('search'),function ($query){
        $query->where('name','like','%'.request('search').'%')
        ->orWhere('email','like','%'.request('search').'%')
        ->orWhere('phone','like','%'.request('search').'%')
        ->orWhere('address','like','%'.request('search').'%');
       })
       ->paginate(3);
        return view('dashboard.users.index',compact('users'));
    }

    public function changeRoleUsingAjax(Request $req)
    {
       $user = User::findOrFail($req->userId);
       $user->update([
        'role' => $req->role
       ]);
       return response()->json([
        'message' => 'success',
       ],200);

    }

    public function editChangeRole($id){
        $user = User::findOrFail($id);
        return view('dashboard.users.edit-change-role',compact('user'));
    }
    public function updateChangeRole(Request $req ,$id){
        User::findOrFail($id)->update([
            'role' => $req->role,
        ]);

        return redirect()->route('userList')->with('message',"Successfully Updated!");
    }

    public function delete($id)
    {
       $user = User::findOrFail($id);
       $user->delete();
       return redirect()->route('userList')->with('message','Successfully Deleted!');

    }

}
