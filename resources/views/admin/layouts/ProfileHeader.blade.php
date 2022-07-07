 <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main" p>
      <div class="container-fluid">
        <!-- Brand -->
 
       <div id="brandlogo">
       <a href="javascript:void(0);" class="select_button1" style="padding-left:20px;"> <img   alt="Image placeholder" id ="logo" class="rounded" src="{{ asset('public/images/img.webp') }}" width="80px;" height="50px;">     
</a> 



       <select id="cus_company" class="select1"  style="display:none" ></select>
       
        </div>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          
        </form>
        <!-- User -->
       <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                 <img src="#" class="rounded-circle" alt="" onerror=this.src="#" >
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->name}}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <div class="dropdown-item"></div>
                <a href="#">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
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
    <div class="header bg-gradient-success pb-4.5 pt-6 pt-md-4.5">
      <div class="container-fluid">
       
      </div>
    </div>