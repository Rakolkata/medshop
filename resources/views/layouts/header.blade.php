
<div class="site-navbar py-2 bg-light">
    <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="{{ route('welcome') }}" class="js-logo-clone"><strong class="text-primary">MEDI</strong>SHOP</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active"><a href="{{ route('welcome') }}">Home</a></li>
                <li><a href="{{ route('shop') }}">Products</a></li>
                <!--li class="has-children">
                  <a href="#">Products</a>
                  <ul class="dropdown">
                    <li><a href="#">Supplements</a></li>
                    <li class="has-children">
                      <a href="#">Vitamins</a>
                      <ul class="dropdown">
                        <li><a href="#">Supplements</a></li>
                        <li><a href="#">Vitamins</a></li>
                        <li><a href="#">Diet &amp; Nutrition</a></li>
                        <li><a href="#">Tea &amp; Coffee</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Diet &amp; Nutrition</a></li>
                    <li><a href="#">Tea &amp; Coffee</a></li>
                    
                  </ul>
                </li--->
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#"class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Sign Up</a>
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none">
              <span class="icon-menu"></span></a>&nbsp;&nbsp;
              @auth
                   <div class="dropdown">
                <a href="#" class="icons-btn d-inline-block bag" data-toggle="dropdown">
                    <span class="icon-shopping-bag"></span>
                    <span class="number">{{ session()->get('cartcount') }}</span>
                </a>
                <div class="dropdown-menu">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ session()->get('cartcount') }}</span>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">{{ session()->get('totalCartprice') }}</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('user.cart') }}" class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
              @else
          @endauth
           
          </div>
        </div>
  </div>
</div>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">SIGN UP</h4>
        </div>
        <div class="modal-body">
        
          <div>
              <form method="POST" action="{{ route('register_create') }}">
                        @csrf
                          <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"> Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>

                            </div>
                        </div>

                 <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">Mobile</label>

                            <div class="col-md-6">
                                <input id="mobile" type="mobile" class="form-control" name="mobile"  required>

                           </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"  required>
                           </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit"  name="send" value="Submit" class="btn btn-primary">Register
                                 </button>
                            </div>
                        </div>
                    </form>
          </div>

        </div>
      </div>
      
    </div>
  </div>




