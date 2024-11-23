@extends('Surat-Izin-Keluar.layout.main')
@section('title')
Persetujuan Security
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Persetujuan Security
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Filter Dropdown and Add New Button -->
        <div class="d-flex">
            <div class="dropdown mb-3">
                <button class="btn btn-success dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter By
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a href="{{ route('security', ['filter' => 'today']) }}" class="dropdown-item">Today</a></li>
                    <li><a href="{{ route('security', ['filter' => 'month']) }}" class="dropdown-item">Month</a></li>
                    <li><a href="{{ route('security', ['filter' => 'year']) }}" class="dropdown-item">Year</a></li>
                    <li><a href="{{ route('security', ['filter' => 'all']) }}" class="dropdown-item">All</a></li>
                    <li><a href="{{ route('security', ['filter' => 'keluar']) }}" class="dropdown-item">Sudah Keluar</a></li>
                </ul>
            </div>
        </div>
    
        <!-- Search Form -->
        <div class="d-flex align-items-center">
            <form action="{{ route('security') }}" method="GET" style="display: inline;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="No Pol or Divisi" value="{{ request('search') }}">
                    <input type="hidden" name="filter" value="{{ request('filter', 'all') }}">
                    <button type="submit" class="btn btn-danger">
                        <label class="m-0" style="text-decoration: none;">Search</label>
                    </button>
                </div>
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
                    <td>{{$loop->iteration}}</td>
                    <td>{{$d->date}}</td>
                    <td>
                        @if ($d->status == 1)
                        <label for="" class="text-danger">Belum Keluar</label>
                        @else
                        <label for="" class="text-success">Selesai</label>
                        @endif
                    </td>
                    <td>{{$d->kode_sik}}</td>
                    <td>{{$d->bagian}}</td>
                    <td>{{$d->keperluan}}</td>
                    <td>{{$d->no_kendaraan}}</td>
                    <td>{{$d->pengemudi}}</td>
                    <td>{{$d->muatan}}</td>
                    <td>{{$d->pemberi_izin}}</td>
                    <td>
                        @if ($d->status == 2)
                            @else
                            <a href="{{route('security.setujui',$d->id)}}" class="btn btn-success"><i class="fa fa-check"></i>Setujui</a>
                        @endif
                        <a href="{{route('sik.print',$d->id)}}" class="btn btn-warning"><i class="fa fa-print"></i>Cetak</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection