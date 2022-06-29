<!DOCTYPE html>
<html>
 <head>
 @include('admin/layouts/head')
 <style>
    @media (max-width: 1026px) {
        #brandlogo {
            display: none;
        }
    }
      #navlink{
        font-size: 15px;

      }

    span#navlinkk {
    font-size: 15.4px;
    font-family: 'Open Sans';
    font-family: sans-serif;
    color: #00000080;
    padding: 14px 16px;
}
.sidenav a:hover {
  color:#6666ff ;
}  

</style>
 </head>
<body>
    @include('admin/layouts/leftnavbar')
  <!-- Main content -->
  <div class="main-content">
    @include('admin/layouts/header')
    <!-- Page content -->
      <div class="container-fluid mt--7">
          @section('content')
            @show

      <br><br><br><br><br><br><br><br><br><br><br><br>
      @include('admin/layouts/footer')
</body>

</html>