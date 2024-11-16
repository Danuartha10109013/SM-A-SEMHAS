@extends('Open-Packing.layout.main')
@section('title')
    Open Packing ||
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
          <h4 class="card-title">Perintah Open Packing</h4>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">
                <a href="{{ Auth::user()->role == 0 ? route('Open-Packing.admin.packing.add') : route('Open-Packing.pegawai.packing.add') }}" 
                   class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px">Tambahkan GM</a>
                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="btn btn-success" style="text-decoration: none; font-size: 15px">Export Excel</a> --}}
            </div>
        
            <form action="{{ route('Open-Packing.admin.packing') }}" method="GET" id="filterForm">
              <div class="row">
                  <div class="col-md-3">
                      <label for="start_date">Start Date:</label>
                      <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}" onchange="this.form.submit()">
                  </div>
                  <div class="col-md-3">
                      <label for="end_date">End Date:</label>
                      <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}" onchange="this.form.submit()">
                  </div>
                  <div class="col-md-2">
                      <label for="month">Month:</label>
                      <select name="month" id="month" class="form-control" onchange="this.form.submit()">
                          <option value="">Select Month</option>
                          @for ($i = 1; $i <= 12; $i++)
                              <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                  {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                              </option>
                          @endfor
                      </select>
                  </div>
                  <div class="col-md-2">
                      <label for="year">Year:</label>
                      <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                          <option value="">Select Year</option>
                          @for ($year = now()->year; $year >= 2000; $year--)
                              <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                  {{ $year }}
                              </option>
                          @endfor
                      </select>
                  </div>
                  <div class="col-md-2">
                      <label for="search">Search:</label>
                      <input type="text" name="search" id="search" class="form-control" placeholder="Search GM" value="{{ request('search') }}" onkeyup="this.form.submit()">
                  </div>
              </div>
          </form>
          <script>
            let timeout = null;
        
            // Delay for search input to prevent too many requests
            document.getElementById('search').addEventListener('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 500);
            });
        
            // Prevent immediate submission on initial page load
            window.addEventListener('load', function () {
                document.querySelectorAll('#filterForm input, #filterForm select').forEach(function (element) {
                    element.addEventListener('change', function () {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            document.getElementById('filterForm').submit();
                        }, 300);
                    });
                });
            });
        </script>
                  
        </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Date </th>
                  <th> No GM </th>
                  <th> Action </th>
                  <th> Total </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->created_at->format('d-m-Y')}} </td>
                    <td> {{$d->gm}} </td>
                    <td><a href="{{route('Open-Packing.admin.packing.add.gm',$d->gm)}}">
                      <label class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.show',$d->gm)}}">
                      <label class="btn btn-success">
                        <i class="fas fa-eye"></i> Show
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.print',$d->gm)}}">
                      <label class="btn btn-warning">
                        <i class="fas fa-print"></i> Print
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.download',$d->gm)}}">
                      <label class="btn btn-dark">
                        <i class="fa fa-download"></i> Export
                      </label></a>
                    </td>
                    <td>
                      @php
                        $total = \App\Models\PackingM::where('gm',$d->gm)->count();
                      @endphp
                      
                      {{$total}} </td>

                    
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