 <!-- MENU SIDEBAR-->
 <aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('dashboard/images/icon/logo.png')}}" alt="Cool Admin" />
        </a>
     
    </div>
   
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="index.html">
                        <i class="fas fa-tachometer-alt pr-2"></i>Home Page
                    </a>
                </li>
                <li>
                    <a href="{{url('products')}}">
                        <i class="fa-solid fa-burger pr-2"></i>Product</a>
                </li>
                <li>
                    <a href="{{url('categories')}}">
                        <i class="fas fa-chart-bar pr-2"></i>Category</a>
                </li>

                <li>
                    <a href="{{url('users')}}">
                        <i class="fas fa-users pr-2"></i>User</a>
                </li>
                <li>
                    <a href="{{url('orders')}}">
                        <i class="fa-solid fa-burger pr-2"></i>Order</a>
                </li>
                <li>
                    <a href="{{url('contact')}}">
                        <i class="fa-solid fa-file-signature pr-2"></i>Contact
                    </a>
                </li>
            </ul>
           
        </nav>
       
    </div> 
</aside> 
<!-- END MENU SIDEBAR-->