@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Category</title>   
@endpush  
@section('content')
<div class="card m-2 p-2" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6 ><span class="ps-1 pe-1" style="border-bottom:1px solid #4e73df">Add Category</span> </h6>
<form action="{{route('admin.store_category')}}" method="post">
   @csrf
   <label class="form-label">Name </label> 
   <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
   <span class="text-danger text-capitalize">
      @error('name')
      {{$message}}
      @enderror
    </span>
   <button class="btn btn-block mt-2 text-white" style="background-color: #4e73df">Submit</button>
</form>
</div>
@endsection