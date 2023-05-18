@extends('frontend.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cartData">
                        @foreach ($cartlist as $item)
                            <tr>
                                <td><img src="{{Storage::url('image/'.$item->image)}}" alt="" width="100px" class="img-thumbnail"></td>
                                <td class="align-middle">{{ $item->product_name }}</td>
                                <td class="align-middle" id="price">{{ $item->price }} Kyats</td>
                                <input type="hidden" id="cartId" value="{{ $item->id }}">
                                <input type="hidden" id="product_id" value="{{ $item->product_id }}">
                                <input type="hidden" id="user_id" value="{{ $item->user_id }}">
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            id="qty" value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $item->price * $item->qty }} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $total_price }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">4000</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $total_price + 4000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Order</button>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="cartClearBtn">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@push('custom-js')
    <script>
        $(document).ready(function() {
            $(".btn-plus, .btn-minus").click(function() {
                $parent = $(this).parents("tr");
                $qty = $parent.find('#qty').val();
                $price = $parent.find('#price').text().replace('Kyats', '');

                $total = $qty * $price;
                $parent.find('#total').html($total + " Kyats");

                summaryCal();
                // console.log($price);
                // console.log($qty);
                // if($qty == 0){
                //     $parent.find('.btn-minus').attr('disabled','')
                // }
            })

            //Remove product form cart
            $('.btnRemove').click(function() {
                $parent = $(this).parents("tr");
                $cartId = $parent.find('#cartId').val();
                console.log($cartId);
                $parent.remove();
                summaryCal();
                $.ajax({
                    type: 'get',
                    url: '/cart/remove_product',
                    dataType: 'json',
                    data: {
                        'cartId': $cartId
                    },
                    success: function(response) {
                        console.log(response)

                    }
                })
            })
            //Calculate Summary
            function summaryCal() {
                //Sub Total Price
                $total_price = 0;
                $('#cartData tr').each(function(index, row) {
                    $total_price += Number($(row).find('#total').html().replace('Kyats', ''));
                });
                $('#subTotal').text($total_price)

                //Final Price
                $('#finalPrice').text(`${$total_price + 4000} Kyats`)
            }
        });
    </script>

    {{-- order --}}
    <script>
        $data = [];
         $(document).ready(function() {
            $('#orderBtn').click(function(){
                $('#cartData tr').each(function(index,row){
                    $data.push({
                        'qty' : $(row).find('#qty').val(),
                        'price' : Number($(row).find('#price').html().replace('Kyats','')),
                        'total' : Number($(row).find('#total').html().replace('Kyats','')),
                        'product_id' : $(row).find('#product_id').val(),
                        'user_id' : $(row).find('#user_id').val(),
                    })
                });

                $summary_price = Number($('#finalPrice').html().replace('Kyats',''));

                $.ajax({
                    type: "get",
                    url : "/order/create",
                    dataType: 'json',
                    data : {
                        'order_data' : $data,
                        'summary_price' : $summary_price,
                    },
                    success: function(response){
                        if(response.status == 'success'){
                            console.log(response);
                            window.location.href = "/home_page";
                        }
                        // console.log(response);
                    }
                })



               
            });
         });
    </script>

    {{-- Cart Clear --}}
    <script>
         $('#cartClearBtn').click(function() {
                $parent = $('#cartData tr');
                $parent.remove();
                $('#subTotal').text('0 Kyats')
                //Final Price
                $('#finalPrice').text('3000 Kyats')
                $.ajax({
                    type: 'get',
                    url: '/cart/remove_product',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)

                    }
                })
            })
    </script>
@endpush
