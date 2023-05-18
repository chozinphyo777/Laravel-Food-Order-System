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
                                    <h2 class="title-1">Order Detail</h2>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div><a href="{{ route('orderList') }}" class="text-dark mb-2"><i
                                        class="fa-solid fa-arrow-left-long"></i> Back</a></div>
                            <div class="align-item-start">
                                <h4>Total: {{ $order_items->count() }}</h4>
                            </div>
                        </div>

                        <div>
                            <div class="card col-md-6">
                                <div class="card-body">
                                    <div class="pb-3">
                                        <h3><i class="fa-solid fa-circle-info pr-2"></i>Order Info</h3>
                                        <span class=" text-warning"><i
                                                class="fa-solid fa-triangle-exclamation pr-2"></i>Include delivery
                                            charge</span>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-5"><i class="fa-solid fa-user pr-2"></i> Name</div>
                                        <div class="col">{{ $order->user->name }}</div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-5"><i class="fa-solid fa-barcode pr-2"></i> Order Code</div>
                                        <div class="col">{{ $order_items[0]->order_code }}</div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-5"><i class="fa-solid fa-calendar pr-2"></i> Order Date</div>
                                        <div class="col">{{ $order_items[0]->created_at->format('F-d-Y') }}</div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-5"><i class="fa-solid fa-money-check-dollar pr-2"></i> Total</div>
                                        <div class="col">{{ $order->total_price }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive horizontal-scrollable">
                            <table class="table table-data2" style="color:rgb(240, 230, 230) !important;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id</th>
                                        <th>Order Code</th>
                                        <th>image</th>
                                        <th>Name</th>
                                        <th>price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_items as $key => $item)
                                        <tr class="tr-shadow">
                                            <td class=" align-middle">{{ ++$key }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->order_code }}</td>
                                            <td class="col-2"><img src="{{ Storage::url('image/' . $item->image) }}"
                                                    alt=""></td>
                                            <td class="">{{ $item->product_name }}</td>
                                            <td class="">{{ $item->price }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->total }}</td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                    <tr class="spacer"></tr>
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
