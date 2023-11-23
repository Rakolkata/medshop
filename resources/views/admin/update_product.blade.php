<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
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
        <select class="form-control"  name="category" aria-label="Default select example" id="category">
            <option disabled selected value> -- select an option -- </option>
            @foreach ($category as $item)
            <option value="{{$item->Categories_id}}" @selected($product->Categories_id == $item->Categories_id)
                @class([
                'bg-purple-600 text-white' => $product->Categories_id == $item->Categories_id
                ])>{{$item->HSN."-".$item->Gstrate."-".$item->Name}}</option>
            @endforeach
        </select>
   
                
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Company(brand)</label>
            <!-- <select class="form-control" name="brand" aria-label="Default select example">
                <option disabled selected value> -- select an option -- </option>
                @foreach ($brand as $item)
                <option value="{{$item->id}}" @selected($product->Brand == $item->id)
                    @class([
                    'bg-purple-600 text-white' => $product->Brand == $item->id
                    ])>{{$item->Name}}</option>
                @endforeach
            </select> -->
            <input  class="form-control" type="text" name="brand" placeholder="Enter or search Product brand" id="brand" value="{{$item->Name}}">
                <input hidden type="number" id="brand_id" name="brand_id" value="{{$item->id}}">
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Box No.</label>
            <input type="text" class="form-control" name="box_no" value="{{$product->Box_No}}" placeholder="Enter Product Box No.">
        </div>

        <div class="col-md-6 mb-2">
            <label class="form-label">Function</label>
            <!-- <select class="form-control" name="function" aria-label="Default select example">
                <option disabled selected value> -- select an option -- </option>
                @foreach ($function as $item)
                <option value="{{$item->id}}" @selected($product->Function == $item->id)
                    @class([
                    'bg-purple-600 text-white' => $product->Function == $item->id
                    ])>{{$item->Name}}</option>
                @endforeach
            </select> -->
            <input  class="form-control" type="text" name="function" placeholder="Enter or search Product function" id="function" value="{{$item->Name}}">
                <input hidden type="number" id="function_id" name="function_id" value="{{$item->id}}">
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
        <!--
        <div class="col-md-6 mb-2">
            <label class="form-label">Pack Size</label>
            <input type="text" class="form-control" name="packsize"  value="{{$product->TripSize}}"  placeholder="Enter Product Pack-Size">
        </div> 
        -->
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
        Batch
    </div>
    <div class="col-2">
        Stock
    </div>
    <div class="col-2">
        Expdate
    </div>
    <div class="col-2">
        MRP
    </div>
    <div class="col-2">
        PackSize
    </div>
    <div class="col-2">
        Rate per price
    </div>
    <div class="col-2">
        Remarks
    </div>
    </div>
    <input name="pid" value="{{$product->id}}" type="hidden" />
    @foreach ($product->ProductVeriant as $item)
    <div class="row" style="margin-bottom: 10px">
        <input name="vid[]" value="{{$item->id}}" type="hidden" />
    <div class="col-2">
        <input name="batch[]" value="{{$item->batch}}" type="text" />
    </div>
    <div class="col-2">
        <input name="stock[]" value="{{$item->stock}}" type="number"/> 
    </div>
    <div class="col-2">
        <input name="expdate[]" value="{{$item->expdate}}" type="date" min="{{ now()->format('Y-m-d') }}"/>
    </div>
    <div class="col-2">
        <input name="mrp[]" value="{{$item->mrp_per_unit}}" class="mrp_per_unit" min="1" step="any" type="number" />
    </div>
    <div class="col-2">
        <input name="strip[]" value="{{$item->strip}}" class="pack_size"  type="number"/>
    </div>
    <div class="col-2">
        <input name="rate[]" value="{{$item->rate}}" min="1" class="medicine_rate" step="any"  type="number"/>
    </div>
    <div class="col-2">
        <input name="remarks[]" value="{{$item->remarks}}" class="remarks"   type="text"/>
    </div>
    </div>
    @endforeach
</div>
    <button class="btn mt-2 text-white" style="background-color: #60b5ba">Submit</button>
    <button onclick="return addrow()" class="btn mt-2 text-white" style="background-color: #60b5ba">Add new</button>
</form>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

<script>
function addrow(){
    let html= '<div class="row" style="margin-bottom: 10px">'
        +'<div class="col-2">'
            +'<input name="batch[]" value=" " type="text" requi/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="stock[]" value=" " type="number"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="expdate[]" value=" " type="date" min="{{ now()->format('Y-m-d') }}"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="mrp[]" value=""  min="1" step="any" class="mrp_per_unit" type="number" step=".1"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="strip[]" value=" "  type="number" class="pack_size"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="rate[]" value=" " min="1" step="any" class="medicine_rate" type="number"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="remarks[]" value=" " class="remarks" type="text"/>'
        +'</div>'
        +'</div>';
    jQuery('.vupdate').append(html);
    return false;
}
</script>
<script>
     $(function() {
        jQuery("#brand").on('keydown', function(event) {
            if (event.keyCode === 8) {
                $("#brand_id").val(null);
            }
        });

        jQuery("#brand").autocomplete({
      source: "{{ route('admin.brand_data') }}",
      dataType: "json",
      minLength: 2,
      select: function(event, ui) {
        $("#brand_id").val(ui.item.id);
      }
     });
});
 
</script>
<script>
     $(function() {
        jQuery("#function").on('keydown', function(event) {
            if (event.keyCode === 8) {
                $("#function_id").val(null);
            }
        });
        
        jQuery("#function").autocomplete({
      source: "{{ route('admin.function_data') }}",
      dataType: "json",
      minLength: 2,
      select: function(event, ui) {
        $("#function_id").val(ui.item.id);
      }
     });

     $(document).on("input",'.mrp_per_unit',function(e){
        var rate =calculateRate($(this).val(), $(this).parent().next().children().val())
        $(this).val(), $(this).parent().next().next().children().val(rate)
        }); 

    $(document).on("input",'.pack_size',function(e){
    var rate =calculateRate($(this).parent().prev().children().val(), $(this).val())
    $(this).val(), $(this).parent().next().children().val(rate)
    }); 

    function calculateRate(mrp, packSize) {
        var num = mrp/packSize;
        return num.toFixed(2);
    }
});
 
</script>
<script>
    $(function(){
     $("#category").on("click",function(){
          console.log("clicked")
     });
    });
</script>