
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('layouts.admin.app')
@push('title')
<title>Medshop |Incoming Invoice</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #60b5ba">Incoming Invoice:</span></h5>
    <div class="container">



              


             

    <div class="container">
        <h5 class="card-title">Incoming Invoice List:</h5>
        <div>
            <div>
                <table style="border-collapse: collapse; width: 100%;" id="value">
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Invoice No</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Order Date</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Total GST</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Total Amount</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Action</td>
                    </tr>
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px;"><input type="text" name="invoice_no" id="invoice_no" placeholder="Enter Invoice No"/></td>
                        <td style="border: 1px solid black; padding: 5px;"><input type="date" name="order_date" id="order_date"/></td>
                        <td style="border: 1px solid black; padding: 5px;"><input type="number" name="total_gst" id="total_gst" placeholder="Enter Total GST "/></td>
                        <td style="border: 1px solid black; padding: 5px;"><input type="number" name="total_amount" id="total_amount" placeholder="Enter Total Amount"/></td>
                        <td style="border: 1px solid black; padding: 5px;"><button type="submit" class="bg-successbtn text-white mt-1" style="background-color: #60b5ba" id="save">save</button></td>
                    </tr>
                   

                </table>
            </div>
            <div class="d-flex" id="pagination">
              
            </div>
        </div>
    </div>


              
            

                
            
    </div>
</div>
@endsection
<script>
    $(function(){
        $( window ).on( "load", function() {
            $.ajax({url: "incoming_invoice_list", success: function(result){
                result.forEach(function( data,index) {
                    let rowId = Date.now();
                    let newRow = $('<tr style="border: 1px solid black;">', {
                    "id": rowId
                    });
                    newRow.append('<td style="border: 1px solid black; padding: 5px;">'+data.invoice_no+'</td><td style="border: 1px solid black; padding: 5px;">'+data.order_date+'</td><td style="border: 1px solid black; padding: 5px;">'+data.total_gst+'</td><td style="border: 1px solid black; padding: 5px;">'+data.total_amount+'</td><td style="border: 1px solid black; padding: 5px;"></td>');
                    $("#value").append(newRow);
                });
            }});
        });

        $('#save').on('click', function () {
    const invoice_id = $('#invoice_no').val();
    const order_date = $('#order_date').val();
    const total_gst = $('#total_gst').val();
    const total_amount = $('#total_amount').val();

    const data = {
        invoice_id: invoice_id,
        order_date: order_date,
        total_gst: total_gst,
        total_amount: total_amount
    };
 
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: 'incoming_invoice_store',
        type: 'POST',
        data: data,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (data) {
                    let rowId = Date.now();
                    let newRow = $('<tr style="border: 1px solid black;">', {
                    "id": rowId
                    });
                    newRow.append('<td style="border: 1px solid black; padding: 5px;">'+data.invoice_id+'</td><td style="border: 1px solid black; padding: 5px;">'+data.order_date+'</td><td style="border: 1px solid black; padding: 5px;">'+data.total_gst+'</td><td style="border: 1px solid black; padding: 5px;">'+data.total_amount+'</td><td style="border: 1px solid black; padding: 5px;"></td>');
                    $("#value").append(newRow);
        },
        error: function (error) {
            console.log(error);
        }
    });
});

    })
</script>

