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
                        <li class="breadcrumb-item active">Products list</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Products list</h4>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-success">Add Product</a>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="productsTable" class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                        <td>{{ $product->code }}</td>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 60px; height: auto; margin-top: 5px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $product->status ? 'Active' : 'Inactive' }}</td> --}}
                                        <td>
                                            <div class="form-check form-switch form-switch-right form-switch-md">
                                                <input class="form-check-input status-switch" type="checkbox" data-id="{{ $product->id }}" data-type="product" {{ $product->status ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection

{{-- Push the script --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                responsive: true,
            });
        });
    </script>
@endpush
