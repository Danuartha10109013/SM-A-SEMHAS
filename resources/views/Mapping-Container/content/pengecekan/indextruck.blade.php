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
<div class="container-xxl">
    <h1 class="app-brand-text demo menu-text fw-bold ms-1 text-center">MAPPING MUAT & CEKLIST TRAILER</h1>
    @foreach ($data as $d)
    <h4 class="app-brand-text demo menu-text fw-bold ms-1 text-center">No Gs : {{$d->no_gs}}</h4>
    <form action="{{ route('Mapping.admin.store-data-truck', $d->no_gs) }}" enctype="multipart/form-data" method="POST" id="sik-form">
        @csrf
        <div class="row">
            <!-- Basic -->
            <style>
                .input-group{
                    margin-top: 20px;
                }
            </style>
            <div class="col-md-6">
                <div class="card mb-4">
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
                                value="trailer" hidden />
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
                                value="-" />
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
                                <option value="-" {{ old('lantai', $p->lantai) == '' ? 'selected' : '' }}>-- - --</option>
             
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
                                <option value="-" {{ old('dinding', $p->dinding) == '' ? 'selected' : '' }}>-- - --</option>

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
                                <option value="-" {{ old('pengunci_kontainer', $p->pengunci_kontainer) == '' ? 'selected' : '' }} >-- - --</option>

                            </select>
                            @error('pengunci_kontainer')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="card demo-vertical-spacing demo-only-element">
                            <div class="row">
                                <div class="col-md-4">
                                    <span>Disapu</span>
                                    <div class="form-check">
                                        <input type="text" name="sapu" value="-" hidden>
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
                                        <input type="text" name="vacum" value="-" hidden>
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
                                        <input type="text" name="disemprot" value="-" hidden>
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
                                value="0" />
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
                                value="0" />
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
                                value="0" />
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
                                value="0" />
                            @error('silica_gel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Fumigasi</span>
                            <select class="form-select @error('fumigasi') is-invalid @enderror" name="fumigasi" aria-label="Fumigasi">
                                <option value="-" {{ old('fumigasi',$p->fumigasi) == '' ? 'selected' : '' }} >-- - --</option>

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
                                value="{{ $p->tare }}" />
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
                              <option value="Danu" {{old('pegawai',$p->pegawai) == 'Danu' ? 'selected' : ''}}>Danu</option>
                              <option value="Riyan H" {{old('pegawai',$p->pegawai) == 'Riyan H' ? 'selected' : ''}}>Riyan H</option>
                              <option value="Freddy" {{old('pegawai',$p->pegawai) == 'Freddy' ? 'selected' : ''}}>Freddy</option>
                              <option value="Dika" {{old('pegawai',$p->pegawai) == 'Dika' ? 'selected' : ''}}>Dika</option>
                              <option value="other">Other</option> <!-- Add this option -->
                          </select>
                        </div>
                        
                        <p class="text-center" style="font-weight:bold;">TRAILER / TRUK</p>
                    
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon41">Kondisi Ban</span>
                            <select class="form-select @error('kondisi_ban') is-invalid @enderror" name="kondisi_ban" aria-label="Kondisi Ban">
                                <option value="" {{ old('kondisi_ban',$p->kondisi_ban) == '' ? 'selected' : '' }} >-- Pilih Kondisi Ban --</option>
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
                                <option value="" {{ old('kondisi_lantai',$p->kondisi_lantai) == '' ? 'selected' : '' }} >-- Pilih Kondisi Lantai --</option>
                                <option value="bagus" {{ old('kondisi_lantai',$p->kondisi_lantai) == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                <option value="kurang bagus" {{ old('kondisi_lantai',$p->kondisi_lantai) == 'kurang bagus' ? 'selected' : '' }}>Kurang Bagus</option>
                                <option value="kurang bagus" {{ old('kondisi_lantai',$p->kondisi_lantai) == 'kurang bagus' ? 'selected' : '' }}>Jelek</option>
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
                                <option value="" >-- Pilih Kondisi Rantai/Webbing --</option>
                                <option value="lengkap" {{ old('rantai_webbing',$p->rantai_webbing) == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                                <option value="tidak lengkap" {{ old('rantai_webbing',$p->rantai_webbing) == 'tidak lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>
                                <option value="tidak ada" {{ old('rantai_webbing',$p->rantai_webbing) == 'tidak ada' ? 'selected' : '' }}>Tidak ada</option>
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
                                <option value="" >-- Pilih Kondisi Tonase --</option>
                                <option value="sesuai kapasitas" {{ old('tonase',$p->tonase) == 'sesuai kapasitas' ? 'selected' : '' }}>Sesuai Kapasitas</option>
                                <option value="tidak sesuai kapasitas" {{ old('tonase',$p->tonase) == 'tidak sesuai kapasitas' ? 'selected' : '' }}>Tidak Sesuai Kapasitas</option>
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
                                <option value=""{{ old('terpal',$p->terpal) == '' ? 'selected' : '' }} >-- Pilih Kondisi Terpal --</option>
                                <option value="tidak ada" {{ old('terpal',$p->terpal) == 'bagus' ? 'selected' : '' }}>Tidak Ada</option>
                                <option value="bagus" {{ old('terpal',$p->terpal) == 'bagus' ? 'selected' : '' }}>Bagus</option>
                                <option value="jelek" {{ old('terpal',$p->terpal) == 'jelek' ? 'selected' : '' }}>Jelek</option>
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
            MAPPING TRUCK
        </h1>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="row mb-4">
                    <div class="col-md-12 bg-danger text-white text-center p-3">
                        <h3>TRAILER</h3>
                    </div>
                </div>
                @foreach ($maps as $m)
                @csrf
                <div class="container">
                    @for ($i = 1; $i <= 12; $i++)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                @php
                                    $coordinateA = 'a' . $i;
                                    $coordinateB = 'b' . $i;
                                    $coordinateC = 'c' . $i;
                                @endphp
                                

                                <!-- Coordinate Select -->
                                <label class="fw-bold mb-1">{{ strtoupper($coordinateA) }}</label>
                                <select
                                class="form-select coil-select"
                                name="{{ $coordinateA }}"
                                id="select-{{ $coordinateA }}"
                                aria-label="Floor Rating"
                                >
                                <option value="">Pilih</option>
                                @foreach ($coil as $c)
                                    <option 
                                        value="{{ $c->kode_produk }}" 
                                        {{ old($coordinateA, $m->$coordinateA) == $c->kode_produk ? 'selected' : '' }}>
                                        {{ substr($c->kode_produk, -5) }}
                                    </option>
                                @endforeach
                                </select>

                                <!-- Eye Select -->
                                <select
                                class="form-select ms-2 eye-select"
                                name="{{ $coordinateA }}_eye"
                                id="eyeSelect-{{ $coordinateA }}"
                                aria-label="Eye Position"
                                >
                                <option value="">Pilih Posisi</option>
                                <option value="eye_to_side" {{ old($coordinateA . '_eye', $m->{$coordinateA . '_eye'}) == 'eye_to_side' ? 'selected' : '' }}>Eye to Side</option>
                                <option value="eye_to_rear" {{ old($coordinateA . '_eye', $m->{$coordinateA . '_eye'}) == 'eye_to_rear' ? 'selected' : '' }}>Eye to Rear</option>
                                <option value="eye_to_sky" {{ old($coordinateA . '_eye', $m->{$coordinateA . '_eye'}) == 'eye_to_sky' ? 'selected' : '' }}>Eye to Sky</option>
                                </select>

                                <!-- JavaScript -->
                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Function to apply background color
                                        function applyBackground(select, bgColor, textColor) {
                                            if (select.value && select.value !== "") {
                                                select.style.backgroundColor = bgColor; // Set background
                                                select.style.color = textColor; // Set text color
                                            } else {
                                                select.style.backgroundColor = ""; // Reset background
                                                select.style.color = ""; // Reset text color
                                            }
                                        }

                                        // Coil Select Background
                                        const coilSelects = document.querySelectorAll(".coil-select");
                                        coilSelects.forEach((select) => {
                                            applyBackground(select, "#d4edda", "#155724"); // Light green
                                            select.addEventListener("change", () => applyBackground(select, "#d4edda", "#155724"));
                                        });

                                        // Eye Select Background
                                        const eyeSelects = document.querySelectorAll(".eye-select");
                                        eyeSelects.forEach((select) => {
                                            applyBackground(select, "#cce5ff", "#004085"); // Light blue
                                            select.addEventListener("change", () => applyBackground(select, "#cce5ff", "#004085"));
                                        });
                                    });
                                </script>


                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="fw-bold mb-1">{{ strtoupper($coordinateB) }}</label>
                                <select
                                    class="form-select coil-select"
                                    name="{{ $coordinateB }}"
                                    aria-label="Floor Rating"
                                    value="{{ old($coordinateB, $m->$coordinateB) }}"
                                >
                                    <option value="">Pilih</option>
                                    @foreach ($coil as $c)
                                    <option value="{{ $c->kode_produk }}" {{ old($coordinateB, $m->$coordinateB) == $c->kode_produk ? 'selected' : '' }}>
                                        {{ substr($c->kode_produk, -5) }}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="{{ $coordinateB }}_eye" value="null">
                                <select
                                    class="form-select ms-2"
                                    name="{{ $coordinateB }}_eye"
                                    aria-label="Eye Position"
                                    value="{{ old($coordinateB . '_eye', $m->{$coordinateB . '_eye'}) }}"
                                >
                                    <option value="">Pilih Posisi</option>
                                    <option value="eye_to_side" {{ old($coordinateB . '_eye', $m->{$coordinateB . '_eye'}) == 'eye_to_side' ? 'selected' : '' }}>Eye to Side</option>
                                    <option value="eye_to_rear" {{ old($coordinateB . '_eye', $m->{$coordinateB . '_eye'}) == 'eye_to_rear' ? 'selected' : '' }}>Eye to Rear</option>
                                    <option value="eye_to_sky" {{ old($coordinateB . '_eye', $m->{$coordinateB . '_eye'}) == 'eye_to_sky' ? 'selected' : '' }}>Eye to Sky</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="fw-bold mb-1">{{ strtoupper($coordinateC) }}</label>
                                <select
                                    class="form-select coil-select"
                                    name="{{ $coordinateC }}"
                                    aria-label="Floor Rating"
                                    value="{{ old($coordinateC, $m->$coordinateC) }}"
                                >
                                    <option value="">Pilih</option>
                                    @foreach ($coil as $c)
                                    <option value="{{ $c->kode_produk }}" {{ old($coordinateC, $m->$coordinateC) == $c->kode_produk ? 'selected' : '' }}>
                                        {{ substr($c->kode_produk, -5) }}
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="{{ $coordinateC }}_eye" value="null">
                                <select
                                    class="form-select ms-2"
                                    name="{{ $coordinateC }}_eye"
                                    aria-label="Eye Position"
                                    value="{{ old($coordinateC . '_eye', $m->{$coordinateC . '_eye'}) }}"
                                >
                                    <option value="">Pilih Posisi</option>
                                    <option value="eye_to_side" {{ old($coordinateC . '_eye', $m->{$coordinateC . '_eye'}) == 'eye_to_side' ? 'selected' : '' }}>Eye to Side</option>
                                    <option value="eye_to_rear" {{ old($coordinateC . '_eye', $m->{$coordinateC . '_eye'}) == 'eye_to_rear' ? 'selected' : '' }}>Eye to Rear</option>
                                    <option value="eye_to_sky" {{ old($coordinateC . '_eye', $m->{$coordinateC . '_eye'}) == 'eye_to_sky' ? 'selected' : '' }}>Eye to Sky</option>
                                </select>
                            </div>
                        </div>
                    </div>
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
                                // Sembunyikan opsi yang sudah dipilih di dropdown lain
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
    <a href="{{route('Mapping.admin.prints',$p->no_gs)}}" class="btn btn-danger mb-5">Cetak</a>
@else
    <p><b>Lengkapi semua data untuk mencetak.</b></p>
@endif
    </form>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

</div>
@endsection
