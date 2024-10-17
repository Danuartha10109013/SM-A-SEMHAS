@extends('Supply-Bahan.layout.main')

@section('title')
    Tambahkan GM ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Make a New Response</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Supply.admin.supply.store') }}" enctype="multipart/form-data" method="POST">
        @else
        <form action="{{ route('Supply.pegawai.supply.store') }}" enctype="multipart/form-data" method="POST">
        @endif
            @csrf
            @method('POST')
            <div class="mb-3">
              @php
                $date = \Carbon\Carbon::now()->format('Y-m-d');
              @endphp
                <label for="atribute" class="form-label">Date</label>
                <input type="date" name="date" id="atribute" value="{{$date}}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="atribute" class="form-label">Shift Leader</label>
                <input type="text" name="shift_leader" id="atribute" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="atribute" class="form-label">Shift</label>
                <input type="text" name="shift" id="atribute" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="atribute" class="form-label">Jenis Supply</label>
              <select name="supply" id="atribute" class="form-select" required>
                  <option value="" selected disabled>--Pilih Jenis Supply--</option>
                  <option value="Ingot">Ingot</option>
                  <option value="Raisin">Raisin</option>
                  <option value="Alkali">Alkali</option>
              </select>
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
        <div class="mb-3">
          <label for="atribute" class="form-label">Catatan</label>
          <input type="text" name="catatan" id="atribute" class="form-control" >
      </div>
            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>
@endsection