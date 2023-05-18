@extends('auth.layouts.app')

@section('title', 'profile')

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
                    <div class="col-lg-8 offset-2">
                        <div class="card py-3">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Profile</h3>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4 offset-md-1">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('dashboard/images/default-user.jpeg') }}" alt="John Doe"
                                                class="rounded-circle" />
                                        @else
                                            <img src="{{ Storage::url('profile/' . Auth::user()->image) }}" alt="John Doe"
                                                class=" rounded-circle" style="width:200px;height:auto; " />
                                        @endif
                                        <div class="text-center pt-3">
                                            <a href="{{ route('editProfile') }}" class="btn btn-primary"><i
                                                    class="fa-regular fa-pen-to-square pr-2"></i>Edit profile</a>

                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-1">
                                        <p class="my-3 text-dark"><i class="fa-solid fa-user pr-2"></i>
                                            {{ Auth::user()->name }}</p>
                                        <p class="my-3 text-dark"><i class="fa-solid fa-envelope pr-2"></i>
                                            {{ Auth::user()->email }}</p>
                                        @if (Auth::user()->gender != null)
                                            <p class="my-3 text-dark"><i class="fa-solid fa-circle-user pr-2"></i>
                                                {{ ucfirst(Auth::user()->gender) }}</p>
                                        @endif
                                        <p class="my-3 text-dark"><i
                                                class="fa-solid fa-phone-volume pr-2"></i>{{ Auth::user()->phone }}</p>
                                        <p class="my-3 text-dark"><i
                                                class="fa-solid fa-circle-user pr-2"></i>{{ Auth::user()->role }}</p>
                                        <p class="my-3 text-dark"><i
                                                class="fa-solid fa-location-arrow pr-2"></i>{{ Auth::user()->address }}</p>
                                    </div>
                                </div>

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
