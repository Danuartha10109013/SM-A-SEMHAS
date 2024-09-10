@extends('layout.pegawai.main')
@section('title')
Shippment || Pegawai 
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
                    <a class="btn btn-primary" href="{{route('pegawai.shipment-a-add')}}">Tambah Data</a>
                
                    <!-- Form Upload File Excel di sebelah kanan -->
                    <form action="{{ route('pegawai.add-shippmenta-excel') }}" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
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
                    <div class="iq-card-body">
                       <p>All data of Shippment type A <a href="{{ route('download.file', ['file' => 'ShippmentA.xlsx']) }}">
                        Download Template
                    </a>
                    </p>
                       <table class="table">
                          <thead>
                             <tr>
                                <th scope="col">#</th>
                                <th scope="col">Collection</th>
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
                                        <td class="mr-2" ><a class="btn btn-primary" href="{{route('pegawai.shipment-a-show',$d->type)}}"><i class="ri-eye-line"></i>Show</a>
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