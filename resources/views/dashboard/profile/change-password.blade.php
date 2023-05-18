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
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <form action="{{ route('changePassword') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="oldPassword" class="control-label mb-1">Old Password</label>
                                        <input id="oldPassword" name="oldPassword" value="{{ old('oldPassword') }}"
                                            type="password"
                                            class="form-control @error('oldPassword') is-invalid @enderror  @if (session('not_match_message')) is-invalid @endif"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Old password...">
                                        @error('oldPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if (session('not_match_message'))
                                            <div class="invalid-feedback">{{ session('not_match_message') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="newPassword" class="control-label mb-1">New Password</label>
                                        <input id="newPassword" name="newPassword" value="{{ old('newPassword') }}"
                                            type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Old password...">
                                        @error('newPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="confirmPassword" class="control-label mb-1">Confirm Password</label>
                                        <input id="confirmPassword" name="confirmPassword"
                                            value="{{ old('confirmPassword') }}" type="password"
                                            class="form-control @error('confirmPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Old password...">
                                        @error('confirmPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Change Password</span>
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
