@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Visitor Create') }}</div>

                <div class="card-body">
                    <form method="post" action="">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name"></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="phone"></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email"></input>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>                                    
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