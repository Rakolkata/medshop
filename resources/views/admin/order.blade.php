<!DOCTYPE html>
<html>
 <head>
 <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}">
   <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
  
 @include('admin/layouts/head')
 <style>
.row{ margin-left:0px !important; margin-right:0px !important;}
  '#reset_btn','#submitInvoice','#re_msg','#save_btn','#printorder','#inv_f_ord','#submitOrder','#cancel'{ display:none; }
.my-pdx .col-sm-1, .my-pdx .col-sm-2, .my-pdx .col-sm-3, .my-pdx .col-sm-4, .my-pdx .col-sm-5, .my-pdx .col-sm-6 {
    padding-right:2px;
    padding-left:2px;
    margin-bottom:0px;
    margin-top:0px;

   
}
.my-pdx .button-box{ margin-top:0px;}

/* add-invoice dataTable Action Column */
#invoices .navbar-nav{
    width: 50px;
    position: relative;
    float: left;
  }

  #invoices .nav-link-icon{
    margin-top: -3px;
  }

</style>
<style>
    @media (max-width: 1026px) {
            #brandlogo {
                display: none;
            }
          }
    * {
      box-sizing: border-box;
    }

    body {
      font: 16px Arial;  
    }

    /*the container must be positioned relative:*/
    .autocomplete {
      position: relative;
      display: inline-block;
    }
    .autocomp {
      position: relative;
      display: inline-block;
    }
    .col-sm-2 {
        padding-left: 5px;
        padding-right: 5px;
    }
    input {
      border: 1px solid transparent;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
    }
    label {
        font-size: 14px;
    }
    label {
        margin: 0px;
    }
    input[type=text] {
      width: 100%;
      height: 44%;
    }
    input[type=number] {
      width: 100%;
      height: 44%;
    }
    input[type=date] {
      width: 100%;
      height: 44%;
    }
    select#subcategory {
        width: 100%;
        height: 34px;
    }

    input[type=submit] {
      background-color: DodgerBlue;
      color: #fff;
      cursor: pointer;
    }

    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
      padding-left: 15px;
      padding-right: 15px;
    }
    .autocomp-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomp items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
      padding-left: 15px;
      padding-right: 15px;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
    }
    .autocomp-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9; 
    }
    .autocomp-items div:hover {
      background-color: #e9e9e9; 
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
      background-color: DodgerBlue !important; 
      color: #ffffff; 
    }

    .autocomp-active {
      background-color: DodgerBlue !important; 
      color: #ffffff; 
    }
    #input_container {
        position:relative; 
    }
    #input {
        height:20px;
        margin:0;
        width: 100%;
    }

    input[type="text"][readonly]{background-color:white;}


    #input_img {
        position:absolute;
        bottom:16px;
        right:19px;
        width:20px;
        height:20px;
        display:none;
    }
    #iteminput_img {
        position:absolute;
        bottom:14px;
        right:19px;
        width:20px;
        height:20px;
        display:none;
    }
    .row.jumbotron {
      padding: 10px;
      margin:0px;
      margin-bottom:5px ;
      margin-top:0px ;
      box-shadow: 2px 2px 2px #ccc;
    }
    i.fa-edit{ padding: 5px; border: 1px solid transparent; border-radius:5px; }
    i.fa-edit:hover{ cursor:pointer; color:blue; 
    border: 1px solid #ccc;}
</style>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <title>Dovetail-crm</title>
  <!-- Favicon -->
  
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

  <script src = "{{asset('public/user/js/nj.js')}}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" /> 
  <script src="{{asset('public/user/js/head.js')}}"></script> 

 <script src="{{asset('public/user/js/tbl4.js')}}"></script>
 
 <script src="{{ URL::asset('public/js/custom.js') }}"></script>

</head>
<body onload="OnloadFun()">
    @include('admin/layouts/leftnavbar')
  <!-- Main content -->
  <div class="main-content">
    @include('admin/layouts/ProfileHeader')
    <div class="container">
             

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="max-width:600px">
   
    <input type="hidden" id="un_chck_id" value="">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <div>
            <h4 class="text-center"><strong>Create Order from Previous Order</strong></h4>
        </div>
        <div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      </div>
         <div class="modal-body" style="padding-top:0px;">
        <div class="col-sm-6">
  <a href="#"><input type="button" id="crt_order" name="crt_order" value="Create Order" class="btn btn-success btn-sm" style=" margin-top: 6px; padding: 5px 10px;"></a>  </div>
            <div class="row">

              <div class="col-sm-6">

                <label>Customer Name</label>
                <input type="text" class="form-control" name="customer_name" autocomplete="off" id="cus_nameorder">
                <select id="cus_orders" style="display:none; width:100%; border-color:#ccc; height:30px; border-radius:5px; margin-top:5px;"></select>
              </div>
              <div class="col-sm-0" style="padding:0px; padding-top:36px;">
                <b style="font-size:13px">Or</b>
              </div>      
              <div class="col-sm-5">
                <label>Enter Order No.</label>
                <input type="text" class="form-control" name="order_no" onkeypress="ValidateOrderNo()" autocomplete="off" id="order_no">
              </div>
              <div style="text-align:right; width:92%">
                    
              <input type="button" id="get_ods" name="search" value="Search" class="btn btn-primary btn-sm" style=" margin-top: 6px; padding: 5px 10px;">         
              </div>
              <div id="ods_summary" style="width:100%; margin-top:10px;">
                <table class="simple_table" style="width:100%; display:none;">
                    <tr>
                      <th colspan="4" style="text-align:center;">Order Summary</th>
                    </tr>  
                    <tr>
                      <th style="width:50%;">Customer Name:</th>
                      <td>Bill Gates</td>
                    </tr>
                    <tr>
                      <th>Order No.</th>
                      <td>55577855</td>
                    </tr> 
                </table>
                <table class="simple_table" style="width:100%; display:none;">
                  <tr>
                    <th width="8%">Sn</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th width="12%"><label>All <input type="checkbox"></label></th>
                  </tr>
                </table> 
                <div style="width:92%; text-align:right;display:none;">
                    <button type="button" name="send" id="order_import" class="btn btn-warning btn-sm" style="margin-top: 15px; padding: 5px 10px; background-color:#ec971f;">Import</button>
                </div>             
              </div>
                  <script>
                      $(document).ready(function(){
                        $('#add_new_invoice').click(function(){
                          $('#myInput').focus();

                           var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                          var yyyy = today.getFullYear();

                         
                          today=yyyy+ '-' +mm + '-'  +dd ;
                         
                           $('#CurrentDate').val(today);
                        });
                      
                        $(document).on('click',"#checkAll",function () {
                            $('.checkItem').not(this).prop('checked', this.checked);
                        });
                      
                        $(document).on('click',".checkItem , #checkAll",function () {
                          var elm = $('.checkItem');
                          var c_arr = '';
                          $.each(elm,function(x){
                            if($(elm[x]).is(':checked') == false){
                              c_arr = c_arr+$(elm[x]).attr('name');
                            }
                          })
                          if($('.checkItem:checked').length != $('.checkItem').length){ $('#checkAll').prop('checked',false); }
                          $('#un_chck_id').val(c_arr);
                        });

                      
                        $('#inv_f_ord').click(function(){
                          $('#cus_name').val('');
                          $('#cus_orders').hide();
                          $('#order_no').val('');
                          $('#ods_summary').html('');
                          setTimeout(() => {
                            $('#order_no').focus();
                          },500);
                        });
                        $(document).on('click','#order_import',function(){
                          if($('#order_no').val() == ""){alert('Order not found..!');}
                          else if($('.checkItem:checked').length <= 0){
                            alert('At Least One Item Should be Selected..!');
                          }else{
                         // formReset('submitInvoice');
                          $.ajaxSetup({
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                          }); 
                          var order_no = document.getElementById("order_no").value; 
                        //  alert("ssa");
                              $.ajax({
                                type:'POST',
                                url:"#",
                                data:{order_no:order_no},
                                success:function(data){
                                    
                                    if(data != 'false' && data.length > 0){
                                      var obj = JSON.parse(data);
                                     
                                      var ob = obj['order'];
                                      var items = obj['items'];
                                      var contactDeatil = obj['companydl'];
                                      var unchck = $('#un_chck_id').val().length > 0 ? $('#un_chck_id').val():[];
                                      unchck = unchck.toString();
                                      $('#myInput').val(ob['partyname']);
                                      $('#myInput').val(ob['partyname']);
                                      $('#shiptoaddress').val(ob['billtoaddress']);
                                      $('#order_type').val('Supplementry');
                                      $('#order_no_sup').val(ob['order_no']);
                                      $.each(contactDeatil,function(index,subcategory){
                                        if(ob['shipto_id']==subcategory.id)
                                       $('#subcategory').append('<option value="">Select</option><option selected value="'+subcategory.id+'">'+subcategory.contact_name+'</option>');
                                      else  
                                      $('#subcategory').append('<option value="">Select</option><option value="'+subcategory.id+'">'+subcategory.contact_name+'</option>');
                                      
                                      })//$('#inv-pre').val(ob['']);
                                      //$('#inv-due').val(ob['delivery_date']);
                                      $('#s_ordno').val(ob['order_no']);
                                      $('#ref_name').val(ob['salesperson']);
                                      $('#p_mode').val(ob['pay_terms']);
                                      $('#custId').val(ob['customer_id']);
                                      $('#totalamount').html(ob['total_amount']+')');
                                      $('.close').click();
                                      var i = 0;
                                     // alert("ssa");
                                     //console.log(obj);
                                      items.forEach(function(value, index, array){
                                        if(unchck.indexOf(i+1) == -1){
                                          if(items.length > 1 && i > 0 && (items.length-unchck.length) > 1){ $('.btn_add').last().click(); }
                                        // alert(value['itemname']);
                                         
                                          $('[name="itemFullname[]"]').last().val(value['itemname']);
                                          $('[name="hsn_code[]"]').last().val(value['hsn_code']);
                                           $('[name="Taxrate[]"]').last().val(value['Taxrate']);
                                           $('[name="itemid[]"]').last().val(value['itemid']);
                                          $('[name="quantity[]"]').last().val(value['qty']);
                                          $('[name="rate[]"]').last().val(value['rate']);
                                          $('[name="discount[]"]').last().val('0');
                                          $('[name="amount[]"]').last().val(value['amount']);
                                          $('[name="packagingunit[]"]').last().val(value['packagingunit']);
                                          $('[name="itemcode[]"]').last().val(value['item_code']);
   
                                                                              
                                        }
                                        i++;
                                      });
                                      setTimeout(() => {
                                        $('[name="rate[]"]').keyup();  
                                      }, 500);

                                    }else if(data == 'false'){ alert('Order not found..!'); }
                                },error: function (xhr) {            
                                }      
                              },"json");
                            }
                            });
                        $('#get_ods').click(function(){
                        $('#un_chck_id').val('');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        }); 
                        
                        var order_no = document.getElementById("order_no").value; 
                        $.ajax({
                          type:'POST',
                          url:"#",
                          data:{order_no:order_no},
                          success:function(data){  
                            if(data != 'false' && data.length > 0){
                              $('#ods_summary').html(data);
                              $('#checkAll').click();
                            }else if(data == 'false'){ alert('Order not found..!'); }
                          }
                        });
                      });
    $('#cus_nameorder').keyup(function(e){
                        //alert("ee");
    if(e.keyCode != 40 && e.keyCode != 38 && e.keyCode != 13){
      $('#cus_orders').hide();
      $('#order_no').val('');
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      }); 
      var custname = $(this).val();

          $.ajax({
            type:'POST',
            url:"#",
            data:{custname:custname},
            success:function(data){
              
              var item =JSON.parse(data);
              //console.log(item);
              const names = [];
              const ids = [];
              for(var i = 0; i < item.length; i++) {
                let str1 = item[i].fname;
                let str2 = item[i].id; 
                names[i]=str1;
                ids[i] = str2;
              }
              
      autocomplete(document.getElementById("cus_nameorder"), names, ids,'getOrdersByid');
            },error: function (xhr) {
              alert("oops! There is some problem")
              
              }
                  
          },"json");
  }
});
$('#cus_orders').change(function(){
  $('#order_no').val($(this).val());
})
                      });
                  </script>
            </div>
        </div>
    </div>
  </div>
