<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>crm : Digital Enablers for SMEs</title>
  <meta name="keywords" content="Accounting Software">
  <meta name="description" content="Dovetail-crm is a technology-driven  manufacturing company  delivering Billing, Payment &amp; Delivery Solutions for Small &amp; Medium Businesses.This software  is the web version of Accounting Software and  modified version of  Tally application. It extends the feature of tally application and provide flexibility to the user to use either web application for accounting or both tally and web application but data will be synced and will provide flexibility to the user.Start 7 Days Free Trial Now!">
   <!-- Favicon -->
  <link href=""  rel="icon" type="image/svg">
  <!-- Fonts -->
  <link href="{{asset('public/user/css/head.css?v=1.0.0')}}" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('public/user/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('public/user/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('public/user/css/argon.css?v=1.0.0') }}" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
        </a>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-success py-5">
      <div class="container">
        <div class="header-body text-center ">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <img src=""/> 
            </div>
          </div>
        </div>
      </div><br><br>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--7 pb-0">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
           
          <div class="card bg-secondary shadow border-0">
           {{--  <div class="card-header bg-transparent pb-3">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="{{ asset('public/user/img/icons/common/github.svg') }}"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="{{ asset('public/user/img/icons/common/google.svg') }}"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div> --}}
            <div class="card-body px-lg-5 py-lg-5">
              <center><b>Admin Login</b></center><br>
              <div class="text-center text-muted mb-4">
                <small>Sign in with credential</small>
              </div>
             <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login') }}">
               {{ csrf_field() }}

                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div> 
                    <input id="email" type="email" placeholder="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                      @if ($errors->has('email'))
                           <span class="help-block">
                               <strong>{{ $errors->first('email') }}</strong>
                           </span>
                       @endif
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div> 
                    <input id="password" type="password" placeholder="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                           <span class="help-block">
                               <strong>{{ $errors->first('password') }}</strong>
                           </span>
                       @endif
                  </div>
                </div>
               <div class="mainDiv">
                <div style="float:left;">
                <div class="custom-control custom-control-alternative custom-checkbox"> 
                  <input  class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember" {{ old('remember') ? 'checked' :''}}>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span> 
                  </label>
                </div>
                </div>
                  <div style="float:right;">
                        <a href="{{ route('admin.forgotpassword') }}" ><small>Forgot password?</small></a>
                  </div>
              </div><br>
                <div class="text-center"> 
                   <button type="submit" class="btn btn-success my-2">
                          Sign in
                       </button> 
                </div>
              </form>
            </div>
          </div>          
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2022  <a href="#" class="font-weight-bold ml-1" target="_blank">Ray Software Service</a>
          </div>
        </div>
        <div class="col-xl-6">
          <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
               <a href="{{ route('welcome')}}" class="nav-link" target="_blank">Home</a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link" target="_blank">Contact Us</a>
            </li>            
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('public/user/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('public/user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('public/user/js/argon.js?v=1.0.0') }}"></script>
</body>

</html>