<!DOCTYPE html>
<html>
 <head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}"> --}}
 <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
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
                    <form method="post" id="updaterecord" action="{{ route('product.store') }}">
                      @csrf
                       <h4 style="text-align:center;color:#000033;">Add Product</h4>
                   <div class="row jumbotron"style="padding:5px">
                   <input type="hidden" name="id"  id="id" value="">
                   <div class="col-sm-4">                                          <label for="gematricname">Gematric Name<span style="color:red;">*</span></label>
                     <input  type="text"  id="gematricName"  class="typeahead  form-control form-control"  name="gematricName" required placeholder="Enter Gematric Name">
                   </div>
                   <div class="col-sm-4">
                     <label for="brand">Brand<span style="color:red;">*</span></label>
                     <input  type="text"  id="brand"  class="typeahead  form-control form-control"  name="brand" required placeholder="Enter  brand name">
                   </div>
                  <div class="col-sm-4">
                   <label for="tilte">Title<span style="color:red;">*</span></label>
                     <input  type="text"  id="title"  class="typeahead  form-control form-control"  name="title" required placeholder="Enter title">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="stock">Stock<span style="color:red;">*</span></label>
                     <input  type="text"  id="stock"  class="typeahead  form-control form-control"  name="stock" required placeholder="Enter stock">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="qnty">Quantity<span style="color:red;">*</span></label>
                     <input  type="number"  id="quantity"  class="typeahead  form-control form-control"  name="quantity" required placeholder="Enter qnty">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="price">Price<span style="color:red;">*</span></label>
                     <input  type="number"  id="price"  class="typeahead  form-control form-control"  name="price" required placeholder="Enter price">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="sellPrice"> Sell Price<span style="color:red;">*</span></label>
                     <input  type="number"  id="sellPrice"  class="typeahead  form-control form-control"  name="sellPrice" required placeholder="Enter  Selling price">
                      
                  </div>
                  <div class="col-sm-4">
                      <label for="description">Description<span style="color:red;">*</span></label>
                      <input type="text" id="description" class="form-control" name="description" placeholder="Enter description" required>
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
                       <a id="cancel" href="{{ route('product.create') }}" class="btn btn-success btn-sm">Cancel</a>
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
  <h4 class="mb-0">Product List List</h4>
    <table class="table table-bordered" id="datatable">
      <thead>
        <tr>
          <th scope="col">SL.No.</th>
          <th scope="col">Gematric Name</th>
          <th scope="col">Brand</th>
          <th scope="col">Title</th> 
          <th scope="col">Stock</th>
          <th scope="col">Qnty</th>
          <th scope="col">Price</th>
          <th scope="col">Sell Price</th>
          <th scope="col">Description</th>
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
            { data: 'title', name: 'title' },
            { data: 'stock', name: 'stock' },
            { data: 'quantity', name: 'quantity' },
            { data: 'price', name: 'price' },
            { data: 'sellPrice', name: 'sellPrice' },
            { data: 'description', name: 'description'},
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
