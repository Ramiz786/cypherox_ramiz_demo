@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h2 class="home_title" style="padding-left: 40%;">Ramiz Girach</h2>
        <br>
        <br>
        @if (Auth::user()->role == 'User')
            <div class="row justify-content-center">
                <div class="container">
                    <div class="row">
                        @foreach ($products as $product)
                            
                       
                        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                            <div class="card">
                                <img class="card-img"
                                    src="{{$product->ProductImage}}"
                                    alt="Vans" style="max-height: 200px; min-height: 200px;">
                                <div class="card-body">
                                    <h4 class="card-title">{{$product->Name}}</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">Category : {{$product->CategoryName}}</h6>
                                    <p class="card-text">
                                        Description : {!! $product->Description!!} </p>
                                    <div class="options d-flex flex-fill">

                                    </div>
                                    <div class="buy d-flex justify-content-between align-items-center">
                                        <div class="price text-success">
                                            <h5 class="mt-4">${{$product->Price}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        @endif
    </div>
@endsection