</div>
            
            <form method="post" action=""  id="submitOrder">
              @csrf       
            <div class="row" style="margin-top:10px;">
              
            <div class="col-sm-4">
               <button type="button"onclick="opendiv()" name="createorder" id="new_sales_order" class="btn btn-success btn-sm"><i class="fa fa-file fa-3">&nbsp;&nbsp;</i>Add New</button>
                <button type="button" data-toggle="modal" data-target="#myModal" name="" id="inv_f_ord" onclick="" class="btn btn-primary btn-sm" title="Create Invoice from Order" style="display:none"> Order &#8658; Order</button>
             </div>
             <div class="col-sm-4"><h5 style="text-align:center;font-weight:bold;font-size:20px;">Add Order Details</h5></div>
              <div class="col-sm-4">
                <div class="row">
                  
                  <div class="col-sm-3">
                    <button type="button" id="printorder" class="btn btn-warning btn-sm" style="display:none"><i class="fas fa-print">&nbsp;&nbsp;</i>Import</button>
                  </div>
                  <div class="col-sm-3">
                    <button type="reset" name="" id="reset_btn" class="btn btn-primary btn-sm" style="display:none;"><i class="fa fa-file fa-3">&nbsp;&nbsp;</i>Reset</button>
                  </div>     
                  <div class="col-sm-3">
                  <button type="submit" name="createord" id="submitInvoice" class="btn btn-success btn-sm" style="display:none"><i class="fa fa-save fa-3">&nbsp;&nbsp;</i>Save</button>
                  </div>
                  <div class="col-sm-3"><a id="cancel" href="#" class="btn btn-warning btn-sm"><i class="fa fa-times fa-3">&nbsp;&nbsp;</i>Close</a></div>
                  </div>
                 </div>
            </div>
            
            <?php if(isset($_GET['q']) and !empty($_GET['q'])){ $q=$_GET['q'];?>
              <div id="suc_msg" style="text-align:right; padding-right:15px;"><p style="color:green; font-weight:600; font-size:14px">New Order Added Successfully <a href="#" target="_blank"><button type="button" class="btn btn-success btn-sm">Print</button></a></p></div>
            <?php } ?>
            
            <div id="Sales" style="display:none">
              <div class="row jumbotron">
                 <div id="input_container" class="col-sm-3" class="autocomplete">
                  <label for="custname">Customer Name <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Customer" class="btn btn-link btn-sm"><i class="fa fa-plus fa-3"></i></a></label> 
                    <input id="myInput" onkeypress="ValidateUserId()" type="text"  class="typeahead form-control" autocomplete="off" name="custname" required>
                    <img src="{{ asset('public/images/checkimg.jpg')}}" id="input_img">
                </div>                 
                  <div class="col-sm-3">
                    <label>BillToAddress</label>
                    <input type="text" class="form-control" id="shiptoaddress" name="BillToAddress" readonly="" required="">
                  </div>
                  <div class="col-sm-3">
                      <label for="paymode">ShipToAddress</label>
                      <select class="browser-default custom-select" name="ShipToAddress" id="subcategory" >
                    </select>
                  </div>   
                  <div class="col-sm-3">
                      <label for="order_no">Order No.</label>
                      <input type="checkbox" id="order_generate" name="auto_gen" checked> Auto generate
                      <input type="text" class="form-control" name="order_no" id="ordno" autocomplete="off" disabled required>
                      <span id="avl_ord" style="font-size:12px; font-weight:600; color:brown"></span>
                  </div>
                  
                  <div class="col-sm-3">
                      <label for="order_type">Order Type</label>
                      <select class="form-control" name="order_type" id="order_type">
                         <option selected >Primary</option>
                         <option value="Trial">Trial</option>
                         <option value="Supplementry">Supplementry</option>
                      </select>
                  </div>
                  <div class="col-sm-3">
                      <label for="salesperson_name">Supplementry Order No</label>
                      <input type="text" class="form-control" name="order_no_sup" id="order_no_sup" >
                  </div>
                  <div class="col-sm-3" id="Primary">
                      <label for="date">Validity Date</label>
                      <input type="date"  class="typeahead form-control"  name="validitydate">
                  </div>  
                  <div class="col-sm-3" id="Trial">
                      <label for="date">Validity Date</label>
                      <input type="date"  class="typeahead form-control" id="expirydate" name="validitydate">
                  </div>
                                                  
                  <div class="col-sm-3">
                      <label for="salesperson_name">Salesperson/Ref. Name</label>
                      <input type="text" class="form-control" name="salesperson_name" >
                  </div>
                  
                   <div class="col-sm-2">
                      <label for="pay_terms">Pay Terms</label>
                      <input type="text" class="form-control" name="pay_terms">
                  </div>
                  <div class="col-sm-2">
                    <label for="delivery_date">PO Date</label>
                      <input type="date" id="Date" class="form-control" name="delivery_date" required>
                  </div>
                  <div class="col-sm-2">
                    <label for="POno">PO No.</label>
                      <input type="input" id="POno" class="form-control" name="POno" required>
                  </div>
                  <div class="col-sm-3">
                      <label for="remarks">Remarks</label>
                      <textarea class="form-control" name="remarks"></textarea>
                  </div>

                  <div class="col-sm-3">
                    <br><br>
                      <input type="checkbox" id="approver_req" name="approval_is">
                      <label for="approver_req">Approval Required</label>
                  </div>   
                  <div class="col-sm-3">
                   
                  </div>   
                  <div class="col-sm-3">
                   
                   </div>  
                   <div class="col-sm-3">
                   
                   </div>  
                  <div class="col-sm-3">
                
                      <label >Net Amount(₹ </label>
                      <label id="totalamount">0)</label>
                      <input type="hidden" id="ttm" name="total_amount" value="">
                      <input type="hidden" id="custId" name="custId" required>
                  </div>              
                  </div>
                  <div class="my-pdx">
                    <div class="">
                  <div class="row jumbotron" id="dynamic_field">
                     <div class="col-sm-2" class="autocomp">
                      <label for="itemFullname">Item name <a href="#" data-toggle="modal" data-target="#ttttitem" data-bs-toggle="tooltip" data-bs-placement="top" title="Show Item Name"><i class="fa fa-plus" aria-hidden="true"></i></a>
                      </label>
                      <input id="itemname" placeholder="item name" autocomplete="off"
                       onkeypress="FillItem('itemname','iteminput_img')" type="text"  class="typeahead form-control"
                        name="itemFullname[]" required>
                        <img src="{{ asset('public/images/checkimg.jpg')}}" id="iteminput_img">
                     </div>
                     <div class="col-sm-2" class="autocomp1">
                        <label for="itemcode">Item Code<a href="#" data-toggle="modal" data-target="#ttttitem" data-bs-toggle="tooltip" data-bs-placement="top" title="Show Item Name"></a></label>
                        <input id="itemcode" placeholder="Item Code" autocomplete="off" type="text" onkeyup="FillItembyCode('itemcode','itemcodeinput_img')" class="typeahead form-control" name="itemcode[]" required>
                         
                          <input type="hidden" id="itemid" name="itemid[]" required>
                        </div>
                     <div class="col-sm-2">
                      <label for="hsn_code">HSN</label>
                      <input type="text" name="hsn_code[]" id="item_tax"  value="" placeholder="#Code" class="form-control" title="Read Only"  readonly/>
                     </div>
                      <input type="hidden" id="Taxrate" name="Taxrate[]" value=""/>
                     
                      <input type="hidden" id="packagingunit" name="packagingunit[]" value=""/>
                     
                     <div class="col-sm-1">
                      <label for="quantity">Qnty</label>
                      <input type="number" name="quantity[]" min=0 oninput="validity.valid||(value='');"  value="0" id="quantity" class="form-control name_list" onkeyup="CalculateAmount('1')" required/>
                     </div>
                     <div class="col-sm-1">
                      <label for="rate">Rate</label>
                      <input type="text" name="rate[]" placeholder="Rate" id="rate" class="form-control name_list" value="0" data-qnty="quantity" data-amount="amount" onkeyup="CalculateAmount('1')" required/>
                     </div>
                     <div class="col-sm-2">
                      <label for="amount">Amount</label><br>
                      <input type="text" name="amount[]" value="0" placeholder="Amount" id="amount" class="form-control name_list" readonly required/>
                     </div>
                     <div class="col-sm-1-half">
                      <label for="">Add</label><br>
                      <div class="button-box row-sm-1-half">
                          <a  name="add" class="btn btn-success btn_add btn-sm"><i class="fa fa-plus fa-3"></i></a>                 
                      </div>                
                    </div>
                   </div>
                </div>
              </div>
          </form>
       </div>
         <!---div class="row">
           <div class="col-sm-10"></div>
          <div class="col-sm-2" style="padding-left:90px;padding-top:5px;padding-bottom:5px;">
           <a href="#" id="save_btn"  onclick="Save_Function()"class="btn btn-success btn-sm"><i class="fa fa-save fa-3"></i>&nbsp;&nbsp;Save</a></div>
        </div----->
  </div>
  <script type="text/javascript">
  function Save_Function() {
  document.getElementById("submitOrder").submit();
}
</script>

