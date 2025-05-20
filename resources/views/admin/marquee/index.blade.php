@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Announcements</h4>
            @can('create marquee')
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMarqueeModal">
                <i class="mdi mdi-plus"></i> Add Announcement
            </button>
            @else
            <button class="btn btn-primary disabled" title="You don't have permission to create marquee">
                <i class="mdi mdi-plus"></i> Add Announcement
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
                        <th>Content</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($marquees as $marquee)
                    <tr>
                        <td>{{ $marquee->content }}</td>
                        <td>
                            @can('toggle marquee')
                            <form action="{{ route('cfadmin.marquees.toggle', $marquee->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-{{ $marquee->is_active ? 'success' : 'secondary' }}">
                                    {{ $marquee->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                            @else
                            <span class="badge bg-{{ $marquee->is_active ? 'success' : 'secondary' }}">
                                {{ $marquee->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <small class="text-muted d-block">(No permission to change)</small>
                            @endcan
                        </td>
                        <td>{{ $marquee->created_at->format('d M Y') }}</td>
                        <td>
                            @can('edit marquee')
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMarqueeModal{{ $marquee->id }}">
                                <i class="icon-pencil"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-info disabled" title="You don't have permission to edit">
                                <i class="icon-pencil"></i>
                            </button>
                            @endcan

                            @can('delete marquee')
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMarqueeModal{{ $marquee->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @else
                            <button class="btn btn-sm btn-danger disabled" title="You don't have permission to delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            @endcan
                            
                            <!-- Edit Modal - Only rendered if user has permission -->
                            @can('edit marquee')
                            <div class="modal fade" id="editMarqueeModal{{ $marquee->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Announcement</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('cfadmin.marquees.update', $marquee->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="content">Content</label>
                                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                                              name="content" rows="3" required>{{ old('content', $marquee->content) }}</textarea>
                                                    @error('content')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_active" 
                                                           id="is_active_{{ $marquee->id }}" {{ $marquee->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active_{{ $marquee->id }}">
                                                        Active
                                                    </label>
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
                            @can('delete marquee')
                            <div class="modal fade" id="deleteMarqueeModal{{ $marquee->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this announcement?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('cfadmin.marquees.destroy', $marquee->id) }}" method="POST">
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

<!-- Add Marquee Modal - Only rendered if user has permission -->
@can('create marquee')
<div class="modal fade" id="addMarqueeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cfadmin.marquees.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="content">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  name="content" rows="3" required>{{ old('content') }}</textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
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