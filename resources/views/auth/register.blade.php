@extends('auth.layouts.app')
@section('title','Register')
@section('content')
<div class="page-content--bge5">
    <div class="container">
        <div class="login-wrap">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                        <img src="{{asset('dashboard/images/icon/logo.png')}}" alt="CoolAdmin">
                    </a>
                </div>
            <div class="login-form">
                <form action="{{route('register')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input class="au-input au-input--full" type="number" name="phone" placeholder="Phone">
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
                        @error('address')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="" class="form-select">
                            <option value="">Choose</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female"  {{ old('gender') == 'female' ? 'selected' : '' }} >Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
                    </div>
                    
                    <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
                    
                </form>
                <div class="register-link">
                    <p>
                        Already have account?
                        <a href="{{ route('loginPage')}}">Sign In</a>
                    </p>
                </div>
            </div>  
            </div>
        </div>
    </div>
</div>
@endsection
