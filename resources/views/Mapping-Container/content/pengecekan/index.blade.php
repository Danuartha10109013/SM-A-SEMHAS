@extends('Mapping-Container.layout.main')
@section('title')
    Form Pengecekan ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="container-fluid">
<div class="container-xxl">
    <h1 class="app-brand-text demo menu-text fw-bold ms-1 text-center">MAPPING MUAT & CEKLIST KONTAINER</h1>
    @foreach ($data as $d)
    <h4 class="app-brand-text demo menu-text fw-bold ms-1 text-center">No Gs : {{$d->no_gs}}</h4>
    <form action="{{ route('Mapping.admin.store-data', $d->no_gs) }}" enctype="multipart/form-data" method="POST" id="sik-form">
        @csrf
        <div class="row">
            <!-- Basic -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <style>
                        .input-group{
                            margin-top: 20px;
                        }
                    </style>
                    <h5 class="card-header">Step 1</h5>
                    @foreach ($pengecekan as $p)
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Awal Muat</span>
                            <input
                                type="time"
                                class="form-control @error('awal_muat') is-invalid @enderror"
                                name="awal_muat"
                                placeholder="09.00"
                                aria-label="Awal Muat"
                                aria-describedby="basic-addon41"
                                value="{{ $p->awal_muat }}" />
                            @error('awal_muat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Awal Muat 1</span>
                            <input
                                type="time"
                                class="form-control @error('awal_muat') is-invalid @enderror"
                                name="awal_muat1"
                                placeholder="09.00"
                                aria-label="Awal Muat"
                                aria-describedby="basic-addon41"
                                value="{{ $p->awal_muat1 }}" />
                            @error('awal_muat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror                   
                    @endforeach
                        </div>

                        <div class="input-group">
                            
                            <input
                                type="text"
                                class="form-control"
                                name="pembeda"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="container" hidden />
                        </div>

                        <div class="input-group">
                            
                            <input
                                type="text"
                                class="form-control"
                                name="no_gs"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="{{$d->no_gs}}" hidden />
                        </div>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Tanggal</span>
                            <input
                                type="date"
                                class="form-control"
                                name="tgl_gs"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="{{$d->tgl_gs}}" readonly />
                        </div>

                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Customer</span>
                            <input
                                type="text"
                                class="form-control"
                                name="customer"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="{{$d->kepada}}" readonly />
                        </div>
                        @foreach ($pengecekan as $p)
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Kota / Negara</span>
                            <input
                                type="text"
                                class="form-control @error('kota_negara') is-invalid @enderror"
                                name="kota_negara"
                                placeholder="Ketikan Kota / Negara tujuan"
                                aria-label="Kota / Negara"
                                aria-describedby="basic-addon41"
                                value="{{$p->kota_negara }}" />
                            @error('kota_negara')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Ekspedisi</span>
                            <input
                                type="text"
                                class="form-control @error('kota_negara') is-invalid @enderror"
                                name="ekspedisi"
                                placeholder="Ketikan Ekspedisi"
                                aria-label="Kota / Negara"
                                aria-describedby="basic-addon41"
                                value="{{$p->ekspedisi }}" />
                            @error('kota_negara')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <p class="text-center" style="font-weight:bold;">KONTAINER / TRAILER / TRUK</p>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Lantai</span>
                            <select class="form-select @error('lantai') is-invalid @enderror" name="lantai" aria-label="Floor Rating">
                                <option value="" {{ old('lantai', $p->lantai) == '' ? 'selected' : '' }}>-- Pilih Kondisi Lantai --</option>
                                <option value="bagus" {{ old('lantai', $p->lantai) == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                <option value="kurang_bagus" {{ old('lantai', $p->lantai) == 'kurang_bagus' ? 'selected' : '' }}>Kurang Bagus</option>
                                <option value="jelek" {{ old('lantai', $p->lantai) == 'jelek' ? 'selected' : '' }}>Jelek</option>
                            </select>
                            @error('lantai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Dinding</span>
                            <select class="form-select @error('dinding') is-invalid @enderror" name="dinding" aria-label="Floor Rating">
                                <option value="" {{ old('dinding', $p->dinding) == '' ? 'selected' : '' }}>-- Pilih Kondisi Dinding --</option>
                                <option value="bagus" {{ old('dinding', $p->dinding) == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                <option value="kurang_bagus" {{ old('dinding', $p->dinding) == 'kurang_bagus' ? 'selected' : '' }}>Kurang Bagus</option>
                                <option value="jelek" {{ old('dinding', $p->dinding) == 'jelek' ? 'selected' : '' }}>Jelek</option>
                            </select>
                            @error('dinding')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Pengunci Kontainer</span>
                            <select class="form-select @error('pengunci_kontainer') is-invalid @enderror" name="pengunci_kontainer" aria-label="Pengunci Kontainer">
                                <option value="" {{ old('pengunci_kontainer', $p->pengunci_kontainer) == '' ? 'selected' : '' }} >-- Pilih Tipe Pengunci --</option>
                                <option value="4_pengunci" {{ old('pengunci_kontainer', $p->pengunci_kontainer) == '4_pengunci' ? 'selected' : '' }}>4 Pengunci</option>
                                <option value="<4_pengunci" {{ old('pengunci_kontainer', $p->pengunci_kontainer) == '<4_pengunci' ? 'selected' : '' }}>< 4 Pengunci</option>
                            </select>
                            @error('pengunci_kontainer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="card demo-vertical-spacing demo-only-element">
                            <div class="row">
                                <input type="hidden" name="sapu" value="">
                                <div class="col-md-4">
                                    <span>Disapu</span>
                                    <div class="form-check">
                                        <input class="form-check-input @error('sapu') is-invalid @enderror" type="radio" id="sapuSudah" name="sapu" value="sudah" {{ old('sapu',$p->sapu) == 'sudah' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="sapuSudah">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('sapu') is-invalid @enderror" type="radio" id="sapuBelum" name="sapu" value="belum" {{ old('sapu',$p->sapu) == 'belum' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="sapuBelum">No</label>
                                    </div>
                                    @error('sapu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                
                                <div class="col-md-4">
                                    <input type="hidden" name="vacum" value="">
                                    <span>Vacum</span>
                                    <div class="form-check">
                                        <input class="form-check-input @error('vacum') is-invalid @enderror" type="radio" id="vacumSudah" name="vacum" value="sudah" {{ old('vacum',$p->vacum) == 'sudah' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="vacumSudah">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('vacum') is-invalid @enderror" type="radio" id="vacumBelum" name="vacum" value="belum" {{ old('vacum',$p->vacum) == 'belum' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="vacumBelum">No</label>
                                    </div>
                                    @error('vacum')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="disemprot" value="">
                                    <span>Disemprot</span>
                                    <div class="form-check">
                                        <input class="form-check-input @error('disemprot') is-invalid @enderror" type="radio" id="disemprotSudah" name="disemprot" value="sudah" {{ old('disemprot',$p->disemprot) == 'sudah' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="disemprotSudah">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('disemprot') is-invalid @enderror" type="radio" id="disemprotBelum" name="disemprot" value="belum" {{ old('disemprot',$p->disemprot) == 'belum' ? 'checked' : '' }} >
                                        <label class="form-check-label" for="disemprotBelum">No</label>
                                    </div>
                                    @error('disemprot')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Choke</span>
                            <input
                                type="number"
                                class="form-control @error('choke') is-invalid @enderror"
                                name="choke"
                                placeholder="0"
                                aria-label="Choke"
                                aria-describedby="basic-addon41"
                                value="{{ $p->choke }}" />
                            @error('choke')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Stopper</span>
                            <input
                                type="number"
                                class="form-control @error('stopper') is-invalid @enderror"
                                name="stopper"
                                placeholder="0"
                                aria-label="Stopper"
                                aria-describedby="basic-addon41"
                                value="{{ $p->stopper }}" />
                            @error('stopper')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Sling</span>
                            <input
                                type="number"
                                class="form-control @error('sling') is-invalid @enderror"
                                name="sling"
                                placeholder="0"
                                aria-label="Sling"
                                aria-describedby="basic-addon41"
                                value="{{ $p->sling }}" />
                            @error('sling')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Silica Gel</span>
                            <input
                                type="number"
                                class="form-control @error('silica_gel') is-invalid @enderror"
                                name="silica_gel"
                                placeholder="0"
                                aria-label="Silica Gel"
                                aria-describedby="basic-addon41"
                                value="{{ $p->silica_gel }}" />
                            @error('silica_gel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Fumigasi</span>
                            <select class="form-select @error('fumigasi') is-invalid @enderror" name="fumigasi" aria-label="Fumigasi">
                                <option value="" {{ old('fumigasi',$p->fumigasi) == '' ? 'selected' : '' }} >-- Pilih Kondisi Fumigasi --</option>
                                <option value="sudah" {{ old('fumigasi',$p->fumigasi) == 'sudah' ? 'selected' : '' }}>Sudah</option>
                                <option value="belum" {{ old('fumigasi',$p->fumigasi) == 'belum' ? 'selected' : '' }}>Belum</option>
                            </select>
                            @error('fumigasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            <!-- Basic -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <h5 class="card-header">Step 2</h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Selesai Muat</span>
                            <input
                                type="time"
                                class="form-control @error('selesai_muat') is-invalid @enderror"
                                name="selesai_muat"
                                placeholder="10:00"
                                aria-label="Selesai Muat"
                                aria-describedby="basic-addon41"
                                value="{{ $p->selesai_muat }}" />
                            @error('selesai_muat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endforeach
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">No Mobil</span>
                            <input
                                type="text"
                                class="form-control"
                                name="no_mobil"
                                placeholder="T 1000 TU"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="{{$d->no_mobil}}" readonly />
                        </div>

                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">No Kontainer</span>
                            <input
                                type="text"
                                class="form-control"
                                name="no_container"
                                placeholder="container"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="{{$d->no_container}}" readonly />
                        </div>
                        @foreach ( $pengecekan as $p)
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Cuaca</span>
                            <select class="form-select @error('cuaca') is-invalid @enderror" name="cuaca" aria-label="Cuaca">
                                <option value="" {{ old('cuaca',$p->cuaca) == '' ? 'selected' : '' }} >-- Pilih Kondisi Cuaca --</option>
                                <option value="cerah" {{ old('cuaca',$p->cuaca) == 'cerah' ? 'selected' : '' }}>Cerah</option>
                                <option value="berawan" {{ old('cuaca',$p->cuaca) == 'berawan' ? 'selected' : '' }}>Berawan</option>
                                <option value="hujan" {{ old('cuaca',$p->cuaca) == 'hujan' ? 'selected' : '' }}>Hujan</option>
                            </select>
                            @error('cuaca')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @endforeach
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Tonase </span>
                            <input
                                type="text"
                                class="form-control"
                                name="tonase_tare"
                                placeholder="T 1000 TU"
                                aria-label="Username"
                                aria-describedby="basic-addon41"
                                value="{{$tonase}}" readonly />
                        </div>
                        @foreach ( $pengecekan as $p)
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Tare</span>
                            <input
                                type="number"
                                class="form-control @error('tare') is-invalid @enderror"
                                name="tare"
                                placeholder="0"
                                aria-label="Sling"
                                aria-describedby="basic-addon41"
                                value="{{$tare}}" readonly/>
                            @error('tare')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group">
                            <span for="atribute" class="input-group-text" id="basic-addon41">Team Lead<small style="color: red;">*</small></span>
                            <select class="form-control @error('pegawai') is-invalid @enderror"
                            name="pegawai"
                            placeholder="Masukan Nama Pegawai"
                            aria-label="pegawai"
                            aria-describedby="basic-addon41" type="text" name="pegawai" id="team" class="form-control" required>
                              <option value="" {{old('pegawai',$p->pegawai) == '' ? 'selected' : ''}}  >--Pilih Shift Leader--</option>
                              <option value="Panggah S" {{old('pegawai',$p->pegawai) == 'Panggah S' ? 'selected' : ''}}>Panggah S</option>
                              <option value="Michael" {{old('pegawai',$p->pegawai) == 'Michael' ? 'selected' : ''}}>Michael</option>
                              <option value="Wahyu Ricci" {{old('pegawai',$p->pegawai) == 'Wahyu Ricci' ? 'selected' : ''}}>Wahyu Ricci</option>
                              <option value="Riyan H" {{old('pegawai',$p->pegawai) == 'Riyan H' ? 'selected' : ''}}>Riyan H</option>
                              <option value="Freddy" {{old('pegawai',$p->pegawai) == 'Freddy' ? 'selected' : ''}}>Freddy</option>
                              <option value="Dika" {{old('pegawai',$p->pegawai) == 'Dika' ? 'selected' : ''}}>Dika</option>
                              <option value="other">Other</option> <!-- Add this option -->
                          </select>
                        </div>

                        <!-- Input field for custom keterangan -->
                  <div class="mb-3" id="other-keterangan-container" style="display: none;">
                    <label for="other-keterangan" class="form-label">Please specify<small style="color: red;">*</small></label>
                    <input type="text" name="other_pegawai" id="other-keterangan" class="form-control" placeholder="Enter new Shift Leader">
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

                        
                        
                        <p class="text-center" style="font-weight:bold;">TRAILER / TRUK</p>
                    
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Kondisi Ban</span>
                            <select class="form-select @error('kondisi_ban') is-invalid @enderror" name="kondisi_ban" aria-label="Kondisi Ban">
                                <option value="" {{ old('kondisi_ban',$p->kondisi_ban) == '' ? 'selected' : '' }} >-- Pilih Kondisi Ban --</option>
                                <option value="-" {{ old('kondisi_ban',$p->kondisi_ban) == '-' ? 'selected' : '' }}>-</option>
                                <option value="bagus" {{ old('kondisi_ban',$p->kondisi_ban) == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                <option value="kurang bagus" {{ old('kondisi_ban',$p->kondisi_ban) == 'kurang bagus' ? 'selected' : '' }}>Kurang Bagus</option>
                                <option value="kurang bagus" {{ old('kondisi_ban',$p->kondisi_ban) == 'kurang bagus' ? 'selected' : '' }}>Jelek</option>
                            </select>
                            @error('kondisi_ban')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Kondisi Lantai</span>
                            <select class="form-select @error('kondisi_lantai') is-invalid @enderror" name="kondisi_lantai" aria-label="Kondisi Lantai">
                                <option value="-" {{ old('kondisi_lantai',$p->kondisi_lantai) == '' ? 'selected' : '' }} >-- - --</option>
                                
                            </select>
                            @error('kondisi_lantai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Rantai Webbing</span>
                            <select class="form-select @error('rantai_webbing') is-invalid @enderror" name="rantai_webbing" aria-label="Rantai Webbing">
                                <option value="-" {{ old('kondisi_lantai',$p->rantai_webbing) == '' ? 'selected' : '' }}>-- - --</option>

                            </select>
                            @error('rantai_webbing')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Tonase</span>
                            <select class="form-select @error('tonase') is-invalid @enderror" name="tonase" aria-label="Tonase">
                                <option value="-" {{ old('kondisi_lantai',$p->tonase) == '' ? 'selected' : '' }} >-- - --</option>

                            </select>
                            @error('tonase')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Terpal</span>
                            <select class="form-select @error('terpal') is-invalid @enderror" name="terpal" aria-label="Terpal">
                                <option value="-" {{ old('terpal', $p->terpal) == '' ? 'selected' : '' }}>-- - --</option>

                            </select>
                            @error('terpal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        
                        
                        
                        @endforeach       
                        
                    </div>
                </div>
                
            </div>
        </div>

        <h1 class="app-brand-text demo menu-text fw-bold ms-1 text-center">
            MAPPING KONTAINER
        </h1>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-md-12 bg-danger text-white text-center p-3">
                        <h3>KONTAINER</h3>
                    </div>
                </div>
        @foreach ($maps as $m)
            
        
                @csrf
                <div class="row">
                    @for ($i = 0; $i < 15; $i++)
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            @php
                                $row = intdiv($i, 3) + 1;
                                $column = chr(65 + ($i % 3)); // A, B, C
                                $coordinate = strtolower($column . $row); // a1, a2, ..., c5
                            @endphp
                            <label class="fw-bold mb-1">{{ strtoupper($coordinate) }}</label>
                            <select
                                class="form-select coil-select"
                                name="{{ $coordinate }}"
                                aria-label="Floor Rating"
                                id="coilSelect-{{ $coordinate }}"
                            >
                                <option value="">Pilih</option>
                                @foreach ($coil as $c)
                                    <option 
                                        value="{{ $c->kode_produk }}" 
                                        {{ old($coordinate, $m->$coordinate) == $c->kode_produk ? 'selected' : '' }}>
                                        {{ substr($c->kode_produk, -10) }}
                                    </option>
                                @endforeach
                            </select>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                const selectElements = document.querySelectorAll(".coil-select");

                                selectElements.forEach((select) => {
                                    changeBackground(select); // Set background on load

                                    select.addEventListener("change", function () {
                                        changeBackground(select); // Set background on change
                                    });
                                });

                                function changeBackground(element) {
                                    if (element.value) {
                                        element.style.backgroundColor = "#d4edda"; // Warna hijau muda
                                        element.style.color = "#155724"; // Warna teks hijau gelap
                                    } else {
                                        element.style.backgroundColor = ""; // Reset ke default
                                        element.style.color = "";
                                    }
                                }
                            });

                            </script>

                            <input type="hidden" name="{{ $coordinate }}_eye" value="null">
                            <select
                                class="form-select ms-2 eye-select"
                                name="{{ $coordinate }}_eye"
                                aria-label="Eye Position"
                                id="eyeSelect-{{ $coordinate }}"
                            >
                                <option value="">Pilih Posisi</option>
                                <option value="eye_to_side" {{ old($coordinate . '_eye', $m->{$coordinate . '_eye'}) == 'eye_to_side' ? 'selected' : '' }}>Eye to Side</option>
                                <option value="eye_to_rear" {{ old($coordinate . '_eye', $m->{$coordinate . '_eye'}) == 'eye_to_rear' ? 'selected' : '' }}>Eye to Rear</option>
                                <option value="eye_to_sky" {{ old($coordinate . '_eye', $m->{$coordinate . '_eye'}) == 'eye_to_sky' ? 'selected' : '' }}>Eye to Sky</option>
                            </select>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const eyeSelects = document.querySelectorAll(".eye-select");

                                    // Inisialisasi fungsi saat halaman dimuat
                                    eyeSelects.forEach((select) => {
                                        changeBackground(select);

                                        select.addEventListener("change", function () {
                                            changeBackground(select);
                                        });
                                    });

                                    // Fungsi untuk mengubah warna background dan teks
                                    function changeBackground(element) {
                                        if (element.value) {
                                            element.style.backgroundColor = "#d4edda"; // Warna latar hijau muda
                                            element.style.color = "#155724"; // Warna teks hijau gelap
                                        } else {
                                            element.style.backgroundColor = ""; // Reset ke default
                                            element.style.color = "";
                                        }
                                    }
                                });

                            </script>
                        </div>
                    </div>
                    @if (($i + 1) % 3 == 0)
                    <div class="w-100"></div>
                    @endif
                    @endfor
                </div>
                @endforeach
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const coilSelects = Array.from(document.querySelectorAll('.coil-select'));
                
                        function updateOptions() {
                            const selectedValues = coilSelects.map(select => select.value).filter(value => value);
                
                            coilSelects.forEach((select) => {
                                const options = select.querySelectorAll("option");
                                options.forEach((option) => {
                                    if (option.value !== "") {
                                        option.style.display = selectedValues.includes(option.value) && option.value !== select.value ? "none" : "";
                                    }
                                });
                
                                const eyeSelect = document.querySelector(`select[name="${select.name}_eye"]`);
                                if (eyeSelect) {
                                    eyeSelect.disabled = !select.value;
                                }
                            });
                        }
                
                        coilSelects.forEach((select) => {
                            select.addEventListener("change", updateOptions);
                        });
                
                        // Initial call to set the correct state on page load
                        updateOptions();
                    });
                </script>
                
        
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            </div>
        </div>
        @endforeach
         
        @foreach ( $pengecekan as $p)
       {{-- text area --}}
       <div class="input-group mb-5">
        <span class="input-group-text">Catatan</span>
        <input
            class="form-control"
            name="catatan"
            aria-label="With textarea"
            placeholder="Tulis Catatan, Jika Ada"
            style="height: 60px"
            value="{{$p->catatan}}"></input>
        </div>
        @endforeach
        
        <div class="row">
            <!-- Pengemudi Section -->
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="pengemudi">Team Leader</label>
                    <input type="text" name="pengemudi" class="form-control" value="{{$p->pegawai}}" readonly>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label for="signature" class="form-label">Tanda Tangan TL</label>
                        <canvas id="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                        <button id="clear" type="button" class="btn btn-secondary mt-2">Clear</button>
                        <input type="hidden" name="signature" id="signature">
                        <!-- Menampilkan tanda tangan yang ada jika tersedia -->
                        @if ($p->signature)
                            <img src="{{ asset($p->signature) }}" alt="Tanda Tangan Team Leader" class="mt-2" />
                        @endif
                    </div>
                </div>
            </div>
        
            <!-- Security Section -->
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="security">OPR Forklift</label>
                    <input type="text" name="checker" class="form-control" value="{{$p->checker}}">
                </div>
                <div class="row mb-3">
                    <div class="col-sm-12">
                        <label for="signature1" class="form-label">Tanda Tangan Opr Forklift</label>
                        <canvas id="signature-pad1" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                        <button id="clear1" type="button" class="btn btn-secondary mt-2">Clear</button>
                        <input type="hidden" name="signature1" id="signature1">
                        <!-- Menampilkan tanda tangan yang ada jika tersedia -->
                        @if ($p->signature1)
                            <img src="{{ asset($p->signature1) }}" alt="Tanda Tangan Opr Forklift" class="mt-2" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Function to initialize a signature pad
                function initializeSignaturePad(canvasId, clearButtonId, hiddenInputId) {
                    const canvas = document.getElementById(canvasId);
                    const clearButton = document.getElementById(clearButtonId);
                    const hiddenInput = document.getElementById(hiddenInputId);
        
                    const signaturePad = new SignaturePad(canvas, {
                        backgroundColor: 'rgba(255, 255, 255, 0)',
                        penColor: 'black'
                    });
        
                    // Resize the canvas dynamically
                    function resizeCanvas() {
                        const ratio = Math.max(window.devicePixelRatio || 1, 1);
                        const container = canvas.parentElement;
                        const oldData = signaturePad.toData(); // Save the signature data
        
                        canvas.width = container.offsetWidth * ratio;
                        canvas.height = 200 * ratio; // Adjust height to 200px
                        const ctx = canvas.getContext('2d');
                        ctx.scale(ratio, ratio);
        
                        // Restore the previous signature data
                        if (oldData.length > 0) {
                            signaturePad.fromData(oldData);
                        }
                    }
        
                    // Initial resize and attach resize event
                    resizeCanvas();
                    window.addEventListener('resize', resizeCanvas);
        
                    // Clear button functionality
                    clearButton.addEventListener('click', () => {
                        signaturePad.clear();
                    });
        
                    return { signaturePad, hiddenInput };
                }
        
                // Initialize signature pads for TL and Checker
                const tlSignature = initializeSignaturePad('signature-pad', 'clear', 'signature'); // For Team Leader
                const checkerSignature = initializeSignaturePad('signature-pad1', 'clear1', 'signature1'); // For Checker
        
                // Handle form submission
                document.querySelector('#sik-form').addEventListener('submit', (e) => {
                    // Only set value if signature is not empty
                    if (!tlSignature.signaturePad.isEmpty()) {
                        tlSignature.hiddenInput.value = tlSignature.signaturePad.toDataURL();
                    } else {
                        tlSignature.hiddenInput.value = ''; // Clear input if empty
                    }
        
                    if (!checkerSignature.signaturePad.isEmpty()) {
                        checkerSignature.hiddenInput.value = checkerSignature.signaturePad.toDataURL();
                    } else {
                        checkerSignature.hiddenInput.value = ''; // Clear input if empty
                    }
                });
            });
        </script>
        
            
        
        

        <button type="submit" class="btn btn-primary mb-5">Simpan</button>
            
        @if($p->isComplete())
    <a href="{{route('Mapping.admin.prints-map',$d->no_gs)}}" class="btn btn-danger mb-5">Cetak</a>
@else
    <p><b>Lengkapi semua data untuk mencetak.</b></p>
@endif
    </form>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

</div>
</div>
@endsection
