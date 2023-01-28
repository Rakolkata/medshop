@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Product</title>   
@endpush  
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6><span style="border-bottom: 1px solid #4e73df">Add Product</span></h6>
<form action="{{route('admin.store_product')}}" method="post">
    @csrf
    <div class="row">
    <div class="col-md-6 mb-2">
    <label class="form-label">Title</label>
    <input class="form-control" type="text" name="title" placeholder="Enter Product Title">
    </div>
    <div class="col-md-6 mb-2">
    <label class="form-label">SKU</label>
    <input class="form-control" type="text" name="sku" placeholder="Enter Product SKU">
    </div>

    <div class="col-md-6 mb-2">
    <label class="form-label">MRP</label>
    <input class="form-control" type="number" name="mrp" placeholder="Enter Product MRP">
    </div>

    <div class="col-md-6 mb-2">
    <label class="form-label">Price/unit</label>
    <input class="form-control" type="number" name="price" placeholder="Enter Product Price/unit">
    </div>

    <div class="col-md-6 mb-2">
    <label class="form-label">Stock</label>
    <input class="form-control" type="number" name="stock" placeholder="Enter Product Stock">
    </div>

    <div class="col-md-6 mb-2">
    <label class="form-label">Exp date</label>
    <input class="form-control" type="date" name="exp_date" placeholder="Enter Product Exp date">
    </div>

    <div class="col-md-6 mb-2">
    <label class="form-label">Category</label>
    <select class="form-control" name="category" aria-label="Default select example">
        @foreach ($category as $item)
        <option value="{{$item->Categories_id}}">{{$item->Name}}</option>    
        @endforeach
      </select>
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">Company(brand)</label>
        <select class="form-control" name="brand" aria-label="Default select example">
            @foreach ($brand as $item)
            <option value="{{$item->id}}">{{$item->Name}}</option>    
            @endforeach
        </select>
    </div> 

    <div class="col-md-6 mb-2">
        <label class="form-label">Box No.</label>
        <input type="text" class="form-control" name="box_no" placeholder="Enter Product Box No."> 
    </div>

    <div class="col-md-6 mb-2">
        <label class="form-label">Function</label>
        <select class="form-control" name="function" aria-label="Default select example">
            @foreach ($function as $item)
            <option value="{{$item->id}}">{{$item->Name}}</option>    
            @endforeach
        </select>
    </div> 

    <div class="col-md-6 mb-2">
        <label class="form-label">Generic name</label>
        <input type="text" class="form-control" name="generic_name" placeholder="Enter Product Generic name"> 
    </div> 

    <div class="col-md-6 mb-2">
        <label class="form-label">Ingredients</label>
        <input type="text" class="form-control" name="infredients" placeholder="Enter Product Ingredients"> 
    </div> 

    <div class="col-md-6 mb-2">
        <label class="form-label">Schedule</label>
        <select class="form-control" name="schedule" aria-label="Default select example">
            @foreach ($schedule as $item)
            <option value="{{$item->id}}">{{$item->Name}}</option>    
            @endforeach
        </select>
    </div> 

    <div class="col-md-12">
      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <button class="btn mt-2 text-white" style="background-color: #4e73df">Submit</button>
    </div>
    </form>

</div>
@endsection