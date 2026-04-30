@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Blog Index') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($blog->description, 80) }}</td>
                                    <td>{{ $blog->author }}</td>
                                    <td>{{ $blog->genre }}</td>
                                    <td>{{ $blog->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary">Show</a>
                                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                                        <a
                                            onclick="return confirm('are you sure you want to delete this blog?')"
                                            href="{{ route('blogs.delete', $blog->id) }}" class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
