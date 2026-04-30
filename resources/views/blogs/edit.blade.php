@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Blog Index') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('blogs.update', $blog->id) }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ $blog->title }}"></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description" rows="4">{{ $blog->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="author" class="col-md-4 col-form-label text-md-end">Author</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="author" value="{{ $blog->author }}"></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="genre" class="col-md-4 col-form-label text-md-end">Genre</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="genre" value="{{ $blog->genre }}"></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
