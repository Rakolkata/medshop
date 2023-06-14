@extends('layouts.admin.app')
@push('title')
<title>Medshop |Reports</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #4e73df">Reports :</span></h5>
    <div class="container">
        <form action="{{route('admin.reports_exports')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">Select Schedule</label>
                    <select class="form-control form-select-lg" name="schedule" id="">
                        <option  selected value="null"> -- select an option -- </option>
                        @foreach ($sched as $item)
                        <option value="{{$item->id}}">{{$item->Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Expairy Date</label>
                    <input type="date" name="exp_date" class="form-control">
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Monthly - Daily sales</label>
                    <select name="day_month"  class="form-control form-select-lg">
                        <option value=null>--select option --</option>
                        <option value="1">Daily</option>
                        <option value="2">Monthly</option>
                    </select>
                </div>
            </div>
            <button class="btn text-white mt-1" style="background-color: #4e73df">Submit</button>
        </form>
    </div>
</div>

<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #4e73df">Reports  Data:</span></h5>
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
            <th>Stock</th>
            <th>Batch</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($schedule as $sch)
        <tr>
            <td>{{$sch->Title}}</td>
            <td>{{$sch->Exp_date}}</td>
            <td>{{$sch->stock}}</td>
            <td>{{$sch->batch}}</td>
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
            <th>Stock</th>
            <th>Batch</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($exp as $exp)
        <tr>
            <td>{{$exp->Title}}</td>
            <td>{{$exp->Exp_date}}</td>
            <td>{{$exp->stock}}</td>
            <td>{{$exp->batch}}</td>
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