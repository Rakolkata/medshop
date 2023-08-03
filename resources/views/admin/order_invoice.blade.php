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
  <ul style="list-style-type: none">
    <li id="patient_name">Patient Name : {{$coustomer_name}}</li>
    <li>Address : {{$customer_address}}</li>
  </ul>
</div>
<div class="col-md-12">
  <table class="table table-responsive-sm">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Description Of Goods</th>
        <th scope="col" style="width:100px">Batch No.</th>
        <th scope="col" style="width:100px">Expiry</th>
        <th scope="col">Qty</th>
        <th scope="col">Rate</th>
        <th scope="col">Gst</th>
        <th scope="col">Discount</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($id as $index=>$value)
      <tr>
        <td>{{$index}}</td>
        <td>{{$title[$index]}}</td>
        <td>{{$batch_no[$index]}}</td>
        <td>{{$exp[$index]}}</td>
        <td>{{$qty[$index]}}</td>
        <td>{{$rate[$index]}}</td>
        <td>{{$gst[$index]}}</td>
        <td>{{$discount[$index]}}</td>
        <td>{{$total[$index]}}</td>

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
      <div class="container my-auto">
        <div class="text-center my-auto">
          <span>Thanks for making an order</span>
        </div>
      </div> 
  </div>

</div>