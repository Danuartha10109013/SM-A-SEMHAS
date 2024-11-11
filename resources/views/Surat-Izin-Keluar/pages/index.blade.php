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
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Left Section: Buttons -->
        <div class="d-flex">
            <!-- Dropdown for Filters -->
            <div class="dropdown mb-3">
                <button class="btn btn-success dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter By
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a href="{{ route('sik', ['filter' => 'today']) }}" class="dropdown-item">Today</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'month']) }}" class="dropdown-item">Month</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'year']) }}" class="dropdown-item">Year</a></li>
                    <li><a href="{{ route('sik', ['filter' => 'all']) }}" class="dropdown-item">All</a></li>
                </ul>
            </div>
            <a href="{{ route('sik.add') }}" class="btn btn-primary mb-3 ml-3"><i class="fa fa-plus"></i> Make New</a>
        </div>
        
        <!-- Right Section: Search Form -->
        <div class="d-flex align-items-center">
            <form action="{{ route('sik') }}" method="GET" style="display: inline;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search By No Pol" style="width: auto;" value="{{ request('search') }}">
                    <input type="hidden" name="filter" value="{{ request('filter', 'all') }}"> <!-- Pass the current filter value -->
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
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
                        @if ($d->status == 0)
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
                        <a href="" class="btn btn-warning"><i class="fa fa-print"></i>Cetak</a>
                        <a href="" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection