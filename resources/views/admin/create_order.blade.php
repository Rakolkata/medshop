
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
    <input name="product" id="seachprodduct" type="text" placeholder="Seach your product" style="padding:5px; margin-bottom:15px;"/>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
      <div class="form-group">
          <table class="table table-striped " >

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
  
  function array_sum(array){
    let sum = 0;

  for (const value of Object.values(array)) {
  sum += value;
  }
  return sum;
  }

  let totals = [];
  let gstValues = [];
  let discounts = [];
  $( function() {
  
  function log( message ) {
    $( "#table" ).append( message );
  }

  $("#seachprodduct").autocomplete({
    source: '{{ route('admin.prod_name') }}',
    minLength: 2,
    select: function( event, ui ) {
      let productV = ui.item.values.product_veriant;
      let category = ui.item.values.category;
      let rowId = Date.now(); // generate a unique identifier for the row
      let newRow = $("<tr>", {"id": rowId}); // add the identifier to the new row
      newRow.append("<td></td><td>"+ui.item.label+"</td><td>"
          +productV[0].mrp_per_unit*productV[0].strip+"</td><td>"
          +productV[0].batch+"</td><td>"
          +productV[0].expdate+"</td>"
          +"<td><input type='number' name='qty[]' value=1 min=1 /></td><td>"
          +productV[0].mrp_per_unit+"</td><td> <input type='number' name='discount[]' class='discount' min=0 max=10 value=0 /></td><td class='gst'>"+parseInt(productV[0].mrp_per_unit) * parseInt(category[0].Gstrate)/100+"</td><td class='total'>"+productV[0].mrp_per_unit+"</td></tr>" );
      $("#table").append(newRow);
        totals[rowId]=productV[0].mrp_per_unit;
        gstValues[rowId]=parseInt(productV[0].mrp_per_unit) * parseInt(category[0].Gstrate)/100;
        discounts[rowId]=0;
        $("#total_taxable_amount").val(array_sum(totals));
        $("#total_gst").val(array_sum(gstValues));
        $("#total_discount").val(array_sum(discounts));
        $("#grand_total").val(array_sum(totals).toFixed(0));
        $("#round_off").val(array_sum(totals)-(array_sum(totals).toFixed(0)));

      $(document).on('change','#'+rowId+' .discount',function(){ // listen to changes on the discount input of the corresponding row
        let discount = $(this).val();
        if (discount > 10) { // limit discount to 10%
            discount = 10;
            $(this).val(discount); // update the value of the discount input to reflect the limit
        }
        $(this).val(discount); // update the value of the discount input to reflect the limit
        let price = productV[0].mrp_per_unit;
        let qty = $(this).closest('tr').find("input[name='qty[]']").val();
        let subtotal = price * qty * (1 - discount / 100);
        $(this).closest('tr').find(".total").text(subtotal); // update the total for the corresponding row
        let gstRate = category[0].Gstrate;
        let gstAmount = subtotal * gstRate / 100;
        $(this).closest('tr').find(".gst").text(gstAmount);
        // let index = totals.indexOf(rowId);
        totals[rowId]=subtotal;
        gstValues[rowId]=gstAmount;
        discounts[rowId]= (price * qty)-subtotal;
        $("#total_taxable_amount").val(array_sum(totals));
        $("#total_gst").val(array_sum(gstValues));
        $("#total_discount").val(array_sum(discounts));
        $("#grand_total").val(array_sum(totals).toFixed(0));
        $("#round_off").val(array_sum(totals)-(array_sum(totals).toFixed(0)));

      });

      $(document).on('change','#'+rowId+' input[name="qty[]"]',function(){ // listen to changes on the quantity input of the corresponding row
        let qty = $(this).val();
        let price = productV[0].mrp_per_unit;
        let discount = $(this).closest('tr').find(".discount").val();
        if (discount > 10) { // limit discount to 10%
            discount = 10;
            $(this).closest('tr').find(".discount").val(discount); // update the value of the discount input to reflect the limit
        }
        $(this).closest('tr').find(".discount").val(discount); // update the value of the discount input to reflect the limit
        let subtotal = price * qty * (1 - discount / 100);
        $(this).closest('tr').find(".total").text(subtotal); // update the total for the corresponding row
        let gstRate = category[0].Gstrate;
        let gstAmount = subtotal * gstRate / 100;
        $(this).closest('tr').find(".gst").text(gstAmount);
        // let index = totals.indexOf(rowId);
        totals[rowId]=subtotal;
        gstValues[rowId]=gstAmount;
        discounts[rowId]= (price * qty)-subtotal;
        $("#total_taxable_amount").val(array_sum(totals));
        $("#total_gst").val(array_sum(gstValues));
        $("#total_discount").val(array_sum(discounts));
        $("#grand_total").val(array_sum(totals).toFixed(0));
        $("#round_off").val(array_sum(totals)-(array_sum(totals).toFixed(0)));
        
      });

    }
  });
});


  
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

