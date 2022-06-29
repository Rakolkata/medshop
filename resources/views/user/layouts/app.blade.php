<!DOCTYPE html>
<html>
 <head>
 @include('user/layouts/head')
  <style>
    @media (max-width: 1026px) {
        #brandlogo {
            display: none;
        }
    }
</style>
 </head>
<body>
    @include('user/layouts/leftnev_bar')
  <!-- Main content -->
  <div class="main-content">
    @include('user/layouts/header')
    <!-- Page content -->
      <div class="container-fluid mt--4">
          @section('content')
            @show
      

      <br><br><br><br><br><br><br><br><br><br>
      @include('user/layouts/footer')
    </div>
</body>

</html>