<script>

 $(document).ready(function() {

  $('#reset_btn').click(function(){
    document.getElementById("submitOrder").reset();
  });

  var sn = 1;
    var table = $('#OrdersList').DataTable( {
        processing: true,
        "ajax": '#',
        columns: [
        {
            "className":      'details-control',
            "orderable":      false,
            "searchable":     false,
            "data":           null,
            "defaultContent": ''
          },{
                    "render": function() {
                        return sn++;
                    }
                },
            {data: 'partyname'},
            { data: 'order_no' },        
            { data: 'order_type' },
            { data: 'delivery_date' },
            { data: 'total_amount'},
            { data: 'action'}
            
        ],
        order: [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#OrdersList tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
          var x = $(this).parent();
          var order_id = x.find('a.get_id').attr('data-id');
          if(order_id != null){
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            }); 
            $.ajax({
                    type:'POST',
                    url:"#",
                    data:{ord_no:order_id},
                    success:function(data){
                    //alert(data);
                    row.child( data ).show();
                    tr.addClass('shown');
                
                      }
                          
                  });
                }
              }
            });
         });
</script>
<style>
 td{
   font-size:11.5px;
   text-align: center;
   padding-top: 5px;
   padding-bottom: 5px;
   
  }
  th{
    text-align: center;
    font-size:11.5px;
  }

