<style type="text/css">
 .active{
 background-color:#b3ccff;
}
</style>

<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid sidenav">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="{{ route('home') }}">
        <img src="#" class="navbar-brand-img" alt="..." style="padding-bottom:0px;">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none"  role="menu" aria-labelledby="menu1">
        <li class="nav-item dropdown current-menu-item" role="presentation">
          <a class="nav-link nav-link-icon" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menuitem" tabindex="-1">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
              <img src="#" class="rounded-circle" alt="" onerror=this.src="">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <!---a href="#" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a---> 
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main" style="padding-bottom:20px;" >
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="../index.html">
                <img src="#">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav" role="menu" aria-labelledby="menu1">
          
          <li class="nav-item {{ 'admin/user' == request()->path() ? 'active' : '' }}">
           <a class="nav-link" href="{{route('user.create')}}">
              <i class="fa fa-th-list text-blue" ></i>Add Customer
            </a>
          </li>
           <li class="nav-item {{ 'admin/product' == request()->path() ? 'active' : '' }}">
           <a class="nav-link" href="{{route('product.create')}}">
              <i class="fa fa-th-list text-blue" ></i>Add Product
            </a>
          </li>
          <li class="nav-item {{ 'admin/order' == request()->path() ? 'active' : '' }}">
           <a class="nav-link" href="{{route('order.create')}}">
              <i class="fa fa-th-list text-blue"></i>Order Details
            </a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
  