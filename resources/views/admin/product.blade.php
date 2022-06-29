<!DOCTYPE html>
<html>
 <head>
  {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/user/css/tbl.css?v=1.0.0')}}"> --}}
 <link href="{{ asset('public/css/datatables.bootstrap.css') }}" rel="stylesheet">
 @include('admin/layouts/head')
 @include('admin/layouts/masterhead')
 </head>
<body onload="OnloadFun()">
     @include('admin/layouts/leftnavbar')
  <!-- Main content -->
  <div class="main-content">
    
    @include('admin/layouts/ProfileHeader')
    <!-- Page content -->
      <div class="container-fluid mt--7">
         
      <div class="row" style="padding-top:110px;">
       <div class="col">
          <div class="card shadow">
              
            <div class="card-header border-0">
              <div class="row" id="demo">
                 <div class="col-md-12">
                  <div class="container">
                    <form method="post" id="updaterecord" action="{{ route('product.index') }}">
                      @csrf
                       <h4 style="text-align:center;color:#000033;">Add Product</h4>
                   <div class="row jumbotron"style="padding:5px">
                   <input type="hidden" name="id"  id="id" value="">
                   <div class="col-sm-4">
                     <label for="gematricname">Gematric Name<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="gematricName" required placeholder="Enter Gematric Name">
                   </div>
                   <div class="col-sm-4">
                     <label for="brand">Brand<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="brand" required placeholder="Enter  brand name">
                   </div>
                  <div class="col-sm-4">
                   <label for="tilte">Title<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="title" required placeholder="Enter title">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="stock">Stock<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="stock" required placeholder="Enter stock">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="qnty">Quantity<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="qnty" required placeholder="Enter qnty">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="price">Price<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="price" required placeholder="Enter price">
                      
                  </div>
                  <div class="col-sm-4">
                   <label for="sellPrice"> Sell Price<span style="color:red;">*</span></label>
                     <input  type="text"  id=""  class="typeahead  form-control form-control"  name="sellPrice" required placeholder="Enter  Selling price">
                      
                  </div>
                  <div class="col-sm-4">
                      <label for="description">Description</label>
                      <input type="text" id="desc" class="form-control" name="description" placeholder="Enter description">
                  </div>
                   <div class="col-sm-2 form-inline" style="padding-top:40px;">
                   <input type="checkbox" id="status" name="status" value="true" checked><span>Status</span>
                      </div>
                     <div  class="col-sm-2 form-inline" style="padding-top:30px;">
                       <div class="row">
                      <div class="col-sm-2">
                       <button type="submit"name="send" id="submitbtn" value="Submit" class="btn btn-primary btn btn-sm">Save</button>
                      </div>
                      <div class="col-sm-4-half">
                       <!--a id="Update"  class="btn btn-danger btn btn-sm ">Update</a>
                       </div>
                       <div class="col-sm-4">
                       <a id="cancel" href="#" class="btn btn-success  btn btn-sm">Cancel</a>
                       </div--->
                       </div>
                     </div>
                  </div>
              </form>
              </div>
            </div>
          </div>
  