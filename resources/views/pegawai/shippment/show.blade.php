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
                    <!-- Tombol Tambah Data di sebelah kiri -->
                    <a class="btn btn-primary" href="">Tambah Data</a>
                
                    <!-- Form Upload File Excel di sebelah kanan -->
                    <form action="{{ route('Ship-Mark.pegawai.add-shippmenta-excel') }}" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                        @csrf
                        <input type="file" name="shipmenta" >
                        <select style="margin-left: -60px;margin-right: 10px" name="satuan_berat" id="">
                            <option value="KG">KG</option>
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
                         <a href="{{route('Ship-Mark.pegawai.shipment-a-print', $type)}}" class="text-right mb-2 btn btn-success">Print All in This Collection</a>
                    
                        <!-- Search Button aligned to the right -->
                        <form class="form-inline" method="GET" action="{{route('Ship-Mark.admin.shipment-a-show',$id)}}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search by Atribute">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                          <thead>
                             <tr>
                                <th scope="col">#</th>
                                <th scope="col">Atribute</th>
                                <th scope="col">Unique Code</th>
                                <th scope="col">Size & Grade</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Satuan Berat</th>
                                <th>Action</th>
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
                                        <td>{{$d->atribute}}</td>
                                        <td>{{$d->unicode}}</td>
                                        <td>{{$d->size}}</td>
                                        <td>{{$d->weight}}</td>
                                        <td>{{$d->destination}}</td>
                                        <td>{{$d->satuan_berat}}</td>
                                        <td>
                                            @if (Auth::user()->role == 0)
                                                <a href="{{route('Ship-Mark.admin.shipment-a-printone', $d->atribute)}}" class="btn btn-primary mr-2 mb-2 text-center"><i class="ri-printer-line"></i></a>
                                                <a href="{{route('Ship-Mark.admin.shipment-a-edit', $d->id)}}" class="btn btn-warning mr-2 mb-2 text-center"><i class="ri-edit-2-line"></i></a>
                                                <a href="{{route('Ship-Mark.admin.shipment-a-delete', $d->id)}}" class="btn btn-danger text-center"><i class="ri-delete-bin-line"></i></a>
                                            @else
                                                <a href="{{route('Ship-Mark.pegawai.shipment-a-printone', $d->atribute)}}" class="btn btn-primary mr-2 mb-2 text-center"><i class="ri-printer-line"></i></a>
                                                <a href="{{route('Ship-Mark.pegawai.shipment-a-edit', $d->id)}}" class="btn btn-warning mr-2 mb-2 text-center"><i class="ri-edit-2-line"></i></a>
                                                <a href="{{route('Ship-Mark.pegawai.shipment-a-delete', $d->id)}}" class="btn btn-danger text-center"><i class="ri-delete-bin-line"></i></a>
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