@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h4 class="home_title" style="padding-left: 40%;">All Photo Gallery <a class="btn btn-primary"
                href="{{ route('home') }}"><i class="fa fa-user"></i>Back</a></h4>
        <br>
        <br>


            <div class="" id="load_more_content">

            </div>
        <center><img src="{{ asset('images/image-loader.gif') }}" style="display: none;" class="loader" /></center>
    </div>
@endsection
