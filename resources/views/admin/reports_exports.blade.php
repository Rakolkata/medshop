@extends('layouts.admin.app')
@push('title')
<title>Medshop |Reports</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #4e73df">Reports :</span></h5>
    <div class="container">
     <!-- schedule -->
    @if($schedule != 'false')
         <?php
        //    excel_exprot($schedule,'schedule')
           ?>
        <h6>Schedule Report</h6>
        <br>
        <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #4e73df;color:#fff">
        <tr>
            <th>Title</th>
            <th>Exp_Date</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($schedule as $sch)
        <tr>
            <td>{{$sch->Title}}</td>
            <td>{{$sch->Exp_date}}</td>
        </tr>
        @endforeach
        </tbody>
      </table> 
      @else
        <h6></h6>
      @endif
    <!-- exp -->
    @if($exp != 'false')
        <h6>Exp_Date Report</h6>
        <br>
        <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #4e73df;color:#fff">
        <tr>
            <th>Title</th>
            <th>Exp_Date</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($exp as $exp)
        <tr>
            <td>{{$exp->Title}}</td>
            <td>{{$exp->Exp_date}}</td>
        </tr>
        @endforeach
        </tbody>
      </table> 
      @else
        <h6></h6>
      @endif

      <!-- dm -->
    @if($dm != 'false')
        <h6>Daily - Monthly Order Report</h6>
        <br>
        <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #4e73df;color:#fff">
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Order Value</th>
            <th>Total GST</th>
            <th>Discount</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($dm as $dm)
        <tr>
            <td>{{$dm->id}}</td>
            <td>{{$dm->cname}}</td>
            <td>{{$dm->Total_Order}}</td>
            <td>{{$dm->Total_Gst}}</td>
            <td>{{$dm->Discount}}</td>
        </tr>

        @endforeach
        </tbody>
      </table> 
      @else
        <h6></h6>
      @endif
      
    </div>

</div>
@endsection


<?php 
// require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// function excel_exprot($data, $report_type){

// }
?>