@extends('layouts.admin.app')
@push('title')
<title>Medshop |Order-List</title>   
@endpush  
@section('content') 

@if (\Session::has('order_deleetd'))
<div class="alert m-2" style=" padding: 10px;background-color: #0c7227;color: white;margin-bottom: 15px;"> 
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="red" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/></svg><span class="closebtn"  onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span> 
  {!! \Session::get('order_deleetd') !!}
</div>
@endif
<div class="card m-1 p-1 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h5 ><span style="border-bottom:1px solid #4e73df">Order List</span></h5>
<table class="table table-striped table-responsive-sm">
    <thead style="background-color: #4e73df;color:#fff">
      <tr>
        <th scope="col">Order Id</th>
        <th scope="col">Name</th>
        <th scope="col">Total Order</th> 
        <th scope="col">Product</th>             
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="text-capitalize" id="order">
      @if (count($order)>=1)
      @foreach ($order as $index=>$value)
      <tr>
        <th scope="row">{{$order[$index]->orderID}}</th>
        <td>{{$order[$index]->name}}</td>
        <td>{{$order[$index]->Total_Order}}</td>
        
        <td>
          @foreach ($Order_Details[$index] as $item)
              {{$item->Title}},
          @endforeach
        </td>
        <td>
          <a href="{{route('admin.order_delete',['id'=>$order[$index]->id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="red" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg></a>
          <a href="{{route('admin.order_details',['Order_id'=>$order[$index]->id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 20px"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="#4e73df" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg></a>
          <a class="btn_pdf" id="{{$loop->iteration}}" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path fill="#4e73df" d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg></a>
        </td>
        </tr>    
      @endforeach    
      @else
      <tr class="text-center">
      <td colspan="5">Data Not Available</td> 
      </tr>
      @endif
       
    </tbody>
  </table> 
  <div class="d-flex">
    {!! $order->links('pagination::bootstrap-5')!!}
</div>
</div>

<div hidden>
  @foreach ($order as $index=>$value)
  <div class="row text-capitalize"   id="recipet{{$loop->iteration}}" >
   
    <div class="col-md-6 p-2"  style="border-bottom: 1px solid black">
      <h5 class="text-capitalize ">{{env('APP_NAME')}}</h5>
    </div>
    <div class="col-md-6 p-2"  style="border-bottom: 1px solid black;text-align:right">
      <h5 class="text-capitalize ">Tax Invoice <br>{{$order[$index]->orderID}}</h5>
      <address>
        {{$order[$index]->Address}}<br>
        <a href="tel:{{$order[$index]->Phone}}">{{$order[$index]->Phone}}</a>
      </address>
    </div>
    
    <div class="col-md-6 p-1" style="border-bottom: 1px dashed">
      <p >Doctor Name/Regd. no. : {{$order[$index]->Doc_Name_RegdNo}}</p>
    </div>
    <div class="col-md-6 p-1" style="border-bottom: 1px dashed">
      <ul style="list-style-type: none">
        <li id="patient_name">Patient Name :  {{$order[$index]->name}}</li>
        <li>Address :  {{$order[$index]->Address}}</li>
      </ul>
    </div>
    <div class="col-md-12">
      <table class="table table-responsive-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Description Of Goods</th>
            <th scope="col">Mrp </th>
            <th scope="col" style="width:100px">Batch No.</th>
            <th scope="col" style="width:100px">Expiry</th>
            <th scope="col">Qty</th>
            <th scope="col">Rate</th>
            <th scope="col">Gst</th>
            <th scope="col">Order Total</th>
            <th scope="col">Discount</th> 
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($Order_Details[$index] as $item)
          <tr>
          <td>{{$loop->iteration}}</td>
          <td >{{$item->Title}}</td>
          <td >{{$item->mrp}}</td>
          <td >{{$item->Sku}}</td> 
          <td >{{$item->Exp}}</td> 
          <td >{{$item->Qty}}</td> 
          <td >{{$item->Rate}}</td>
          <td >{{$item->Gst}}</td>
          <td >{{$item->total_order}}</td>
          <td >{{$item->discount}}</td>
          <td >{{$item->Total}}</td>
          
          </tr>
          @endforeach
        </tbody>
      </table>
      <div style="text-align: right">
        <ul style="list-style-type: none">
          <li>Grand Total : {{sprintf("%.2f",$order[$index]->Total_Order)}}</li>
        </ul>
      </div>
    </div>
    <footer class="sticky-footer bg-white text-center" style="margin-top:10%;">
      <div class="container my-auto">
          <div class="text-center my-auto">
              <span>Thanks for making an order</span>
          </div>
      </div>
    </footer>
  </div>  
  @endforeach
</div>
 
<script type="text/javascript">
$(document).ready(function(){
  $(".btn_pdf").click(function(){
   var id = $(this).attr("id");
   window.jsPDF = window.jspdf.jsPDF;

   var doc = new jsPDF();
	
   // Source HTMLElement or a string containing HTML.

  var elementHTML = document.querySelector("#recipet"+(id));
  doc.html(elementHTML, {
    callback: function(doc) {
        // Save the PDF
        doc.save('recipt.pdf');
    },
    x: 15,
    y: 15,
    width: 170, //target width in the PDF document
    windowWidth: 650 //window width in CSS pixels
   }); 
  });
 
});
</script>

@endsection