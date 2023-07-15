@extends('layouts.app')

@section('title', 'Medium List')

@section('content')

<div class="page-content">
    <div class="container-fluid">

    {{add_edit_form()}}
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Products</h4>

                    <div class="page-title-right">
                       
                        <a href="javascript:;" data-method="{{ route('product.product-form') }}" type="button" class="btn btn-primary waves-effect waves-light open_my_form_form">
                            <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add New
                        </a>

                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <table id="" class="table table-bordered dt-responsive  nowrap w-100 data-table" data-url="{{ route('product.product-data') }}" data-colmuns='["CategoryName","Name","ProductImage","Price","action"]'>
                            <thead>
                                <tr>
                                    <th width="20%">Category</th>
                                    <th width="20%">Product Name</th>
                                    <th width="20%">Image</th>
                                    <th width="20%">Price</th>
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
@if (count($product) > 0)
@include('product.delete-modal')
@endif
@endsection

@section('scripts')

@endsection