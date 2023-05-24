
@extends('layouts.admin.app')
@push('title')
<title>Medshop | Create-Order</title>
@endpush


@section('content')

<form action="{{route('admin.order_store')}}" method="post">
  @csrf
<div class="customerInfo">
  <div class="container">
    <h2>Customer Info:</h2>
    <div class="ciRow3">
      <div class="ciCol"><label>Name</label><input type="text" name="coustomer_name" required/></div>
      <div class="ciCol"><label>Phone</label><input type="text" name="coustomer_phone" required/></div>
      <div class="ciCol"><label>Email</label><input type="email" name="coustomer_email" required/></div>
    </div>

     <div class="ciRow2">
      <div class="ciCol"><label>Address</label><textarea name="customer_address" required></textarea></div>
      <div class="ciCol"><label>Dr. Name/Reg. No.</label ><textarea name ="doc_name_regdno"></textarea></div>
    </div>
  </div>
</div>
<div class="row">
    Search
    <div class="col-md-12">
    <input name="product" id="seachprodduct" type="text" placeholder="Seach your product"/>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
      <div class="form-group">
          <table class="table table-striped table-responsive" >

              <thead style="background-color: #4e73df;color:#fff">

                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col" style="display:none">Id</th>
                  <th scope="col">MRP</th>
                  <th scope="col">Batch No.</th>
                  <th scope="col">Exp. Dt</th>
                  <th scope="col">Qty</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Discount (%)</th>
                  <th scope="col" style="display:none">Subtotal</th>
                  <th scope="col">GST</th>
                  <th scope="col">Total (inc. GST)</th>


                </tr>
              </thead>
              <tbody id="table" >

              </tbody>
            </table>
      </div>
  </div>

  <div class="col-md-6">
    <div class="row">
    <div class="col-md-6">
    <ul  style="text-align: right;list-style-type:none">
      <li class="mt-2" style="display:none">SubTotal</span></li>
      <li class="mt-2">Discount</li>
      <li class="mt-2">Taxable Amount</li>
      <li class="mt-2">Tax (GST)</li>
      <li class="mt-2">Rand Off</li>
      <li class="mt-2">Grand Total</li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul  style="text-align: right;list-style-type:none">
      <li class="p-1" ><input type="number" name="total_subtotal" id="total_subtotal" readonly style="border:none;display:none"></li>
      <li class="p-1"><input type="number" name="total_discount" id="total_discount" readonly style="border:none"></li>
      <li class="p-1"><input type="number" name="total_taxable_amount" id="total_taxable_amount" readonly style="border:none"></li>
      <li class="p-1"><input type="number" name="total_gst"  id="total_gst" readonly style="border:none"></li>
      <li class="p-1"><input type="number" name="round_off" id ="round_off" readonly style="border:none"></li>
      <li class="p-1"><input type="number" name="grand_total" id="grand_total" readonly style="border:none"></li>
    </ul>
  </div>
  </div>
  </div>
</div>
<div style="text-align:right">
<button class="btn text-white" style="background: #4e73df">Save Order</button>
</div>
</form>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $( function() {
    function log( message ) {
      $( "#table" ).append( message );

    }

    $( "#seachprodduct" ).autocomplete({
      source: '{{ route('admin.prod_name') }}',
      minLength: 2,
      select: function( event, ui ) {
        console.log(ui.item.value.product_veriant)
        let productV = ui.item.value.product_veriant;
        log( "<tr><td></td><td>"+ui.item.label+"</td><td>"
            +productV[0].mrp_per_unit*productV[0].strip+"</td><td>"
            +productV[0].batch+"</td><td>"
            +productV[0].expdate+"</td>"
            +"<td><input type='number' name='qty[]' step=1 value=1/></td><td>"
            +productV[0].mrp_per_unit+"</td><td> <input type='number' name='discount[]' /></td></tr>" );
        jQuery('#seachprodduct').val('a');
      }
    });
  } );
    </script>



@push('styles')
<style>
  ul li:hover{
   cursor: copy;
   background-color:#4e73df;
   color: #fff;
 }
 .container{width:1100px; margin:0 auto;}
 .ciRow3, .ciRow2{clear:both; display:block; margin-bottom:15px;}
 .ciRow3:after, .ciRow2:after{content:""; clear:both; display:block; height:1px; width:100%;}
 .ciRow3 .ciCol{width:31%; float:left; margin-right:2%;}
 .ciRow2 .ciCol{width:48%; float:left; margin-right:2%;}
 .ciRow3 .ciCol label{clear:both; display:block; margin-bottom:5px;}
 .ciRow3 .ciCol input{border:1px solid #ebebeb; padding:10px; width:90%;}
 .ciRow2 .ciCol label{clear:both; display:block; margin-bottom:5px;}
 .ciRow2 .ciCol textarea{border:1px solid #ebebeb; padding:10px; width:91%;}
 .customerInfo .container{background:#f7f7f7; padding:30px; border-radius:0px 0px 20px 20px; margin-bottom:10px;}
 .qty_outoff_stock{
  background-color: red;
  color: #fff;
 }
 .qty_in_stock{
  background-color: #fff;
 }
 </style>
@endpush
@endsection

