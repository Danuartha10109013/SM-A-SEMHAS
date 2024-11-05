@extends('Form-Check.layout.main')
@section('title')
    Form Submission EUP
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Add Submission EUP
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>
      <div class="row stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">From Daily Checklist Pallet EUP </h4>
                <p class="card-description">Formulir ini dibuat untuk memastikan kondisi Pallet yang di terima dalam kondisi sesuai standar. Serta, untuk memastikan kondisi Pallet yang ada dalam layout penyimpanan dalam keadaan standar (tidak ada yang pecah atau patah) <br>
                  </p>
                    @if (Auth::user()->role == 0)
                    <form action="{{route('Form-Check.admin.eup.create')}}" method="POST" enctype="multipart/form-data">
                    @else
                    <form action="{{route('Form-Check.pegawai.eup.create')}}" method="POST" enctype="multipart/form-data">
                    @endif
                        @method('POST')
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputUsername1"><b>Checker Pallet<small style="color: red;">*</small></b>
                        </label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1"><b>Tanggal Pengecekan Pallet<small style="color: red;">*</small></b>
                        </label>
                        <input type="date" name="date" class="form-control" id="exampleInputUsername1" value="" >
                      </div>

                      <div class="form-group">
                        <b>Jenis Pengecekan<small style="color: red;">*</small></b> <br class="mb-3">
                        <label><input class="mt-3" type="radio" name="jenis" value="Penerimaan Pallet"> Penerimaan Pallet</label><br>
                        <label><input type="radio" name="jenis" value="Pengecekan Pergantian Shift (Layout Penyimpanan Pallet dan EUP)"> Pengecekan Pergantian Shift (Layout Penyimpanan Pallet dan EUP)</label><br>
                    </div>
                </div>
                <hr class="mt-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">
                           <b> Kondisi Kaki Pallet <small style="color: red;">*</small></b><br>
                        </label>
                <div class="row mt-3">
                        <div class="col-md-6">
                            <label><input type="checkbox" name="kaki_pallet[]" value="Bentuk kaki simetris (Balok)">
                              <img src="{{asset('pallet1.jpg')}}" width="70%" alt=""><br> Bentuk kaki simetris (Balok)</label><br>
                            
                        </div>
                        <div class="col-md-6">
                            <label><input type="checkbox" name="kaki_pallet[]" value="Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata">
                              <img src="{{asset('pallet2.jpg')}}" width="50%" alt=""><br> Bentuk kaki bagian bawah rata namun bagian atas sedikit tidak rata</label><br>
                            
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        
                        
                        
                        <div class="form-group">
                          <label for="exampleInputPassword1">
                           <b> Kondisi Papan Permukaan Pallet <small style="color: red;">*</small></b> <br>
                          </label>
                            <label><input type="checkbox" name="permukaan_pallet" value="Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)">
                              <img src="{{asset('pallet3.jpg')}}" width="50%" alt=""><br> Permukaan Papan Rata (Tidak Pecah, Tidak Patah dan Tidak Basah)</label><br>
                        </div>  
                        <hr>
                        <div class="form-group">
                          <label for="exampleInputPassword1">
                           <b> Kondisi Ketebalan Papan Pallet <small style="color: red;">*</small></b> <br>
                          </label>
                            <label><input type="checkbox" name="ketebalan_pallet" value="Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)">
                              <img src="{{asset('pallet4.png')}}" width="50%" alt=""><br> Ketebalan Papan (Tidak Pecah, Tidak Patah dan Tidak Basah)</label><br>
                        </div>  
                        <hr>
                        <div class="form-group">
                          <label for="exampleInputPassword1">
                            <b>Kondisi Paku pada Pallet <small style="color: red;">*</small></b> <br>
                          </label>
                            <label><input type="checkbox" name="paku_pallet" value="Paku tidak Keluar">
                              <img src="{{asset('pallet4.png')}}" width="50%" alt=""><br> Paku tidak Keluar</label><br>
                        </div>  
                        <hr>
                    
                    </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <label for="exampleInputPassword1">
                         <b> Kondisi Paku pada Pallet <small style="color: red;">*</small></b> <br>
                        </label>
                          <label><input type="checkbox" name="keluar_pallet" value="Paku Keluar">
                            <img src="{{asset('pallet9.png')}}" width="50%" alt=""><br> Paku Keluar</label><br>
                      </div>
                        <hr>
                        
                        <div class="form-group">
                         <b> Kondisi Pallet Sesuai Standar Warehouse TML <small style="color: red;">*</small></b>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="sesuai" value="Ya"> Ya</label><br>
                                <label><input type="radio" name="sesuai" value="Tidak"> Tidak</label><br>
                        </div>
                        <div class="form-group">
                          <b>Proses yang dilakukan?<small style="color: red;">*</small></b>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="action" value="Pallet diterima"> Pallet diterima</label><br>
                                <label><input type="radio" name="action" value="Pallet ditolak"> Pallet ditolak</label><br>
                                <label><input type="radio" name="action" value="Pallet diganti"> Pallet diganti</label><br>
                                <label><input type="radio" name="action" value="Pallet dilayout OK"> Pallet dilayout OK</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload7"><b>Bukti  Foto <small style="color: red;">*</small></b><br></label>
                            <input type="file" class="" name="foto7[]" id="fotoUpload7" multiple>
                            <div id="fileList7"></div>
                        </div>     
                        <script>
                            var selectedFiles7 = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload7').addEventListener('change', function() {
                                var fileList7 = document.getElementById('fileList7');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles7.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList7.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles7.length; i++) {
                                    fileList7.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles7[i].name + '</p>';
                                }
                            });
                        </script>
                    <hr>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">
                       <b> Kondisi Kaki Pallet</b> <small style="color: red;">*</small><br>
                      </label>
                      <div class="row">
                        <div class="col-md-6">
                          <label><input type="checkbox" name="kaba_simetris" value="Bentuk kaki bagian bawah tidak simetris (Tidak Balok)">
                            <img src="{{asset('pallet5.jpg')}}" width="50%" alt=""><br> Bentuk kaki bagian bawah tidak simetris (Tidak Balok)</label><br>
                      
                        </div>
                        <div class="col-md-6">
                          <label><input type="checkbox" name="kaba_asimetris" value="Bentuk kaki bagian atas tidak simetris (Tidak Balok)">
                            <img src="{{asset('pallet6.jpg')}}" width="50%" alt=""><br> Bentuk kaki bagian atas tidak simetris (Tidak Balok)</label><br>
                          </div>
                        </div>
                        <hr>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">
                       <b> Kondisi Papan Permukaan Pallet <small style="color: red;">*</small></b><br>
                      </label>
                      <div class="row">
                        <div class="col-md-6">
                          <label><input type="checkbox" name="papan_patah" value="Papan Permukaan Pallet Patah">
                            <img src="{{asset('pallet7.jpg')}}" width="50%" alt=""><br> Papan Permukaan Pallet Patah</label><br>
                      
                        </div>
                        <div class="col-md-6">
                          <label><input type="checkbox" name="papan_pecah" value="Papan Permukaan Pallet Pecah">
                            <img src="{{asset('pallet8.jpg')}}" width="50%" alt=""><br> Papan Permukaan Pallet Pecah</label><br>
                      
                        </div>
                      </div>
                    </div>
                </div>

                

                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    
            </form>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection