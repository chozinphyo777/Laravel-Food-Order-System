@extends('auth.layouts.app')

@section('title', 'Product Detail')

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
                    <div class="col-lg-10 offset-1">
                        <div class="card py-3">
                            <div class="card-body">
                                <a href="{{ route('productList') }}" class=""><i
                                        class="fa-solid fa-arrow-left-long"></i></a>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Product Detail</h3>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-3 offset-md-1">
                                        <img src="{{ Storage::url('image/' . $product->image) }}" alt="John Doe"
                                            class=" img-thumbnail" style="width:200px;height:auto; " />

                                        <div class="text-center pt-3">
                                            <a href="{{ route('productEdit', $product->id) }}" class="btn btn-primary"><i
                                                    class="fa-regular fa-pen-to-square pr-2"></i>Edit Product</a>

                                        </div>
                                    </div>
                                    <div class="col-md-8 ps-md-5">
                                        <div>
                                            <h3 class="my-3"><i class="fa-solid fa-burger pr-2"></i> {{ $product->name }}
                                            </h3>
                                        </div>
                                        <span class="my-3 btn-sm btn-dark"><i class="fas fa-chart-bar pr-2"></i>
                                            {{ $product->category->name }}</span>
                                        <span class="my-3 btn-sm btn-dark"><i
                                                class="fa-solid fa-money-check-dollar pr-2"></i>
                                            {{ $product->price }}</span>
                                        <span class="my-3 btn-sm btn-dark"><i
                                                class="fa-solid fa-clock pr-2"></i>{{ $product->waiting_time }}</span>
                                        <span class="my-3 btn-sm btn-dark"><i
                                                class="fa-regular fa-eye pr-2"></i>{{ $product->view_count }}</span>
                                        <div class="my-3">
                                            {{ $product->description }}
                                        </div>
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
