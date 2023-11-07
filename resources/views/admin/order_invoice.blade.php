<div>

    <div class="col-md-12" style="border-bottom: 1px solid">
        <table style="width: 100%">
            <tr>
                <td style="text-align: left">
                    <h5 class="text-capitalize ">{{ env('APP_NAME') }}</h5>
                </td>
                <td style="text-align: right">
                    <address>
                      {{ env('APP_ADDRESS') }}<br>
                      {{ env('APP_GST') }}<br>
                    </address>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-12" style="border-bottom: 1px solid">
        <table style="width: 100%">
            <tr>
                <td style="text-align: left">
                    <ul style="list-style-type: none; padding-left: 0px">
                        <li id="patient_name">Patient Name : {{ $coustomer_name }}</li>
                        <li>Address : {{ $customer_address }}</li>
                    </ul>
                </td>
                <td style="text-align: right">
                 
                        <h5 class="text-capitalize">Tax Invoice <br>{!! $order_id !!}</h5>
                 
                </td>
            </tr>
        </table>
    </div>



    <div class="col-md-6 p-1" style="border-bottom: 1px dashed">
        <p>Doctor Name/Regd. no. : {{ $doc_name_regdno }}</p>
    </div>

    <div class="col-md-12">
      <table style="width: 100%">
            <thead>
                <tr>
                    <th scope="col" style="width:30px">#</th>
                    <th scope="col" style="width:150px;">Description</th>
                    <th scope="col" style="width:92px;">Batch No.</th>
                    <th scope="col" style="width:70px">Expiry</th>
                    <th scope="col" style="width:70px">Qty</th>
                    <th scope="col" style="width:70px">Rate</th>
                    <th scope="col" style="width:70px">Gst</th>
                    <th scope="col" style="width:70px">Discount</th>
                    <th scope="col" style="width:70px">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($id as $index => $value)
                    <tr>
                        <td style="text-align: center">{{ $index + 1 }}</td>
                        <td style="text-align: center;padding-left:15px">{{ $title[$index] }}</td>
                        <td style="text-align: center">{{ $batch_no[$index] }}</td>
                        <td style="text-align: center; padding-left:20px">{{ $exp[$index] }}</td>
                        <td style="text-align: center">{{ $qty[$index] }}</td>
                        <td style="text-align: center">{{ $rate[$index] }}</td>
                        <td style="text-align: center">{{ $gst[$index] }}</td>
                        <td style="text-align: center">{{ $discount[$index] }}</td>
                        <td style="text-align: center">{{ $total[$index] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right">
            <ul style="list-style-type: none">
                <li>Total Discount : {{ sprintf('%.2f', $total_discount) }}</li>
                <li>Sub Total : {{ sprintf('%.2f', $total_taxable_amount) }}</li>
                <li>Total GST : {{ sprintf('%.2f', $total_gst) }}</li>
                <li>Round Off : {{ sprintf('%.2f', $round_off) }}</li>
                <li>Grand Total : {{ sprintf('%.2f', $grand_total) }}</li>
            </ul>
        </div>
        <div style="text-align: center">
            <span style="">Thanks for making an order</span>
        </div>
    </div>

</div>

</div>
