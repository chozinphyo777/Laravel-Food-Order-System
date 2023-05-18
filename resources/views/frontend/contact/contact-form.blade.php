@extends('frontend.layouts.master')
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact
                Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">

                    @if (session('message'))
                        <div class="alert alert-dismissible fade show text-white" role="alert"
                            style="background-color: #63c76a">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('contactStore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="control-group pb-3">
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                                placeholder="Your Name" data-validation-required-message="Please enter your name" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="control-group pb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email"
                                data-validation-required-message="Please enter your email" />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="control-group pb-3">
                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                data-validation-required-message="Please enter a subject" />
                        </div>
                        <div class="control-group pb-3">
                            <textarea class="form-control" rows="8" name="message" placeholder="Message"
                                data-validation-required-message="Please enter your message"></textarea>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-lg-5 mb-5">

                <div class="bg-light p-30 mb-3">
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
