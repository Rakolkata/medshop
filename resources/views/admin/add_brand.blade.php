@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Brand</title>   
@endpush  
@section('content')
<h6 ><span style="border-bottom: 1px solid #4e73df">Add Brand</span></h6>
<form action="{{route('admin.store_brand')}}" method="post">
@csrf
<label class="form-label">Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Brand Name">
<span class="text-capitalize text-danger">
@error('name')
{{$message}}    
@enderror
</span>
<button class="btn btn-block text-white mt-2" style="background-color:#4e73df">Submit</button>
</form>
@endsection