@extends('Open-Packing.layout.main')
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
    <h3 class="text-center mb-4">Make a New GM </h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Open-Packing.admin.packing.store') }}" method="POST">
        @else
        <form action="{{ route('Open-Packing.pegawai.packing.store') }}" method="POST">
        @endif
            @csrf
            @method('POST')
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">No. GM</label>
                  <input type="text" name="gm" id="atribute" class="form-control" required>
              </div>
              <div class="mb-3">
                  <label for="atribute" class="form-label">Team Lead</label>
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
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">Shift</label>
                  <select type="text" name="shift" id="atribute" class="form-control" required>
                    <option value="" selected disabled>--Pilih Shift--</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
              <div class="mb-3">
                  <label for="atribute" class="form-label">Jenis</label>
                  <select type="text" name="jenis" id="atribute" class="form-control" required>
                    <option value="" selected disabled>--Pilih Jenis--</option>
                    <option value="CRC">CRC</option>
                    <option value="RESIN">RESIN</option>
                    <option value="ALKALI">ALKALI</option>
                    <option value="ZINC INGOT">ZINC INGOT</option>
                    <option value="ALUMUNIUM">ALUMUNIUM</option>
                  </select>
              </div>
              </div>
            </div>
            
            
            <div class="mb-3">
                <label for="atribute" class="form-label">Operator</label>
                <input type="text" name="operator" id="atribute" class="form-control" value="{{Auth::user()->name}}" readonly>
            </div>

            

            <button type="submit" class="btn btn-primary w-100">Save New GM</button>
        </form>
    </div>
</div>
@endsection