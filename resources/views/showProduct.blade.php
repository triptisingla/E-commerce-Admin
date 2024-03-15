@extends('layouts.navbar')
@section('css')
    <!-- <link rel="stylesheet" href="{{asset('css/showProducts.css')}}"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection

@section('content')
<div class="container">


    <div class="card mb-3 w-50 m-auto border border-4">
    <img src="{{$product->productimage}}" class="card-img-top" alt="{{$product->name}}">
    <div class="card-body">
        <h5 class="card-title">{{$product->name}}</h5>

        <div class="p-2">
            <label for="price" class="mt-2"><b>Price</b></label>
            <p>	&#8377; {{$product->price}}</p>
        </div>

        <div class="p-2" style="border: 1px solid black;">
            <label for="details" class="mt-2"><b>Details</b></label>
            <p class="card-text" id="details">{{$product->detail}}</p>
        </div>


        <p class="card-text"><small class="text-body-secondary">Last update {{$product->updated_at->diffForHumans()}}</small></p>

        <div class="adddedBy">
            <label for="addedby">Added By:</label>
            <p>{{$product->user->name}}</p>
        </div>
    
    </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/showProducts.js"></script>
@endsection