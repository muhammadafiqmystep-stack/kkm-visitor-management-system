@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Show') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly></input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}" readonly></input>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
