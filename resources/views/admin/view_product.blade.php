@extends('layouts.admin.app')
@push('title')
<title>Medshop | view-Product</title>
@endpush
@section('content')
@if (\Session::has('import_success'))
<div class="alert m-2" style=" padding: 10px;background-color: #0c7227;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="#fff" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
  </svg><span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('import_success') !!}
</div>
@endif
@if (\Session::has('error'))
<div class="alert m-2" style=" padding: 10px;background-color: #db4a10;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="#fff" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
  </svg><span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('error') !!}
</div>
@endif
@if (\Session::has('msg'))
<div class="alert m-2" style=" padding: 10px;background-color: #0c7227;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="#fff" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z" />
  </svg><span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
  color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('msg') !!}
</div>
@endif
@if (\Session::has('msg-deleted'))
<div class="alert m-2" style=" padding: 10px;background-color: #0c7227;color: white;margin-bottom: 15px;">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="height: 20px;width:20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
    <path fill="red" d="M256 512c141.4 0 256-114.6 256-256S397.4 0 256 0S0 114.6 0 256S114.6 512 256 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zm32 224c0 17.7-14.3 32-32 32s-32-14.3-32-32s14.3-32 32-32s32 14.3 32 32z" />
  </svg>
  <span class="closebtn" onclick="this.parentElement.style.display='none';" style=" margin-left: 15px;
    color: white;font-weight: bold;float: right;font-size: 22px;line-height: 20px;cursor: pointer;transition: 0.3s;">&times;</span>
  {!! \Session::get('msg-deleted') !!}
