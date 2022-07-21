<!DOCTYPE html>
<html>
 <head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}"> --}}
 <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
 <script src="{{ asset('public/js/custom.js')}}"></script>

<link href="{{ asset('public/css/comman.css') }}" rel="stylesheet">
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
           @if (\Session::has('message'))
        <div class="alert alert-success alert-dismissible" style="margin-top:10px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{!! \Session::get('message') !!}</strong> 
       </div>
       @endif
            <div class="card-header border-0">
              <div class="row" id="demo">
                 <div class="col-md-12">
                  <div class="container">
                    <form method="post" id="updaterecord" action="{{ route('user.store') }}">
                      @csrf
                       <h4 style="text-align:center;color:#000033;">Add Customer</h4>
                   <div class="row jumbotron"style="padding:5px">
                   <input type="hidden" name="id"  id="id" value="">
                   <div class="col-sm-4">                                         
                    <label for="name">Name<span style="color:red;">*</span></label>
                     <input  type="text"  id="name" onkeyup="checkletter(this)"  class="@error('name') is-invalid @enderror form-control"  name="name" placeholder="Enter customer name"onkeypress="ValidateUserId()"  onkeyup="checkletter(this)">
                      <img src="{{ asset('public/images/wrongimg.jpg')}}" id="wr_img" style="height: 24px; width: 24px; float: right; margin-top: -35px; margin-right: 7px; display:none;">
                      <img src="{{ asset('public/images/checkimg.jpg')}}" id="ch_img" style="height: 24px; width: 24px; float: right; margin-top: -35px; margin-right: 7px; display:none;">
                      <input type="hidden" id="res_im" value="false">
                      @error('name')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                   </div>
                  <div class="col-sm-4">
                   <label for="mobile">Mobile</label>
                     <input  type="number"  id="mobile" onchange="ValidatePhoneNumber(this)"  class="@error('mobile') is-invalid @enderror form-control"  name="mobile" placeholder="Enter mobile number">
                     @error('mobile')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-4">
                   <label for="email">Email</label>
                     <input  type="email"  id="email"  class="@error('email') is-invalid @enderror form-control"  name="email"  placeholder="Enter Email">
                     @error('email')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-4">
                   <label for="alternate_email"> Alternate email</label>
                     <input  type="email"  id="alternate_email"  class="@error('alternate_email') is-invalid @enderror form-control"  name="alternate_email"  placeholder="Enter  Alternate Email">
                     @error('alternate_email')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-4">
                      <label for="address">Address</label>
                      <input type="text" id="address" class="@error('address') is-invalid @enderror form-control" name="address" placeholder="Enter address">
                      @error('address')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-4">
                      <label for="country">Country</label>
                      <select type="text" id="country" class="@error('country') is-invalid @enderror form-control" name="country" placeholder="Enter country">
                      <option selected value="India">India</option>
                     @foreach ($CountryList as $row)
              <option value="{{$row->country}}">{{$row->country}} 
                          </option>
                          @endforeach   
                      </select>
                      @error('country')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div> 
                  <div class="col-sm-4" id="india">
                      <label for="state">state</label>
                      <select type="text" id="state" class="@error('state') is-invalid @enderror form-control" name="state" placeholder="Enter state">
                      @foreach ($StateList as $row)
                    <option value="{{$row->State}}">{{$row->State}}</option>
                     @endforeach   
                    </select>
                    @error('state')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                    </div>
                  <div class="col-sm-3" id="other">
                      <label for="State">State</label>
                      <input type="text" name="foreignerState" onkeyup="checkletter(this)"  class="@error('foreignerState') is-invalid @enderror form-control" placeholder=" Enter State">
                      @error('state')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                    </div>
                  <div class="col-sm-4">
                      <label for="pincode">pincode</label>
                      <input type="number" maxlength="6" id="pincode" class="@error('pincode') is-invalid @enderror form-control" name="pincode" placeholder="Enter pincode">
                      @error('pincode')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div  class="col-sm-2 form-inline" style="padding-top:30px;">
                       <div class="row">
                      <div class="col-sm-2">
                       <button type="submit"name="send" id="submitbtn" value="Submit" class="btn btn-success btn-sm">Save</button>
                      </div>
                      <div class="col-sm-4-half">
                       <a id="Update"  class="btn btn-success btn btn-sm ">Update</a>
                       </div>
                       <div class="col-sm-4">
                       <a id="cancel" href="{{ route('user.create') }}" class="btn btn-danger btn-sm">Cancel</a>
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
             document.getElementById("mobile").value=item["mobile"];
             document.getElementById("email").value=item["email"];
             document.getElementById("alternate_email").value=item["alternate_email"];
             document.getElementById("address").value=item["address"];
             document.getElementById("country").value=item["country"];
              if(item["country"]=="India"){
                  $("#state option").filter(function(){
                  return $(this).attr('value')==item["state"];
                  }).attr('selected',true); 
                  $('#india').show();
                    $('#other').hide();
             }else{
                    $('#india').hide();
                    $('#other').show(); 
               document.getElementById("foreignerState").value=item["state"]; 
             }
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
    var country=document.getElementById('country').value;
    if(country=="India")
    {
      $('#other').hide();
      $('#india').show(); 
    } else if(country!=="India")
    {
        $('#other').show();
        $('#india').hide();
         
    }    
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
$(function() {
    $('#country').change(function(){
        if($('#country').val() == 'India') {
            $('#other').hide();
            $('#india').show(); 
        } else if($('#country').val()!=='India') {
            $('#other').show();
            $('#india').hide();
        } 
    });
});
</script>
 <script src="{{ URL::asset('public/js/custom.js') }}"></script>
<script type="text/javascript">
  
//------------------------- Modified ------------------

function ValidateUserId(){
  setTimeout(function ajaxfun()
    { 
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
     var name = document.getElementById("name").value;
        $.ajax({
           type:'POST',
           url:"{{ route('user.Name') }}",
           data:{name:name},
           success:function(data){
            var item =JSON.parse(data); 

            const names = [];
            if(item.length > 0 ){
              
              for(var i = 0; i < item.length; i++) {
                let str1 = item[i].name;
                
                if(str1.toLowerCase() == name.trimEnd().toLowerCase()){
                  $('#wr_img').show();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }
                else 
                {
                  $('#wr_img').hide();
                  $('#ch_img').show();
                  $('#res_im').val('true');
                }
                if(name == null || name == ""){
                  $('#wr_img').hide();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }
                
                let str2 = "("+item[i].id+")"; 
                names[i]=str1
              }
            }else{ 
              if(name == null || name == ""){
                  $('#wr_img').hide();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }else{ $('#ch_img').show(); $('#res_im').val('true');}
             }
            
           autocomplete(document.getElementById("name"), names);
           },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
        },"json");
               
    });
}

$('#name').focusout(function(){
    if($('#res_im').val() == 'false'){
      $(this).val('');
    }
  });
</script>

