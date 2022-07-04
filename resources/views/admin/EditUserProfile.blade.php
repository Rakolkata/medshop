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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <title>Medshop</title>
  <!-- Fonts -->
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
        <div class="col-xl-12 order-xl-1 " style="padding:30px;">
           <form  method="post" action="{{ route('User.Profile.update') }}"  enctype="multipart/form-data">
            @csrf 
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-4">
                  <h3 class="mb-0">Edit Customer Detail </h3>
               </div>
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">Customer Details</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label> 
                        <input type="text"id="input-username" class=" form-control form-control-alternative" name="user_name" placeholder="Username" value="{{ $user->user_name }}">
                        <input name="id" type="hidden"value="{{ $user->id }}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label> 
                        <input type="email"id="input-email" class="form-control form-control-alternative" name="email" placeholder="Email"  value="{{ $user->email }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Name</label> 
                        <input type="text" class="form-control" id="input-name" class="form-control form-control-alternative" name="name" placeholder="Name"  value="{{ $user->name }}">

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
                <h6 class="heading-small text-muted mb-4">Contact Detail</h6>
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
                            <option value="{{ ($user->state == '') ? '' : '$user->state'  }}" selected>{{ ($user->state == '') ? 'select state' : $user->state }}</option>
                           @foreach ($StateList as $row)
                           <option value="
                            {{$row->State}}">{{$row->State}} 
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
                <div class="col-lg-12 col-sm-6">
                <center><input type="submit" id="Save" name="send" value="Save" class="btn btn-primary"></center>
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
</body>

</html>


