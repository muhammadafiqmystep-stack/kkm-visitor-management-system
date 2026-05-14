@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <span>{{ __('Notifications') }}</span>
                    <div class="d-flex flex-wrap gap-2">
                        <form action="{{ route('notifications.mark-all-read') }}" method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">{{ __('Mark all as read') }}</button>
                        </form>
                        <form action="{{ route('notifications.destroy-all') }}" method="post" class="d-inline"
                              onsubmit="return confirm('{{ __('Delete all notifications? This cannot be undone.') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete all') }}</button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-3" role="alert">{{ session('status') }}</div>
                    @endif

                    @if ($notifications->isEmpty())
                        <p class="text-muted mb-0">{{ __('You have no notifications yet.') }}</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Status') }}</th>
                                        <th scope="col">{{ __('Type') }}</th>
                                        <th scope="col">{{ __('Message') }}</th>
                                        <th scope="col">{{ __('When') }}</th>
                                        <th scope="col" class="text-end">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
                                        <tr class="{{ $notification->read_at ? '' : 'table-light' }}">
                                            <td>
                                                @if ($notification->read_at)
                                                    <span class="badge bg-secondary">{{ __('Read') }}</span>
                                                @else
                                                    <span class="badge bg-primary">{{ __('Unread') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ class_basename($notification->type) }}</td>
                                            <td>
                                                {{ \Illuminate\Support\Str::limit($notification->data['message'] ?? json_encode($notification->data), 80) }}
                                            </td>
                                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('notifications.show', $notification->id) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $notifications->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
