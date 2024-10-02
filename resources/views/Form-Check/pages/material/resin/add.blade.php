@extends('Form-Check.layout.main')
@section('title')
    Form Submission Material CRC
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
          </span> Add Submission Material RESIN
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
                <h4 class="card-title">From Daily Checklist Kedatangan Material  FM.WH.02.01</h4>
                <p class="card-description">Form checklist ini dibuat untuk memastikan kondisi material yang datang dalam kondisi baik (tanpa cacat) sesuai dengan spesifikasi yang telah di tentukan sebelumnya. <br>
                    <br>Serta untuk melihat kesesuaian material yang ada pada surat jalan dengan kondisi fisiknya.</p>
                    @if (Auth::user()->role == 0)
                    <form action="{{route('Form-Check.admin.resin.create')}}" method="POST" enctype="multipart/form-data">
                    @else
                    <form action="{{route('Form-Check.pegawai.resin.create')}}" method="POST" enctype="multipart/form-data">
                    @endif
                @method('POST')
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputUsername1">PENERIMA</label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NOMOR DOKUMEN</label>
                        <input type="text" class="form-control" name="shift_leader" id="exampleInputUsername1" required>
                      </div>
                   
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">TANGGAL SURAT JALAN</label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist</label>
                        <input type="time" name="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                      </div>
                </div>
                <hr class="mt-2">


                    <div class="form-group">
                        <label for="exampleInputPassword1">
                            PENGIRIM/SUPPLIER <br>
                        </label>
                <div class="row mt-3">
                    
                        <div class="col-md-6">
                            <label><input type="radio" name="supplier[]" value="Metal Coat"> Metal Coat</label><br>
                            <label><input type="radio" name="supplier[]" value="Inkote"> Inkote</label><br>
                            <label><input type="radio" id="otherCheckbox"> Other: </label>
                            <input type="text" name="supplier[]" id="otherText" disabled><br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                JENIS <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="jenis" value="RESIN"> RESIN</label><br>
                                <label><input type="radio" name="jenis" value="ALKALI"> Zinc Ingot</label><br>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <script>
                    document.getElementById('otherCheckbox').addEventListener('change', function() {
                        var otherText = document.getElementById('otherText');
                        otherText.disabled = !this.checked;
                    });
                </script>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            CUACA <br class="mb-3">
                            <label><input class="mt-3" type="radio" name="cuaca" value="Cerah"> Cerah</label><br>
                            <label><input type="radio" name="cuaca" value="Berawan"> Berawan</label><br>
                            <label><input type="radio" name="cuaca" value="Hujan"> Hujan</label><br>
                        </div>
                        <div class="form-group">
                            TUJUAN SURAT JALAN <br class="mb-3">
                            <label><input class="mt-3" type="radio" name="jalan" value="Sesuai"> Sesuai</label><br>
                            <label><input type="radio" name="jalan" value="Tidak Sesuai"> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload">FOTO <br></label>
                            <input type="file" class="" name="foto[]" id="fotoUpload" multiple>
                            <div id="fileList"></div>
                        </div>     
                        <script>
                            var selectedFiles = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload').addEventListener('change', function() {
                                var fileList = document.getElementById('fileList');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList1.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles.length; i++) {
                                    fileList.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles[i].name + '</p>';
                                }
                            });
                        </script>
                          
                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>  
                        
                        <div class="form-group">
                                BARANG SESUAI SURAT JALAN <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="sesuai" value="sesuai"> Sesuai</label><br>
                                <label><input type="radio" name="sesuai" value="tidak sesuai"> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload1">FOTO <br></label>
                            <input type="file" class="" name="foto1[]" id="fotoUpload1" multiple>
                            <div id="fileList1"></div>
                        </div>     
                        <script>
                            var selectedFiles1 = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload1').addEventListener('change', function() {
                                var fileList1 = document.getElementById('fileList1');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles1.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList1.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles1.length; i++) {
                                    fileList1.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles1[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan1" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>


                        
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            KERING / BASAH <br class="mb-3">
                            <label><input class="mt-3" type="radio" name="kering" value="Kering/Tidak kena air"> Kering/Tidak kena air</label><br>
                            <label><input type="radio" name="kering" value="Basah/Terdapat bercak bekas terkena air"> Basah/Terdapat bercak bekas terkena air</label><br>
                    </div>
                    <div class="mb-3">
                        <label for="fotoUpload3">FOTO <br></label>
                        <input type="file" class="" name="foto3[]" id="fotoUpload3" multiple>
                        <div id="fileList3"></div>
                    </div>     
                    <script>
                        var selectedFiles3 = []; // Array untuk menyimpan file yang dipilih
                    
                        document.getElementById('fotoUpload3').addEventListener('change', function() {
                            var fileList3 = document.getElementById('fileList3');
                            
                            // Menambahkan file yang baru dipilih ke array
                            for (var i = 0; i < this.files.length; i++) {
                                selectedFiles3.push(this.files[i]);
                            }
                    
                            // Reset daftar tampilan
                            fileList3.innerHTML = '';
                    
                            // Menampilkan semua file yang ada di array
                            for (var i = 0; i < selectedFiles3.length; i++) {
                                fileList3.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles3[i].name + '</p>';
                            }
                        });
                    </script>

                    <div class="form-group">
                        <label for="exampleInputPassword1">KETERANGAN</label>
                        <input type="text" class="form-control" name="keterangan3" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                    </div>

                        <div class="form-group">
                            JUMLAH SESUAI SURAT JALAN
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="jumlahin" value="Sesuai"> Sesuai</label><br>
                                <label><input type="radio" name="jumlahin" value="Tidak Sesuai"> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload5">FOTO <br></label>
                            <input type="file" class="" name="foto5[]" id="fotoUpload5" multiple>
                            <div id="fileList5"></div>
                        </div>     
                        <script>
                            var selectedFiles5 = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload5').addEventListener('change', function() {
                                var fileList5 = document.getElementById('fileList5');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles5.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList5.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles5.length; i++) {
                                    fileList5.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles5[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan5" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <div class="form-group">
                            DRUM TIDAK PENYOK/BOCOR (RESIN-ALKALI)
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="drum" value="Sesuai"> Sesuai</label><br>
                                <label><input type="radio" name="drum" value="Tidak Sesuai"> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload6">FOTO <br></label>
                            <input type="file" class="" name="foto6[]" id="fotoUpload6" multiple>
                            <div id="fileList6"></div>
                        </div>     
                        <script>
                            var selectedFiles6 = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload6').addEventListener('change', function() {
                                var fileList6 = document.getElementById('fileList6');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles6.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList6.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles6.length; i++) {
                                    fileList6.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles6[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan5" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
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
