@extends('Form-Check.layout.main')
@section('title')
    Form Submission Trailler
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
          </span> Add Submission Trailler
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
                <h4 class="card-title">From Daily Checklist Trailler</h4>
                <p class="card-description"> FORMULIR Forklift <br>
                    PENGISIAN FORMULIR DILAKUKAN AWAL SHIFT/SEBELUM DIGUNAKAN </p>
            @if (Auth::user()->role == 0)
            <form action="{{route('Form-Check.admin.trailler.create')}}" method="POST">
            @else
            <form action="{{route('Form-Check.pegawai.trailler.create')}}" method="POST">
            @endif
                @method('POST')
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputUsername1">NAMA OPERATOR CHEKLIST TRAILER<small style="color: red;">*</small></label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="atribute" class="form-label">Team Lead<small style="color: red;">*</small></label>
                        <select type="text" name="shift_leader" id="team" class="form-control" required>
                          @php
                                $team_lead = \App\Models\TeamLeadM::where('active',1)->whereJsonContains('type', 'FC')->get()
                            @endphp
                          <option value="" selected disabled>--Pilih Shift Leader--</option>
                          @foreach ($team_lead as $tl)
                          <option value="{{$tl->name}}">{{$tl->name}}</option>
                              
                          @endforeach <!-- Add this option -->
                      </select>
                    </div>
                  
                  <!-- Input field for custom keterangan -->
                  <div class="mb-3" id="other-keterangan-container" style="display: none;">
                      <label for="other-keterangan" class="form-label">Please specify</label>
                      <input type="text" name="other_sift_leader" id="other-keterangan" class="form-control" placeholder="Enter new Shift Leader">
                  </div>
                  <script>
                      document.getElementById('team').addEventListener('change', function() {
                          var otherKeteranganContainer = document.getElementById('other-keterangan-container');
                          if (this.value === 'other') {
                              otherKeteranganContainer.style.display = 'block'; // Show the custom input field
                          } else {
                              otherKeteranganContainer.style.display = 'none'; // Hide the custom input field
                          }
                      });
                  </script>
                    

                    <div class="form-group">
                        <label for="label">NO TRAILER/DRIVER<small style="color: red;">*</small>
                        </label>
                        <select class="form-control" name="jenis_forklift" id="exampleSelectOption" required>
                            <option value="">--Pilih Trailler--</option>
                            @php
                                $trailer = \App\Models\TrailerNameM::all();
                            @endphp

                            @foreach ($trailer as $t)
                                <option value="{{ $t->no_mobil }}/{{ $t->pengguna }}" 
                                    {{ old('jenis_forklift') == $t->no_mobil . '/' . $t->pengguna ? 'selected' : '' }}>
                                    {{ $t->no_mobil }}/{{ $t->pengguna }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hari / Tanggal<small style="color: red;">*</small></label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist Trailler<small style="color: red;">*</small></label>
                        <input type="time" class="form-control" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                      </div>
                </div>
                <p class="card-description"> JIKA KETERANGAN (X,O) HARAP SEGERA INFORMASI KE MAINTENANCE  </p>
                <p>KETERANGAN: <br>
                    <b>V</b>: KONDISI BAIK <br>
                    <b>X</b>: KONDISI TIDAK BAIK DAN TRAILLER TIDAK BISA DIGUNAKAN <br>
                    <b>O</b>: KONDISI TIDAK BAIK NAMUN MASIH BISA DIGUNAKAN</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pastikan kondisi Carrier Trailer bagus atau tidak <small style="color: red;">*</small><br>
                                <b>Bagian penghubung terlumasi dan tidak ada yang menganjal</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="carrier" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="carrier" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="carrier" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pastikan kondisi Carrier Trailer bagus atau tidak</label>
                            <input type="text" class="form-control" name="ket_carrier" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Hook pengait rantai <small style="color: red;">*</small><br>
                                <b>Kondisi weldingan bagus</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="rantai" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rantai" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rantai" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Hook pengait rantai</label>
                            <input type="text" class="form-control" name="ket_rantai" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Kondisi Ban dalam keadaan baik <small style="color: red;">*</small> <br>
                                <b>Ban tidak bocor,masih ada kembangan dan tidak retak</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="ban" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ban" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ban" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Kondisi Ban dalam keadaan baik</label>
                            <input type="text" class="form-control" name="ket_ban" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Ban cadangan <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="cadangan" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="cadangan" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="cadangan" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Ban cadangan</label>
                            <input type="text" class="form-control" name="ket_cadangan" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu sein kanan dan kiri <small style="color: red;">*</small><br>
                                <b>MENYALA KANAN DAN KIRI</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="sein" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sein" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="sein" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Lampu sein kanan dan kiri</label>
                            <input type="text" class="form-control" name="ket_sein" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu rotating <small style="color: red;">*</small><br>
                                <b>Menyala jika di operasikan</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="rotating" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rotating" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rotating" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pengecekan Lampu rotating</label>
                            <input type="text" class="form-control" name="ket_rotating" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu stop <small style="color: red;">*</small><br>
                                <b>Menyala jika di operasikan</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="stop" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="stop" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="stop" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Lampu stop</label>
                            <input type="text" class="form-control" name="ket_stop" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu utama <small style="color: red;">*</small><br>
                                <b>Menyala jika di operasikan</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="utama" id="startX" value="h" {{ old('utama') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="utama" id="startV" value="l" {{ old('utama') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>                       
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Pengecekan Level Air utama (H/L)</label>
                            <input type="text" class="form-control" name="ket_utama" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu kota <small style="color: red;">*</small><br>
                                <b>LEVEL HARUS DIATAS L</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="kota" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="kota" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="kota" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Lampu kota</label>
                            <input type="text" class="form-control" name="ket_kota" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Battery connector <small style="color: red;">*</small><br>
                                <b>Kencang</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="connector" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="connector" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="connector" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Battery connector</label>
                            <input type="text" class="form-control" name="ket_connector" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Level air accu (H/L) <small style="color: red;">*</small> <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="accu" id="startX" value="h" {{ old('start') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="accu" id="startV" value="l" {{ old('start') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Level air accu (H/L)</label>
                            <input type="text" class="form-control" name="ket_accu" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Air coolant <br>
                                <b>LEVEL HARUS DIATAS L <small style="color: red;">*</small></b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="coolant" id="startX" value="h" {{ old('start') == 'h' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    H
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="coolant" id="startV" value="l" {{ old('coolant') == 'l' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    L
                                </label>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Air coolant</label>
                            <input type="text" class="form-control" name="ket_coolant" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake parking <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="parking" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="parking" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="parking" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake parking</label>
                            <input type="text" class="form-control" name="ket_parking" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                    </div>

                    
                    
                    <div class="col-md-6">

                        

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="brake" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brake" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="brake" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Brake</label>
                            <input type="text" class="form-control" name="ket_brake" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Horn <small style="color: red;">*</small><br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="horn" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="horn" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="horn" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Horn</label>
                            <input type="text" class="form-control" name="ket_horn" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Alarm mundur <small style="color: red;">*</small><br>
                                <b>TIDAK ADA YANG RETAK/PUTUS</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="mundur" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="mundur" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="mundur" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Alarm mundur</label>
                            <input type="text" class="form-control" name="ket_mundur" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                All U bolt clamp per <small style="color: red;">*</small><br>
                                <b>Berfungsi normal</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="clamp" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="clamp" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="clamp" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan All U bolt clamp per</label>
                            <input type="text" class="form-control" name="ket_clamp" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Terpal <small style="color: red;">*</small><br>
                                <b>Ada dan tidak sobek</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="terpal" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="terpal" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="terpal" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Terpal</label>
                            <input type="text" class="form-control" name="ket_terpal" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Rantai pengikat <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="rantai_pe" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rantai_pe" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="rantai_pe" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Rantai pengikat</label>
                            <input type="text" class="form-control" name="ket_rantai_pe" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Ganjal ban <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="ganjal" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ganjal" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="ganjal" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>

                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Ganjal ban</label>
                            <input type="text" class="form-control" name="ket_ganjal" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Palet/ganjalan coil + karet <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="pallet" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="pallet" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="pallet" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Palet/ganjalan coil + karet</label>
                            <input type="text" class="form-control" name="ket_pallet" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Apar <small style="color: red;">*</small><br>
                                <b>Ada dan belum expired</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="apar" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="apar" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="apar" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan apar ban</label>
                            <input type="text" class="form-control" name="ket_apar" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Kotak P3K <small style="color: red;">*</small><br>
                                <b>Ada dan belum expired</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="p3k" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="p3k" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="p3k" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Kotak P3K</label>
                            <input type="text" class="form-control" name="ket_p3k" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Fancing/pembatas di atas Carrier <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="fancing" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="fancing" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="fancing" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Fancing/pembatas di atas Carrier</label>
                            <input type="text" class="form-control" name="ket_fancing" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Red triangle <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="triangle" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="triangle" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="triangle" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Red triangle</label>
                            <input type="text" class="form-control" name="ket_triangle" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>
                        <hr>

                        <div class="form-group p-3 border rounded bg-light">
                            <label for="exampleInputPassword1" class="text-dark">
                                Tools penggantian roda <small style="color: red;">*</small><br>
                                <b>Ada dan kondisi baik</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="tools" id="startX" value="v" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    V
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="tools" id="startV" value="x" {{ old('start') == 'v' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startV">
                                    X
                                </label>
                            </div>
                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="tools" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan Tools penggantian roda</label>
                            <input type="text" class="form-control" name="ket_tools" id="exampleInputPassword1" placeholder="Masukan keterangan jika ada">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputPassword1">CATATAN</label>
                            <input type="text" class="form-control" name="catatan" id="exampleInputPassword1" placeholder="Masukan catatan jika ada">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama MTC yang bertugas<small style="color: red;">*</small></label>
                            <input type="text" class="form-control" name="mtc" id="exampleInputPassword1" placeholder="Masukan MTC ">
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