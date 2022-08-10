@extends('layouts.app')

@section('content')
<!-- Table -->
 @if (Session::has('success'))
    <div class="py-2">
        <div class="row">
          <div class="col-md-12 mb-0" style="background-color: #b9dded;">
                <span class="mx-2 mb-0"> <h4 class="text-success">{{ Session::get('success') }}</h4></span>
          </div>
      </div>
    </div>  
    @endif
<div class="bg-light">    
    <div class="py-2">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{ route('welcome') }}">Home</a>
                <span class="mx-2 mb-0">/</span> <strong class="text-black">Store</strong>
          </div>
        </div>
      </div>
    </div>    
<div class="row">
    @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="content-bg">
                <img src="{{asset('/storage/app').'/'.$product->image }}" alt="">
                <div class="caption" style="text-align:center; padding-top:0px;">
                    <h4>{{ $product->gematricName }}</h4>
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
    @endforeach
  </div>
</div> 
  <script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('public/js/popper.min.js') }}"></script>
  <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('public/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('public/js/aos.js') }}"></script>
  <script src="{{ asset('public/js/main.js') }}"></script>
@endsection