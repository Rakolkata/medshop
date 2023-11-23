<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@extends('layouts.admin.app')
@push('title')
<title>Medshop | View-Category</title>
@endpush
@section('content')
@if (\Session::has('message'))
<div class="alert m-2" style=" padding: 10px;background-color: #0c7227;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="#fff" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
  </svg><span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('message') !!}
</div>
@endif

@if (\Session::has('msg-delete'))
<div class="alert m-2" style=" padding: 10px;background-color: #3818c9;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="red" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zm32 224c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32z" />
  </svg>
  <span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('msg-delete') !!}
</div>
@endif

@if (\Session::has('message-updated'))
<div class="alert m-2" style=" padding: 10px;background-color: #0c7227;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="#fff" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
  </svg><span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('message-updated') !!}
</div>
@endif

<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
  <div style="text-align:right">
    <a href="{{route('admin.add_category')}}" class="btn text-white p-1 m-2" style="background-color: #60b5ba">Add Category</a>
  </div>
  <div class="m-2">
    <h5><span style="border-bottom:1px solid #60b5ba">Manage Your Category</span></h5>
  </div>
  <div class="col-md-6">

    <form action="" method="get">
      <div class="input-group flex-nowrap mb-3 p-2" style="background-color: #60b5ba">
        <input type="text" class="form-control" id="search" name="search" placeholder="Name" aria-describedby="basic-addon1">
        <!-- <button style="border:none" id="search"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:20px;">! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc.
            <path fill="#60b5ba" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
          </svg></button> -->
        <a class="btn  text-white" href="" id="reset">Reset</a>
      </div>
    </form>
    <ul id="search-suggestions"></ul>
  </div>
  <table class="table table-striped text-capitalize">
    <thead class="text-white" style="background-color: #60b5ba">
      <tr>
        <th scope="col">#</th>
        <th scope="col">HSN</th>
        <th scope="col">Name</th>
        <th scope="col">Gst Rate</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @if (count($category)>=1)
      @foreach ($category as $item)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$item->HSN}}</td>
        <td>{{$item->Name}}</td>
        <td>{{$item->Gstrate}}</td>
        <td>
          <a href="{{route('admin.delete_category',['id'=>$item->Categories_id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path fill="red" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
            </svg></a>
          <a href="{{route('admin.edit_category',['id'=>$item->Categories_id])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path fill="#60b5ba" d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />
            </svg></a>
        </td>
      </tr>
      @endforeach
      @else
      <tr class="text-center">
        <td colspan="5">{{"Data Not Available"}}</td>
      </tr>
      @endif


    </tbody>
  </table>
  <div class="d-flex">
    {!! $category->links('pagination::bootstrap-5')!!}
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  $(function(){
  $("#search").on('keyup', function(){
     const search = $("#search").val();
    //  console.log(search)
    if(search.length>=3){
      searchs(search);
    }
    function searchs(query) {
      var url = "{{ route('admin.category_search') }}";

    axios.get(url, { 
        params: {
          query: query
        }
      }).then(function(response) {
        $('tbody').empty();
       var tableBody = document.querySelector('tbody');
        $.each(response.data, function(index, item) {
          console.log(item);
          var row = document.createElement('tr');
        
          var indexCell = document.createElement('td');
          indexCell.textContent = index+1;
          row.appendChild( indexCell);

          var hsnCell = document.createElement('td');
          hsnCell.textContent = item.HSN;
          row.appendChild( hsnCell);

          var nameCell = document.createElement('td');
          nameCell.textContent = item.Name;
          row.appendChild( nameCell);

          var gstCell = document.createElement('td');
          gstCell.textContent = item.Gstrate;
          row.appendChild( gstCell);

         

          var id = item.Categories_id;
          var baseurl = "{{route('admin.delete_category',['id'=>':id'])}}";
          var deleteLink = document.createElement('a');
          deleteLink.href = baseurl.replace(':id', id);
          deleteLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->'+
          '<path fill="red" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />'+
          '</svg>';

         
          var id = item.Categories_id;
          var baseurl = "{{route('admin.edit_category',['id'=>':id'])}}";
          var editLink = document.createElement('a');
          editLink.href = baseurl.replace(':id', id);
          editLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->'+
          '<path fill="#60b5ba" d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />'+
          '</svg>';

          var deleteCell = document.createElement('td');
          deleteCell.appendChild(deleteLink);
          
          deleteCell.appendChild(editLink);
          row.appendChild(deleteCell);

         
         

          tableBody.appendChild(row);

        });



      });
    }
    
  });
  });
</script>
@endsection