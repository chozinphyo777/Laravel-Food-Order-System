@extends('auth.layouts.app')

@include('dashboard.layouts.sidebar')
<!-- PAGE CONTAINER-->
<div class="page-container">
    <!-- HEADER DESKTOP-->
    @include('dashboard.layouts.header')
    <!-- HEADER DESKTOP-->

   @yield('main_content')
   
</div>
 <!-- END PAGE CONTAINER-->
    
