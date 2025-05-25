@extends('layout.pegawai.main')
@section('title')
@if (Auth::user()->role == 0)
Shippment A || Admin 
@else
Shippment A || Pegawai 
@endif
@endsection
@section('content')
        <div class="container-fluid">
           <div class="row">
               <div class="col-sm-12 col-lg-12">
                <div class="save d-flex justify-content-between align-items-center mb-3">
                   @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- Tombol Tambah Data di sebelah kiri -->
                    @if (Auth::user()->role == 0)
                    <a class="btn btn-primary" href="{{route('Ship-Mark.admin.shipment-a-add')}}">Tambah Data</a>
                    @else
                    <a class="btn btn-primary" href="{{route('Ship-Mark.pegawai.shipment-a-add')}}">Tambah Data</a>
                    @endif
                
                    <!-- Form Upload File Excel di sebelah kanan -->
                    @if (Auth::user()->role == 0)
                    <form action="{{ route('Ship-Mark.admin.add-shippmenta-excel') }}" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                    @else
                    <form action="{{ route('Ship-Mark.pegawai.add-shippmenta-excel') }}" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                    @endif   
                    @csrf
                        <input type="file" name="shipmenta" >
                        <select style="margin-left: -60px;margin-right: 10px" name="satuan_berat" id="">
                            <option value="KGS">KGS</option>
                            <option value="LBS">LBS</option>
                            <option value="MT">MT</option>
                        </select>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>


                    
                </div>
                
                
                 <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                       <div class="iq-header-title">
                          <h4 class="card-title">Shippment A</h4>
                       </div>
                    </div>
                    <div class="iq-card-body d-flex justify-content-between align-items-center">
                        <p>All data of Shipment type A 
                            <a href="{{ route('download.file', ['file' => 'ShippmentA.xlsx']) }}">
                                Download Template
                            </a>
                        </p>
                        @if (Auth::user()->role == 0)
                        <form class="form-inline" method="GET" action="{{ route('Ship-Mark.admin.shipment-a') }}">
                        @else
                        <form class="form-inline" method="GET" action="{{ route('Ship-Mark.pegawai.shipment-a') }}">
                        @endif    <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search by no SO">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    </p>
                       <table class="table">
                          <thead>
                             <tr>
                                <th scope="col">#</th>
                                <th scope="col">No SO</th>
                                <th scope="col">Action</th>
                             </tr>
                          </thead>
                          <tbody>
                            @if (empty($data) || $data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center">Data Tidak Ada</td>
                                </tr>
                            @else
                                @foreach ($data as $d)
                                    <tr>
                                        <th>{{$loop->iteration}}</th>
                                        <td>{{$d->type}}</td>
                                        <td >
                                            @if (Auth::user()->role == 0)
                                            <a class="btn btn-primary" href="{{route('Ship-Mark.admin.shipment-a-show',$d->type)}}">
                                                <i class="ri-eye-line"></i>Show
                                            </a>
                                            @else
                                            <a class="btn btn-primary" href="{{route('Ship-Mark.pegawai.shipment-a-show',$d->type)}}">
                                                <i class="ri-eye-line"></i>Show
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        
                        </table>
                    </div>
                 </div>
                 
              </div>
              
           </div>
        </div>
     </div>
@endsection