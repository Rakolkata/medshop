@extends('layouts.admin.app')
@push('title')
<title>Medshop |Order Details</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
  <div style="text-align: right">
    <a href="{{route('admin.order_view')}}" class="btn text-white" style="background-color: #4e73df">Back</a>
  </div>
  <h6 class="p-2"><span style="border-bottom:1px solid #4e73df">Order Details</span></h6>

  <table class="table table-striped table-responsive-sm">
    <thead style="background-color: #4e73df;color:#fff">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Product</th>
        <th scope="col">Rate</th>
        <th scope="col">Quantity</th>
        <th scope="col">Gst</th>
        <th scope="col">Total</th>
        <th scope="col">Order Status</th>
        <th scope="col">Cancle Order ?</th>
      </tr>
    </thead>
    <tbody class="text-capitalize">
      @foreach ($order_details as $item)
      <!-- model start -->
      <div id="myModel" class="modal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cancle Order</h5>
            </div>
            <div class="modal-body">
              <div>
                Want to cancle this order ?
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" id="deleteButton" onclick="closeModel()" class="btn btn-danger text-white">Close</button>
              <a href="{{ route('order_cancle',$item->Product_id) }}" class="btn btn-success">Cancle Order</a>
            </div>
          </div>
        </div>
      </div>
      <!-- model end -->
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$item->products->pluck('Title')[0]}}</td>
        <td>{{sprintf("%.2f",$item->rate)}}</td>
        <td>{{$item->qty}}</td>
        <td>{{$item->gst}}</td>
        <td>{{$item->Product_price}}</td>
        <td><a href="{{ route('cahnge_status', $item->Product_id) }}" class="btn btn-primary">{{ $item->status }}</a></td>
        <td> <a class="btn btn-danger" onclick="togglemodel()">Cancle Order</a></td>
        <!-- <td><a href="{{ route('order_cancle',$item->Product_id) }}" class="btn btn-success">Cancle Order</a></td> -->
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<script type="text/javascript">
  function togglemodel() {
    let mod = document.getElementById('myModel').style.display = "block"
  }

  function closeModel() {
    let clos = document.getElementById('myModel').style.display = "none"
  }
</script>

@endsection