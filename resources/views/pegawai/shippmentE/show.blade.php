@extends('layout.pegawai.main')

@section('title')
    Shippment E || {{ Auth::user()->role == 0 ? 'Admin' : 'Pegawai' }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="save d-flex justify-content-between align-items-center mb-3">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <a class="btn btn-primary" href="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.shipment-e-add' : 'Ship-Mark.pegawai.shipment-e-add') }}">Tambah Data</a>
                    
                    <form action="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.add-shippmente-excel' : 'Ship-Mark.pegawai.add-shippmente-excel') }}" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                        @csrf
                        <input type="file" name="shipmentb">
                        <select class="ms-2 me-2" name="satuan_berat">
                            <option value="KG">KG</option>
                            <option value="LBS">LBS</option>
                            <option value="MT">MT</option>
                        </select>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>

                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <h4 class="card-title">Shippment E</h4>
                    </div>
                    
                    <div class="iq-card-body d-flex justify-content-between align-items-center">
                        <a href="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.shipment-e-print' : 'Ship-Mark.pegawai.shipment-e-print', $type) }}" class="btn btn-success">Print All in This Collection</a>
                        <form class="form-inline" method="GET" action="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.shipment-e-show' : 'Ship-Mark.pegawai.shipment-e-show', $id) }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ $search ?? '' }}" placeholder="Search by Attribute">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </form>
                    </div>

                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Attribute</th>
                                <th>Name</th>
                                <th>POD</th>
                                <th>Product</th>
                                <th>Net/Weight</th>
                                <th>Satuan Berat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $d->attribute }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->pod }}</td>
                                    <td>{{ $d->product }}</td>
                                    <td>{{ $d->weight }}</td>
                                    <td>{{ $d->satuan_berat }}</td>
                                    <td>
                                        <a href="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.shipment-e-printone' : 'Ship-Mark.pegawai.shipment-e-printone', $d->id) }}" class="btn btn-primary"><i class="ri-printer-line"></i></a>
                                        <a href="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.shipment-e-edit' : 'Ship-Mark.pegawai.shipment-e-edit', $d->id) }}" class="btn btn-warning"><i class="ri-edit-2-line"></i></a>
                                        <a href="{{ route(Auth::user()->role == 0 ? 'Ship-Mark.admin.shipment-e-delete' : 'Ship-Mark.pegawai.shipment-e-delete', $d->id) }}" class="btn btn-danger"><i class="ri-delete-bin-line"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center">Data Tidak Ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
