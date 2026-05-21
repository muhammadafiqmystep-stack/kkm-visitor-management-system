@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="card-body">
                    <a
                        onclick="return confirm('Are you sure you want to export visitors?')"
                        href="{{ route('visitors.export') }}" class="btn btn-outline-primary">Export Visitors Excel
                    </a>
                    <a
                        onclick="return confirm('Are you sure you want to export blogs?')"
                        href="{{ route('blogs.export') }}" class="btn btn-outline-secondary">Export Blogs Excel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
