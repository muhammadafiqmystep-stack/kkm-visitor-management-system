<h1>Visitors Index</h1>

@foreach ($visitors as $visitor)
    <p>{{ $visitor->name }}</p>
    <p>{{ $visitor->phone }}</p>
    <p>{{ $visitor->email }}</p>
@endforeach