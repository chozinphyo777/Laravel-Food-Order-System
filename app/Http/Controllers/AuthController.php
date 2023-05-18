<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function registerPage(){
        return view('auth.register');
    }
    
    public function home(){
        if( Auth::user()->role == 'admin'){
            return redirect()->route('productList');
        }
        return redirect()->route('fontendHomePage');
    }

    public function changePasswordPage(){
        return view('dashboard.profile.change-password');
    }

    public function changePassword(Request $req){
       $this->checkPasswordValidation($req);
       if(Hash::check($req->oldPassword,Auth::user()->password)){
         Auth::user()->update([
            'password' => Hash::make($req->newPassword),
         ]);
         Auth::logout();
         return redirect()->route('login');
       }
       return redirect()->back()->with(['not_match_message'=>'Old Password doesn\'t match! Please Try again' ]);
    }

    public function showProfile(){
        return view('dashboard.profile.show-profile');
    }

    public function editProfile(){
      return view('dashboard.profile.edit-profile');
    }
    public function updateProfile(Request $req){
        $this->checkUpdateProfileValidation($req);

        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'role' => $req->role,
            'gender' => $req->gender
        ];
        if($req->hasFile('image')){
            //Delete old image from storage
            Storage::delete('public/profile/'.Auth::user()->image);

            $file_name = uniqid().'_'.$req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/profile',$file_name);
            $data['image'] = $file_name;
        }
       
        Auth::user()->update($data);
        return redirect('home');
    }
    private function checkPasswordValidation($req){
       Validator::make($req->all(),[
        'oldPassword' => 'required',
        'newPassword' => 'required|min:8',
        'confirmPassword' => 'required|same:newPassword',
       ])->validate();
    }

    private function checkUpdateProfileValidation($req){
        Validator::make($req->all(),
        [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'address' => 'required',
            'role' => 'required',
            'phone' => 'required',
            'gender' => 'nullable',
            'image' => 'mimes:jpg,jpeg,png,webp',
        ])->validate();
    }
}
