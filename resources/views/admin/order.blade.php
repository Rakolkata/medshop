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
                    <form method="post" id="updaterecord" action="{{ route('order.store') }}">
                      @csrf
                       <h4 style="text-align:center;color:#000033;">Order Detail</h4>
                   <div class="row jumbotron"style="padding:5px">
                   <input type="hidden" name="id"  id="id" value="">
                   <div class="col-sm-4">                                          <label for="customername">Customer Name<span style="color:red;">*</span></label>
                     <input  type="text"  id="customerName"  class="typeahead  form-control form-control"  onkeyup="checkletter(this)" name="customerName" required placeholder="Enter Customer Name">
                   </div>
                   <div class="col-sm-4">
                     <label for="orderId">Order id<span style="color:red;">*</span></label>
                     <input  type="number"  id="orderId"  class="typeahead  form-control form-control"  name="orderId" required placeholder="Enter  Order Id">
                   </div>
                  <div class="col-sm-4">
                   <label for="orderNumber">Order Number<span style="color:red;">*</span></label>
                     <input  type="text"  id="orderNumber"  class="typeahead  form-control form-control"  name="orderNumber" required placeholder="Enter Order Number">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="productId">Product id<span style="color:red;">*</span></label>
                     <input  type="number"  id="productId"  class="typeahead  form-control form-control"  name="productId" required placeholder="Enter Product Id">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="productName">Product Name<span style="color:red;">*</span></label>
                     <input  type="text" onkeyup="checkletter(this)"  id="productName"  class="typeahead  form-control form-control"  name="productName" required placeholder="Enter Product Name">
                  </div>
                  <div class="col-sm-4">
                   <label for="price">Price<span style="color:red;">*</span></label>
                     <input  type="number"  id="price"  class="typeahead  form-control form-control"  name="price" required placeholder="Enter price">
                  </div>

                  <div class="col-sm-4">
                   <label for="qnty">Quantity<span style="color:red;">*</span></label>
                     <input  type="number"  id="quantity"  class="typeahead  form-control form-control"  name="quantity" required placeholder="Enter qnty">
                      
                  </div>
                  
                  <div class="col-sm-4">calculatePrice
                   <label for="totalPrice">Total Price<span style="color:red;">*</span></label>
                     <input  type="number"  id="totalPrice"  class="typeahead  form-control form-control"  name="totalPrice" required placeholder="Enter  Total Price">
                      
                  </div>
                  <div class="col-sm-4">
                      <label for="paymentMode">Mode of Payment<span style="color:red;">*</span></label>
                      <input type="text" id="paymentMode" class="form-control" name="paymentMode" placeholder="Enter Mode of Payment" required>
                  </div>
                  <div class="col-sm-4">
                      <label for="deliveryDate">Delivery Date<span style="color:red;">*</span></label>
                      <input type="date" id="deliveryDate" class="form-control" name="deliveryDate" placeholder="Enter Delivery Date" required>
                  </div>
                  <div class="col-sm-8">
                      <label for="deliveryNote">Delivery Note<span style="color:red;">*</span></label>
                      <input type="text" id="deliveryNote" class="form-control" name="deliveryNote" placeholder="Enter Delivery Note" required>
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
                       <a id="cancel" href="{{ route('order.create') }}" class="btn btn-danger btn-sm">Cancel</a>
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
  <h4 class="mb-0">Order List </h4>
    <table class="table table-bordered" id="datatable">
      <thead>
        <tr>
          <th scope="col">SL.No.</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Order No.</th>
          <th scope="col">Product Name</th> 
          <th scope="col">Delivery Date</th>
          <th scope="col">Qnty</th>
          <th scope="col">Price</th>
          <th scope="col">Total Price</th>
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
        ajax: '{!! route('order.show') !!}',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex'},
            { data: 'customerName', name: 'customerName' },
            { data: 'orderNumber', name: 'orderNumber' },
            { data: 'productName', name: 'productName' },
            { data: 'deliveryDate', name: 'deliveryDate' },
            { data: 'quantity', name: 'quantity' },
            { data: 'price', name: 'price' },
            { data: 'totalPrice', name: 'totalPrice' },
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
           url:"{{ route('order.edit') }}",
           data:{item:item},
           success:function(data){
           var item =JSON.parse(data);
             document.getElementById("id").value=item["id"];
             document.getElementById("customerName").value=item["customerName"];
             document.getElementById("orderId").value=item["orderId"];
             document.getElementById("orderNumber").value=item["orderNumber"];
             document.getElementById("productId").value=item["productId"];
             document.getElementById("productName").value=item["productName"];
             document.getElementById("quantity").value=item["quantity"];
             document.getElementById("price").value=item["price"];
             document.getElementById("totalPrice").value=item["totalPrice"];
             document.getElementById("paymentMode").value=item["paymentMode"];
             document.getElementById("deliveryDate").value=item["deliveryDate"];
             document.getElementById("deliveryNote").value=item["deliveryNote"];
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
       url:"{{ route('order.update')}}",
      
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
    
    $('#quantity').on("change", function() {
        calculatePrice();
    });
    $('#price').on("change", function() {
        calculatePrice();
    });

    function calculatePrice(){
        var quantity = $('#quantity').val();
        var rate = $('#price').val();
        if(quantity != "" && rate != ""){
            var price = quantity * rate;
        }
        $('#totalPrice').val(price.toFixed(2));
    }
});



</script>
