@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Category</title>   
@endpush  
@section('content')
<div class="card m-2 p-2" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6><span style="border-bottom:1px solid #4e73df">Update Category</span></h6>
<form action="{{route('admin.update_category',['id'=>$category->Categories_id ])}}" method="post">
@csrf
<label class="form-label">Name</label>
<input class="form-control" type="text" name="name" value="{{$category->Name}}">
<button class="btn btn-block text-white mt-1" style="background: #4e73df">Submit</button>
</form>
</div>
@endsection