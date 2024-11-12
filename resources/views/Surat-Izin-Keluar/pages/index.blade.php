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
        <!-- Filter Dropdown and Add New Button -->
        <div class="d-flex">
            <div class="dropdown mb-3">
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
            <a href="{{ route('sik.add') }}" class="btn btn-primary mb-3 ml-3"><i class="fa fa-plus"></i> Make New</a>
        </div>
    
        <!-- Search Form -->
        <div class="d-flex align-items-center">
            <form action="{{ route('sik') }}" method="GET" style="display: inline;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search By No Pol" value="{{ request('search') }}">
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
                        <a href="{{route('sik.print',$d->id)}}" class="btn btn-warning"><i class="fa fa-print"></i>Cetak</a>
                        @if ($d->status != 1)
                            <a href="{{route('sik.edit',$d->id)}}" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                            <!-- Delete Button to Trigger Modal -->
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $d->id }}">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        @else

                        @endif
                    

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this item?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <a href="#" id="confirmDelete" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const deleteModal = document.getElementById('deleteModal');
                                deleteModal.addEventListener('show.bs.modal', function(event) {
                                    // Button that triggered the modal
                                    const button = event.relatedTarget;
                                    // Get item ID from data attribute
                                    const itemId = button.getAttribute('data-id');
                                    // Update confirm delete link with route
                                    const confirmDelete = deleteModal.querySelector('#confirmDelete');
                                    confirmDelete.setAttribute('href', `/Surat-Izin-Keluar/delete/${itemId}`);
                                });
                            });
                        </script>

                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection