@extends('layouts.app')

@section('content')
<!-- Table -->
<div class="bg-light">
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
         @php $totalAmount=0  @endphp
            @foreach($cartlist as $product)
                <tr data-id="{{ $product->id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{asset('/storage/app').'/'.$product->image}}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $product->gematricName }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{$product->price }}</td>
                    <td data-th="Quantity">
                        <input type="number" min="1" onkeypress="return event.charCode >= 49" onfocusout="updateQuantity(event)" data-value={{$product->id}} value="{{ $product->quantity }}" class="form-control" required/>
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $product->price * $product->quantity }}</td>
                    <td class="actions" data-th="">
                        <a href="{{route('remove.from.cart').'/'.$product->id }}" class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @php $totalAmount=$totalAmount+$product->price * $product->quantity; @endphp
            @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Total ${{$totalAmount}}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ route('shop') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success" onclick="window.location='{{ route('checkout') }}'">Checkout</button>
            </td>
        </tr>
    </tfoot>
</table>
</div>
<script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('public/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('public/js/aos.js') }}"></script>
  <script src="{{ asset('public/js/main.js') }}"></script>

  <script>
  function updateQuantity(e)
  { 
     var itemquantity = e.target.value;
      var productId = e.target.dataset.value;
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    }); 
      $.ajax({
        type:'POST',
        url:"{{ route('update.productQuantity') }}",
        data:{quantity:itemquantity,productid:productId},
        success:function(data){ 
           var obj = JSON.parse(JSON.stringify(data))
         if(obj.success==true)
         {
            location.reload();
            return false;
         }
        },error: function (xhr) {            
        }      
      },"json");
 }
</script>

@endsection