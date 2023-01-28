@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Function</title>   
@endpush  
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <h6 ><span style="border-bottom: 1px solid #4e73df">Add Function</span></h6>
    <form action="{{route('admin.store_function')}}" method="post">
    @csrf
    <label class="form-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Enter Function Name">
    <button class="btn btn-block text-white mt-2" style="background-color:#4e73df">Submit</button>
    </form>
</div>
@endsection