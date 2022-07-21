<!DOCTYPE html>
<html>
 <head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}"> --}}
 <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
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
                    <form method="post" id="updaterecord" action="{{ route('product.store') }}" enctype="multipart/form-data">
                      @csrf
                    <h4 style="text-align:center;color:#000033;">Add Product</h4>
                   <div class="row jumbotron"style="padding:5px">
                   <input type="hidden" name="id"  id="id" value="">
                   <div class="col-sm-4">                                          
                    <label for="gematricname">Gematric Name<span style="color:red;">*</span></label>
                     <input  type="text"  id="gematricName" name="gematricName" placeholder="Enter Gematric Name" required 
                     onkeypress="ValidateUserId()"  onkeyup="checkletter(this)" class="@error('gematricName') is-invalid @enderror form-control">
                      <img src="{{ asset('public/images/wrongimg.jpg')}}" id="wr_img" style="height: 24px; width: 24px; float: right; margin-top: -35px; margin-right: 7px; display:none;">
                      <img src="{{ asset('public/images/checkimg.jpg')}}" id="ch_img" style="height: 24px; width: 24px; float: right; margin-top: -35px; margin-right: 7px; display:none;">
                      <input type="hidden" id="res_im" value="false">
                      @error('gematricName')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                   </div>
                   <div class="col-sm-4">
                     <label for="brand">Brand<span style="color:red;">*</span></label>
                     <input  type="text"  id="brand"  class="@error('brand') is-invalid @enderror form-control"  name="brand"  placeholder="Enter  brand name" required>
                      @error('brand')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                   </div>
                  <div class="col-sm-4">
                   <label for="tilte">Title<span style="color:red;">*</span></label>
                     <input  type="text"  id="title"  class="@error('title') is-invalid @enderror form-control"  name="title"  placeholder="Enter title" required>
                    @error('title')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-4">
                   <label for="stock">Stock<span style="color:red;">*</span></label>
                     <input  type="text"  id="stock"  class="@error('stock') is-invalid @enderror form-control"  name="stock" placeholder="Enter stock" required>
                      @error('stock')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-sm-4">
                   <label for="qnty">Quantity<span style="color:red;">*</span></label>
                     <input  type="number"  id="quantity"  class="@error('quantity') is-invalid @enderror form-control"  name="quantity"  placeholder="Enter qnty" required>
                      @error('quantity')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-sm-4">
                   <label for="price">Price<span style="color:red;">*</span></label>
                     <input  type="number"  id="price"  class="@error('price') is-invalid @enderror form-control"  name="price" placeholder="Enter price" required>
                     @error('price')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                     
                  </div>
                  <div class="col-sm-4">
                   <label for="sellPrice"> Sell Price<span style="color:red;">*</span></label>
                     <input  type="number"  id="sellPrice"  class="@error('sellPrice') is-invalid @enderror form-control"  name="sellPrice"  placeholder="Enter  Selling price" required>
                     @error('sellPrice')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                  </div>
                  <div class="col-sm-4">
                      <label for="description">Description<span style="color:red;">*</span></label>
                      <input type="text" id="description" class="@error('description') is-invalid @enderror form-control" name="description" placeholder="Enter description" required>
                      @error('description')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                      
                  </div>
                   <div class="col-sm-4">
                      <label for="image">Image</label>
                      <input type="file" id="image" class="@error('image') is-invalid @enderror form-control" name="image">
                      @error('image')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      @enderror
                  </div>
                  <div  class="col-sm-2 form-inline" style="padding-top:30px;">
                       <div class="row">
                      <div class="col-sm-2">
                       <button type="submit"name="send" id="submitbtn" value="Submit" class="btn btn-success btn-sm">Save</button>
                      </div>
                      <div class="col-sm-4-half">
                       <a id="Update"  class="btn btn-success btn btn-sm">Update</a>
                       </div>
                       <div class="col-sm-4">
                       <a id="cancel" href="{{ route('product.create') }}" class="btn btn-danger btn-sm">Cancel</a>
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
  <h4 class="mb-0">Product List</h4>
    <table class="table table-bordered" id="datatable">
      <thead>
        <tr>
          <th scope="col">SL.No.</th>
          <th scope="col">Gematric Name</th>
          <th scope="col">Brand</th>
          <th scope="col">Stock</th>
          <th scope="col">Qnty</th>
          <th scope="col">Price</th>
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
        ajax: '{!! route('product.get') !!}',
        columns: [
            
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'gematricName', name: 'gematricName' },
            { data: 'brand', name: 'brand' },
            { data: 'stock', name: 'stock' },
            { data: 'quantity', name: 'quantity' },
            { data: 'price', name: 'price' },
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
           url:"{{ route('edit.product') }}",
           data:{item:item},
           success:function(data){
           var item =JSON.parse(data);
             document.getElementById("id").value=item["id"];
             document.getElementById("gematricName").value=item["gematricName"];
             document.getElementById("brand").value=item["brand"];
             document.getElementById("title").value=item["title"];
             document.getElementById("stock").value=item["stock"];
             document.getElementById("quantity").value=item["quantity"];
             document.getElementById("price").value=item["price"];
             document.getElementById("sellPrice").value=item["sellPrice"];
             document.getElementById("description").value=item["description"];
             document.getElementById("image").value=item["image"];
             
             },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
                
        },"json");
               
    }  
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
     var gematricName = document.getElementById("gematricName").value;
        $.ajax({
           type:'POST',
           url:"{{ route('product.Name') }}",
           data:{gematricName:gematricName},
           success:function(data){
            var item =JSON.parse(data); 

            const names = [];
            if(item.length > 0 ){
              
              for(var i = 0; i < item.length; i++) {
                let str1 = item[i].gematricName;
                
                if(str1.toLowerCase() == gematricName.trimEnd().toLowerCase()){
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
                if(gematricName == null || gematricName == ""){
                  $('#wr_img').hide();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }
                
                let str2 = "("+item[i].id+")"; 
                names[i]=str1
              }
            }else{ 
              if(gematricName == null || gematricName == ""){
                  $('#wr_img').hide();
                  $('#ch_img').hide();
                  $('#res_im').val('false');
                }else{ $('#ch_img').show(); $('#res_im').val('true');}
             }
            
    autocomplete(document.getElementById("gematricName"), names);
         },error: function (xhr) {
                        console.log((xhr.responseJSON.errors));
                    }
        },"json");
               
    })
}
$('#gematricName').focusout(function(){
    if($('#res_im').val() == 'false'){
      $(this).val('');
    }
  });
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
       url:"{{ route('update.product')}}",
      
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
