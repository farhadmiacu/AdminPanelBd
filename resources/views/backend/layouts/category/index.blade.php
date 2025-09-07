@extends('backend.master')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Categories</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories list</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Categories list</h4>
                </div><!-- end card header -->

                {{-- <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-xxl-12 col-md-12">
                            <div>
                                <label for="placeholderInput" class="form-label">Input with Placeholder</label>
                                <input type="password" class="form-control" id="placeholderInput" placeholder="Placeholder">
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="card-body">

                    <div class="row gy-4">

                    </div>
                </div> --}}

                <div class="card-body">
                    <div class="table-reponsive">
                        <table id="categoriesTable" class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            @if ($category->image)
                                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="width: 60px; height: auto; margin-top: 5px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{ $category->status ? 'Active' : 'Inactive' }}</td> --}}
                                        <td>
                                            <div class="form-check form-switch form-switch-right form-switch-md">
                                                <input class="form-check-input status-switch" type="checkbox" data-id="{{ $category->id }}" data-type="category" {{ $category->status ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
            $('#categoriesTable').DataTable({
                responsive: true,

            });
        });
    </script>
@endpush
