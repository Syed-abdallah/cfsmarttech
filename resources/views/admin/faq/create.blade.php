@extends('dashboard.layout.layout')

@section('title', 'Create FAQ')
@section('content')

    <div class="container-fluid" style="margin-top: 20px; margin-bottom: 20px;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="my-3">Create FAQ</h2>
                        <div class="form-validation">
                            <form action="{{ route('cfadmin.faqs.store') }}" 
                                  method="POST">
                                @csrf

                                <!-- Question Field -->
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" 
                                           name="question" 
                                           id="question" 
                                           class="form-control" 
                                           value="{{ old('question') }}" 
                                           required>
                                    @error('question')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Answer Field -->
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea id="summernote" class="note-editable" name="answer">{{ old('answer') }}</textarea>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            // Initialize Summernote
                                            $('#summernote').summernote({
                                                height: 200, // Set height of the editor
                                                tabsize: 2
                                            });

                                            var oldText = @json(old('answer')); // Get old text from Laravel
                                            if (oldText) {
                                                $('#summernote').summernote('code', oldText); // Set the old text to Summernote instance
                                            }
                                        });
                                    </script>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
