@extends('layouts.app')

@section('title', __('Authentication Logs'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Authentication Logs') }}
                </div>

                <div class="card-body">
                    @if ($logs->isEmpty())
                        <p class="text-muted mb-0">{{ __('No authentication activity has been recorded yet.') }}</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('IP address') }}</th>
                                        <th scope="col">{{ __('Browser / device') }}</th>
                                        <th scope="col">{{ __('Signed in') }}</th>
                                        <th scope="col">{{ __('Signed out') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ $log->ip_address ?? '—' }}</td>
                                            <td>
                                                <span title="{{ $log->user_agent }}">
                                                    {{ \Illuminate\Support\Str::limit($log->user_agent ?? '—', 64) }}
                                                </span>
                                            </td>
                                            <td>{{ $log->login_at?->timezone(config('app.timezone'))->format('Y-m-d H:i') ?? '—' }}</td>
                                            <td>{{ $log->logout_at?->timezone(config('app.timezone'))->format('Y-m-d H:i') ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
