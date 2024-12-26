@extends('Coil-Damage.layout.main')
@section('title')
    Coil Damage||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Coil Damage
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>

      @if (Auth::user()->role == 0)
      <a href="{{ route('Coil-Damage.admin.damage.add') }}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i> New Coil</a>
      @else
      <a href="{{ route('Coil-Damage.pegawai.damage.add') }}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i> New Coil</a>
      @endif
  
      <!-- Export Form -->
      @if (Auth::user()->role == 0)
      <form action="{{ route('Coil-Damage.admin.damage.export') }}" method="GET" class="mb-3">
      @else
      <form action="{{ route('Coil-Damage.pegawai.damage.export') }}" method="GET" class="mb-3">
      @endif

          @csrf
  
          <!-- Include the current filter values -->
          <input type="hidden" name="year" value="{{ $selectedYear }}">
          <input type="hidden" name="month" value="{{ $selectedMonth }}">
          <input type="hidden" name="search" value="{{ $search }}">
  
          <button type="submit" class="btn btn-success mb-3">
              <i class="mdi mdi-export"></i> Export
          </button>
      </form>
    
<div class="row">
  <div class="col-md-7">
    <!-- Year Filter Form -->
    <!-- Year Filter Form -->
    @if (Auth::user()->role == 0)
    <form action="{{ route('Coil-Damage.admin.dashboard') }}" method="GET">
    @else
    <form action="{{ route('Coil-Damage.pegawai.dashboard') }}" method="GET">
    @endif
        <select name="year" id="year" onchange="this.form.submit()" class="form-select">
            @foreach($years as $year)
                <option value="{{ $year->year }}" {{ $selectedYear == $year->year ? 'selected' : '' }}>
                    {{ $year->year }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <input type="hidden" name="search" value="{{ $search }}">
    </form>

    <!-- Month Filter Form -->
    @if (Auth::user()->role == 0)
    <form action="{{ route('Coil-Damage.admin.dashboard') }}" method="GET">
    @else
    <form action="{{ route('Coil-Damage.pegawai.dashboard') }}" method="GET">
    @endif
        <select name="month" id="month" onchange="this.form.submit()" class="form-select mt-2">
            <option value="">-- Select Month --</option>
            @foreach(range(1, 12) as $month)
                <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                    {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                </option>
            @endforeach
        </select>
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="search" value="{{ $search }}">
    </form>

    
  </div>
  <div class="col-md-5 text-end">
    <!-- Search Form -->
    <form action="{{ route('Coil-Damage.admin.dashboard') }}" method="GET" class="d-inline">
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <input type="text" name="search" placeholder="Search By Attribute" class="form-control d-inline" value="{{ $search }}" style="width: auto;background-color: white">
        <button class="btn btn-success" type="submit">Search</button>
    </form>
  </div>
</div>

    

    <!-- Bar Chart for Coil Damage -->
    <div class="card mt-4 mb-4">
        <div class="card-body">
            <canvas id="coilDamageChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for Chart.js
        const data = @json($chart);
        const labels = [];
        const damageCounts = [];

        data.forEach(item => {
            // If month filter is selected, show daily data
            if (item.day) {
                labels.push(`Day ${item.day}`);
                damageCounts.push(item.total);
            }
            // If month filter is not selected, show monthly data
            else {
                const monthName = new Date(item.month + '-01').toLocaleString('default', { month: 'long' });
                labels.push(monthName);
                damageCounts.push(Math.round(item.total));
            }
        });

        // Render the bar chart
        const ctx = document.getElementById('coilDamageChart').getContext('2d');
        const coilDamageChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Coil Damage Count',
                    data: damageCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Ensures the chart resizes based on the container
                maintainAspectRatio: false, // Allows flexible resizing of the chart
                animations: {
                    tension: {
                        duration: 0 // Disables animation on bar chart tension
                    },
                    x: {
                        duration: 0 // Disables animation for x-axis
                    },
                    y: {
                        duration: 0 // Disables animation for y-axis
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: '{{ $selectedMonth ? "Day" : "Month" }}'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Damage Count'
                        }
                    }
                }
            }
        });
    </script>

    
      <div class="card mt-4">
        <div class="card-header">Data Detail</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>Attribute</th>
                  <th>Berat Coil</th>
                  <th>Jenis Handling</th>
                  <th>Foto</th>
                  <th>Keterangan</th>
                  <th>Pelapor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  
                <tr>
                  <td class="align-middle text-start">{{$loop->iteration}}</td>
                  <td class="align-middle text-start">{{ $d->created_at->format('d-m-Y')}}</td>

                  <td class="align-middle text-start">{{$d->attribute}}</td>
                  <td class="align-middle text-start">{{$d->berat_coil}}</td>
                  <td class="align-middle text-start">{{$d->jenis_handling}}</td>
                  <td class="align-middle">
                    <!-- Slider for Images -->
                    @if($d->foto)
                        @php
                            $images = json_decode($d->foto, true);
                             // Decode the JSON string into an array
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                            <div id="carousel{{ $d->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('storage/coil_damages/'.$image) }}" class="d-block w-100 h-100" alt="Product Image">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $d->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <p>No images available</p>
                        @endif
                    @else
                        <p>No images available</p>
                    @endif
                </td>
                
                  <td class="align-middle text-start">{{$d->keterangan}}</td>
                  <td class="align-middle text-start">
                    @php
                      $name = \App\Models\User::where('id',$d->user_id)->value('name');
                    @endphp
                    {{$name}}
                  </td>
                  <td class="align-middle text-start">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $d->id }}">
                      <i class="fa fa-edit"></i> 
                    </a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $d->id }}">
                      <i class="fa fa-trash"></i> 
                  </a>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal-{{ $d->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $d->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                            @if (Auth::user()->role == 0)
                              <form action="{{route('Coil-Damage.admin.damage.delete',$d->id)}}" method="POST">
                            @else
                              <form action="{{route('Coil-Damage.pegawai.damage.delete',$d->id)}}" method="POST">
                            @endif
                                  @csrf
                                  @method('DELETE')
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel-{{ $d->id }}">Delete d</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      Are you sure you want to delete this?
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-danger">Delete</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal-{{ $d->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="editModalLabel-{{ $d->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              @if (Auth::user()->role == 0)
                              <form action="{{ route('Coil-Damage.admin.damage.update', $d->id) }}" enctype="multipart/form-data" method="POST">
                              @else
                              <form action="{{ route('Coil-Damage.pegawai.damage.update', $d->id) }}" enctype="multipart/form-data" method="POST">
                              @endif
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $d->id }}">Edit d</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Attribute field with QR scanner -->
                                        <div class="form-group position-relative">
                                            <label for="edit_attribute_{{ $d->id }}">Attribute</label>
                                            <input type="text" class="form-control" id="edit_attribute_{{ $d->id }}" name="attribute" value="{{ $d->attribute }}">
                                            <button type="button" id="scan-button-attribute-{{ $d->id }}" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
                                            <div id="qr-reader-attribute-{{ $d->id }}" style="width: 100%; display: none;"></div>
                                        </div>

                                        <div class="mb-3 position-relative">
                                          <label for="berat_coil" class="form-label">Berat Coil</label>
                                          <input type="text" name="berat_coil" id="berat_coil" class="form-control" value="{{$d->berat_coil}}" required>
                                        </div>

                                        <div class="mb-3">
                                          <label for="jenis_handling" class="form-label">Jenis Handling</label>
                                          <select name="jenis_handling" id="jenis_handling" class="form-control" required>
                                              <option value="" disabled>-- Select Jenis Handling --</option>
                                              <option value="Crane" {{ old('kondisi', $d->jenis_handling) == 'Crane' ? 'selected' : '' }}>Crane</option>
                                              <option value="Forklift" {{ old('kondisi', $d->jenis_handling) == 'Forklift' ? 'selected' : '' }}>Forklift</option>
                                              <option value="other" {{ old('kondisi', $d->jenis_handling) == 'other' ? 'selected' : '' }}>other</option>
                                          </select>
                                        </div>
                                        <div class="mb-3" id="other-handling-container" style="display: none;">
                                          <label for="other-handling" class="form-label">Please specify</label>
                                          <input type="text" name="other_handling" id="other-handling" class="form-control" placeholder="Enter your custom handling">
                                        </div>
                                        <div class="mb-3 position-relative">
                                          <label for="foto" class="form-label">Foto Coil</label>
                                          <input type="file" name="foto[]" id="foto" multiple class="form-control">
                                        </div>
                        
                                        <div class="mb-3 position-relative">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" name="keterangan" id="keterangan" value="{{$d->keterangan}}" class="form-control">
                                        </div>
                                        

                                        <!-- QR Code Scanner Script -->
                                        <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
                                        <script>
                                            // Toggle display of custom handling input
                                            document.getElementById('jenis_handling').addEventListener('change', function() {
                                                const otherHandlingContainer = document.getElementById('other-handling-container');
                                                otherHandlingContainer.style.display = this.value === 'other' ? 'block' : 'none';
                                            });

                                            function initQrScanner(buttonId, readerId, inputId) {
                                                const scanButton = document.getElementById(buttonId);
                                                const qrReader = document.getElementById(readerId);
                                                const input = document.getElementById(inputId);
                                                let html5QrCode = null;
                                                let scannerIsActive = false;

                                                scanButton.addEventListener('click', () => {
                                                    input.value = '';

                                                    if (!scannerIsActive) {
                                                        qrReader.style.display = 'block';
                                                        html5QrCode = new Html5Qrcode(readerId);

                                                        html5QrCode.start(
                                                            { facingMode: "environment" },
                                                            { fps: 10, qrbox: 250 },
                                                            qrCodeMessage => {
                                                                input.value = qrCodeMessage;
                                                                stopQrScanner();
                                                            },
                                                            errorMessage => console.log("Scanning failed:", errorMessage)
                                                        ).catch(err => {
                                                            console.error("Error starting QR code scanner:", err);
                                                            qrReader.style.display = 'none';
                                                        });

                                                        scannerIsActive = true;
                                                    } else {
                                                        stopQrScanner();
                                                    }
                                                });

                                                function stopQrScanner() {
                                                    if (html5QrCode) {
                                                        html5QrCode.stop().then(() => {
                                                            qrReader.style.display = 'none';
                                                            scannerIsActive = false;
                                                            html5QrCode.clear();
                                                        }).catch(err => console.error("Error stopping the QR code scanner:", err));
                                                    }
                                                }
                                            }

                                            initQrScanner('scan-button-attribute-{{ $d->id }}', 'qr-reader-attribute-{{ $d->id }}', 'edit_attribute_{{ $d->id }}');
                                            initQrScanner('scan-button-layout-{{ $d->id }}', 'qr-reader-layout-{{ $d->id }}', 'edit_layout_{{ $d->id }}');
                                        </script>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
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
@endsection