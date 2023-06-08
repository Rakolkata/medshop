
@extends('layouts.admin.app')
@push('title')
<title>Medshop | Update-Product  of {{ $product->Title}}</title>
@endpush
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
<h6 class="p-2"><span style="border-bottom: 1px solid #4e73df">Update Product of {{ $product->Title}}</span></h6>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('admin.update_product_veriant_save',['id'=>$product->id])}}" method="post">
<div class="container vupdate" >
    @csrf
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
    <button class="btn mt-2 text-white" style="background-color: #4e73df">Submit</button>
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
