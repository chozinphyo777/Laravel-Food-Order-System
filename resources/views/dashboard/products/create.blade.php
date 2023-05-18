@extends('auth.layouts.app')
@section('title', 'Create Products')

@section('content')
    @include('dashboard.layouts.sidebar')
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        @include('dashboard.layouts.header')
        <!-- HEADER DESKTOP-->
        <!-- MAIN CONTENT-->
        <div class="main-content ">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-9">
                            <a href="{{ url('products/') }}"><button class="btn bg-dark text-white my-3">List</button></a>

                        </div>
                    </div>
                    <div class="col-lg-8 offset-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Products Create</h3>
                                </div>
                                <form action="{{ route('productStore') }}" method="post" novalidate="novalidate"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" name="name" value="{{ old('name') }}" type="text"
                                            class="form-control @error('name') is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="Enter Category Name...">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="category" class="control-label mb-1">Category</label>
                                        <select name="category" id=""
                                            class=" form-select @error('category') is-invalid @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (old('category') == $category->id) selected @endif>{{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="control-label mb-1">Description</label>
                                        <textarea name="description" id="" cols="30" rows="10" placeholder="Enter Description"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="control-label mb-1">Image</label>
                                        <input id="image" type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" aria-required="true"
                                            aria-invalid="false">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" name="price" value="{{ old('price') }}" type="text"
                                            class="form-control @error('price') is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="Enter price...">
                                        @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="waiting_time" class="control-label mb-1">Waiting Time</label>
                                        <input id="waiting_time" name="waiting_time" value="{{ old('waiting_time') }}"
                                            type="text" class="form-control @error('waiting_time') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter waiting time...">
                                        @error('waiting_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                            <span id="payment-button-amount">Create</span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
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
