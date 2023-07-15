@extends('layouts.app')

@section('title', 'CMS page List')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Change Password</h4>

                    <div class="page-title-right">

                       

                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{route('submit-change-password')}}" enctype="multipart/form-data" id="change_password" class="default_form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">

                                    {{-- Old Password --}}
                                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                        <span style="color:red;">*</span>Old Password</label>
                                        <input type="password" class="form-control form-control-user @error('old_password') is-invalid @enderror" id="old_password" placeholder="Old Password" name="old_password" value="{{ old('old_password') }}">

                                        <span id="span-error-old_password" class="text-danger span-error"></span>
                                    </div>
                                    {{-- New Password --}}
                                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                        <span style="color:red;">*</span>New Password</label>
                                        <input type="password" class="form-control form-control-user @error('old_password') is-invalid @enderror" id="password" placeholder="New password" name="password" value="{{ old('password') }}">

                                        <span id="span-error-password" class="text-danger span-error"></span>
                                    </div>
                                    {{-- Confirm Password --}}
                                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                        <span style="color:red;">*</span>Confirm Password</label>
                                        <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" value="{{ old('password') }}">

                                        <span id="span-error-password_confirmation" class="text-danger span-error"></span>
                                    </div>


                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('exhibition.index') }}">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>
@include('cmspage.delete-modal')
@endsection

@section('scripts')

@endsection