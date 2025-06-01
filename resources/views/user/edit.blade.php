@extends('user.layout.main')

@section('title')
Kelola User @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection

@section('content')
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="{{ route('superadmin.Administrator.kelola-user.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel{{ $data->id }}">Edit User</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}" required>
          </div>

          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $data->username }}" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" required>
          </div>

          <div class="form-group">
  <label for="division">Divisi</label>
  <select class="form-control" id="division" name="division" required>
    <option value="Warehouse" {{ $data->division == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
    <option value="Produksi" {{ $data->division == 'Produksi' ? 'selected' : '' }}>Produksi</option>
  </select>
</div>

<div class="form-group">
  <label for="role">Role</label>
  <select class="form-control" id="role" name="role" required>
    <option value="0" {{ $data->role == 0 ? 'selected' : '' }}>Admin</option>
    <option value="1" {{ $data->role == 1 ? 'selected' : '' }}>Pegawai</option>
  </select>
</div>

<div class="form-group ml-5">
  <label for="type">Type</label>
  <div id="type">
    <div class="row">
      <div class="col-md-6">
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role" type="checkbox" name="type[]" value="SP" id="typeSP"
            {{ in_array('SP', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeSP">Shipping Mark</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role" type="checkbox" name="type[]" value="MP" id="typeMP"
            {{ in_array('MP', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeMP">Mapping</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="FC" id="typeFC"
            {{ in_array('FC', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeFC">Form Check</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role" type="checkbox" name="type[]" value="OP" id="typeOP"
            {{ in_array('OP', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeOP">Open Packing</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role" type="checkbox" name="type[]" value="SB" id="typeSB"
            {{ in_array('SB', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeSB">Supply Bahan</label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role" type="checkbox" name="type[]" value="PL" id="typePL"
            {{ in_array('PL', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typePL">Packing List</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox pegawai-only" type="checkbox" name="type[]" value="CK" id="typeCK"
            {{ in_array('CK', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeCK">Checklist Kendaraan</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox pegawai-only" type="checkbox" name="type[]" value="SL" id="typeSL"
            {{ in_array('SL', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeSL">Scan Layout</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role" type="checkbox" name="type[]" value="CD" id="typeCD"
            {{ in_array('CD', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeCD">Coil Damage</label>
        </div>
        <div class="form-check">
          <input class="form-check-input type-checkbox all-role form-check-only" type="checkbox" name="type[]" value="SIK" id="typeSIK"
            {{ in_array('SIK', json_decode($data->type, true) ?? []) ? 'checked' : '' }}>
          <label class="form-check-label" for="typeSIK">Surat Izin Keluar</label>
        </div>

        
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const roleSelect = document.getElementById("role");
    const divisionSelect = document.getElementById("division");

    function updateTypeVisibility() {
  const roleValue = roleSelect.value;
  const divisionValue = divisionSelect.value;

  // Sembunyikan semua type terlebih dahulu
  const allTypes = document.querySelectorAll(".type-checkbox");
  allTypes.forEach(el => {
    el.closest('.form-check').style.display = 'none';
  });

  // Tampilkan selalu Form Check (FC) di semua kondisi
  document.querySelectorAll(".form-check-only").forEach(el => {
    el.closest('.form-check').style.display = 'block';
  });

  if (divisionValue === 'Produksi') {
    // Produksi: selain FC disembunyikan
    return;
  }

  if (divisionValue === 'Warehouse') {
    if (roleValue === '0') {
      // Admin Warehouse: tampilkan semua
      document.querySelectorAll(".all-role").forEach(el => {
        el.closest('.form-check').style.display = 'block';
      });
    } else if (roleValue === '1') {
      // Pegawai Warehouse: tampilkan pegawai-only
      document.querySelectorAll(".pegawai-only").forEach(el => {
        el.closest('.form-check').style.display = 'block';
      });
    }
  } else {
    // Divisi lain-lain: tampilkan all-role dan pegawai-only
    document.querySelectorAll(".all-role, .pegawai-only").forEach(el => {
      el.closest('.form-check').style.display = 'block';
    });
  }
}


    // Panggil saat halaman dimuat
    updateTypeVisibility();

    // Tambahkan event listener untuk select
    roleSelect.addEventListener("change", updateTypeVisibility);
    divisionSelect.addEventListener("change", updateTypeVisibility);
  });
</script>



          <div class="form-group">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar">
            @if($data->avatar)
              <img src="{{ asset('storage/' . $data->avatar) }}" alt="User Avatar" class="img-thumbnail mt-2" style="width: 100px; height: 100px;">
            @endif
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
          </div>

          <a href="{{ route('superadmin.Administrator.kelola-user') }}" class="btn btn-secondary mt-3">Close</a>
          <button type="submit" class="btn btn-primary mt-3">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
