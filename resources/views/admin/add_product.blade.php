@extends('layouts.admin.app')
@push('title')
<title>Medshop | Add-Product</title>
@endpush
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <h6><span style="border-bottom: 1px solid #60b5ba">Add Product</span></h6>
    <form action="{{route('admin.store_product')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-2">
                <label class="form-label">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Enter Product Title" value="{{ old('title') }}">
                <span class="text-capitalize text-danger">
                    @error('title')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <!-- <div class="col-md-6 mb-2">
                <label class="form-label">Batch No.</label>
                <input class="form-control" type="text" name="sku" placeholder="Enter Product Batch No.">
            </div> -->

            <!-- <div class="col-md-6 mb-2">
                <label class="form-label">MRP</label>
                <input class="form-control" type="number" min="0" step=".01" name="mrp" placeholder="0.00">
            </div> -->

            <!-- <div class="col-md-6 mb-2">
                <label class="form-label">Stock</label>
                <input class="form-control" type="number" min="0" name="stock" value="0" placeholder="Enter Product Stock">
            </div> -->

            <!-- <div class="col-md-6 mb-2">
                <label class="form-label">Exp. date</label>
                <input class="form-control" type="date" name="exp_date" placeholder="Enter Product Exp date">
            </div> -->

            <div class="col-md-6 mb-2">
                <label class="form-label">Category</label>
                <select class="form-control" name="category" aria-label="Default select example">
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($category as $item)
                    <option value="{{$item->Categories_id}}">{{$item->Name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Company(brand)</label>
                <select class="form-control" name="brand" aria-label="Default select example">
                    <option disabled selected value> -- select an option -- </option>
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
                    <option disabled selected value> -- select an option -- </option>
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
                <select class="form-control" name="schedule">
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($schedule as $item)
                    <option value="{{$item->id}}" {{ old('schedule') == $item->id ? "selected" : "" }}>{{$item->Name}}</option>
                    @endforeach
                </select>
                <span class="text-danger text-capitalize">
                    @error('schedule')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <!-- <div class="col-md-6 mb-2">
                <label class="form-label">Trip Size</label>
                <input type="number" name="tripsize" class="form-control" placeholder="Enter Trip Size">
                <span class="text-danger text-capitalize">
                </span> 
            </div> -->

            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>

            <button class="btn mt-2 text-white" style="background-color: #60b5ba">Submit</button>
        </div>
    </form>

</div>
@endsection