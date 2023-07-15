<div class="row">
    <div class="col-12">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
            <a href="{{route('category.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>
        <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>
            <form method="POST" action="{{route('product.update', ['product' => $product->id])}}" class="default_form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">

                         {{-- Category --}}
                         <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Category</label>
                            <select class="form-control form-control-user select2 @error('Category') is-invalid @enderror" id="ArtType" name="Category" data-placeholder="Select Category">
                                <option selected value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option {{ $product->Category == $category->id  ? "selected" : "" }} value="{{$category->id}}">{{$category->Name}}</option>
                                @endforeach
                            </select>
                            <span id="span-error-Category" class="text-danger span-error"></span>
                        </div>

                        {{-- Product Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Product Name</label>
                            <input type="text" class="form-control form-control-user @error('product_name') is-invalid @enderror" id="exampleProductName" placeholder="Product Name" name="product_name" value="{{ old('product_name') ? old('product_name') : $product->Name }}">

                            @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="span-error-product_name" class="text-danger span-error"></span>
                        </div>
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Product Price</label>
                            <input type="text" class="form-control form-control-user @error('product_price') is-invalid @enderror" id="exampleProductPrice" placeholder="Product Price" name="product_price" value="{{ old('product_name') ? old('product_name') : $product->Price }}">

                            @error('product_price')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="span-error-product_price" class="text-danger span-error"></span>
                        </div>
                         {{-- Product Image --}}
                         <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Product Image</label>
                            <input type="file" class="form-control form-control-user @error('Image') is-invalid @enderror" id="exampleImage" name="Image" value="{{ old('Image') ?  old('Image') : $product->Image}}">

                            <a href="{{ url('uploads/product/'.$product->Image) }}" target="_blank"><img src="{{ url('uploads/product/'.$product->Image) }}" width="100" height="100"></a>
                            @error('Image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="span-error-Image" class="text-danger span-error"></span>
                        </div>
                         {{-- Product Description --}}
                         <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                            Product Description</label>

                            <textarea class="form-control form-control-user @error('ProductDescription') is-invalid @enderror" id="exampleProductDescription" placeholder="Product Description" name="ProductDescription" value="{{ old('ProductDescription') ?  old('ProductDescription') : $product->Description}}">{{ old('ProductDescription') ?  old('ProductDescription') : $product->Description}}</textarea>


                            <span id="span-error-ProductDescription" class="text-danger span-error"></span>
                        </div>
                       


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                    <a class="btn btn-primary float-right mr-3 mb-3 cancel_button" href="javascript:;">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        // $('.ckeditor').ckeditor();
        CKEDITOR.replace('exampleProductDescription',
            {
                
            });
    });
</script>