@extends('backend.master')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Products</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Product Create</h4>
                </div><!-- end card header -->

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row gy-4">

                            {{-- Name Field --}}
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Product Name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Slug Field (readonly, auto-generated) --}}
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Auto-generated slug" value="{{ old('slug') }}" readonly>
                                </div>
                            </div>

                            {{-- Category Select --}}
                            <div class="col-xxl-12 col-md-12">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                    <option value="" disabled selected>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Brand Select --}}
                            <div class="col-xxl-12 col-md-12">
                                <label for="brand_id" class="form-label">Brand</label>
                                <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id" id="brand_id">
                                    <option value="" disabled selected>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Code Field --}}
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="code" class="form-label">Product Code</label>
                                    <input type="text" name="code" id="code" class="form-control" placeholder="Enter Product Code" value="{{ old('code') }}">
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Image Field --}}
                            <div class="col-xxl-12 col-md-12">
                                <div>
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" name="image" id="image" class="form-control dropify" data-allowed-file-extensions="jpg jpeg png gif">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Short Description --}}
                            <div class="col-xxl-12 col-md-12">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control" rows="3">{{ old('short_description') }}</textarea>
                            </div>

                            {{-- Long Description --}}
                            <div class="col-xxl-12 col-md-12">
                                <label for="long_description" class="form-label">Long Description</label>
                                {{-- <textarea name="long_description" id="long_description" class="form-control" rows="5">{{ old('long_description') }}</textarea> --}}
                                <textarea name="long_description" id="long_description">{{ old('long_description') }}</textarea>

                            </div>

                            {{-- Regular Price --}}
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="regular_price" class="form-label">Regular Price</label>
                                    <input type="number" name="regular_price" id="regular_price" class="form-control" placeholder="Enter Regular Price" value="{{ old('regular_price') }}" step="0.01">
                                    @error('regular_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Selling Price --}}
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="selling_price" class="form-label">Selling Price</label>
                                    <input type="number" name="selling_price" id="selling_price" class="form-control" placeholder="Enter Selling Price" value="{{ old('selling_price') }}"
                                        step="0.01">
                                    @error('selling_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Stock --}}
                            <div class="col-xxl-6 col-md-6">
                                <div>
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" name="stock" id="stock" class="form-control" placeholder="Enter Stock Quantity" value="{{ old('stock', 0) }}">
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status Field --}}
                            <div class="col-xxl-6 col-md-6">
                                <label class="form-label" for="statusSelect">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="statusSelect">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Submit Button --}}
                            <div class="col-xxl-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Save Product</button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection

{{-- Push the script --}}
@push('scripts')
    <script>
        document.getElementById('name').addEventListener('input', function() {
            let name = this.value;
            let slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // remove special chars
                .replace(/\s+/g, '-') // replace spaces with -
                .replace(/-+/g, '-'); // remove multiple -
            document.getElementById('slug').value = slug;
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove file',
                    'error': 'Ooops! something went wrong.'
                }
            });
        });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#long_description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