td.details-control {
    background: url('../public/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../public/images/details_close.png') no-repeat center center;
}
</style>
<div class="row" style="margin:0px; margin-bottom:30px;">
  <div class="col">
    <div class="card shadow" style="padding:4px">
      <div class="table-responsive"> 
        <table id="OrdersList" class="display" style="width:100%">
          <thead>
            <tr>
              <th></th>
              <th scope="col">Sl. No.</th>
              <th scope="col">Customer</th>
              <th scope="col">Order No</th>
              <th scope="col">Order Type</th>
              <th scope="col">Delivery Date</th>
              <th scope="col">Total Amount</th> 
              <th scope="col">Action</th>
            </tr> 
          </thead>
          
        </table>
      </div>
    </div>
  </div>
</div>


<!-- The Modal -->
  <div class="modal fade" id="ttttitem">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
              <div>
              <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus">Add Item</i></a>
            </div>
            <div class="col-sm-1">
            <a href="#"data-dismiss="modal" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></a>
           </div>
      </div>
        <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0" style="padding-left:0px;">
              <div class="table-responsive container">
               <div class="row">
                  <div class="col-sm-10">  
                    <h4 class="mb-0">Item List</h4>
                  </div>
                 </div> 
              <br>
              <table class="table-bordered" id="item">
                <thead>
                   <tr>                   
                    <th scope="col">SL.NO.</th>
                    <th scope="col">BRAND</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">ITEM CODE</th>
                    <th scope="col">ITEM NAME</th>
                    <th scope="col">HSN No</th>
                    <th scope="col">UNIT</th>
                    <th scope="col">UNIT PRICE</th>
                    <th scope="col">QTY</th>
                    <!--th scope="col">TOTAL PRICE</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th----->
                    
                  </tr> 
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript" src="{{asset('public/user/js/tbl.js')}}"></script> 
    <script>
    $(function() {
      var sn=1;
    $('#item').DataTable({
        processing: true,
        serverSide: true,
        ajax: '',
        columns: [
            
            {render:function(){ return sn++; } },
            { data: 'brand', name: 'brand' },
            { data: 'category', name: 'category' },
            { data: 'item_code',name:'item_code'},
            { data: 'item_name', name: 'item_name' },
           { data: 'hsncode', name : 'hsncode'},                               
            { data: 'unit', name: 'unit' },
            { data:'rate_unit', name:'rate_unit'},
           // { data: 'quantity', name: 'quantity' },
            //{ data: 'costprice', name: 'costprice' },
            //{ data: 'status', name: 'status', orderable: false, searchable: false},
            //{ data:'action', name:'action' }

        ]
    });
});
</script>
</div>
</div>
</div>
</div>
</body>
</html>
<script src="{{ URL::asset('public/js/custom.js') }}?<?php echo rand(); ?>"></script>
<script type="text/javascript">
  $(function() {
   $('#Trial').hide(); 
    $('#order_type').change(function(){
        if($('#order_type').val() == 'Trial') {
            $('#Primary').hide();
            $('#Trial').show(); 
        } else {
            $('#Trial').hide();
            $('#Primary').show(); 
        } 
    });
});

