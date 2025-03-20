
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@extends('layouts.admin.app')
@push('title')
<title>Medshop |GST Reports</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #60b5ba">Reports:</span></h5>
    <div class="container">



              


             

    <div class="container">
        <h5 class="card-title">GST Report</h5>
        <div>
            <form action="{{ route('admin.gst_report_export') }}" method="post">
                @csrf
                <input type="hidden" name="data" value="{{$order}}"> 
                <button class="btn text-white mt-1" style="background-color: #60b5ba">Download Report</button>
            </form>
            <br>
            <div>
                <table style="border-collapse: collapse; width: 100%;">
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Invoice No</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Order Date</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Total GST</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Total Amount</td>
                    </tr>

                    @foreach($order as $data)
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px;">{{$data->orderID}}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{$data->created_at}}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{$data->Total_Gst}}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{$data->Total_Order}}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
            <div class="d-flex" id="pagination">
              
            </div>
        </div>
    </div>


              
            

                
            
    </div>
</div>
@endsection


