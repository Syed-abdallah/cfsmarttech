@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Permissions</h4>
            @can('create permissions')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                <i class="mdi mdi-plus"></i> Add Permission
            </button>
            @else
            <button class="btn btn-primary disabled" title="You don't have permission to create permissions">
                <i class="mdi mdi-plus"></i> Add Permission
            </button>
            @endcan
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at->format('d M Y') }}</td>
                        <td>
                            @can('edit permissions')
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editPermissionModal{{ $permission->id }}">
                                <i class="icon-pencil"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-info disabled" title="You don't have permission to edit permissions">
                                <i class="icon-pencil"></i>
                            </button>
                            @endcan

                            @can('delete permissions')
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletePermissionModal{{ $permission->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-danger disabled" title="You don't have permission to delete permissions">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @endcan
                            
                            <!-- Edit Modal - Only rendered if user has permission -->
                            @can('edit permissions')
                            <div class="modal fade" id="editPermissionModal{{ $permission->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Permission</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('cfadmin.permissions.update', $permission->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                           name="name" value="{{ old('name', $permission->name) }}" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            
                            <!-- Delete Modal - Only rendered if user has permission -->
                            @can('delete permissions')
                            <div class="modal fade" id="deletePermissionModal{{ $permission->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this permission?</p>
                                            <p><strong>{{ $permission->name }}</strong></p>
                                            <p class="text-danger">Warning: This may affect user access controls!</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('cfadmin.permissions.destroy', $permission->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Permission Modal - Only rendered if user has permission -->
@can('create permissions')
<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cfadmin.permissions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" required placeholder="Enter permission name (e.g. edit posts)">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="text-muted">Use lowercase with hyphens (e.g. manage-users)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endcan

@endsection