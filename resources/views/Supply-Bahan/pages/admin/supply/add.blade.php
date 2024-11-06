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
                <label for="atribute" class="form-label">Date<small style="color: red;">*</small></label>
                <input type="date" name="date" id="atribute" value="{{$date}}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="atribute" class="form-label">Team Lead<small style="color: red;">*</small></label>
              <select type="text" name="shift_leader" id="team" class="form-control" required>
                <option value="" selected disabled>--Pilih Shift Leader--</option>
                <option value="Danu">Danu</option>
                <option value="Riyan H">Riyan H</option>
                <option value="Freddy">Freddy</option>
                <option value="Dika">Dika</option>
                <option value="other">Other</option> <!-- Add this option -->
            </select>
          </div>
        
        <!-- Input field for custom keterangan -->
        <div class="mb-3" id="other-keterangan-container" style="display: none;">
            <label for="other-keterangan" class="form-label">Please specify<small style="color: red;">*</small></label>
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
            <div class="form-group mb-3">
              <label for="label">SHIFT<small style="color: red;">*</small>
              </label>
              <select class="form-control" name="shift" id="exampleSelectOption" required>
                  <option value="" selected disabled>--Pilih Sift--</option>
                  <option value="1" {{ old('jenis_crane') == '1' ? 'selected' : '' }}>1</option>
                  <option value="2" {{ old('jenis_crane') == '2' ? 'selected' : '' }}>2</option>
                  <option value="3" {{ old('jenis_crane') == '3' ? 'selected' : '' }}>3</option>
              </select>
          </div>
            <div class="mb-3">
              <label for="atribute" class="form-label">Jenis Supply <small style="color: red;">*</small></label>
              <select name="supply" id="atribute" class="form-select" required>
                  <option value="" selected disabled>--Pilih Jenis Supply--</option>
                  <option value="Ingot">Ingot</option>
                  <option value="Raisin">Raisin</option>
                  <option value="Alkali">Alkali</option>
              </select>
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
        <div class="mb-3">
          <label for="atribute" class="form-label">Catatan</label>
          <input type="text" name="catatan" id="atribute" class="form-control" >
      </div>
            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>
@endsection