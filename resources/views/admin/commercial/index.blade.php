@extends('dashboard.layout.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Commercial Prices</h4>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="zero_config" class="table border table-striped table-bordered text-nowrap">
                 <thead class="table-dark">
                        <tr>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prices as $price)
                            <tr>
                                <td>{{ $price->size }}</td>
                                <td>{{ number_format($price->price, 2) }}</td>
                                <td>
                                    @can('edit commercial')
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#editPriceModal{{ $price->id }}">
                                        <i class="icon-pencil"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-sm btn-info disabled" title="You don't have permission to edit">
                                        <i class="icon-pencil"></i>
                                    </button>
                                    @endcan

                                    <!-- Edit Modal -->
                                    @can('edit commercial')
                                    <div class="modal fade" id="editPriceModal{{ $price->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Price</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('cfadmin.commercial.update', $price->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Size</label>
                                                            <div class="p-2 bg-light rounded">
                                                                {{ $price->size }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="price">Price</label>
                                                            <input type="number" step="0.01" class="form-control"
                                                                name="price" value="{{ $price->price }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
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
@endsection