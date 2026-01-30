@foreach(auth()->user()->toArray() as $key => $value)
<p>{{ $key }}: {{ $value }}</p>
@endforeach