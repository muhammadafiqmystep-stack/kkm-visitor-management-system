@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Visitor Index') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->name }}</td>
                                    <td>{{ $visitor->phone }}</td>
                                    <td>{{ $visitor->email }}</td>
                                    <td>{{ $visitor->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-primary">Show</a>
                                        @can('edit visitors')
                                        <a href="{{ route('visitors.edit', $visitor->id) }}" class="btn btn-warning">Edit</a>
                                        @endcan
                                        @can('soft delete visitors')
                                        <a 
                                            onclick="return confirm('Are you sure you want to delete this visitor?')"
                                            href="{{ route('visitors.delete', $visitor->id) }}" class="btn btn-danger">
                                            Delete
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            @can('restoreDelete visitors')
            <div class="card">
                <div class="card-header">{{ __('Visitor Soft Deleted Index') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deletedVisitors as $deletedVisitor)
                                <tr>
                                    <td>{{ $deletedVisitor->name }}</td>
                                    <td>{{ $deletedVisitor->phone }}</td>
                                    <td>{{ $deletedVisitor->email }}</td>
                                    <td>{{ $deletedVisitor->created_at->diffForHumans() }}</td>
                                    <td>{{ $deletedVisitor->deleted_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('visitors.restore', $deletedVisitor->id) }}" class="btn btn-success">Restore</a>
                                        <a 
                                            onclick="return confirm('Are you sure you want to force delete this visitor?')"
                                            href="{{ route('visitors.force-delete', $deletedVisitor->id) }}" class="btn btn-dark">
                                            Force Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection