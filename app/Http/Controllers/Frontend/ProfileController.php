<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editPassword(){
        return view('frontend.profile.edit-password');
    }
    public function editProfile(){
        return view('frontend.profile.edit-profile');
    }
}
