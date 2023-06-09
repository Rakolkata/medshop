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
      </tr>
    </thead>
    <tbody class="text-capitalize">
    @foreach ($order_details as $item)
    <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$item->products->pluck('Title')[0]}}</td>
        <td>{{sprintf("%.2f",$item->rate)}}</td>
        <td>{{$item->qty}}</td>
        <td>{{$item->gst}}</td>
        <td>{{$item->Product_price}}</td>
        <td><a href="{{ route('cahnge_status', $item->Product_id) }}">{{ $item->status }}</a></td>
      </tr>   
    @endforeach
    </tbody>
  </table>
</div>
@endsection