</div>
@endif
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">

  <div style="text-align:right">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Import Excel
    </button>
    <a href="{{route('admin.add_product')}}" class="btn text-white p-1 m-2" style="background-color: #60b5ba">Add Product</a>
  </div>
  <div class="mb-2">
    <h5><span style="border-bottom:1px solid #60b5ba">Manage Your Product</span></h5>
  </div>
  <div class="col-md-6">

    <form action="" method="get">
      <div class="input-group flex-nowrap mb-3 p-2" style="background-color: #60b5ba">
        <input type="text" class="form-control" id="search-input" name="search" placeholder="Title, Genericname, Ingerediant, Function" aria-describedby="basic-addon1">
        <button style="border:none"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width:20px;"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path fill="#60b5ba" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
          </svg></button>
        <a class="btn  text-white" href="{{route('admin.view_product')}}">Reset</a>
      </div>
    </form>
    <ul id="search-suggestions"></ul>
  </div>

  <table class="table table-striped text-capitalize table-responsive-sm" style="width:100%">
    <thead class="text-white" style="background-color: #60b5ba">
      <tr>
        <th scope="col">Title</th>
        <th scope="col">MRP</th>
        <th scope="col">Box</th>
        <th scope="col">Price Per unit</th>
        <th scope="col">Stock</th>
        <th scope="col">Exp. Date</th>
        <th scope="col">Category</th>
        <th scope="col">Brand</th>
        <th scope="col">Function</th>
        <th scope="col">Schedule</th>
        <th scope="col">TripSize</th>
        <th scope="col" colspan="3">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if (count($product)>=1)
      @foreach ($product as $item)
      <tr>
        <td>{{$item->Title}}</td>
        <td>{{$item->MRP}}</td>
        <td>{{$item->Box_No}}</td>
        <td>{{$item->Price_unit}}</td>
        <td>{{$item->Stock}}</td>
        <td>{{$item->Exp_date}}</td>
        <td>
          @if (count($item->category->pluck('Name'))>=1)
          {{$item->category->pluck('Name')[0]}}
          @endif
        </td>
        <td>
          @if (count($item->brand->pluck('Name'))>=1)
          {{$item->brand->pluck('Name')[0]}}
          @endif
        </td>
        <td>
          @if (count($item->function->pluck('Name'))>=1)
          {{$item->function->pluck('Name')[0]}}
          @endif
        </td>
        <td>
          @if (count($item->schedule->pluck('Name'))>=1)
          {{$item->schedule->pluck('Name')[0]}}
          @endif
        </td>
        <td>
          {{$item->TripSize}}
        </td>

        <td>
          <a href="{{route('admin.edit_product',['id'=>$item->id,'page'=>$product->currentpage()])}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
              <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
            </svg>Edit Product</a>

        </td>

        <!-- <td>
          <a href="{{route('admin.update_product_veriant',['id'=>$item->id,'page'=>$product->currentpage()])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="height: 20px">
              <path fill="#60b5ba" d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V285.7l-86.8 86.8c-10.3 10.3-17.5 23.1-21 37.2l-18.7 74.9c-2.3 9.2-1.8 18.8 1.3 27.5H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128zM549.8 235.7l14.4 14.4c15.6 15.6 15.6 40.9 0 56.6l-29.4 29.4-71-71 29.4-29.4c15.6-15.6 40.9-15.6 56.6 0zM311.9 417L441.1 287.8l71 71L382.9 487.9c-4.1 4.1-9.2 7-14.9 8.4l-60.1 15c-5.5 1.4-11.2-.2-15.2-4.2s-5.6-9.7-4.2-15.2l15-60.1c1.4-5.6 4.3-10.8 8.4-14.9z" />
            </svg>Edit stock</a>
        </td> -->
        <td>
          <a href="{{route('admin.delete_product',['id'=>$item->id,'page'=>$product->currentpage()])}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path fill="red" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
            </svg></a>

        </td>
      </tr>
      @endforeach
      @else
      <tr class="text-center">
        <td colspan="12">{{"Data Not Available"}}</td>
      </tr>
      @endif
    </tbody>
  </table>
  <div class="d-flex">
    {!! $product->links('pagination::bootstrap-5')!!}
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="border: none">x</button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.product_exel_import')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="" class="form-label">Choose file</label>
            <input type="file" class="form-control" name="uploaded_file" id="" placeholder="" aria-describedby="fileHelpId">
            <div id="fileHelpId" class="form-text text-warning">
              <p>Only Upload Excel File</p>
            </div>
          </div>
          <div style="text-align: right">
            <button class="btn text-white" style="background: #60b5ba">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  var searchInput = document.getElementById('search-input');
  var searchSuggestions = document.getElementById('search-suggestions');
  // console.log(searchSuggestions);
  var minimumQueryLength = 3; // Minimum number of characters to trigger the search

  searchInput.addEventListener('input', function() {
    var query = searchInput.value.trim();
    if (query.length >= minimumQueryLength) {
      search(query);
    } 
    // else {
    //   clearSearch();
    // }
    console.log(query)
  });

  function search(query) {
    var url = "{{ route('search') }}";

    axios.get(url, { 
        params: {
          query: query
        }
      })
      .then(function(response) {
    var results = response.data;
    console.log(results);

    // Clear the existing table rows
    var tableBody = document.querySelector('tbody');
    tableBody.innerHTML = '';

    if (results.length > 0) {
      results.forEach(function(item) {
        var row = document.createElement('tr');
        
        var titleCell = document.createElement('td');
        titleCell.textContent = item.Title;
        row.appendChild(titleCell);

        var mrpCell = document.createElement('td');
        mrpCell.textContent = item.MRP;
        row.appendChild(mrpCell);

        var boxNoCell = document.createElement('td');
        boxNoCell.textContent = item.Box_No;
        row.appendChild(boxNoCell);

        var priceUnitCell = document.createElement('td');
        priceUnitCell.textContent = item.Price_unit;
        row.appendChild(priceUnitCell);

        var stockCell = document.createElement('td');
        stockCell.textContent = item.Stock;
        row.appendChild(stockCell);

        var expDateCell = document.createElement('td');
        expDateCell.textContent = item.Exp_date ? item.Exp_date : '';
        row.appendChild(expDateCell);


        var categoryCell = document.createElement('td');
        categoryCell.textContent = item.category.length > 0 ? item.category[0].Name : '';
        row.appendChild(categoryCell);


        var brandCell = document.createElement('td');
        brandCell.textContent = item.brand.length > 0 ? item.brand[0].Name : '';
        row.appendChild(brandCell);


        var functionCell = document.createElement('td');
        functionCell.textContent = item.function.length > 0 ? item.function[0].Name : '';
        row.appendChild(functionCell);

        var scheduleCell = document.createElement('td');
        scheduleCell.textContent = item.schedule.length > 0 ? item.schedule[0].Name : '';
        row.appendChild(scheduleCell);


        var tripSize = document.createElement('td');
        tripSize.textContent = item.TripSize;
        row.appendChild(tripSize);


        var id = item.id;
        var currentPage = "{{ $product->currentpage() }}";
        var baseUrl = "{{ route('admin.edit_product', ['id' => ':id', 'page' => ':page']) }}";
        var editLink = document.createElement('a');
        editLink.href = baseUrl.replace(':id', id).replace(':page', currentPage);
        editLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">' +
       '<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>' +
        '</svg>' + 'Edit Product';

        var editCell = document.createElement('td');
        editCell.appendChild(editLink);
        row.appendChild(editCell);






        var functionCell = document.createElement('td');
        var deleteLink = document.createElement('a');
        deleteLink.href = "{{route('admin.delete_product',['id'=>" + item.id + ",'page'=>$product->currentpage()])}}";
        deleteLink.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="height: 20px">' +
          '<path fill="red" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>' +
        '</svg>';

        functionCell.appendChild(deleteLink);
        row.appendChild(functionCell);




  

        // Append the row to the table body
        tableBody.appendChild(row);
      });
    } else {
      // If no results, display a message in a table row
      var noDataRow = document.createElement('tr');
      var noDataCell = document.createElement('td');
      noDataCell.setAttribute('colspan', '12');
      noDataCell.textContent = "Data Not Available";
      noDataRow.appendChild(noDataCell);
      tableBody.appendChild(noDataRow);
    }
  })
      .catch(function(error) {
        console.log(error);
      });
  }

  // function updateSearchSuggestions(results) {
  //   clearSearchSuggestions();

  //   results.forEach(function(result) {
  //     var li = document.createElement('li');
  //     li.textContent = result;
  //     searchSuggestions.appendChild(li);
  //   });
  // }

  // function clearSearchSuggestions() {
  //   searchSuggestions.innerHTML = '';
  // }
</script>
@endsection
