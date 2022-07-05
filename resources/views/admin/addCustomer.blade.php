<!DOCTYPE html>
<html>
 <head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}"> --}}
 <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
 <script src="{{ asset('public/js/custom.js')}}"></script>
 @include('admin/layouts/head')
  @include('admin/layouts/masterhead')
</head>
<body>
     @include('admin/layouts/leftnavbar')
  <!-- Main content -->
  <div class="main-content">
    
    @include('admin/layouts/ProfileHeader')
    <!-- Page content -->
      <div class="container-fluid mt--7">
         
      <div class="row" style="padding-top:110px;">
       <div class="col">
          <div class="card shadow">
              
            <div class="card-header border-0">
              <div class="row" id="demo">
                 <div class="col-md-12">
                  <div class="container">
                    <form method="post" id="updaterecord" action="{{ route('user.store') }}">
                      @csrf
                       <h4 style="text-align:center;color:#000033;">Add Customer</h4>
                   <div class="row jumbotron"style="padding:5px">
                   <input type="hidden" name="id"  id="id" value="">
                   <div class="col-sm-4">                                          <label for="name">Name<span style="color:red;">*</span></label>
                     <input  type="text"  id="name" onkeyup="checkletter(this)"  class="typeahead  form-control form-control"  name="name" required placeholder="Enter customer name">
                   </div>
                   <div class="col-sm-4">
                     <label for="user_id">Customer id<span style="color:red;">*</span></label>
                     <input  type="text"  id="user_id"  class="typeahead  form-control form-control"  name="user_id" required placeholder="Enter Customer id">
                   </div>
                  <div class="col-sm-4">
                   <label for="user_name">User name<span style="color:red;">*</span></label>
                     <input  type="text"  id="user_name"  class="typeahead  form-control form-control"  name="user_name" required placeholder="Enter User name">
                      
                  </div>
                  <div class="col-sm-4" id="password1">
                   <label for="password">Password<span style="color:red;">*</span></label>
                     <input  type="password"  id="password"  class="typeahead  form-control form-control"  name="password" required placeholder="Enter password">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="mobile">Mobile</label>
                     <input  type="number"  id="mobile"  class="typeahead  form-control form-control" pattern="[1-9]{1}[0-9]{9}" name="mobile" placeholder="Enter mobile number">
                  </div>
                  <div class="col-sm-4">
                   <label for="email">Email</label>
                     <input  type="email"  id="email"  class="typeahead  form-control form-control"  name="email"  placeholder="Enter Email">
                  </div>
                  <div class="col-sm-4">
                   <label for="alternate_email"> Alternate email</label>
                     <input  type="email"  id="alternate_email"  class="typeahead  form-control form-control"  name="alternate_email"  placeholder="Enter  Alternate Email">
                  </div>
                  <div class="col-sm-4">
                      <label for="address">Address</label>
                      <input type="text" id="address" class="form-control" name="address" placeholder="Enter address">
                  </div>
                  <div class="col-sm-4">
                      <label for="country">Country</label>
                      <input type="text" id="country" class="form-control" name="country" placeholder="Enter country">
                  </div> 
                  <div class="col-sm-4">
                      <label for="state">state</label>
                      <input type="text" id="state" class="form-control" name="state" placeholder="Enter state">
                  </div>
                  <div class="col-sm-4">
                      <label for="pincode">pincode</label>
                      <input type="number" id="pincode" class="form-control" name="pincode" placeholder="Enter pincode">
                  </div>
                  <div class="col-sm-4" id="image1">
                      <label for="image">image</label>
                      <input type="file" id="image" class="form-control" name="image" placeholder="Add image">
                  </div>
                  <div  class="col-sm-2 form-inline" style="padding-top:30px;">
                       <div class="row">
                      <div class="col-sm-2">
                       <button type="submit"name="send" id="submitbtn" value="Submit" class="btn btn-primary btn-sm">Save</button>
                      </div>
                      <div class="col-sm-4-half">
                       <a id="Update"  class="btn btn-danger btn btn-sm ">Update</a>
                       </div>
                       <div class="col-sm-4">
                       <a id="cancel" href="{{ route('user.create') }}" class="btn btn-success btn-sm">Cancel</a>
                       </div>
                       </div>
                     </div>
                  </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive container">
  <h4 class="mb-0">Customer List</h4>
    <table class="table table-bordered" id="datatable">
      <thead>
        <tr>
          <th scope="col">SL.No.</th>
          <th scope="col">Name</th>
          <th scope="col">User id</th>
          <th scope="col">User name</th> 
          <th scope="col">email</th>
          <th scope="col">mobile</th>
          <th scope="col">address</th>
          <th scope="col">country</th>
          <th scope="col">state</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
    </table>
</div>
</div>

</body>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> 
<script>
    $(function() {
    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('user.show') !!}',
        columns: [
            
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'name', name: 'name' },
            { data: 'user_id', name: 'user_id' },
            { data: 'user_name', name: 'user_name' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { data: 'address', name: 'address' },
            { data: 'country', name: 'country' },
            { data: 'state', name: 'state'},
            { data: 'action', name: 'action' }

        ]
    });
});

</script>
<script>  
   function myfunction(item)
    {  
        document.getElementById('submitbtn').style.visibility = 'hidden';
        document.getElementById('image1').style.visibility = 'hidden';
        document.getElementById('Update').style.visibility = 'visible';
        document.getElementById('cancel').style.visibility = 'visible';
      
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
     
        $.ajax({
           type:'POST',
           url:"{{ route('user.edit') }}",
           data:{item:item},
           success:function(data){
           var item =JSON.parse(data);
             document.getElementById("id").value=item["id"];
             document.getElementById("name").value=item["name"];
             document.getElementById("user_id").value=item["user_id"];
             document.getElementById("user_name").value=item["user_name"];
             document.getElementById("mobile").value=item["mobile"];
             document.getElementById("email").value=item["email"];
             document.getElementById("alternate_email").value=item["alternate_email"];
             document.getElementById("address").value=item["address"];
             document.getElementById("country").value=item["country"];
             document.getElementById("state").value=item["state"];
             document.getElementById("pincode").value=item["pincode"];
             },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
                
        },"json");
               
    }  
</script>

<script> 
 $(document).ready(function(){  
   document.getElementById('Update').style.visibility = 'hidden';
   document.getElementById('cancel').style.visibility = 'hidden';     
});
</script>
</html>
<script type="text/javascript">
$('#Update').click(function(){    
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
});
    $.ajax({
       type:'POST',
       url:"{{ route('user.update')}}",
       data:$('#updaterecord').serialize(),
       success:function(data){ 
        if(data.status==true)
        {
          alert('Updated Successfully!');
          location.reload(true);
        }        
       },error: function (xhr) {
                        
        }   
    },"json");
});
</script>
