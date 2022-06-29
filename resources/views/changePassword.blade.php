<!DOCTYPE html>
<html>
 <head>
 @include('user/layouts/head')
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('public/user/css/tbl1.css?v=1.0.0')}}">
  <script src="{{asset('public/user/js/head.js')}}"></script>
  <script src="{{asset('public/user/js/tbl2.js')}}"></script>
  <script src="{{asset('public/user/js/tbl3.js')}}"></script>  
 </head>
<body>
    @include('user/layouts/leftnev_bar')
  <!-- Main content -->
  <div class="main-content">
    @include('user/layouts/ProfileHeader')
    <br/><br/><br/><br/>
      <div class="container">
        <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password</div>
   
                <div class="card-body">
                    <form method="POST" action="{{ route('password.reset') }}"> @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
