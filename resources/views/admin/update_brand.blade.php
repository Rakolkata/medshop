@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Brand</title>   
@endpush  
@section('content') 
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6 class="p-2"><span style="border-bottom: 1px solid #4e73df">Update Brand</span> </h6>
<form action="{{route('admin.update_brand',['id'=>$brand->id])}}" method="post">
@csrf
<label>Name</label>
<input type="text" class="form-control" name="name" value="{{$brand->Name}}">
<button class="btn text-white mt-1" style="background-color: #4e73df">Submit</button>
</form>
</div>
@endsection
