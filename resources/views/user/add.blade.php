@extends(Auth::user()->type == "Ship-Mark" ? 'layout.pegawai.main' : 'Form-Check.layout.main')
@section('title')
    Profile  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')

@endsection