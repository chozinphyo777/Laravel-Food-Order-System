@extends('frontend.layouts.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5" style="height: 500px">
            <div class="col-lg-8 offset-lg-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cartData">
                        @foreach ($orders as $item)
                            <tr>
                                <td class="align-middle">{{ $item->created_at->format('F-j-Y') }}</td>
                                <td class="align-middle" >{{ $item->order_code }} </td>
                                <td class="align-middle" >{{ $item->total_price }} Kyats</td>
                                <td class="align-middle @if($item->status == 'pending') text-warning @elseif($item->status == 'success') text-success @else text-danger @endif" >
                                    {{ $item->status }} 
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="mt-4">
                    {{$orders->links()}}
                </div>
            </div>
            
        </div>
    </div>
    <!-- Cart End -->
@endsection
@push('custom-js')
    {{-- <script>
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
    </script> --}}

    {{-- order --}}
    {{-- <script>
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
    </script> --}}
@endpush
