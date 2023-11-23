<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@extends('layouts.admin.app')
@push('title')
<title>Medshop |Reports</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #60b5ba">Reports :</span></h5>
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
            <button class="btn text-white mt-1" style="background-color: #60b5ba">Filter</button>
        </form>
    </div>
</div>

<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #60b5ba">Reports  Data:</span></h5>
    <div class="container">
     
    @if($schedule != 'false')
         
        <h6>Order Report</h6><form action="{{route('admin.reports_exports_excel')}}" method="post">
        @csrf
        <input type="hidden" name="data" value="{{ $schedule }}">
        <input type="hidden" name="report_type" value="schedule">
        <button class="btn text-white mt-1" style="background-color: #60b5ba">Download Report</button></form>
        <br>
        <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #60b5ba;color:#fff">
        <tr>
            <th>Title</th>
            <th>Exp_Date</th>
            <th>Stock</th>
            <th>Batch</th>
            <th>Invoice No</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($schedule as $sch)
        <tr>
            <td>{{$sch->Title}}</td>
            <td>{{$sch->expdate}}</td>
            <td>{{$sch->stock}}</td>
            <td>{{$sch->batch}}</td>
            <td>{{$sch->orderID}}</td>
        </tr>
        @endforeach
        </tbody>

      </table> 
     
        
      @else
        <h6></h6>
      @endif
      
    
    @if($exp != 'false')
        <h6>Order Report</h6><form action="{{route('admin.reports_exports_excel')}}" method="post">
        @csrf
        <input type="hidden" name="data" value="{{ $exp }}">
        <input type="hidden" name="report_type" value="exp">
        <button class="btn text-white mt-1" style="background-color: #60b5ba">Download Report</button></form>
        <br>
        <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #60b5ba;color:#fff">
        <tr>
            <th>Title</th>
            <th>Exp_Date</th>
            <th>Stock</th>
            <th>Batch</th>
            <th>Invoice No</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($exp as $exp)
        <tr>
            <td>{{$exp->Title}}</td>
            <td>{{$exp->expdate}}</td>
            <td>{{$exp->stock}}</td>
            <td>{{$exp->batch}}</td>
            <td>{{$exp->orderID}}</td>
        </tr>
        @endforeach
        </tbody>
      </table> 
      
      @else
        <h6></h6>
      @endif

      
    @if($dm != 'false')
        <h6> Order Report</h6><form action="{{route('admin.reports_exports_excel')}}" method="post">
        @csrf
        <input type="hidden" name="data" value="{{ $dm }}">
        <input type="hidden" name="report_type" value="dm">
        <button class="btn text-white mt-1" style="background-color: #60b5ba">Download Report</button></form>
        <br>
        <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #60b5ba;color:#fff">
    <tr>
            <th>Title</th>
            <th>Exp_Date</th>
            <th>Stock</th>
            <th>Batch</th>
            <th>Invoice No</th>
        </tr>
     </thead>
     <tbody class="text-capitalize" id="order">
        @foreach ($dm as $dm)
        <tr>
            <td>{{$dm->Title}}</td>
            <td>{{$dm->expdate}}</td>
            <td>{{$dm->stock}}</td>
            <td>{{$dm->batch}}</td>
            <td>{{$dm->orderID}}</td>
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



