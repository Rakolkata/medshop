<!--<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->
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
                    
                    <option value="{{$item->Categories_id}}">{{$item->HSN."-".$item->Gstrate."-".$item->Name}}</option>
                    @endforeach
                </select>
                

            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Company(brand)</label>
                <!-- <select class="form-control" name="brand" aria-label="Default select example">
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($brand as $item)
                    <option value="{{$item->id}}">{{$item->Name}}</option>
                    @endforeach
                </select> -->
                <input  class="form-control" type="text" name="brand" placeholder="Enter or search Product brand" id="brand">
                <input hidden type="number" id="brand_id" name="brand_id">
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Box No.</label>
                <input type="text" class="form-control" name="box_no" placeholder="Enter Product Box No.">
            </div>

            <div class="col-md-6 mb-2">
                <label class="form-label">Function</label>
                <!-- <select class="form-control" name="function" aria-label="Default select example">
                    <option disabled selected value> -- select an option -- </option>
                    @foreach ($function as $item)
                    <option value="{{$item->id}}">{{$item->Name}}</option>
                    @endforeach
                </select> -->
                <input  class="form-control" type="text" name="function" placeholder="Enter or search Product function" id="function">
                <input hidden type="number" id="function_id" name="function_id">
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
              <!--
                <div class="col-md-6 mb-2">
                <label class="form-label">Pack Size</label>
                <input type="number" name="packsize" class="form-control" placeholder="Enter Pack Size">
                <span class="text-danger text-capitalize">
                </span> 
            </div> 
             -->
            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>

            <!-- <button class="btn mt-2 text-white" style="background-color: #60b5ba">Submit</button> -->
        </div>
        <div class="container" style="margin-top:40px" >
    <div class="row" style="flex-wrap: nowrap">

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
        Pack Size
    </div>
    <div class="col-2">
        Rate per price
    </div>
    <div class="col-2">
        Remarks
    </div>
    </div>
   
    <div class="row" style="margin-bottom: 10px; flex-wrap: nowrap">
    <input name="vid[]" type="hidden" />
    <div class="col-2">
        <input name="batch[]" type="text" required />
    </div>
    <div class="col-2">
        <input name="stock[]" type="number" required />
    </div>
    <div class="col-2">
        <input name="expdate[]" type="date" required min="{{ now()->format('Y-m-d') }}"/>
    </div>
    <div class="col-2">
        <input name="mrp[]" type="number" class="mrp_per_unit" min="1" step="any" required />
    </div>
    <div class="col-2">
        <input name="strip[]" type="number" class="pack_size" required />
    </div>
    <div class="col-2">
    <input name="rate[]" type="number" min="1" step="any" class="medicine_rate" required />
    </div>
    <div class="col-2">
    <input name="remarks[]" type="text"  class="remarks" required />
    </div>

</div>

   
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
            +'<input name="batch[]" value=" " type="text" />'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="stock[]" value=" " type="number"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="expdate[]" value=" " type="date" min="{{ now()->format('Y-m-d') }}"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="mrp[]" value="  " class="mrp_per_unit" type="number" step=".1"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="strip[]" value=" " class="pack_size" type="number"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="rate[]" value=" " min="1" step="any" class="medicine_rate" type="number"/>'
        +'</div>'
        +'<div class="col-2">'
            +'<input name="remarks[]" value=" "  class="remarks" type="text"/>'
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
<style>

    
</style>