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
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <!-- Add User Button on the Left -->
                        <label class="btn btn-primary">
                            <a style="text-decoration: none; font-size: 15px;color:white" href="#" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</a>
                        </label>
                        <a href="{{route('superadmin.Administrator.kelola-user.print')}}" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
                    
                        <!-- Search Form on the Right -->
                        <form action="{{ route('superadmin.Administrator.kelola-user') }}" method="GET" class="ml-2 mt-2 text-end" style="display: inline;">
                            <input type="text" name="search" placeholder="Search By Name" class="form-control d-inline" value="{{$search}}" style="width: auto; display: inline;">
                            <button class="btn btn-success" type="submit"> 
                                Search
                            </button>
                        </form>
                    </div>
                    
                    <h4 class="card-title">Daftar Pegawai</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> User </th>
                                    <th> Email </th>
                                    <th> Divisi </th>
                                    <th> Action </th>
                                    <th> Date Joined </th>
                                    <th> Role </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <img src="{{asset('storage/'.$d->profile)}}" class="me-2" alt="image"> {{$d->name}}
                                    </td>
                                    <td> {{$d->email}} </td>
                                    <td> {{$d->division}} </td>
                                    <td>
                                        <label class="btn btn-success"><a style="color: white" href="{{route('superadmin.Administrator.kelola-user.edit',$d->id)}}">Edit</a></label>
                                        <label class="btn btn-danger">
                                          <form action="{{ route('superadmin.Administrator.kelola-user.delete', $d->id) }}" method="POST" style="display: inline;">
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
                    <style>
                        svg .w-5 {
                          display: none;
                        }
                        .hidden{
                          display: none;
                        }
                      </style>
                    </div>
                    <div class="mt-3">
                      {{ $data->onEachSide(2)->links() }}
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
            <form action="{{ route('superadmin.Administrator.kelola-user.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="division">division</label>
                        <select name="division" id="division" class="form-control" required>
                            <option value="" selected disabled>--Pilih Divisi--</option>
                            @php
                                $division = \App\Models\DivisionM::all();
                            @endphp
                            @foreach ($division as $div)
                            <option value="{{$div->division}}">{{$div->division}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required onchange="filterTypes()">
                            <option value="0">Admin</option>
                            <option value="1">Pegawai</option>
                        </select>
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="PL" id="typePL">
                                        <label class="form-check-label" for="typePL">Packing List</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="CK" id="typeCK">
                                        <label class="form-check-label" for="typeCK">Checklist Kendaraan</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="SL" id="typeSL">
                                        <label class="form-check-label" for="typeSL">Scan Layout</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="CD" id="typeCD">
                                        <label class="form-check-label" for="typeCD">Coil Damage</label>
                                    </div>
                                    
                                    <!-- Tambahkan di bagian kolom kanan bawah -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="type[]" value="SIK" id="typeSIK">
                                        <label class="form-check-label" for="typeSIK">Surat Izin Keluar</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function filterTypes() {
                            const role = document.getElementById('role').value;
                            const division = document.getElementById('division').value.toLowerCase();

                            const allTypes = ['SP', 'MP', 'FC', 'OP', 'PL', 'CK', 'SL', 'CD', 'all', 'SIK'];
                            const allowedForPegawaiWarehouse = ['FC', 'CK', 'SL'];

                            document.querySelectorAll('input[name="type[]"]').forEach(input => {
                                const type = input.value;
                                let show = false;

                                if (division === 'warehouse') {
                                    // Admin: semua tampil; Pegawai: terbatas + SIK
                                    if (role === '0') {
                                        show = true; // semua
                                    } else {
                                        show = allowedForPegawaiWarehouse.includes(type) || type === 'SIK';
                                    }
                                } else if (division === 'produksi') {
                                    // Produksi hanya FC dan SIK
                                    show = (type === 'FC' || type === 'SIK');
                                } else {
                                    // Divisi lain: hanya SIK
                                    show = (type === 'SIK');
                                }

                                input.closest('.form-check').style.display = show ? 'block' : 'none';
                            });
                        }

                        window.onload = filterTypes;
                        document.getElementById('role').addEventListener('change', filterTypes);
                        document.getElementById('division').addEventListener('change', filterTypes);
                    </script>



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