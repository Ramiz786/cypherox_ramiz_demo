@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="page-content">
<div class="container-fluid">

<div class="row">
                            <div class="col-12">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Users</h1>
        <a href="{{route('medium.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <form method="POST" action="{{route('medium.update', ['medium' => $medium->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">

                    {{-- Medium Name --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Medium Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('medium_name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="Medium Name" 
                            name="medium_name" 
                            value="{{ old('medium_name') ?  old('medium_name') : $medium->MediumName}}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Update</button>
                <a class="btn btn-primary float-right mr-3 mb-3 cancel_button" href="javascript:;">Cancel</a>
            </div>
        </form>
    </div>
    </div>
    </div>

</div>
</div>


@endsection