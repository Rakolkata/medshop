@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Category</title>
@endpush
@section('content')
<div class="card m-2 p-2" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
   <h6><span class="ps-1 pe-1" style="border-bottom:1px solid #60b5ba">Add Category</span> </h6>
   <form action="{{route('admin.store_category')}}" method="post">
      @csrf

      <div class="row">
         <div class="col-md-12">
            <label class="form-label">Name </label>
            <input type="text" class="form-control" name="name" placeholder="Enter Category Name">
            <span class="text-danger text-capitalize">
               @error('name')
               {{$message}}
               @enderror
            </span>
         </div>
         <div class="col-md-6 pt-2">
            <label>HSN</label>
            <input class="form-control" name="HSN" type="text">
         </div>
         <div class="col-md-6 pt-2">
            <label>GST Rate</label>
            <input type="text" name="gst_rate" class="form-control">
         </div>
         <div class="col-md-12 pt-2">
            <label for="" class="form-label">Description</label>
            <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
         </div>

         <div class="col-md-12">
            <button class="btn btn-block mt-2 text-white" style="background-color: #60b5ba">Submit</button>
         </div>
      </div>


   </form>
</div>
@endsection