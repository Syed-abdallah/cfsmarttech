{{-- @extends('dashboard.layout.layout')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    {{ __('Profile Information') }}
                </h2>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    {{ __('Update Password') }}
                </h2>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    {{ __('Delete Account') }}
                </h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection --}}


@extends('dashboard.layout.layout')

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <!-- Profile Card with Animated Header -->
                <div class="card border-0 shadow-lg mb-5 animate__animated animate__fadeIn">
                    <div class="card-header bg-gradient-primary text-dark py-4 position-relative">
                        <h2 class="h3 mb-0">
                            <i class="bi bi-person-circle me-2"></i>Profile Settings
                        </h2>
                        <p class="mb-0 opacity-75">Manage your account information</p>
                    </div>
                    
                    <div class="card-body p-0">
                        <!-- Profile Information Section -->
                        <div class="p-4 p-md-5 border-bottom">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-person-badge fs-2 text-primary"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-1">Profile Information</h3>
                                    <p class="text-muted mb-0">Update your account details</p>
                                </div>
                            </div>
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        
                        <!-- Password Section -->
                        <div class="p-4 p-md-5 border-bottom bg-light bg-opacity-10">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-shield-lock fs-2 text-warning"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-1">Update Password</h3>
                                    <p class="text-muted mb-0">Keep your account secure</p>
                                </div>
                            </div>
                            @include('profile.partials.update-password-form')
                        </div>
                        
                        <!-- Danger Zone Section -->
                        <div class="p-4 p-md-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                                    <i class="bi bi-exclamation-octagon fs-2 text-danger"></i>
                                </div>
                                <div>
                                    <h3 class="h5 mb-1">Danger Zone</h3>
                                    <p class="text-muted mb-0">Permanently delete your account</p>
                                </div>
                            </div>
                            
                            <div class="alert alert-danger border-danger border-2">
                                <div class="d-flex">
                                    <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
                                    <div>
                                        <h4 class="alert-heading h5">Warning!</h4>
                                        <p class="mb-2">Once you delete your account, there is no going back. Please be certain.</p>
                                        <button class="btn btn-outline-danger" type="button" data-bs-toggle="collapse" data-bs-target="#deleteAccountCollapse">
                                            I understand, show me the options
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="collapse" id="deleteAccountCollapse">
                                <div class="card card-body border-danger">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light text-center py-3">
                        <p class="mb-0 text-muted">
                            <i class="bi bi-info-circle me-1"></i> Last updated: {{ now()->format('M d, Y h:i A') }}
                        </p>
                    </div>
                </div>

                <!-- Website Settings Card -->
                <div class="card border-0 shadow-lg mb-5 animate__animated animate__fadeIn">
                    <div class="card-header bg-gradient-primary text-dark py-4 position-relative">
                        <h2 class="h3 mb-0">
                            <i class="bi bi-globe me-2"></i>Website Settings
                        </h2>
                        <p class="mb-0 opacity-75">Manage your website configuration</p>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="p-4 p-md-5">
                            <form method="POST" action="{{ route('cfadmin.settings.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="website_name" class="form-label">Website Name</label>
                                        <input type="text" class="form-control" id="website_name" name="website_name" 
                                               value="{{ old('website_name', $settings->website_name ?? '') }}">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="name_color" class="form-label">Name Color</label>
                                        <div class="input-group">
                                            <input type="color" class="form-control form-control-color" id="name_color_picker" 
                                                   value="{{ old('name_color', $settings->name_color ?? '#000000') }}" title="Choose color">
                                            <input type="text" class="form-control" id="name_color" name="name_color" 
                                                   value="{{ old('name_color', $settings->name_color ?? '#000000') }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input class="form-control" type="file" id="logo" name="logo" accept="image/*">
                                        
                                        @if(isset($settings) && $settings->logo_path)
                                            <div class="mt-3">
                                                <p class="mb-1">Current Logo:</p>
                                                <img src="{{ asset($settings->logo_path) }}" alt="Site Logo" class="img-thumbnail" style="max-height: 100px;">
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Fun Progress Section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body text-center py-4">
                        <h4 class="h5 mb-3">Your Profile Strength</h4>
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                <span class="fw-bold">85% Complete</span>
                            </div>
                        </div>
                        <p class="text-muted mb-0">
                            <i class="bi bi-emoji-smile me-1"></i> Great job! Just a few more details to make your profile perfect!
                        </p>
                    </div>
                </div>
                
                <!-- Fun Tip -->
                <div class="alert alert-info border-info border-2 d-flex align-items-center">
                    <i class="bi bi-lightbulb fs-3 me-3"></i>
                    <div>
                        <h5 class="alert-heading h6 mb-1">Did You Know?</h5>
                        <p class="mb-0">Users with complete profiles get 30% more engagement! Keep it updated!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
    }
    .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    .progress-bar {
        border-radius: 10px;
    }
    .animate__animated {
        animation-duration: 0.5s;
    }
</style>
@endpush

@push('scripts')
<script>
    // Sync color picker with text input
    document.getElementById('name_color_picker').addEventListener('input', function() {
        document.getElementById('name_color').value = this.value;
    });
    
    // Sync text input with color picker
    document.getElementById('name_color').addEventListener('input', function() {
        if (/^#[0-9A-F]{6}$/i.test(this.value)) {
            document.getElementById('name_color_picker').value = this.value;
        }
    });
</script>
@endpush

@endsection