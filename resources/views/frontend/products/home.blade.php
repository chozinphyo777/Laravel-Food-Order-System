{{-- This is Forntend Page
<html>
   
</html> --}}

@extends('frontend.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Category Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

                            <a href="{{ url('home_page'. '?category_id=all') }}" class=" text-muted">
                                <label class="" for="color-1">All Category</label>
                            </a>
                            <span class="badge border font-weight-normal">{{ $products->total() }}</span>
                        </div>
                        <input type="hidden" value="0" id="hiddenCategoryId">
                        @foreach ($categories as $category)
                            <div class="categoryClass custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <a  class="text-muted categoryFilter" >
                                    <input type="hidden" value="{{$category->id}}" id="categoryId">
                                    <label class="" for="color-1" >{{ $category->name }}</label>
                                </a>
                                {{-- <span class="badge border font-weight-normal">150</span> --}}
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Category End -->
                

            </div>
            <!-- Shop Sidebar End -->



            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <select name="" id="sorting" class="custom-select-box">
                                    <option value="">Choose Sorting</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="productListId">
                   @include('frontend.products.data-list')
                </div>

               

            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@push('custom-js')
    <script>
        $(document).ready(function() {
            function fetch_data(page, category_id, sorting_status) {
                console.log("page number " + page + " sorting status " + sorting_status);
                $.ajax({
                    url: "/product-filter?page=" + page +"&category_id="+ category_id+"&sorting_status="+sorting_status,
                    success: function(response) {
                        console.log("Response" +response);
                        $('#productListId').html(response);
                    }
                })
            }

           
            $category_parameter = window.location.search.substring(1);
            $category = $category_parameter.split("=");
            console.log("Category" +$category);

             // sorting
            $('#sorting').change(function() {
                $page = $('#hidden_page').val();
                $categoryId =  $('#hiddenCategoryId').val();
                fetch_data($page, $categoryId,  $('#sorting').val() == 'desc' ? 'desc' : 'asc');
            })

            //Click Pagination
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                $('#hidden_page').val(page);
                $categoryId =  $('#hiddenCategoryId').val();
                console.log("category id is " + $categoryId);
                
                fetch_data(page, $categoryId,  $('#sorting').val() == 'desc' ? 'desc' : 'asc');
                $('li').removeClass('active');
                $(this).parent().addClass('active');
            });

            $('.categoryFilter').click(function(){
                $page = $('#hidden_page').val();
                $parentNode = $(this).parents('.categoryClass');
                 $categoryId = $parentNode.find('#categoryId').val();
               $('#hiddenCategoryId').val($categoryId);
                fetch_data($page, $categoryId,  $('#sorting').val() == 'desc' ? 'desc' : 'asc');
            })
        });
    </script>
@endpush
