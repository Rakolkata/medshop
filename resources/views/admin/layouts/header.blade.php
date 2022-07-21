   <!-- Top navbar -->
   <style>
     @media (max-width:1032px) {
        #brandlogo {
            display:block;
            padding-bottom:0px;
        }

    }
   </style>
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
    
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
             
          </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                    <img src="{{ URL::asset('storage/app')}} {{'/'.$user->image}}" class="rounded-circle" alt="">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0"> Welcome ! </h6>
              </div>
              <div class="dropdown-item"></div>
                <a href="{{route('admin.register.profile', ['id' => Auth::user()->id])}}">
                <i class="ni ni-single-02"></i>
                <span> My profile </span>
              </a>
               
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                <i class="ni ni-user-run"></i>
                <span>Logout</span> 
              </a> 
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
  <div class="header bg-gradient-success pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row" style="margin-top:22px;">
           <div class="col-xl-3 col-lg-6">
              
            </div>
             <div class="col-xl-3 col-lg-6">
              
            </div>
            <div class="col-xl-3 col-lg-6">
             
            </div>
            <div class="col-xl-3 col-lg-6">
              
            </div>
          </div>
        </div>
      </div>
    </div>
    