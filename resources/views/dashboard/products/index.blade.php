@extends('auth.layouts.app')
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
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Product List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{url('products/create')}}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>add item
                                    </button>  
                                </a>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>  
                                @if(session('message'))
                                <div class="alert alert-dismissible fade show text-white my-3 bg-success" role="alert" >
                                {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="align-item-start"><h4>Total: {{$products->total()}}</h4></div>
                            <form action="{{route('productList')}}" method="get">
                            <div class="input-group mb-3 ">
                                <input type="text" name="search" id="" placeholder=" Search... " value="{{request('search')}}" class="text-muted pl-2 ">
                                <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                            </form>
                        </div>
                        <div class="table-responsive horizontal-scrollable" >
                            <table class="table table-data2" style="color:rgb(240, 230, 230) !important;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id</th>
                                        <th>name</th>
                                        <th>image</th>
                                        <th>Category</th>
                                        <th>price</th>
                                        {{-- <th>description</th> --}}
                                        <th>waiting time</th>
                                        <th>view count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $key=>$product)
                                <tr class="tr-shadow">
                                    <td class=" align-middle">{{++$key}}</td>
                                    <td>{{$product->id}}</td>
                                    <td class="">{{$product->name}}</td>
                                    <td class="col-md-2"><img src="{{Storage::url('image/'.$product->image) }}" alt=""></td>
                                    {{-- <td class="">{{$product->category->name}}</td> --}}
                                    <td class="">{{$product->category_name}}</td>
                                    <td>{{$product->price}}</td>
                                    {{-- <td class="">{{$product->description}}</td> --}}
                                    <td>{{$product->waiting_time}}</td>
                                    <td>{{$product->view_count}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{route('productEdit', $product->id)}}" class="pr-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('productDelete', $product->id)}}" class="pr-2">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        <a href="{{route('productDetail',$product->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                <i class="zmdi zmdi-more"></i>
                                            </button>
                                        </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                                @endforeach
                                    <tr class="spacer"></tr>
                                    <div class="my-2"> {{ $products->appends(request()->query())->links()}}</div>
                                </tbody>
                            </table>
                        
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->
@endsection