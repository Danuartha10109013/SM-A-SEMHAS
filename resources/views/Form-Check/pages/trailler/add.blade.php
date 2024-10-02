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
                        <label for="exampleInputUsername1">NAMA OPERATOR CHEKLIST TRAILER</label>
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <input type="text" class="form-control" id="exampleInputUsername1" value="{{ Auth::user()->name }}" readonly>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NAMA SHIFT LEADER BERTUGAS</label>
                        <input type="text" class="form-control" name="shift_leader" id="exampleInputUsername1" required>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">NAMA MTC YANG BERTUGAS</label>
                        <input type="text" class="form-control" name="mtc_name" id="exampleInputUsername1" required>
                      </div>

                    <div class="form-group">
                        <label for="label">NO TRAILER/DRIVER
                        </label>
                        <select class="form-control" name="jenis_forklift" id="exampleSelectOption" required>
                            <option value="B 9134 BEA/PAK ANDRI-PAK RIZKI" {{ old('jenis_forklift') == 'B 9134 BEA/PAK ANDRI-PAK RIZKI' ? 'selected' : '' }}>B 9134 BEA/PAK ANDRI-PAK RIZKI</option>
                            <option value="B 9159 BEA/PAK DASEP-PAK ROHIMAT" {{ old('jenis_forklift') == 'B 9159 BEA/PAK DASEP-PAK ROHIMAT' ? 'selected' : '' }}>B 9159 BEA/PAK DASEP-PAK ROHIMAT</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hari / Tanggal</label>
                        <input type="Date" class="form-control" name="date" id="exampleInputEmail1" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Jam Checklist Trailler</label>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Pastikan kondisi Carrier Trailer bagus atau tidak <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Hook pengait rantai <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Kondisi Ban dalam keadaan baik <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Ban cadangan <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu sein kanan dan kiri<br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu rotating <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu stop<br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu utama <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Lampu kota<br>
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

                        

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Battery connector<br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Level air accu (H/L) <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Air coolant <br>
                                <b>LEVEL HARUS DIATAS L</b>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake parking <br>
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

                        

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Brake<br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Horn <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Alarm mundur<br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                All U bolt clamp per <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Terpal<br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Rantai pengikat <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Ganjal ban <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Palet/ganjalan coil + karet <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Apar <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Kotak P3K <br>
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

                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Fancing/pembatas di atas Carrier <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Red triangle <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                Tools penggantian roda <br>
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
                        <div class="form-group p-3 border rounded bg-secondary">
                            <label for="exampleInputPassword1" class="text-dark">
                                NAMA MTC YANG BERTUGAS <br>
                                <b>BERFUNGSI NORMAL</b>
                            </label>
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="radio" name="mtc" id="startX" value="x" {{ old('start') == 'x' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startX">
                                    X
                                </label>
                            </div>

                            <div class="form-check ml-3 mt-2">
                                <input class="form-check-input" type="radio" name="mtc" id="startO" value="o" {{ old('start') == 'o' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="startO">
                                    O
                                </label>
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