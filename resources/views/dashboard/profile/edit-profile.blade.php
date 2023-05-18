@extends('auth.layouts.app')
@section('title', 'Update prifile')

@section('content')
    @include('dashboard.layouts.sidebar')
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        @include('dashboard.layouts.header')
        <!-- HEADER DESKTOP-->
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card py-3">
                            <div class="card-body">
                                {{-- <div class="card-title">
                                <h3 class="text-center title-2">Update Profile</h3>
                            </div> --}}
                                <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-4">
                                        <div class="col-md-5 text-center">
                                            @if (Auth::user()->image == null)
                                                <img src="{{ asset('dashboard/images/default-user.jpeg') }}" alt="John Doe"
                                                    class="rounded-circle w-50" />
                                            @else
                                                <img src="{{ Storage::url('profile/' . Auth::user()->image) }}" alt="John Doe"
                                                    class="rounded-circle" style="width:200px;height:auto; " />
                                            @endif
                                            <div class="col-md-8 mx-auto pt-4">
                                                <input type="file" name="image" id="" class="text-center">
                                                @error('image')
                                                    <small><span class="text-danger">{{ $message }}</span></small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group row">
                                                <label for="name" class="col-sm-2 col-form-label text-dark">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ Auth::user()->name }}" type="text" class="form-control"
                                                        placeholder="Enter name">
                                                    @error('name')
                                                        <small><span class="text-danger">{{ $message }}</span></small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="email"
                                                    class="col-sm-2 col-form-label text-dark">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="email" id="email"
                                                        value="{{ Auth::user()->email }}" type="text"
                                                        class="form-control" placeholder="Enter email">
                                                    @error('email')
                                                        <small><span class="text-danger">{{ $message }}</span></small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone"
                                                    class="col-sm-2 col-form-label text-dark">Phone</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="phone" id="phone"
                                                        value="{{ Auth::user()->phone }}" type="text"
                                                        class="form-control" placeholder="Enter phone">
                                                    @error('phone')
                                                        <small><span class="text-danger">{{ $message }}</span></small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="role" class="col-sm-2 col-form-label text-dark">Role</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="role" id="role"
                                                        value="{{ Auth::user()->role }}" type="text"
                                                        class="form-control" placeholder="Enter role" readonly>
                                                    @error('role')
                                                        <small><span class="text-danger">{{ $message }}</span></small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="gender"
                                                    class="col-sm-2 col-form-label text-dark">Gender</label>
                                                <div class="col-sm-10">
                                                    <select name="gender" id="" class="form-select">
                                                        <option value="">Choose</option>
                                                        <option value="male"
                                                            {{ old('gender', Auth::user()->gender) == 'male' ? 'selected' : '' }}>
                                                            Male</option>
                                                        <option value="female"
                                                            {{ old('gender', Auth::user()->gender) == 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="address"
                                                    class="col-sm-2 col-form-label text-dark">Address</label>
                                                <div class="col-sm-10">
                                                    <textarea name="address" id="" cols="20" rows="10" class="form-control" placeholder="Enter address">{{ Auth::user()->address }}</textarea>
                                                    @error('address')
                                                        <small><span class="text-danger">{{ $message }}</span></small>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="text-end pt-3">
                                                <button class="btn btn-primary px-5"><i
                                                        class="fa-solid fa-pen-to-square pr-2"></i>Update profile</button>

                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->

@endsection
