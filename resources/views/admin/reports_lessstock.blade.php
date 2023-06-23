@extends('layouts.admin.app')
@push('title')
<title>Medshop |Reports</title>
@endpush
@section('content')
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #4e73df">Reports :</span></h5>
    <div class="container">
        <form action="{{route('admin.report_lessstock')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label">Select Schedule</label>
                    <select class="form-control form-select-lg" name="schedule" id="">
                        <option  selected value="null"> -- select an option -- </option>
                        @foreach ($sched as $item)
                        <option value="{{$item->id}}">{{$item->Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-2">
                    <label class="form-label">Expairy Date</label>
                    <input type="date" name="exp_date" class="form-control">
                </div>
                
            </div>
            <button class="btn text-white mt-1" style="background-color: #4e73df">Filter</button>
        </form>
    </div>
</div>
<div class="card m-1 p-1" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;z-index:1">
    <h5 class="p-2"><span style="border-bottom:1px solid #4e73df">Reports:</span></h5>
    <div class="container">
    
    <h5 class="card-title">Less Stock Products(5)</h5>
                <div>
                <table style="border-collapse: collapse; width: 100%;">
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Product Name</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Exp Date</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Stock</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Batch No</td>
                    </tr>
                    @foreach($qty as $index => $item)
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid black; padding: 5px;">{{ $item->product_name }}</td>
                            <td style="border: 1px solid black; padding: 5px;">{{ $item->expdate }}</td>
                            <td style="border: 1px solid black; padding: 5px;">{{ $item->stock }}</td>
                            <td style="border: 1px solid black; padding: 5px;">{{ $item->batch }}</td>
                        </tr>
                       
                    @endforeach

                    
                      
                    

                </table>

                </div>
                
            
    </div>
</div>
@endsection