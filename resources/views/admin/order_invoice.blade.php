<div >


    <div class="col-md-6 p-2" style="border-bottom: 1px solid black">
      <h5 class="text-capitalize ">{{env('APP_NAME')}}</h5>
    </div>
    <div class="col-md-6 p-2" style="border-bottom: 1px solid black;text-align:right">
@if(isset($order_id))
    <h5 class="text-capitalize">Tax Invoice <br>{!! $order_id !!}</h5>
@else
    <h5 class="text-capitalize">Tax Invoice <br>{{ substr(env('APP_NAME'), 0, 1) . date("dmY") . $id[0] }}</h5>
@endif

      <address>
        {{$customer_address}}<br>
        <a href="tel:{{$coustomer_phone}}">{{$coustomer_phone}}</a>
      </address>
      </div>

<div class="col-md-6 p-1" style="border-bottom: 1px dashed">
  <p>Doctor Name/Regd. no. : {{$doc_name_regdno}}</p>
</div>
<div class="col-md-6 p-1" style="border-bottom: 1px dashed">
  <ul style="list-style-type: none; padding-left: 0px">
    <li id="patient_name">Patient Name : {{$coustomer_name}}</li>
    <li>Address : {{$customer_address}}</li>
  </ul>
</div>
<div class="col-md-12">
  <table class="table table-responsive-sm" style="width:100% border-collapse:collapse">
    <thead>
      <tr>
        <th scope="col" style="width:30px">#</th>
        <th scope="col" style="width:92px;padding-left:15px">Description Of Goods</th>
        <th scope="col" style="width:92px;padding-left:15px">Batch No.</th>
        <th scope="col" style="width:92px;padding-left78px">Expiry</th>
        <th scope="col" style="width:70px">Qty</th>
        <th scope="col" style="width:70px">Rate</th>
        <th scope="col" style="width:70px">Gst</th>
        <th scope="col" style="width:70px">Discount</th>
        <th scope="col" style="width:70px">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($id as $index=>$value)
      <tr>
        <td style="text-align: center">{{$index}}</td>
        <td style="text-align: center;padding-left:15px">{{$title[$index]}}</td>
        <td style="text-align: center">{{$batch_no[$index]}}</td>
        <td style="text-align: center; padding-left:20px">{{$exp[$index]}}</td>
        <td style="text-align: center">{{$qty[$index]}}</td>
        <td style="text-align: center">{{$rate[$index]}}</td>
        <td style="text-align: center">{{$gst[$index]}}</td>
        <td style="text-align: center">{{$discount[$index]}}</td>
        <td style="text-align: center">{{$total[$index]}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="text-align: right">
    <ul style="list-style-type: none">
      <li>Total Discount : {{sprintf("%.2f",$total_discount)}}</li>
      <li>Total Taxable Ammount : {{sprintf("%.2f",$total_taxable_amount)}}</li>
      <li>Total GST : {{sprintf("%.2f",$total_gst)}}</li>
      <li>Round Off : {{sprintf("%.2f",$round_off)}}</li>
      <li>Grand Total : {{sprintf("%.2f",$grand_total)}}</li>
        </ul>
      </div>
    </div>
      <div class="container my-auto" style="position: absolute bottom: 0">
        <div class="text-center my-auto">
          <span style="position:fixed; bottom:0; left:0">Thanks for making an order</span>
        </div>
      </div> 
  </div>

</div>