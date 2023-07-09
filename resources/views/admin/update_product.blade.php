@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Product</title>
@endpush
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6 class="p-2"><span style="border-bottom: 1px solid #60b5ba">Update Product</span></h6>

<form action="{{route('admin.update_product',['id'=>$product->id])}}" method="post">

    @csrf
 
    <div class="row">
        <div class="col-md-6 mb-2">
        <label class="form-label">Title</label>
        <input class="form-control" type="text" name="title" placeholder="Enter Product Title" value="{{$product->Title}}">
        </div>
        <!-- <div class="col-md-6 mb-2"> 
        <label class="form-label">Batch No.</label>
        <input class="form-control" type="text" name="bath_no" placeholder="Enter Product Batch No." value="{{$product->SKU}}">
        </div> -->

        <!-- <div class="col-md-6 mb-2">
        <label class="form-label">MRP</label>
        <input class="form-control" type="number" min="0" step=".01"  name="mrp" placeholder="0.00" value="{{$product->MRP}}">
        </div> -->

        <!-- <div class="col-md-6 mb-2">
        <label class="form-label">Price/unit</label>
        <input class="form-control" type="number" min="0" step=".01" name="price" placeholder="0.00" value="{{$product->Price_unit}}">
        </div> -->



        <!-- <div class="col-md-6 mb-2">
        <label class="form-label">Stock</label>
        <input class="form-control" type="number" min="0" name="stock" placeholder="Enter Product Stock" value="{{$product->Stock}}">
        </div> -->

        <!-- <div class="col-md-6 mb-2">
        <label class="form-label">Exp. date</label>
        <input class="form-control" type="date"  name="exp_date"  placeholder="Enter Product Exp date" value="{{$product->Exp_date}}">
        </div> -->

        <div class="col-md-6 mb-2">
        <label class="form-label">Category</label>
        <select class="form-control"  name="category" aria-label="Default select example">
            <option disabled selected value> -- select an option -- </option>
            @foreach ($category as $item)
            <option value="{{$item->Categories_id}}" @selected($product->Categories_id == $item->Categories_id)
                @class([
                'bg-purple-600 text-white' => $product->Categories_id == $item->Categories_id
                ])>{{$item->Name}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Company(brand)</label>
            <select class="form-control" name="brand" aria-label="Default select example">
                <option disabled selected value> -- select an option -- </option>
                @foreach ($brand as $item)
                <option value="{{$item->id}}" @selected($product->Brand == $item->id)
                    @class([
                    'bg-purple-600 text-white' => $product->Brand == $item->id
                    ])>{{$item->Name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Box No.</label>
            <input type="text" class="form-control" name="box_no" value="{{$product->Box_No}}" placeholder="Enter Product Box No.">
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Function</label>
            <select class="form-control" name="function" aria-label="Default select example">
                <option disabled selected value> -- select an option -- </option>
                @foreach ($function as $item)
                <option value="{{$item->id}}" @selected($product->Function == $item->id)
                    @class([
                    'bg-purple-600 text-white' => $product->Function == $item->id
                    ])>{{$item->Name}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Generic name</label>
            <input type="text" class="form-control" name="generic_name" value="{{$product->Generic_name}}" placeholder="Enter Product Generic name">
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Ingredients</label>
            <input type="text" class="form-control" name="ingredients" value="{{$product->Ingredients}}" placeholder="Enter Product Ingredients">
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Schedule</label>
            <select class="form-control" name="schedule" >
                <option disabled selected value> -- select an option -- </option>
                @foreach ($schedule as $item)
                <option value="{{$item->id}}" @selected($product->Schedule == $item->id)
                    @class([
                    'bg-purple-600 text-white' => $product->Schedule == $item->id
                    ])>{{$item->Name}}</option>
                @endforeach
            </select>
            <span class="text-danger text-capitalize">
            @error('schedule')
            {{$message}}
            @enderror
            </span>
        </div>

        <!-- <div class="col-md-6 mb-2">
            <label class="form-label">Pack Size</label>
            <input type="text" class="form-control" name="tripsize"  value="{{$product->TripSize}}"  placeholder="Enter Product Trip-Size">
        </div> -->

        <div class="col-md-12">
          <label for="exampleFormControlTextarea1" class="form-label">Description</label>
          <textarea class="form-control" name="description"  rows="3">{{$product->Description}}</textarea>
        </div>
        <input type="hidden" name="page" value={{Request::get('page')}} />
        <!-- <button class="btn mt-2 text-white" style="background-color: #60b5ba">Submit</button> -->
        </div>

        <div class="container vupdate" style="margin-top:40px" >
    <div class="row">

    <div class="col-2">
        batch
    </div>
    <div class="col-2">
        stock
    </div>
    <div class="col-2">
        expdate
    </div>
    <div class="col-2">
        MRP per unit
    </div>
    <div class="col-2">
        strip
    </div>
    </div>
    <input name="pid" value="{{$product->id}}" type="hidden" />
    @foreach ($product->ProductVeriant as $item)
    <div class="row">
        <input name="vid[]" value="{{$item->id}}" type="hidden" />
    <div class="col-2">
        <input name="batch[]" value="{{$item->batch}}" type="text" />
    </div>
    <div class="col-2">
        <input name="stock[]" value="{{$item->stock}}" type="number"/> 
    </div>
    <div class="col-2">
        <input name="expdate[]" value="{{$item->expdate}}" type="date" />
    </div>
    <div class="col-2">
        <input name="mrp[]" value="{{$item->mrp_per_unit}}" type="number" step="0.1"/>
    </div>
    <div class="col-2">
        <input name="strip[]" value="{{$item->strip}}"  type="number"/>
    </div>
    </div>
    @endforeach
</div>
    <button class="btn mt-2 text-white" style="background-color: #60b5ba">Submit</button>
    <button onclick="return addrow()" >Add new</button>
</form>
</div>
@endsection


<script>
function addrow(){
    let html= '<div class="row">'
        +'<div class="col-2">'
            +'<input name="batch[]" value=" " type="text" />'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="stock[]" value=" " type="number"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="expdate[]" value=" " type="date" />'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="mrp[]" value="  " type="number" step=".1"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="strip[]" value=" "  type="number"/>'
        +'</div>'
        +'</div>';
    jQuery('.vupdate').append(html);
    return false;
}
</script>
