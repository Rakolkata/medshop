 <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
       <div id="brandlogo">
         <img alt="Image placeholder" class="rounded" src="{{ asset('public/images/fabfinner.png') }}" width="110px" height="78px">     
       </div>


       <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <div class="dropdown-item"></div>
                <i class="ni ni-single-02"></i>&nbsp;&nbsp;&nbsp;
                <span class="mb-0 text-sm ">My profile</span>
              </a>
               
              <div class="dropdown-divider"></div>
            
            </div>
          </li>
        </ul>
      </div>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form>
        <!-- User -->
         <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="{{ asset('public/user/img/theme/team-4-800x800.jpg') }}">
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
                <a href="{{route('register.profile',$user)}}">
                <i class="ni ni-single-02"></i>&nbsp;&nbsp;&nbsp;
                <span class="mb-0 text-sm ">My profile</span>
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
    <div class="header bg-gradient-primary pb-4.5 pt-7 pt-md-4.5">
      <div class="container-fluid">
       
      </div>
    </div>