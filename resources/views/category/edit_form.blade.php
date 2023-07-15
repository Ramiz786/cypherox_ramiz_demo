<div class="row">
    <div class="col-12">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
            <a href="{{route('category.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
            </div>
            <form method="POST" action="{{route('category.update', ['category' => $category->id])}}" class="default_form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Parent Category</label>
                            <select class="form-control form-control-user select2 @error('ParentCategory') is-invalid @enderror" id="ArtType" name="ParentCategory" data-placeholder="Select Parent Category">
                                <option selected value="">Select Parent Category</option>
                                @foreach ($categories as $single_category)
                                <option {{ $category->Parent == $single_category->id  ? "selected" : "" }} value="{{$single_category->id}}">{{$single_category->Name}}</option>
                                @endforeach
                            </select>
                            <span id="span-error-ParentCategory" class="text-danger span-error"></span>
                        </div>

                        {{-- Category Name --}}
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;">*</span>Category Name</label>
                            <input type="text" class="form-control form-control-user @error('category_name') is-invalid @enderror" id="exampleCategoryName" placeholder="Category Name" name="category_name" value="{{ old('category_name') ? old('category_name') : $category->Name }}">

                            @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <span id="span-error-category_name" class="text-danger span-error"></span>
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