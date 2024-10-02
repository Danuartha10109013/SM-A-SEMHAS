@extends(Auth::user()->type == "Ship-Mark" ? 'layout.pegawai.main' : 'Form-Check.layout.main')

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
      <form action="{{ route('kelola-user.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel{{ $data->id }}">Edit User</h5>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ $data->name }}" required>
          </div>
          <div class="form-group mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Enter username" value="{{ $data->username }}" required>
          </div>
          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ $data->email }}" required>
          </div>
          <div class="form-group mb-3">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
              <option value="0" {{ $data->role == 0 ? 'selected' : '' }}>Admin</option>
              <option value="1" {{ $data->role == 1 ? 'selected' : '' }}>Pegawai</option>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="profile">Profile Picture</label>
            <input type="file" name="avatar" class="form-control" id="profile">
          </div>
          <div class="form-group mb-3">
            <label for="password">New Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter New password" >
          </div>
          <small class="mb-3" style="color: red;">Biarkan kosong jiak tidak diperlukan</small>
        </div>
          <a href="{{route('kelola-user')}}" class="btn btn-secondary mt-3">Close</a>
          <button type="submit" class="btn btn-primary mt-3">Update User</button>
      </form>
    </div>
  </div>
</div>
@endsection
