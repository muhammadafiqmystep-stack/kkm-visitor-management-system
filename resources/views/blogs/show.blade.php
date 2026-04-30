@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Blog Index') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title" value="{{ $blog->title }}" readonly></input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="description" rows="4" readonly>{{ $blog->description }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="author" class="col-md-4 col-form-label text-md-end">Author</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="author" value="{{ $blog->author }}" readonly></input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="genre" class="col-md-4 col-form-label text-md-end">Genre</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="genre" value="{{ $blog->genre }}" readonly></input>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Back to Blogs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
