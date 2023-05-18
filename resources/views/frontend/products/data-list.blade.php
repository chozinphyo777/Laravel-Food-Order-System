{{-- @if (count($products) != 0) --}}
@foreach ($products as $product)
    <div class="col-lg-4 col-md-4 col-sm-6 pb-1">
        <div class="product-item bg-light mb-4">
            <div class="product-img position-relative overflow-hidden">
                <img class="img-fluid w-100" src="{{ Storage::url('image/' . $product->image) }}"
                    alt="">
                <div class="product-action">
                    <a class="btn btn-outline-dark btn-square" href=""><i
                            class="fa fa-shopping-cart"></i></a>
                    <a class="btn btn-outline-dark btn-square"
                        href="{{ route('frontendProductDetail', $product->id) }}"><i
                            class="fa-solid fa-circle-info"></i></a>
                </div>
            </div>
            <div class="text-center py-4">
                <a class="h6 text-decoration-none text-truncate"
                    href="">{{ $product->name }}</a>
                <div class="d-flex align-items-center justify-content-center mt-2">
                    <h5>20000 kyats</h5>
                    <h6 class="text-muted ml-2"><del>{{ $product->price }}</del></h6>
                </div>
                <div class="d-flex align-items-center justify-content-center mb-1">
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                    <small class="fa fa-star text-primary mr-1"></small>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- @else
<div style=" text-align:center" class="h2 text-muted col-md-6 offset-md-3">There is no product
</div>
@endif --}}
<div class="row col-md-12">
    {{ $products->links() }}
</div>