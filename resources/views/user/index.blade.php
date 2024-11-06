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
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <label class="badge badge-gradient-primary">
                        <a style="text-decoration: none; font-size: 15px;color:white" href="#" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</a>
                    </label>
                    <h4 class="card-title">Daftar Pegawai</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> User </th>
                                    <th> Email </th>
                                    <th> Action </th>
                                    <th> Date Joined </th>
                                    <th> Role </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>
                                        <img src="{{asset('storage/'.$d->profile)}}" class="me-2" alt="image"> {{$d->name}}
                                    </td>
                                    <td> {{$d->email}} </td>
                                    <td>
                                        <label class="badge badge-gradient-success"><a style="color: white" href="{{route('Administrator.kelola-user.edit',$d->id)}}">Edit</a></label>
                                        <label class="badge badge-gradient-danger">
                                          <form action="{{ route('Administrator.kelola-user.delete', $d->id) }}" method="POST" style="display: inline;">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" style="border: none; background: none; color: inherit; cursor: pointer;" onclick="return confirm('Are you sure you want to delete this user?');">
                                                  Delete
                                              </button>
                                          </form>
                                      </label>                                      
                                    </td>
                                    <td> {{$d->created_at}}</td>
                                    <td> {{$d->role == 0 ? 'Admin' : 'Pegawai'}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('Administrator.kelola-user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" name="username" class="form-control" id="name" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group ml-5">
                        <label for="type">Type</label>
                        <div id="type">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="SP" id="typeSP">
                                        <label class="form-check-label" for="typeSP">Shipping Mark</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="MP" id="typeMP">
                                        <label class="form-check-label" for="typeMP">Mapping</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="FC" id="typeFC">
                                        <label class="form-check-label" for="typeFC">Form Check</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="OP" id="typeOP">
                                        <label class="form-check-label" for="typeOP">Open Packing</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="SB" id="typeSB">
                                        <label class="form-check-label" for="typeSB">Supply Bahan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="PL" id="typePL">
                                        <label class="form-check-label" for="typePL">Packing List</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="CK" id="typePL">
                                        <label class="form-check-label" for="typePL">Checklist Kendaraan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="SL" id="typePL">
                                        <label class="form-check-label" for="typePL">Scan Layout</label>
                                    </div>
                                   
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="all" id="typeAll">
                                        <label class="form-check-label" for="typeAll">Akses Penuh</label>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option name="role" value="0">Admin</option>
                            <option name="role" value="1">Pegawai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profile">Profile Picture</label>
                        <input type="file" name="avatar" class="form-control" id="profile">
                    </div>
                    <small style="color: red">Password Auto "Tatametal123"</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection