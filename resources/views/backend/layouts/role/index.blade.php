@extends('backend.master')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Roles</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Roles List</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Roles List</h4>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success">Add Role</a>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="rolesTable" class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ ucfirst($role->name) }}</td>
                                        <td>
                                            @if ($role->permissions->count() > 0)
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge bg-primary mb-1">{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No Permissions</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block;">
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
            $('#rolesTable').DataTable({
                responsive: true,
            });
        });
    </script>
@endpush
