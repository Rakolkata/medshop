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
        <select class="form-control form-select-lg" name="" id="">
            <option disabled selected value> -- select an option -- </option>
            @foreach ($Schedule as $item)
            <option value="{{$item->id}}">{{$item->Name}}</option>   
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        
    </div>
    <div class="col-md-6 mt-2">
        <label class="form-label">From</label>
        <input type="date" name="from" class="form-control">
    </div>
    <div class="col-md-6 mt-2">
        <label class="form-label">To</label>
        <input type="date" name="to" class="form-control">
    </div>
</div>


<button class="btn text-white mt-1" style="background-color: #4e73df">Submit</button>
</form>
</div>
</div>
@endsection