$(document).ready(function(){
$('#cancel').hide(); 
    $('#new_sales_order').click(function(){
       $('#cancel').show(); 
}); 

});

</script>
<script>
  $(document).ready(function(){
    $('#ordno').val('ORD0001 (Sample)');
    $('#order_generate').click(function(){
      if($(this).is(':checked') == true){
        $('#ordno').prop('disabled', true);
        $('#ordno').val('ORD0001 (Sample)');
      }else{
        $('#ordno').prop('disabled', false);
        $('#ordno').val('');
      }
    });
  });
</script>
<script type="text/javascript">
function oncheckboxclick()
{
      var finalinvamount=0;
      $("input[name='amount[]']").each(function()
      {
        finalinvamount= parseFloat(finalinvamount) + parseFloat($(this).val());
      });      
      var totalAppliedTax=0;
      var taxrate=parseFloat(0);
      if(document.getElementById('cgst').checked)
      {
         taxrate=taxrate+parseFloat({{env('CGST')}});
      }
      if(document.getElementById('sgst').checked)
      {
         taxrate=taxrate+parseFloat({{env('SGST')}});
      }
      if(document.getElementById('igst').checked)
      {
         taxrate=taxrate+parseFloat({{env('IGST')}});
      }
      if(taxrate!=0)
      {
         Amount=(finalinvamount/100)*(100-taxrate);         
         totalAppliedTax = finalinvamount-Amount;
         finalinvamount+=totalAppliedTax;         
      }
      document.getElementById('totalamount').innerHTML=(finalinvamount.toFixed(2))+")";
      //document.getElementById('taxapplied').innerHTML=totalAppliedTax.toFixed(2)+ ")";
}

