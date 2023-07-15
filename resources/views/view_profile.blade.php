@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h4 class="home_title" style="padding-left: 40%;">{{ $user_profiles->name }} Photo Gallery <a class="btn btn-primary" href="{{ route('home') }}"><i class="fa fa-user"></i>Back</a></h4>
        <br>
        <br>
        

        <div class="row justify-content-center">
            <?php
            // $files = Storage::files(public_path('uploads/' . $user_profiles->folder_name));
            // print_r($files);die;

            $folder_path = public_path('uploads/' . $user_profiles->folder_name) . '/*';
            // echo $folder_path;die;
            ?>

            {{-- @foreach (File::glob(public_path('uploads/bhavik_shah') . '/*') as $path) --}}
            @foreach (File::glob($folder_path) as $path)
                <div class="col-sm-2">
                    <div class="card card-dark card-profile">
                        <div class="card-body">
                            <a data-fancybox="gallery_<?php echo $user_profiles->id; ?>" href="{{ str_replace(public_path(), '', $path) }}">
                                <img src="{{ str_replace(public_path(), '', $path) }}" style="height: 100%;width:100%;">
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
