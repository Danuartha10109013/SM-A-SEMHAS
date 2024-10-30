@extends('Kendaraan.layout.main')

@section('title')
    Dashboard ||
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dashboard</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{route('Kendaraan.pegawai.check.add')}}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i> Add CK
                        </a>
                    </div>
                    <form action="" method="GET" class="ml-2">
                        <input type="text" name="search" placeholder="Search by Date" class="form-control d-inline" style="width: auto;" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-danger ml-2">Search</button>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TGL</th>
                                <th>IN (Jam)</th>
                                <th>Action</th>
                                <th>NO. URUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($records as $record)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $record->created_at->format('d-m-Y') }}</td> 
                                    <td>{{ $record->created_at->format('H:i:s') }}</td> 

                                    <td>
                                        <a href="" class="badge badge-gradient-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="" class="badge badge-gradient-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $record->id }}').submit();">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                        <form id="delete-form-{{ $record->id }}" action="" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                    <td>{{$record->no_urut}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
@endsection
