@extends('auth.layouts.app')
@section('title', 'users')

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
                                    <h2 class="title-1">Users</h2>

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
                        <div>
                            <div class="align-item-start pb-3"><h4>Total: {{$users->total()}}</h4></div>
                            <form action="{{route("userList")}}" class="d-flex justify-content-between">
                                <select class="form-select d-inline col-3" aria-label="Choose Role" onchange="this.form.submit()" name="role" id="role">
                                    <option value="0">All</option>
                                    <option value="admin" @if (request('role') == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if (request('user') == 'user') selected @endif>User</option>
                                </select>
                                {{-- <div class="input-group mb-3 align-item-end d-inline"> --}}
                                    <input type="text" name="search" id="" placeholder=" Search... "
                                        value="{{ request('search') }}" class="text-muted pl-2 mb-3">
                                {{-- </div> --}}
                            </form>
                        </div>
                        <div class="col-md-4 offset-md-8">
                            @if(session('message'))
                                <div class="alert alert-dismissible fade show text-white" role="alert"
                                    style="background-color: #63c76a">
                                    {{ session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive ">
                            @if (count($users) != 0)
                                <table class="table table-data2 " style="color:rgb(240, 230, 230) !important;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th>Role</th>
                                            <th>Created Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $key=>$user)
                                            <tr class="tr-shadow">
                                                <td class="align-middle">{{ ++$key }}</td>
                                                <td>{{ $user->id }}</td>
                                                <input type="hidden" id="userId" value="{{ $user->id }}">
                                                <td>{{ $user->name }}</td>

                                                @if ($user->image != null)
                                                    <td class="col-1"><img
                                                            src="{{ Storage::url('profile/' . $user->image) }}"
                                                            alt=""> </td>
                                                @else
                                                    <td><img src="{{ asset('dashboard/images/default-user.png') }}"
                                                            alt=""> </td>
                                                @endif


                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->gender }}</td>
                                                <td>
                                                    <select class="changeRole">
                                                        <option value="admin"
                                                            @if ($user->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user"
                                                            @if ($user->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </td>
                                                <td>{{ $user->created_at->format('j-M-Y') }}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        @if (Auth::user()->id != $user->id)
                                                            <a href="{{ route('editChangeRole', $user->id) }}"
                                                                class="pr-2">
                                                                <button class="item" data-toggle="tooltip"
                                                                    data-placement="top" title="Change Role">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('deleteUser', $user->id) }}"
                                                                class="pr-2">
                                                                <button class="item" data-toggle="tooltip"
                                                                    data-placement="top" title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </a>
                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center">
                                    <h3>There is no user</h3>
                                </div>
                            @endif
                        </div>
                        <div>
                            {{ $users->appends(request()->query())->links()}}
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    </div>
@endsection

@push('custom-js')
    <script>
        $(document).ready(function() {
            $('.changeRole').change(function() {
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find("#userId").val();
                $role = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '/users/change-role',
                    dataType: 'json',
                    data: {
                        'role': $role,
                        'userId': $userId,
                    },
                    success: function(response) {
                        console.log(response);
                    }

                })
                location.reload();

            });

    </script>
   
@endpush