function CalculateAmount(id_name)
{ 
  var id_name = parseInt(id_name);
  if(id_name == 1){id_name = '';}
  var rate_is = $('#rate'+id_name).val();
  var qnty_is = $('#quantity'+id_name).val();
  
  if(rate_is != null && qnty_is != null){
    $('#amount'+id_name).val((rate_is*qnty_is).toFixed(2));  
  }

  var final_amount=0;
  $("input[name='amount[]']").each(function()
  {
    final_amount= parseFloat(final_amount) + parseFloat($(this).val());
  });
  $('#totalamount').html((final_amount).toFixed(2)+')');
  $('#ttm').val((final_amount).toFixed(2));     
    

}
 function OnloadFun() 
 {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    //alert(today);
    document.getElementById("Date").value=today;

   const expirydate = new Date();
    var month =expirydate.setMonth(expirydate.getMonth()+1);    
    var dd = String(expirydate.getDate()).padStart(2, '0');    
    var yyyy = expirydate.getFullYear();
    var mm=String(expirydate.getMonth() + 1).padStart(2, '0');
    var expdate = yyyy + '-' + mm + '-' + dd;
    document.getElementById("expirydate").value=expdate;

    
};
function autocompletecst(inp, arr,bind_id=true) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          b.setAttribute("id", this.id + "autocomplete-list");
          b.setAttribute("onclick","AuthenticateUser('"+arr[i]+"')");
          /*make the matching letters bold:*/
          var search_str = "";
          if(bind_id==false){ 
            search_str = arr[i].split('(');
            search_str = search_str[0];
          }
          else{ search_str = arr[i]; }
          b.innerHTML = "<strong>" + search_str.substr(0, val.length) + "</strong>";
          b.innerHTML += search_str.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + search_str + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
