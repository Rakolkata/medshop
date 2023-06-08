@extends('layouts.admin.app')
@push('title')
<title>Medshop | Admin-Dashboard</title>
@endpush 
@section('content')
<div class="card m-3 p-3 " style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    <div class="m-2">
        <h5><span style="border-bottom:1px solid #4e73df">Dashboard</span></h5>
    </div>
    <div class="row text_center">
        <div class="card m-4 border_card" style="width: 25rem; height: 18rem">
            <div class="card-body">
                <h5 class="card-title">Monthly Sale</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $result }}</h6>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <a href="#" class="card-link">Card link</a>
            </div>
        </div> 

        <div class="card border_card m-4" style="width: 25rem; height: 18rem">
            <div class="card-body">
                <h5 class="card-title">Last Month Comparision</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <a href="#" class="card-link">Card link</a>
            </div> 
        </div>
    </div>
    <div class="row text_center ">
        <div class="card m-4 border_card" style="width: 25rem; height: 18rem">
            <div class="card-body">
                <h5 class="card-title">Upcoming expire Products</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
            </div>
        </div>

        <div class="card border_card m-4" style="width: 25rem; height: 18rem">
            <div class="card-body">
                <h5 class="card-title">Less Stock Products(5)</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
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
@endsection