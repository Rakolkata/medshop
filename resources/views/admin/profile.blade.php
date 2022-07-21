<!DOCTYPE html>
<html>
 <head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}"> --}}
 <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
 @include('admin/layouts/head')
 <style>
    @media (max-width: 1032px) {
        #brandlogo {
            display: block;
        }
    }
</style>
<meta charset="utf-8">
   <link href="{{asset('public/user/css/head.css?v=1.0.0')}}" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('public/user/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('public/user/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{asset('public/user/css/argon.css?v=1.0.0')}}" rel="stylesheet">
  <script src="{{ asset('public/user/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('public/user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('public/user/js/argon.js?v=1.0.0') }}"></script>
 </head>
<body>
    @include('admin/layouts/leftnavbar')
  <!-- Main content -->
  <div class="main-content">
    @include('admin/layouts/ProfileHeader')
    <!-- Page content -->
      <div class="container-fluid mt--7">
         
         <div class="row" style="padding-top:40px;">
        <div class="col-xl-4 order-xl-2 mb-5 pt-md-9 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                 <a href="#">
                    <img src="{{ URL::asset('storage/app')}} {{'/'.$user->image}}" class="rounded-circle" alt="">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              {{-- <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div> --}}
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    
                  </div>

          
              <form role="form" action="{{ route('admin.image.upload',['id' => Auth::user()->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}                 
                  <div class="row" style="width:300px">
                    <div class="col-8 text-right" style="padding-left:0px;">             
                       <input type="file" name="image" id="image">
                    </div>
                    <div class="col-4 text">
                      {{-- <a href="#!" class="btn btn-larg btn-primary">Update</a> --}}
                     <input type="submit" id="update" name="save" value="update" class="btn btn-success">
                  </div>
                </div>
              </form>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1 pt-md-6" style="padding-left:0px;">
           <form role="form" action="{{ route('admin.profile.update',$user) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-4">
                  <h3 class="mb-0">My account</h3>
               </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label> 
                        <input type="text"id="input-username" class="form-control form-control-alternative" name="user_name" placeholder="Username" value="{{ $user->name }}" readonly>

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label> 
                        <input type="email" class="form-control" id="input-email" class="form-control form-control-alternative" name="email" placeholder="Email" value="{{ $user->email }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Name</label> 
                        <input type="text" class="form-control" id="input-name" class="form-control form-control-alternative" name="name" placeholder="Name" value="{{ $user->name }}">

                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Mobile</label>
                        <input type="text" id="input-mobile" class="form-control form-control-alternative" placeholder="Mobile" name="mobile"  value="{{ $user->mobile }}">
                      </div>
                    </div>
                  </div>
                   
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input-address">Address</label>
                        <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" name="address" value="{{ $user->address }}" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label>State:</label>
                          <select class="form-control form-control-alternative" name="state" id="input-State">
                            <option value="" disabled selected>select state</option>
                        @foreach ($StateList as $row)
            <option value="{{$row->State}}" @if($row->State == $user->state) selected @endif>{{$row->State}} 
                          </option>
                           @endforeach                          

                          </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Pin Code</label>
                        <input type="number" id="Pin Number" class="form-control form-control-alternative" placeholder="Pin Number" name="pincode"value="{{ $user->pincode }}" >
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="form-group" style="padding-left:100px;">
                <input type="submit" id="Save" name="send" value="Save" class="btn btn-success">
              </div>
                  {{-- <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-city">City</label>
                        <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="New York">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Country</label>
                        <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="United States">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-country">Postal code</label>
                        <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">
                      </div>
                    </div>
                  </div> --}}
                </div> 
              </form>
            </div>
          </div>
          </form>
        </div>
         </div>
      </div>
  </div>
</body>

</html>


