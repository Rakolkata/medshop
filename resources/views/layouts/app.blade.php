<!DOCTYPE html>
<html>
 <head>
 @include('layouts/head')
 </head>
<body>
  <!-- Main content -->
  <div class="main-content">
    @include('layouts/header')
    <!-- Page content -->
      <div class="container-fluid mt--7">
          @section('content')
            @show

        @include('layouts/footer')
      </div>
    
</body>

</html>