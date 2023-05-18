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
                                    <h2 class="title-1">Order List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                                @if (session('message'))
                                    <div class="alert alert-dismissible fade show text-white my-3 bg-success"
                                        role="alert">
                                        {{ session('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class=" mb-2">
                            <h4 class="d-inline">Total: {{ $orders->total() }}</h4>
                        </div>
                        <div class=" clearfix">
                            <div class=" pull-left">
                                <select id="orderStatus" class="form-select">
                                    <option value="0">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="success">Success</option>
                                    <option value="reject">Reject</option>
                                </select>
                            </div>
                            <div class="pull-right d-flex">
                                <input type="text" name="search" id="search" placeholder=" Search... "
                                    value="{{ request('search') }}" class="text-muted pl-2 ">
                            </div>
                        </div>
                        <div class="table-responsive horizontal-scrollable">
                            <table class="table table-data2" style="color:rgb(240, 230, 230) !important;">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Id</th>
                                        <th>User Name</th>
                                        <th>Total Price</th>
                                        <th>Order Code</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @include('dashboard.orders.data-list')
                                </tbody>
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
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
@push('custom-js')
    <script>
        $(document).ready(function() {
            //Data fetch by page number , order stauts and search
            function fetch_data(page, filter_by, query) {
                console.log("page number" + query);
                $.ajax({
                    url: "orders/pagination/fetch_data?page=" + page + "&filterby=" + filter_by +
                        "&search=" + query,
                    success: function(data) {
                        console.log(data);
                        $('tbody').html('');
                        $('tbody').html(data);
                    }
                })
            }
            //Search
            $(document).on('keyup', '#search', function() {
                var query = $('#search').val();
                var orderStatus = $('#orderStatus').val();
                var page = $('#hidden_page').val();
                fetch_data(page, orderStatus, query);
            });

            //Filter by order status
            $('#orderStatus').change(function() {
                $orderStatus = $('#orderStatus').val();
                $page = 1;
                $query = $('#search').val();
                fetch_data($page, $orderStatus, $query)
            })

            //Click Pagination
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                var orderStatus = $('#orderStatus').val();
                var query = $('#search').val();
                fetch_data(page, orderStatus, query);
                $('li').removeClass('active');
                $(this).parent().addClass('active');
            });

            //Filter by order status without pagination ( not use)
            //  $('#orderStatus').change(function() {
            //     $orderStatus = $('#orderStatus').val();
            //     fetch_data($page, $orderStatus, $query)
            //     $.ajax({
            //         type: 'get',
            //         url: '/orders',
            //         dataType: 'json',
            //         data: {
            //             'orderStatus': $orderStatus
            //         },
            //         success: function(response) {
            //             console.log(response);
            //             $list = '';
            //             for ($i = 0; $i < response.data.length; $i++) {
            //                 $date = new Date(response.data[$i].created_at);
            //                 $months = ["January", "February", "March", "April", "May", "June",
            //                     "July", "August", "September", "October", "November",
            //                     "December"
            //                 ];

            //                 $list += `
        //             <tr class="tr-shadow">
        //                 <td class=" align-middle">${$i+1}</td>
        //                 <td>${response.data[$i].id}</td>
        //                 <td>${response.data[$i].user_name}</td>
        //                 <td>${response.data[$i].total_price}</td>
        //                 <td>${response.data[$i].order_code}</td>
        //                 <td>${$months[$date.getMonth()]+"-"+ $date.getDate()+"-"+$date.getFullYear()}</td>
        //                 <td>
        //                     <select onchange="changeOrderStatus(this, ${response.data[$i].id})">
        //                         <option value="pending" ${ (response.data[$i].status == 'pending') ? 'selected'  : '' }>Pending</option>
        //                         <option value="success" ${ (response.data[$i].status == 'success') ? 'selected'  : '' }>Success</option>
        //                         <option value="reject" ${ (response.data[$i].status == 'reject') ? 'selected'  : '' }>Reject</option>
        //                     </select>
        //                 </td>
        //                 <td>
        //                     <div class="table-data-feature">
        //                        <a href="">
        //                         <button class="item" data-toggle="tooltip" data-placement="top" title="More">
        //                             <i class="zmdi zmdi-more"></i>
        //                         </button>
        //                        </a>
        //                     </div>
        //                 </td>
        //             </tr>
        //             `;
            //             }
            //             $('#dataList').html($list);
            //         }
            //     })
            // })

            //  Change Order Status use class name (not use)
            // $('.changeOrderStatus').change(function(){
            //     $orderStatus = $(this).val();
            //     $parentNode = $(this).parents("tr");
            //     $orderId = $parentNode.find('#orderId').val();
            //     $.ajax({
            //         type:'get',
            //         url: '/orders/changeOrderStatus',
            //         dataType: 'json',
            //         data : {'orderStatus' : $orderStatus , 'orderId' : $orderId},
            //         success: function(response){
            //             console.log(response);
            //         }
            //     })
            // });
        });

        // Change Order Status with function call
        function changeOrderStatus(orderStatus, orderId) {
            console.log(orderStatus.value + " " + orderId);
            $.ajax({
                type: 'get',
                url: '/orders/changeOrderStatus',
                dataType: 'json',
                data: {
                    'orderStatus': orderStatus.value,
                    'orderId': orderId
                },
                success: function(response) {
                    console.log(response);
                }
            })
            // location.reload();
        }
    </script>
@endpush