function ValidateUserId(){
      document.getElementById("input_img").src = "{{ asset('public/images/wrongimg.jpg')}}";
      document.getElementById("input_img").style.display = "block";
      document.getElementById("custId").value="";
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
     var custname = document.getElementById("myInput").value; 
        $.ajax({
           type:'POST',
           url:"#",
           data:{custname:custname},
           success:function(data){
             var item =JSON.parse(data);
            const names = [];
            //const ids = [];
            for(var i = 0; i < item.length; i++) {
              let str1 = item[i].fname;
              let str2 = "("+item[i].id+")"; 
              names[i]=str1+str2;
              //ids[i]=str2;
            }
            
            autocompletecst(document.getElementById("myInput"), names,false);
           },error: function (xhr) {
            
            }
                
        },"json");
}
function getOrdersByid(item){
  
  if (item)
  {
    var custid=item;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $.ajax({
      type:'POST',
      url:"#",
      data:{custid:custid},
      success:function(data){            
        var item =JSON.parse(data);  
       // console.log(item);                    
        $('#cus_orders').show();
        $('#cus_orders').html('<option>Select Order No.</option>');
        $.each(item,function(index,subcategory){
          $('#cus_orders').append('<option value="'+subcategory.order_no+'">'+subcategory.order_no+'</option>');
        })
      },error: function (xhr) {}     
    },"json");
}
}

function AuthenticateUser(item)
{
  document.getElementById("input_img").src = "{{ asset('public/images/checkimg.jpg')}}";
  document.getElementById("input_img").style.display = "block";

  var matches = item.match(/(\d+)/);
  if (matches)
  {
    var custid=matches[0];
    document.getElementById("custId").value=custid;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
        $.ajax({
           type:'POST',
           url:"#",
           data:{custid:custid},
           success:function(data){            
             var item =JSON.parse(data);  
             console.log(custid);   
             $('#subcategory').empty();
          $.each(item.contactdetails,function(index,subcategory){
            $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.address+'</option>');
            })
          document.getElementById('shiptoaddress').value=item.custmaster.address;       
         
         // document.getElementById('shiptoaddress').value=item[0].address;
           },error: function (xhr) {
            
            }
                
        },"json");
  }
}


</script>
<script type="text/javascript">

