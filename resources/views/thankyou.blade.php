   @extends('layouts.app')

   @section('content')
   <!-- Table -->
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{ route('welcome') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong
              class="text-black">Thank You</strong></div>
        </div>
      </div>
    </div>
    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-primary"></span>
            <h2 class="display-3 text-black">Thank you!</h2>
            <p class="lead mb-5">You order was successfuly completed.</p>
            <p><a href="{{ route('shop') }}" class="btn btn-md height-auto px-4 py-3 btn-primary">Back to store</a></p>
          </div>
        </div>
      </div>
    </div>
    
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>

@endsection