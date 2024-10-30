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
          </span> Add Submission Material CRC
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
                    <form action="{{route('Form-Check.admin.crc.create')}}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{route('Form-Check.admin.crc.create')}}" method="POST" enctype="multipart/form-data">
                    @endif
                        @method('POST')
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        
                        <label for="exampleInputUsername1">PENERIMA<small style="color: red;">*</small></label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NOMOR DOKUMEN<small style="color: red;">*</small></label>
                        <input type="text" class="form-control" name="shift_leader" id="exampleInputUsername1" required>
                      </div>
                   
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">TANGGAL SURAT JALAN<small style="color: red;">*</small></label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist <small style="color: red;">*</small></label>
                        <input type="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                      </div>
                </div>
                <hr class="mt-2">
                    <div class="form-group">
                        <label for="exampleInputPassword1">
                            PENGIRIM/SUPPLIER <small style="color: red;">*</small><br>
                        </label>
                <div class="row mt-3">
                        <div class="col-md-6">
                            <label><input type="checkbox" name="supplier[]" value="Krakatau Steel"> Krakatau Steel</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Gunung Garuda"> Gunung Garuda</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Alexindo"> Alexindo</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Essar"> Essar</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Synn Industrial"> Synn Industrial</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Langfang"> Langfang</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Baotou"> Baotou</label><br>
                        </div>
                        <div class="col-md-6">
                            <label><input type="checkbox" name="supplier[]" value="Lianxin"> Lianxin</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Ton Yi"> Ton Yi</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Shandong (Steelforce)"> Shandong (Steelforce)</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Krakatau Baja Industri"> Krakatau Baja Industri</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Stinko / Posco Vietnam"> Stinko / Posco Vietnam</label><br>
                            <label><input type="checkbox" name="supplier[]" value="Posco Korea / Posco"> Posco Korea / Posco</label><br>    
                            <!-- Checkbox untuk "Other" dengan input text -->
                            <label><input type="checkbox" id="otherCheckbox"> Other: </label>
                            <input type="text" name="supplier[]" id="otherText" disabled><br>
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
                            <label for="jumlahDropdown">Jumlah<small style="color: red;">*</small></label>
                            <select class="form-control" name="ket_awal" id="jumlahDropdown">
                                <option value="" selected disabled>--Pilih jumlah--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <hr>

                        <div class="form-group">
                            CUACA <small style="color: red;">*</small><br class="mb-3">
                            <label><input class="mt-3" type="radio" name="cuaca" value="Cerah"> Cerah</label><br>
                            <label><input type="radio" name="cuaca" value="Berawan"> Berawan</label><br>
                            <label><input type="radio" name="cuaca" value="Hujan"> Hujan</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload">FOTO <small style="color: red;">*</small><br></label>
                            <input type="file" class="" name="foto[]" id="fotoUpload" multiple>
                            <div id="fileList"></div>
                        </div>     
                          
                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>  
                        <hr>
                        
                        <div class="form-group">
                                BARANG SESUAI SURAT JALAN <small style="color: red;">*</small><br class="mb-3">
                                <label><input class="mt-3" type="radio" name="sesuai" value="sesuai"> Sesuai</label><br>
                                <label><input type="radio" name="sesuai" value="tidak sesuai"> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload1">FOTO <small style="color: red;">*</small><br></label>
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
                        <hr>

                        <div class="form-group">
                                KONDISI KEMASAN BAIK <small style="color: red;">*</small><br class="mb-3">
                                <label><input class="mt-3" type="radio" name="baik" value="baik"> Baik</label><br>
                                <label><input type="radio" name="baik" value="tidak baik"> Tidak Baik</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload2">FOTO <small style="color: red;">*</small><br></label>
                            <input type="file" class="" name="foto2[]" id="fotoUpload2" multiple>
                            <div id="fileList2"></div>
                        </div>     
                        <script>
                            var selectedFiles2 = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload2').addEventListener('change', function() {
                                var fileList2 = document.getElementById('fileList2');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles2.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList2.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles2.length; i++) {
                                    fileList2.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles2[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan2" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                        <hr>

                        <div class="form-group">
                                KERING / BASAH <small style="color: red;">*</small><br class="mb-3">
                                <label><input class="mt-3" type="radio" name="kering" value="Kering/Tidak kena air"> Kering/Tidak kena air</label><br>
                                <label><input type="radio" name="kering" value="Basah/Terdapat bercak bekas terkena air"> Basah/Terdapat bercak bekas terkena air</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload3">FOTO <small style="color: red;">*</small><br></label>
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

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            KONDISI PENGIKAT (STRAPPING) KENCANG    <small style="color: red;">*</small>                        <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="kencang" value="Kencang"> Kencang</label><br>
                                <label><input type="radio" name="kencang" value="Tidak kencang/ada yang putus"> Tidak kencang/ada yang putus</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload4">FOTO <small style="color: red;">*</small><br></label>
                            <input type="file" class="" name="foto4[]" id="fotoUpload4" multiple>
                            <div id="fileList4"></div>
                        </div>     
                        <script>
                            var selectedFiles4 = []; // Array untuk menyimpan file yang dipilih
                        
                            document.getElementById('fotoUpload4').addEventListener('change', function() {
                                var fileList4 = document.getElementById('fileList4');
                                
                                // Menambahkan file yang baru dipilih ke array
                                for (var i = 0; i < this.files.length; i++) {
                                    selectedFiles4.push(this.files[i]);
                                }
                        
                                // Reset daftar tampilan
                                fileList4.innerHTML = '';
                        
                                // Menampilkan semua file yang ada di array
                                for (var i = 0; i < selectedFiles4.length; i++) {
                                    fileList4.innerHTML += '<p>' + (i+1) + '. ' + selectedFiles4[i].name + '</p>';
                                }
                            });
                        </script>

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan4" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>
                        
                        <div class="form-group">
                            JUMLAH SESUAI SURAT JALAN<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="jumlahin" value="Sesuai"> Sesuai</label><br>
                                <label><input type="radio" name="jumlahin" value="Tidak Sesuai"> Tidak Sesuai</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload5">FOTO <small style="color: red;">*</small><br></label>
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
                        <hr>
                        
                        
                        <div class="form-group">
                            RANTAI DIALAS KARET BAN LUAR<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="alas" value="Di atas alas karet ban"> Di atas alas karet ban</label><br>
                                <label><input type="radio" name="alas" value="Tidak terdapat alas karet ban"> Tidak terdapat alas karet ban</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload6">FOTO <small style="color: red;">*</small><br></label>
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
                            <input type="text" class="form-control" name="keterangan6" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>
                        
                        <div class="form-group">
                            MENGGUNAKAN SIDE WALL<small style="color: red;">*</small>
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="wall" value="Menggunakan side wall"> Menggunakan side wall</label><br>
                                <label><input type="radio" name="wall" value="Tidak menggunakan side wall"> Tidak menggunakan side wall</label><br>
                        </div>
                        <div class="mb-3">
                            <label for="fotoUpload7">FOTO <small style="color: red;">*</small><br></label>
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
                        
                        

                        <div class="form-group">
                            <label for="exampleInputPassword1">KETERANGAN</label>
                            <input type="text" class="form-control" name="keterangan7" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group">
                            BAN DI GANJAL            <small style="color: red;">*</small>              
                            <br class="mb-3">
                                <label><input class="mt-3" type="radio" name="perganjalan" value="Ya"> Ya</label><br>
                                <label><input type="radio" name="perganjalan" value="Tidak"> Tidak</label><br>
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
