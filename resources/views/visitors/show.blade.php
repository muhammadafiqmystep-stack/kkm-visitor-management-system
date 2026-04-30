@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Visitor Index') }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ $visitor->name }}" readonly></input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" value="{{ $visitor->phone }}" readonly></input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email" value="{{ $visitor->email }}" readonly></input>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('visitors.index') }}" class="btn btn-secondary">Back to Visitors</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection