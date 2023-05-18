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
                                    <h2 class="title-1">Category List Page</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <a href="{{ route('categoryCreate') }}">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        <i class="zmdi zmdi-plus"></i>add item
                                    </button>
                                </a>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('categoryList') }}" method="get">
                                <div class="input-group mb-3 align-item-end">
                                    <input type="text" name="search" id="" placeholder=" Search... "
                                        value="{{ request('search') }}" class="text-muted pl-2 ">
                                    <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 offset-md-8">
                            @if (session('message'))
                                <div class="alert alert-dismissible fade show text-white" role="alert"
                                    style="background-color: #63c76a">
                                    {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive table-responsive-data2">
                            @if (count($categories) != 0)
                                <table class="table table-data2 " style="color:rgb(240, 230, 230) !important;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Created Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $key=>$category)
                                            <tr class="tr-shadow">
                                                <td class="align-middle">{{ ++$key }}</td>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->created_at ? $category->created_at->format('j-M-Y') : '' }}
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                        <a href="{{ route('categoryEdit', $category->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('categoryDelete', $category->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center">
                                    <h3>There is no category</h3>
                                </div>
                            @endif
                        </div>
                        <div>
                            {{ $categories->links() }}
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