$(document).ready(function(){      

$('#ordno').focusout(function(){
  if(($('#avl_ord').html()).length > 2){
    $(this).val('');
  }
  $('#avl_ord').html('');
});
$('#ordno').keyup(function(){
  var ord_no = $(this).val();
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  $.ajax({
           type:'POST',
           url:"#",
           data:{order_no:ord_no},
           success:function(data){
            var ob = JSON.parse(data);
             if(ob == 'false'){
              $('#avl_ord').html('');  
             }else if(ob != null){
              $('#avl_ord').html('Order Already Exist  <span style="color:green">(Avail - '+ob+')</span>');
             }
            }             
        },"json");
});

$('#new_sales_order').click(function(e){
    slideUpDown('#new_sales_entry','#submitInvoice','#printorder','#reset_btn','#save_btn','#cancel');
    // $('#suc_msg').remove();
  });
      var i=1;
      $(document).on('click', '.btn_add', function(){ 
           i++;    
           var itmname='itemname'+i;
           var itmimgname='iteminput_img'+i;
           var quantityname='quantity'+i;
           var discountname='discount'+i;
           $('#dynamic_field').append('<br><div id="row'+i+'" class="col-sm-2" class="autocomp" style="margin-top:0px; margin-buttom:0px;"><label></label><input id="itemname'+i+'" placeholder="item name" autocomplete="off" onkeypress="FillItem('+"'"+itmname+"'"+','+"'"+itmimgname+"'"+')" type="text"  class="typeahead form-control" name="itemFullname[]" required><img src="{{ asset('public/images/checkimg.jpg')}}" id="iteminput_img'+i+'"></div><div id="row'+i+'" class="col-sm-2" class="autocomp"><label></label><input id="itemcode'+i+'" placeholder="item code" autocomplete="off" onkeyup="FillItembyCode(this.id,'+itmimgname+')" type="text"  class="typeahead form-control" name="itemcode[]" required></div><div id="row'+i+'"class="col-sm-2"><label ></label><input type="text" name="hsn_code[]" id="item_tax'+i+'"  value="" placeholder="#Code" class="form-control" title="Read Only" required readonly/></div><input type="hidden" id="Taxrate'+i+'" name="Taxrate[]" value=""/><input type="hidden" id="packagingunit'+i+'" name="packagingunit[]" value=""/><input type="hidden" id="itemid'+i+'" name="itemid[]" value=""/><div id="row'+i+'" class="col-sm-1"><label></label><input type="number" placeholder="Quantity" name="quantity[]" min=0 id="quantity'+i+'" oninput="validity.valid||(value='+"''"+');"value="0" class="form-control name_list" onkeyup="CalculateAmount('+i+')" required/></div><div id="row'+i+'" class="col-sm-1"><label></label><input type="text" id="rate'+i+'" name="rate[]" placeholder="Rate" value="0" class="form-control name_list" onkeyup="CalculateAmount('+i+')" data-qnty="quantity'+i+'" data-amount="amount'+i+'"  required/></div><div id="row'+i+'" class="col-sm-2"><label></label><input type="text" name="amount[]" placeholder="Amount" value="0"id="amount'+i+'" class="form-control name_list" readonly required/></div><div id="row'+i+'" class="col-sm-1-half"><br><div class="button-box row-sm-1-half"><a href="#" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm"><i class="fas fa-trash-alt"></i></a><a href="#" name="add" class="btn btn-success btn_add btn-sm"><i class="fa fa-plus fa-3"></i></a></div></div>');

           var itemprop=document.getElementById('iteminput_img'+i);
           itemprop.style.cssText = "position:absolute;bottom:16px;right:19px;width:20px;height:20px;display:none;";
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();
           $('#row'+button_id+'').remove();
           $('#row'+button_id+'').remove();
           $('#row'+button_id+'').remove();
           $('#row'+button_id+'').remove(); 
           $('#row'+button_id+'').remove(); 
           $('#row'+button_id+'').remove();                
      });  
});

function autocomp(inp, arr,bind_id=true) {
  /*the autocomp function takes two arguments,
  the text field element and an array of possible autocomp values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocomp values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomp-list");
      a.setAttribute("class", "autocomp-items");
      /*append the DIV element as a child of the autocomp container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          b.setAttribute("id", this.id + "autocomp-list");
          b.setAttribute("onclick","VerifyItem('"+arr[i]+"','"+this.id+"','')");
          /*make the matching letters bold:*/
          var search_str = "";
          if(bind_id==false){ 
            search_str = arr[i].split('(');
            search_str = search_str[0];
          }
          else{ search_str = arr[i]; }
          b.innerHTML = "<strong>" + search_str.substr(0, val.length) + "</strong>";
          b.innerHTML += search_str.substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + search_str + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomp text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocomp values,
              (or any other open lists of autocomp values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomp-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomp-active":*/
    x[currentFocus].classList.add("autocomp-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomp items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomp-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomp lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomp-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

function opendiv() {
  var x = document.getElementById("Sales");
  if (x.style.display === "none") {
    x.style.display = "block";
  document.getElementById("submitInvoice").style.display="block";
  document.getElementById("reset_btn").style.display="block";
  document.getElementById("printorder").style.display="block";
  document.getElementById("new_sales_order").style.display="none";
  document.getElementById("inv_f_ord").style.display="block";
  document.getElementById("save_btn").style.display="block";
  document.getElementById("cancel").style.display="block";

  
  
  } 
  else {
    x.style.display = "none";
     document.getElementById("submitInvoice").style.display="none";
     document.getElementById("reset_btn").style.display="none";
     document.getElementById("printorder").style.display="none";
     document.getElementById("inv_f_ord").style.display="none";
     document.getElementById("save_btn").style.display="none";
     document.getElementById("cancel").style.display="none";
     
  }
}

</script>

























