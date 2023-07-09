@extends('layouts.admin.app')
@push('title')
<title>Medshop | Admin-Dashboard</title>
@endpush 
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <div class="m-2">
        <h5><span style="border-bottom:1px solid #60b5ba">Dashboard</span></h5>
    </div>
    <div class="row text_center">
        <div class="card m-4 border_card" style="width: 25rem; height: 18rem">
            <div class="card-body">
                <h5 class="card-title">Monthly Sale</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ !empty($result[0]->monthly_sale) ? $result[0]->monthly_sale : 0 }}</h6>

                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <!-- <a href="#" class="card-link">Card link</a> -->
            </div>
        </div> 

         <div class="card border_card m-4" style="width: 25rem; height: 18rem">
            <!--<div class="card-body">
                <h5 class="card-title">Last Month Comparision</h5> -->
                <div id="monthtomonth" style></div>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <!-- <a href="#" class="card-link">Card link</a> -->
            <!-- </div>--> 
        </div> 
    </div>
    <div class="row text_center ">
        <div class="card m-4 border_card" style="width: 25rem; height: 18rem">
            <div class="card-body">
                <h5 class="card-title">Upcoming expire Products</h5>
                
                <div>
                <table style="border-collapse: collapse; width: 100%;">
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Product Name</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Exp Date</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Stock</td>
                        <td style="border: 1px solid black; padding: 5px; font-weight: bold;">Batch No</td>
                    </tr>
                    @foreach($exp as $index => $item)
                    <tr style="border: 1px solid black;">
                        <td style="border: 1px solid black; padding: 1px; font-size:11px">{{ $item->product_name }}</td>
                        <td style="border: 1px solid black; padding: 1px; font-size:11px">{{ $item->expdate }}</td>
                        <td style="border: 1px solid black; padding: 1px; font-size:11px">{{ $item->stock }}</td>
                        <td style="border: 1px solid black; padding: 1px; font-size:11px">{{ $item->batch }}</td>
                    </tr>
                    @if($index === 4 && count($exp) > 5)
                        @break
                    @endif
                    @endforeach

                    @if(count($exp) > 5)
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                <a href="/admin/reports/upcoming_exp_product" class="btn btn-primary">View More</a>
                            </td>
                        </tr>
                    @endif                                                      

                </table>

                </div>
                
            </div>
        </div>

        <div class="card border_card m-4" style="width: 25rem; height: 18rem">
            <div class="card-body">
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
                            <td style="border: 1px solid black; padding: 5px; font-size:11px">{{ $item->product_name }}</td>
                            <td style="border: 1px solid black; padding: 5px; font-size:11px">{{ $item->expdate }}</td>
                            <td style="border: 1px solid black; padding: 5px; font-size:11px">{{ $item->stock }}</td>
                            <td style="border: 1px solid black; padding: 5px; font-size:11px">{{ $item->batch }}</td>
                        </tr>
                        @if($index === 4 && count($qty) > 5)
                            @break
                        @endif
                    @endforeach

                    @if(count($qty) > 5)
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                <a href="/admin/view/product" class="btn btn-primary">View More</a>
                            </td>
                        </tr>
                    @endif

                </table>

                </div>
            </div>
        </div>
    </div>
    
</div>
<style>
    .text_center {
        /* align-content: center; */
        padding-left: 20rem;
    }

    h5.card-title {
        color: black;
    }

    .border_card {
        border: 3px solid black;
    }
</style>
<!-- script for the  chart -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $("#monthtomonth").highcharts({
        chart: {
            type: 'column',
            height: '330rem'
        },
        title: {
            text: 'Month To Month Compare'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                'Oct', 'Nov', 'Dec'
            ]
        },
        yAxis: {
            title: {
                text: 'Monthly Sales'
            }
        },
        series: [{
            name: 'Monthly Sales',
            data: {{ json_encode($mtm) }},
            color: '#60b5ba'
        }],
        
    });
</script>


@endsection