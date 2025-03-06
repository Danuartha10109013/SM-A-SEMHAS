@extends(session('layout', 'layout.pegawai.main')) <!-- Dynamically set layout -->

@section('title')
    Edit Shipment A || {{ Auth::user()->role == 0 ? 'Admin' : 'Pegawai' }}
@endsection

@section('content')
<div class="container text-center">
    <h1 class="text-danger">{{ $status ?? 500 }} - Internal Server Error</h1>
    <p>Oops! Something went wrong on our end. Try refreshing the page or come back later.</p>

    @if (!empty($exception) && config('app.debug')) 
        <p class="text-muted">Error Message: {{ $exception->getMessage() }}</p>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-primary">Go Back</a>
</div>
@endsection
