@extends('Open-Packing.layout.main')
@section('title')
    Open Packing ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Perintah Open Packing</h4>
          <a href="#" data-toggle="modal" data-target="#uploadModal" 
            class="btn btn-primary mr-2 mb-3" style="text-decoration: none; font-size: 15px">
            <i class="fas fa-plus"></i> Tambahkan GM
          </a>
          <!-- Modal -->
          <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true" 
              data-backdrop="false" data-keyboard="false">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="uploadModalLabel">Upload Excel File</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('Open-Packing.admin.packing.excel') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="excelFile">Choose Excel File</label>
                      <input type="file" class="form-control" id="excelFile" name="excel_file" accept=".xls, .xlsx" required>
                    </div>
                    <div class="form-group">
                      <label for="excelFile">Shift</label>
                      <select type="text" class="form-control" id="excelFile" name="shift" required>
                        <option value="" selected disabled>--Pilih Shift--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                    </div>
                    <div class="form-group">
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
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <a href="{{route('Open-Packing.admin.packing.add.gm')}}" class="btn btn-success mb-3"><i class="fa fa-qrcode"></i> Scan</a>

          {{-- <a href="{{ Auth::user()->role == 0 ? route('Open-Packing.admin.packing.add') : route('Open-Packing.pegawai.packing.add') }}" 
            class="btn btn-primary mr-2" style="text-decoration: none; font-size: 15px"><i class="fas fa-plus"></i> Tambahkan GM</a> --}}
            <p><a href="{{route('download.file','Template Input GM.csv')}}">click here</a> for download a template</p>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex">

                {{-- <a href="{{ route('Form-Check.admin.crane.export') }}" 
                   class="btn btn-success" style="text-decoration: none; font-size: 15px">Export Excel</a> --}}
            </div>
        
            <form action="{{ route('Open-Packing.admin.packing') }}" method="GET" id="filterForm">
              <div class="row">
                  <div class="col-md-3">
                      <label for="start_date">Start Date:</label>
                      <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}" onchange="this.form.submit()">
                  </div>
                  <div class="col-md-3">
                      <label for="end_date">End Date:</label>
                      <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}" onchange="this.form.submit()">
                  </div>
                  <div class="col-md-2">
                      <label for="month">Month:</label>
                      <select name="month" id="month" class="form-control" onchange="this.form.submit()">
                          <option value="">Select Month</option>
                          @for ($i = 1; $i <= 12; $i++)
                              <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                  {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                              </option>
                          @endfor
                      </select>
                  </div>
                  <div class="col-md-2">
                      <label for="year">Year:</label>
                      <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                          <option value="">Select Year</option>
                          @for ($year = now()->year; $year >= 2000; $year--)
                              <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                  {{ $year }}
                              </option>
                          @endfor
                      </select>
                  </div>
                  <div class="col-md-2">
                      <label for="search">Search:</label>
                      <input type="text" name="search" id="search" class="form-control" placeholder="Search GM" value="{{ request('search') }}" onkeyup="this.form.submit()">
                  </div>
              </div>
          </form>
          <script>
            let timeout = null;
        
            // Delay for search input to prevent too many requests
            document.getElementById('search').addEventListener('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 500);
            });
        
            // Prevent immediate submission on initial page load
            window.addEventListener('load', function () {
                document.querySelectorAll('#filterForm input, #filterForm select').forEach(function (element) {
                    element.addEventListener('change', function () {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            document.getElementById('filterForm').submit();
                        }, 300);
                    });
                });
            });
        </script>
                  
        </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Date </th>
                  <th> No GM </th>
                  <th> Action </th>
                  <th> Status </th>
                  <th> Total </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$d->created_at->format('d-m-Y')}} </td>
                    <td> {{$d->gm}} </td>
                    <td><a href="{{route('Open-Packing.admin.packing.add.gm',$d->gm)}}">
                      
                      <a href="{{route('Open-Packing.admin.packing.show',$d->gm)}}">
                      <label class="btn btn-success">
                        <i class="fas fa-eye"></i> Show
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.print',$d->gm)}}">
                      <label class="btn btn-warning">
                        <i class="fas fa-print"></i> Print
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.download',$d->gm)}}">
                      <label class="btn btn-dark">
                        <i class="fa fa-file-excel"></i> Export
                      </label></a>
                      <a href="{{route('Open-Packing.admin.packing.delete.gm',$d->gm)}}">
                      <label class="btn btn-danger">
                        <i class="fa fa-trash"></i> Delete
                      </label></a>
                    </td>
                    <td>
                      @php
                          // Fetch the packing details where the gm matches and check if b_aktual is filled
                          $details = \App\Models\PackingDetailM::where('gm', $d->gm)->get();
                          $isComplete = $details->every(function($detail) {
                              return !empty($detail->b_aktual);  // Check if b_aktual is filled
                          });
                      @endphp
                      
                      <!-- Show the button based on completeness -->
                      @if($isComplete)
                          <button class="btn btn-success">Complete</button>
                      @else
                          <button class="btn btn-danger">Not Complete</button>
                      @endif
                  </td>
                  
                    <td>
                      @php
                      $total = \App\Models\PackingDetailM::where('gm',$d->gm)->count();
                      @endphp
                      
                      {{$total}}
                     </td>

                    
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
          @if ( request('search'))
          <h5 class="fw-bold text-center mt-5">Data by Attribute</h5>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> No </th>
                  <th> Atribute / Batch </th>
                  <th> Berat Label </th>
                  <th> Berat Aktual </th>
                  <th> Selisih </th>
                  <th> Persentase </th>
                  <th> Keterangan </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @if ($att)
                
                  @foreach ($att as $d)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td> {{$d->attribute}} </td>
                      <td> {{$d->b_label}} </td>
                      <td> {{$d->b_aktual}} </td>
                      <td> {{$d->selisih}} </td>
                      @if ($d->persentase >= 0)
                      <td style="color: green">{{$d->persentase}} %</td>
                      @elseif ($d->persentase <= -0.25)
                          <td style="color: red">{{$d->persentase}} %</td>
                      @else
                          <td style="color: green">{{$d->persentase}} %</td>
                      @endif
                      <td>{{$d->keterangan}}</td>
                      <td><a href="{{route('Open-Packing.admin.packing.edit',$d->id)}}">
                        <label class="btn btn-primary">
                          <i class="fas fa-edit"></i> 
                        </label></a>
                        <a href="{{route('Open-Packing.admin.packing.delete',$d->id)}}">
                        <label class="btn btn-danger">
                          <i class="fas fa-trash"></i>
                        </label></a>
                        
                      </td>
                      
                    </tr>
                  @endforeach
                @else
                <tr>
                  <td colspan="8" class="text-center align-middle">Data Not Found</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection