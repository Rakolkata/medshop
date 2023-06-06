@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Category</title>
@endpush
@section('content')
<div class="card m-2 p-2" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <h6><span style="border-bottom:1px solid #4e73df">Update Category</span></h6>
    <form action="{{route('admin.update_category',['id'=>$category->Categories_id ])}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{$category->Name}}">
            </div>
            <div class="col-md-6 pt-2">
                <label class="form-label">HSN</label>
                <input class="form-control" type="text" name="HSN" value="{{$category->HSN}}">
            </div>
            <div class="col-md-6 pt-2">
                <label class="form-label">Gst Rate</label>
                <input class="form-control" type="text" name="gstrate" value="{{$category->Gstrate}}">
            </div>
            <div class="col-md-12 pt-2">
                <label for="" class="form-label">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{$category->description}}</textarea>
            </div>
            <div class="col-md-12 pt-1">
                <button class="btn btn-block text-white mt-1" style="background: #4e73df">Submit</button>
            </div>
        </div>

    </form>
</div>
@endsection