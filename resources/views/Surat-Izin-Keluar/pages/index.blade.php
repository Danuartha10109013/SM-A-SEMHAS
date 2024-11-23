@extends('Surat-Izin-Keluar.layout.main')
@section('title')
    Surat Izin Keluar
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Surat Izin Keluar
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    
    <div class="row mb-3">
        <!-- Filter Dropdown, Month/Year Selectors, and Add New Button -->
        <div class="col-12 col-md-5 d-flex flex-wrap mb-2 mt-2">
            <div class="dropdown  me-2">
                <button class="btn btn-success dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter By
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a href="{{ route('sik', ['filter' => 'today']) }}" class="dropdown-item">Today</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'month']) }}" class="dropdown-item">Month</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'year']) }}" class="dropdown-item">Year</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'all']) }}" class="dropdown-item">All</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'keluar']) }}" class="dropdown-item">Sudah Keluar</a></li>
                </ul>
            </div>

            @if ($filter === 'month' && $months->isNotEmpty())
                <select onchange="window.location.href=this.value" class="form-select  me-2">
                    <option>Select Month</option>
                    @foreach ($months as $month)
                        <option value="{{ route('sik', ['filter' => 'month', 'month' => $month->month, 'year' => $month->year]) }}"
                            {{ request('month') == $month->month && request('year') == $month->year ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month->month)->format('F') }} {{ $month->year }}
                        </option>
                    @endforeach
                </select>
            @elseif ($filter === 'year' && $years->isNotEmpty())
                <select onchange="window.location.href=this.value" class="form-select  me-2">
                    <option>Select Year</option>
                    @foreach ($years as $year)
                        <option value="{{ route('sik', ['filter' => 'year', 'year' => $year->year]) }}"
                            {{ request('year') == $year->year ? 'selected' : '' }}>
                            {{ $year->year }}
                        </option>
                    @endforeach
                </select>
            @endif
            <a href="{{ route('sik.add') }}" class="btn btn-primary ms-0"><i class="fa fa-plus"></i> New</a>
        </div>
        <div class="col-md-3 mb-2 mt-2">
            <!-- Export Button -->
            <div class="">
                <a href="{{ route('sik.export', [
                    'filter' => request('filter', 'all'),
                    'search' => request('search'),
                    'month' => request('month'),
                    'year' => request('year')
                ]) }}" class="btn btn-info">
                    <i class="fa fa-download"></i> Export
                </a>
            </div>
        </div>
        
        <!-- Search Form -->
        <div class="col-12 col-md-4 mb-2 mt-2" >
            <form action="{{ route('sik') }}" method="GET" class="d-flex">
                <input type="text" name="search" style="background-color: white" class="form-control" placeholder="No Pol or Divisi" value="{{ request('search') }}">
                <input type="hidden" name="filter" value="{{ request('filter', 'all') }}">
                @if (request('filter') === 'month')
                    <input type="hidden" name="month" value="{{ request('month', now()->month) }}">
                    <input type="hidden" name="year" value="{{ request('year', now()->year) }}">
                @elseif (request('filter') === 'year')
                    <input type="hidden" name="year" value="{{ request('year', now()->year) }}">
                @endif
                <button type="submit" class="btn btn-danger ms-2">Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Kode SIK</th>
                    <th>Divisi</th>
                    <th>Nama / Bagian</th>
                    <th>Keperluan</th>
                    <th>Kendaraan No.</th>
                    <th>Pengemudi</th>
                    <th>Muatan</th>
                    <th>Pemberi Izin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->date }}</td>
                        <td>
                            @if ($d->status == 0)
                                <label class="text-danger">Menunggu Izin</label>
                            @elseif ($d->status == 1)
                                <label class="text-warning">Security</label>
                                @else
                                <label class="text-success">Selesai</label>
                            @endif
                        </td>
                        <td>{{ $d->kode_sik }}</td>
                        <td>{{ $d->divisi }}</td>
                        <td>{{ $d->bagian }}</td>
                        <td>{{ $d->keperluan }}</td>
                        <td>{{ $d->no_kendaraan }}</td>
                        <td>{{ $d->pengemudi }}</td>
                        <td>{{ $d->muatan }}</td>
                        <td>{{ $d->pemberi_izin }}</td>
                        <td>
                            <a href="{{ route('sik.print', $d->id) }}" class="btn btn-warning"><i class="fa fa-print"></i> Cetak</a>
                            @if ($d->status != 1)
                                <a href="{{ route('sik.edit', $d->id) }}" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('sik.delete',$d->id)}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $d->id }}">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
