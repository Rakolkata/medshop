<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Brand</title>   
@endpush  
@section('content')
<h6 ><span style="border-bottom: 1px solid #60b5ba">Add Brand</span></h6>
<form action="{{route('admin.store_brand')}}" method="post">
@csrf
<label class="form-label">Name</label>
<input type="text" class="form-control" name="name" placeholder="Enter Brand Name">
<span class="text-capitalize text-danger">
@error('name')
{{$message}}    
@enderror
</span>
<button class="btn btn-block text-white mt-2" style="background-color:#60b5ba">Submit</button>
</form>
@endsection