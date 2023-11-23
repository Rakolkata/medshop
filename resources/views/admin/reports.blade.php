
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
                        @foreach ($Schedule as $item)
                        <option value="{{$item->id}}">{{$item->Name}}</option>
                        @endforeach
                    </select>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Expiry Date</label>
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
@endsection

