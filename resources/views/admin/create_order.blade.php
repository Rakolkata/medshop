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
                  <th scope="col">Discount</th>
                  <th scope="col" style="display:none">Subtotal</th>
                  <th scope="col">GST</th>
                  <th scope="col">Total (inc. GST)</th>
                  

                </tr>
              </thead>
              <tbody id="table" >
                <tr>
                 <td>1</td>
                 <td><input name="title[]" id="name1" >
                  <ul  style='list-style-type:none' id="title_list1" class="list-group">

                  </ul>
                </td>
                <td style="display:none"><input name="id[]" id="p-id1" ></td>
                <td ><input name="mrp[]" id="mrp1" style="width:80%;border:none"></td>
                <td ><input name="sku[]" id="sku1" style="width:100%;border:none" readonly></td>
                <td ><input name="exp_date[]" id="exp_date1" style="width:80%;border:none"></td>
                <td ><input name="qty[]" value="1" min="1" id="qty1" style="width:80%"></td>
                <td ><input name="rate[]" id="rate1" style="width:70%;border:none"></td>
                <td ><input name="discount[]" id="discount1" value="0" style="width:70%;border:none"></td>
                <td style="display:none" ><input name="subtotal[]" id="subtotal1" ></td>
                <td ><input name="gst[]"  id="gst1" style="width:80%;border:none"></td>
                <td ><input name="total[]" id="total1" style="width:80%;border:none"></td>
                </tr>
              </tbody>
            </table>
      </div>
  </div>
  <div class="col-md-6">
    <input type="button" class="add-row" value="Add Row">
  </div>
  <div class="col-md-6">
    <div class="row">
    <div class="col-md-6">
    <ul  style="text-align: right;list-style-type:none">
      <li class="mt-2" >SubTotal</span></li>
      <li class="mt-2">Discount</li>
      <li class="mt-2">Taxable Amount</li>
      <li class="mt-2">Tax (GST)</li>
      <li class="mt-2">Rand Off</li>
      <li class="mt-2">Grand Total</li>
    </ul>
  </div>
  <div class="col-md-6">
    <ul  style="text-align: right;list-style-type:none">
      <li class="p-1" ><input type="number" name="total_subtotal" id="total_subtotal" readonly style="border:none;"></li>
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
<script>
  $(document).ready(function(){
  var tl = $('#table').find('tr').length;
  $('#name'+(tl)).on('keyup',function () {
    var query = $(this).val();
    $.ajax({
    url:'{{ route('admin.prod_name') }}',
    dataType: 'json',
    type:'GET',
    data:{'name':query},
    success:function (output) {
     var data = JSON.stringify(output);
     let text = "";
     let data_gst="";
     for (let i = 0; i < output.length; i++) {
      for (let index = 0; index < output[i].category.length; index++) {
      if ( output[i].category[index].Gstrate !=undefined) {
        data_gst = output[i].category[index].Gstrate; 
      } else {
        data_gst = 0;
      }
      
     }
      text += '<li id="item'+tl+'"  data-id="'+output[i].id+'"  data-cat="'+output[i].Categories_id +'"  data-mrp="'+output[i].MRP+'" data-sku="'+output[i].SKU+'" data-exp="'+output[i].Exp_date+'" data-rate="'+output[i].Price_unit+'" data-gstrate="'+data_gst+'" data-stock="'+output[i].Stock+'"  style="border:1px solid;padding:2px">'+output[i].Title+'</li>';
      
      if (output[i].Title != undefined) {
        $('#title_list'+(tl)).html(text); 
      }
      
    }  
  }
}); 
 
});
$(document).on('click', '#item'+(tl), function(){
  $('#title_list'+(tl)).html("");
  var value = $(this).text();
  var mrp = $(this).attr("data-mrp");
  var sku = $(this).attr("data-sku");
  var exp_date = $(this).attr("data-exp");
  var rate = $(this).attr("data-rate");
  var gst_rate =  $(this).attr("data-gstrate");
  var stock =  $(this).attr("data-stock");
  var id =  $(this).attr("data-id");
  window.gstrate = gst_rate;
  var qty = $("#qty"+(tl)).val();
  $('#name'+(tl)).val(value);
  $('#p-id'+(tl)).val(id);
  $('#mrp'+(tl)).val(mrp);
  $('#sku'+(tl)).val(sku);
  $('#exp_date'+(tl)).val(exp_date);  
  $("#qty"+(tl)).attr("max", stock);
  $('#rate'+(tl)).val(rate);
  var subtotal = qty * rate;
  $('#subtotal'+(tl)).val(subtotal); 
  var discount_value  = $("#discount"+(tl)).val();
  var discount = discount_value/100 * subtotal;
  var gst = gst_rate / 100 * $('#subtotal'+(tl)).val();
  $('#gst'+(tl)).val(gst.toFixed(2)); 
  $('#total'+(tl)).val(parseFloat($('#subtotal'+(tl)).val())- discount); 
  //Total Subtotal
  var ftl = $('#table').find('tr').length;
  const total_subtotal = [];
  for (let index = 1; index <= ftl; index++) {
    total_subtotal.push(parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_add = 0;
  total_subtotal.forEach(x_add => {
  sum_add += x_add;
  });

  $('#total_subtotal').val(sum_add); 

  //Total Discount
  const total_discount = [];
  for (let index = 1; index <= ftl; index++) {
    total_discount.push(parseFloat($('#discount'+(index)).val())/100*parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_discount = 0;
  total_discount.forEach(x_discount => {
    sum_discount += x_discount;
  });

  $('#total_discount').val(sum_discount.toFixed(2)); 

  var taxable_ammount= $('#total_subtotal').val()-$('#total_discount').val();
  $('#total_taxable_amount').val(taxable_ammount.toFixed(2)); 

//Total Gst
 const total_gst = [];
 for (let index = 1; index <= ftl; index++) {
  total_gst.push(parseFloat($('#gst'+(index)).val()));
  }
  var sum_gst = 0;
  total_gst.forEach(x_gst => {
    sum_gst += x_gst;
  });
  $('#total_gst').val(sum_gst.toFixed(2)); 

  var round_taxable_ammount = Math.round(taxable_ammount);
  var round_ammount = taxable_ammount - round_taxable_ammount;
  $('#round_off').val(round_ammount.toFixed(2)); 
  $('#grand_total').val(round_taxable_ammount.toFixed(2)); 
    
});

$(document).on('keyup', '#discount'+(tl), function(){
  var qty = $('#qty'+(tl)).val();
  console.log('Qty'+qty);
  var rate = $('#rate'+(tl)).val();
  console.log('rate'+rate);
  var discount = $('#discount'+(tl)).val();
  console.log('discount'+discount);
  var subtotal = $('#subtotal'+(tl)).val();
  console.log('subtotal'+subtotal);
  var discount_value = $('#discount'+(tl)).val()/100*subtotal; 
  console.log('discount_value'+discount_value);
  var total = qty * rate - discount_value;
  console.log('total'+total);
  var gst = window.gstrate/100 * total;
  $('#gst'+(tl)).val(gst.toFixed(2)); 
  $('#total'+(tl)).val(parseFloat($('#subtotal'+(tl)).val())- discount_value); 

    //Total Subtotal
    var ftl = $('#table').find('tr').length;
  const total_subtotal = [];
  for (let index = 1; index <= ftl; index++) {
    total_subtotal.push(parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_add = 0;
  total_subtotal.forEach(x_add => {
  sum_add += x_add;
  });

  $('#total_subtotal').val(sum_add); 

  //Total Discount
  const total_discount = [];
  for (let index = 1; index <= ftl; index++) {
    total_discount.push(parseFloat($('#discount'+(index)).val())/100*parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_discount = 0;
  total_discount.forEach(x_discount => {
    sum_discount += x_discount;
  });

  $('#total_discount').val(sum_discount.toFixed(2)); 

  var taxable_ammount= $('#total_subtotal').val()-$('#total_discount').val();
  $('#total_taxable_amount').val(taxable_ammount.toFixed(2)); 

//Total Gst
 const total_gst = [];
 for (let index = 1; index <= ftl; index++) {
  total_gst.push(parseFloat($('#gst'+(index)).val()));
  }
  var sum_gst = 0;
  total_gst.forEach(x_gst => {
    sum_gst += x_gst;
  });
  $('#total_gst').val(sum_gst.toFixed(2)); 

  var round_taxable_ammount = Math.round(taxable_ammount);
  var round_ammount = round_taxable_ammount - taxable_ammount;
  $('#round_off').val(round_ammount.toFixed(2)); 
  $('#grand_total').val(round_taxable_ammount.toFixed(2)); 


});

$(document).on('keyup', '#qty'+(tl), function(){
  var qty = $('#qty'+(tl)).val();
  var rate = $('#rate'+(tl)).val();
  var discount = $('#discount'+(tl)).val();
  var subtotal_value = qty*rate;
  $('#subtotal'+(tl)).val(subtotal_value);

  var discount_value = $('#discount'+(tl)).val()/100*subtotal_value; 
  var subtotal_disc = qty * rate - discount_value;

  var gst = window.gstrate/100 * subtotal_disc;
  $('#gst'+(tl)).val(gst.toFixed(2));
 $('#total'+(tl)).val(subtotal_disc);

  //Total Subtotal
  var ftl = $('#table').find('tr').length;
  const total_subtotal = [];
  for (let index = 1; index <= ftl; index++) {
    total_subtotal.push(parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_add = 0;
  total_subtotal.forEach(x_add => {
  sum_add += x_add;
  });

  $('#total_subtotal').val(sum_add); 

  //Total Discount
  const total_discount = [];
  for (let index = 1; index <= ftl; index++) {
    total_discount.push(parseFloat($('#discount'+(index)).val())/100*parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_discount = 0;
  total_discount.forEach(x_discount => {
    sum_discount += x_discount;
  });

  $('#total_discount').val(sum_discount.toFixed(2)); 

  var taxable_ammount= $('#total_subtotal').val()-$('#total_discount').val();
  $('#total_taxable_amount').val(taxable_ammount.toFixed(2)); 

//Total Gst
 const total_gst = [];
 for (let index = 1; index <= ftl; index++) {
  total_gst.push(parseFloat($('#gst'+(index)).val()));
  }
  var sum_gst = 0;
  total_gst.forEach(x_gst => {
    sum_gst += x_gst;
  });
  $('#total_gst').val(sum_gst.toFixed(2)); 

  var round_taxable_ammount = Math.round(taxable_ammount);
  var round_ammount = round_taxable_ammount - taxable_ammount;
  $('#round_off').val(round_ammount.toFixed(2)); 
  $('#grand_total').val(round_taxable_ammount.toFixed(2)); 


});




});
</script>
<script>
   $(".add-row").click(function(){
    var tl = $('#table').find('tr').length + 1;
    var markup = "<tr><td id='count" + (tl) + "'></td><td><input type='text'  name='title[]' id='name"+(tl)+"'><ul id='title_list"+(tl)+"' class='list-group' style='list-style-type:none'></ul></td><td style='display:none'><input name='id[]' id='p-id"+(tl)+"'></td><td ><input name='mrp[]' id='mrp"+(tl)+"' style='width:80%;border:none' readonly></td><td><input name='sku[]' id='sku"+(tl)+"' style='width:100%;border:none' readonly></td><td><input name='exp_date[]' id='exp_date"+(tl)+"' style='width:80%;border:none' readonly></td><td><input name='qty[]' id='qty"+(tl)+"' value='1'  min='1' style='width:80%'></td><td><input name='rate[]' id='rate"+(tl)+"' style='width:80%;border:none' readonly></td><td style='display:none'><input name='subtotal[]' id='subtotal"+(tl)+"' style='width:80%;border:none' readonly></td><td ><input name='discount[]' id='discount"+(tl)+"' value='0' style='width:70%;border:none'></td><td ><input name='gst[]' id='gst"+(tl)+"' style='width:80%;border:none' readonly></td><td><input name='total[]' id='total"+(tl)+"' style='width:80%;border:none' readonly></td></tr>";
    $("table tbody").append(markup);
    $('#count'+  (tl)).text(tl);
    $('#name'+(tl)).on('keyup',function () {
    var query = $(this).val();
    $.ajax({
    url:'{{ route('admin.prod_name') }}',
    dataType: 'json',
    type:'GET',
    data:{'name':query},
    success:function (output) {
     var data = JSON.stringify(output);
     let text = "";
     let data_gst="";
     for (let i = 0; i < output.length; i++) {
      for (let index = 0; index < output[i].category.length; index++) {
      if ( output[i].category[index].Gstrate !=undefined) {
        data_gst = output[i].category[index].Gstrate; 
      } else {
        data_gst = 0;
      }
     }
      text += '<li id="item'+tl+'"  data-id="'+output[i].id+'"  data-cat="'+output[i].Categories_id +'"  data-mrp="'+output[i].MRP+'" data-sku="'+output[i].SKU+'" data-exp="'+output[i].Exp_date+'" data-rate="'+output[i].Price_unit+'" data-gstrate="'+data_gst+'" data-stock="'+output[i].Stock+'"  style="border:1px solid;padding:2px">'+output[i].Title+'</li>';
      
      if (output[i].Title != undefined) {
        $('#title_list'+(tl)).html(text); 
      }
      
    }  
  }
   });
   });
   $(document).on('click', '#item'+(tl), function(){
  $('#title_list'+(tl)).html("");
  var value = $(this).text();
  var mrp = $(this).attr("data-mrp");
  var sku = $(this).attr("data-sku");
  var exp_date = $(this).attr("data-exp");
  var rate = $(this).attr("data-rate");
  var gst_rate =  $(this).attr("data-gstrate");
  var stock =  $(this).attr("data-stock");
  var id =  $(this).attr("data-id");
  window.gstrate = gst_rate;
  var qty = $("#qty"+(tl)).val();
  $('#name'+(tl)).val(value);
  $('#p-id'+(tl)).val(id);
  $('#mrp'+(tl)).val(mrp);
  $('#sku'+(tl)).val(sku);
  $('#exp_date'+(tl)).val(exp_date);  
  $("#qty"+(tl)).attr("max", stock);
  $('#rate'+(tl)).val(rate);
  var subtotal = qty * rate;
  $('#subtotal'+(tl)).val(subtotal); 
  var discount_value  = $("#discount"+(tl)).val();
  var discount = discount_value/100 * subtotal;
  var gst = gst_rate / 100 * $('#subtotal'+(tl)).val();
  $('#gst'+(tl)).val(gst.toFixed(2));
  $('#total'+(tl)).val(parseFloat($('#subtotal'+(tl)).val()) - discount); 

  //Total Subtotal
  var ftl = $('#table').find('tr').length;
  const total_subtotal = [];
  for (let index = 1; index <= ftl; index++) {
    total_subtotal.push(parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_add = 0;
  total_subtotal.forEach(x_add => {
  sum_add += x_add;
  });
  alert(sum_add);
  $('#total_subtotal').val(sum_add); 

  //Total Discount
  const total_discount = [];
  for (let index = 1; index <= ftl; index++) {
    total_discount.push(parseFloat($('#discount'+(index)).val())/100*parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_discount = 0;
  total_discount.forEach(x_discount => {
    sum_discount += x_discount;
  });

  $('#total_discount').val(sum_discount.toFixed(2)); 
  var taxable_ammount= $('#total_subtotal').val()-$('#total_discount').val();
  $('#total_taxable_amount').val(taxable_ammount.toFixed(2)); 
 
//Total Gst
 const total_gst = [];
 for (let index = 1; index <= ftl; index++) {
  total_gst.push(parseFloat($('#gst'+(index)).val()));
  }
  var sum_gst = 0;
  total_gst.forEach(x_gst => {
    sum_gst += x_gst;
  });
  $('#total_gst').val(sum_gst.toFixed(2)); 
   
  var round_taxable_ammount = Math.round(taxable_ammount);
  var round_ammount = taxable_ammount - round_taxable_ammount;
  $('#round_off').val(round_ammount.toFixed(2)); 
  $('#grand_total').val(round_taxable_ammount.toFixed(2)); 
    
  });
  $(document).on('keyup', '#discount'+(tl), function(){
  });
  $(document).on('keyup', '#discount'+(tl), function(){
  var qty = $('#qty'+(tl)).val();
  console.log('Qty'+qty);
  var rate = $('#rate'+(tl)).val();
  console.log('rate'+rate);
  var discount = $('#discount'+(tl)).val();
  console.log('discount'+discount);
  var subtotal = $('#subtotal'+(tl)).val();
  console.log('subtotal'+subtotal);
  var discount_value = $('#discount'+(tl)).val()/100*subtotal; 
  console.log('discount_value'+discount_value);
  var total = qty * rate - discount_value;
  console.log('total'+total);
  var gst = window.gstrate/100 * total;
  $('#gst'+(tl)).val(gst.toFixed(2)); 
  $('#total'+(tl)).val(parseFloat($('#subtotal'+(tl)).val())- discount_value); 

    //Total Subtotal
    var ftl = $('#table').find('tr').length;
  const total_subtotal = [];
  for (let index = 1; index <= ftl; index++) {
    total_subtotal.push(parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_add = 0;
  total_subtotal.forEach(x_add => {
  sum_add += x_add;
  });

  $('#total_subtotal').val(sum_add); 

  //Total Discount
  const total_discount = [];
  for (let index = 1; index <= ftl; index++) {
    total_discount.push(parseFloat($('#discount'+(index)).val())/100*parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_discount = 0;
  total_discount.forEach(x_discount => {
    sum_discount += x_discount;
  });

  $('#total_discount').val(sum_discount.toFixed(2)); 

  var taxable_ammount= $('#total_subtotal').val()-$('#total_discount').val();
  $('#total_taxable_amount').val(taxable_ammount.toFixed(2)); 

//Total Gst
 const total_gst = [];
 for (let index = 1; index <= ftl; index++) {
  total_gst.push(parseFloat($('#gst'+(index)).val()));
  }
  var sum_gst = 0;
  total_gst.forEach(x_gst => {
    sum_gst += x_gst;
  });
  $('#total_gst').val(sum_gst.toFixed(2)); 

  var round_taxable_ammount = Math.round(taxable_ammount);
  var round_ammount = round_taxable_ammount - taxable_ammount;
  $('#round_off').val(round_ammount.toFixed(2)); 
  $('#grand_total').val(round_taxable_ammount.toFixed(2)); 
  });

  $(document).on('keyup', '#qty'+(tl), function(){
    
  });

  
$(document).on('keyup', '#qty'+(tl), function(){
  var qty = $('#qty'+(tl)).val();
  var rate = $('#rate'+(tl)).val();
  var discount = $('#discount'+(tl)).val();
  var subtotal_value = qty*rate;
  $('#subtotal'+(tl)).val(subtotal_value);

  var discount_value = $('#discount'+(tl)).val()/100*subtotal_value; 
  var subtotal_disc = qty * rate - discount_value;

  var gst = window.gstrate/100 * subtotal_disc;
  $('#gst'+(tl)).val(gst.toFixed(2));
 $('#total'+(tl)).val(subtotal_disc);

  //Total Subtotal
  var ftl = $('#table').find('tr').length;
  const total_subtotal = [];
  for (let index = 1; index <= ftl; index++) {
    total_subtotal.push(parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_add = 0;
  total_subtotal.forEach(x_add => {
  sum_add += x_add;
  });

  $('#total_subtotal').val(sum_add); 

  //Total Discount
  const total_discount = [];
  for (let index = 1; index <= ftl; index++) {
    total_discount.push(parseFloat($('#discount'+(index)).val())/100*parseFloat($('#subtotal'+(index)).val()));
  }
  var sum_discount = 0;
  total_discount.forEach(x_discount => {
    sum_discount += x_discount;
  });

  $('#total_discount').val(sum_discount.toFixed(2)); 

  var taxable_ammount= $('#total_subtotal').val()-$('#total_discount').val();
  $('#total_taxable_amount').val(taxable_ammount.toFixed(2)); 

//Total Gst
 const total_gst = [];
 for (let index = 1; index <= ftl; index++) {
  total_gst.push(parseFloat($('#gst'+(index)).val()));
  }
  var sum_gst = 0;
  total_gst.forEach(x_gst => {
    sum_gst += x_gst;
  });
  $('#total_gst').val(sum_gst.toFixed(2)); 

  var round_taxable_ammount = Math.round(taxable_ammount);
  var round_ammount = round_taxable_ammount - taxable_ammount;
  $('#round_off').val(round_ammount.toFixed(2)); 
  $('#grand_total').val(round_taxable_ammount.toFixed(2)); 


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
 }
 </style>
@endpush
@endsection