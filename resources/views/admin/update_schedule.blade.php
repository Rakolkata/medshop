@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Schedule</title>   
@endpush  
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6 class="p-2"><span style="border-bottom: 1px solid #60b5ba">Update Schedule</span></h6>
<form action="{{route('admin.update_schedule',['id'=>$schedule->id])}}" method="post">
@csrf
<input type="text" class="form-control" name="name" value="{{$schedule->Name}}">
<div class="mt-1">
<button class="btn text-white" style="background-color: #60b5ba">Submit</button>
</div>
</form>
</div>
@endsection