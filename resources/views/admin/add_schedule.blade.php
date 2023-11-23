<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Schedule</title>   
@endpush  
@section('content')

<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6><span style="border-bottom: 1px solid #60b5ba">Add Schedule</span></h6>
<form action="{{route('admin.store_schedule')}}" method="post">
@csrf
<label class="form-label">Name</label>
<input class="form-control" type="text" name="name" placeholder="Enter Schedule Name">
<span class="text-danger Text-capitalize">
@error('name')
{{$message}}  
@enderror
</span>
<button class="btn btn-block mt-2 text-white" style="background-color: #60b5ba">Submit</button>
</form>
</div>
@endsection
