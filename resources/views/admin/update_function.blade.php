@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Function</title>   
@endpush  
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6 class="p-2"><span style="border-bottom: 1px solid #4e73df">Update Function</span></h6>
<form action="{{route('admin.update_function',['id'=>$function->id])}}" method="post">
@csrf
<input type="text" class="form-control" name="name" value="{{$function->Name}}">
<span class="text-danger text-capitalize">
@error('name')
{{$message}} 
@enderror
</span>
<div>
<button class="btn text-white mt-1" style="background-color:#4e73df">Submit</button>
</div>
</form>
</div>
@endsection