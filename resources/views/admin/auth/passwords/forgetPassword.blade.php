<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Medshop</title>
  <meta name="keywords" content="Accounting Software">
  <meta name="description" content="crm is a technology-driven  manufacturing company  delivering Billing, Payment &amp; Delivery Solutions for Small &amp; Medium Businesses.This software  is the web version of Accounting Software and  modified version of  Tally application. It extends the feature of tally application and provide flexibility to the user to use either web application for accounting or both tally and web application but data will be synced and will provide flexibility to the user.Start 7 Days Free Trial Now!">
  <!-- Favicon -->
  <link href="#" rel="icon" type="image/svg">
  <!-- Fonts -->
   <link href="{{asset('public/user/css/head.css?v=1.0.0')}}" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('public/user/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('public/user/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('public/user/css/argon.css?v=1.0.0') }}" rel="stylesheet">
   <script src="{{asset('public/user/js/head.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script src="{{asset('public/user/js/nj.js')}}"></script> 

<script type="text/javascript">  
   function ValidateUserId()
    {   
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
     var id = document.getElementById("admin_id").value; 
        $.ajax({
           type:'POST',
           url:"{{ route('admin.validate.forgotpassword') }}",
           data:{id:id},
           success:function(data){
              if(data.success==true){
                document.getElementById("email").value=data.email; 
              }
           },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
                
        },"json");
               
    }  
    
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}

  
  
</script> 
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="#">
          {{-- <img src="{{ asset('public/user/img/brand/white.png') }} " /> --}}
        </a>
        <!--button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span--->
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.html">
                  <img src="{{ asset('public/user/img/brand/SiteLogo.jpg') }} ">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <!---button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav"---->
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
              <img src="#" /> 
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
         <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forgot Password</div>
   
                <div class="card-body">
                    <form method="POST" action="{{route('admin.update.forgotpassword')}}"> @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="admin_id" class="col-md-4 col-form-label text-md-right"> Id</label>
  
                            <div class="col-md-6">
                                <input  type="text" id="admin_id" class="form-control" name="id" onblur="ValidateUserId()">


                                


                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
  
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" autocomplete="email" required="required">
                            </div>
                            
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
    
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="new-password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"> Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="confirm_password"  type="password" class="form-control" name="new_password" autocomplete="new_password" required="required">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-4">
                                <center><button type="submit" class="btn btn-success btn-sm">
                                    Reset Password
                                </button></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
  </div>
</div>
  <!-- Footer -->
  <footer class="py-3">
    <div class="container">
      <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
          <div class="copyright text-center text-xl-left text-muted">
            &copy; 2022 <a href="#" class="font-weight-bold ml-1" target="_blank">Ray Software Service</a>
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