@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Schedule</title>   
@endpush  
@section('content')

<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6><span style="border-bottom: 1px solid #4e73df">Add Schedule</span></h6>
<form action="{{route('admin.store_schedule')}}" method="post">
@csrf
<label class="form-label">Name</label>
<input class="form-control" type="text" name="name" placeholder="Enter Schedule Name">
<button class="btn btn-block mt-2 text-white" style="background-color: #4e73df">Submit</button>
</form>
</div>
@endsection
