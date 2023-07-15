@extends('layouts.app')

@section('title', 'Users List 123')

@section('content')

<div class="page-content">
    <div class="container-fluid">
    {{add_edit_form()}}
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">&nbsp;</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-left">
                            
                            <a href="javascript:;" data-method="{{ route('users.users-form') }}" type="button" class="btn btn-primary waves-effect waves-light open_my_form_form">
                                <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add New
                            </a>

                        </div>
                        <br>


                        <table id="" class="table table-bordered dt-responsive  nowrap w-100 data-table" data-url="{{ route('users.users-data') }}" data-colmuns='["name","email","mobile_no","role","action"]'>
                            <thead>
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="25%">Email</th>
                                    <th width="15%">Mobile</th>
                                    <th width="15%">Role</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div> <!-- container-fluid -->
</div>

@include('users.delete-modal')

@endsection

@section('scripts')

@endsection