@extends('dashboard.layout.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Sliders</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSliderModal">
                <i class="mdi mdi-plus"></i> Add Slider
            </button>
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
                        <th>Image</th>
                        <th>Heading</th>
                        <th>Paragraph</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr>
                        <td>
                            <img src="{{ asset('sliders/'.$slider->image) }}" alt="{{ $slider->heading }}" style="max-width: 100px;">
                        </td>
                        <td>{{ $slider->heading }}</td>
                        <td>{{ Str::limit($slider->paragraph, 50) }}</td>
                        <td>
                            <form action="{{ route('cfadmin.sliders.toggle', $slider->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-{{ $slider->is_active ? 'success' : 'secondary' }}">
                                    {{ $slider->is_active ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </td>
                        <td>{{ $slider->created_at->format('d M Y') }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editSliderModal{{ $slider->id }}">
                                <i class="icon-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSliderModal{{ $slider->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editSliderModal{{ $slider->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Slider</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('cfadmin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="heading">Heading</label>
                                                    <input type="text" class="form-control @error('heading') is-invalid @enderror" 
                                                           name="heading" value="{{ old('heading', $slider->heading) }}" required>
                                                    @error('heading')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="paragraph">Paragraph</label>
                                                    <textarea class="form-control @error('paragraph') is-invalid @enderror" 
                                                              name="paragraph" rows="3">{{ old('paragraph', $slider->paragraph) }}</textarea>
                                                    @error('paragraph')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                                           name="image" accept="image/*" >
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <small class="text-muted">Current image: {{ $slider->image }}</small>
                                                    <div class="mt-2">
                                                        <img src="{{ asset('sliders/'.$slider->image) }}" alt="Current Image" style="max-width: 50%;height: 200px;">
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="is_active" 
                                                           id="is_active_{{ $slider->id }}" {{ $slider->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_active_{{ $slider->id }}">
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
                            
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteSliderModal{{ $slider->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this slider? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('cfadmin.sliders.destroy', $slider->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Slider Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cfadmin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="heading">Heading</label>
                        <input type="text" class="form-control @error('heading') is-invalid @enderror" 
                               name="heading" value="{{ old('heading') }}" required>
                        @error('heading')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="paragraph">Paragraph</label>
                        <textarea class="form-control @error('paragraph') is-invalid @enderror" 
                                  name="paragraph" rows="3">{{ old('paragraph') }}</textarea>
                        @error('paragraph')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               name="image" accept="image/*" required>
                        @error('image')
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

@endsection