@extends('Scan-Layout.layout.main')
@section('title')
    Kelola Scan Layout||
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
          </span> Kelola Scan Layout
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>

      <a href="{{route('Scan-Layout.pegawai.scan.add')}}" class="btn btn-primary mb-3"><i class="mdi mdi-plus"></i>New Scan</a>
      <a href="{{route('Scan-Layout.pegawai.scan.export')}}" class="btn btn-success mb-3"><i class="mdi mdi-export"></i>Export</a>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Tanggal</th>
                  <th>Attribute</th>
                  <th>Layout</th>
                  <th>Kondisi</th>
                  <th>Group</th>
                  <th>Responden</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $d)
                  
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{ $d->created_at->format('d-m-Y') }}</td>

                  <td>{{$d->attribute}}</td>
                  <td>{{$d->layout}}</td>
                  <td>{{$d->kondisi}}</td>
                  <td>{{$d->group}}</td>
                  <td>
                    @php
                      $name = \App\Models\User::where('id',$d->user_id)->value('name');
                    @endphp
                    {{$name}}
                  </td>
                  <td>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editModal-{{ $d->id }}">
                      <i class="fa fa-edit"></i> Edit
                    </a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $d->id }}">
                      <i class="fa fa-trash"></i> Delete
                  </a>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal-{{ $d->id }}" data-backdrop="false" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $d->id }}" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <form action="{{route('Scan-Layout.pegawai.scan.delete',$d->id)}}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="deleteModalLabel-{{ $d->id }}">Delete d</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      Are you sure you want to delete this d?
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
                                <form action="{{ route('Scan-Layout.pegawai.scan.update', $d->id) }}" enctype="multipart/form-data" method="POST">
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

                                        <!-- Layout field with QR scanner -->
                                        <div class="form-group position-relative">
                                            <label for="edit_layout_{{ $d->id }}">Layout</label>
                                            <input type="text" class="form-control" id="edit_layout_{{ $d->id }}" name="layout" value="{{ $d->layout }}">
                                            <button type="button" id="scan-button-layout-{{ $d->id }}" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
                                            <div id="qr-reader-layout-{{ $d->id }}" style="width: 100%; display: none;"></div>
                                        </div>

                                        <!-- Kondisi Dropdown -->
                                        <div class="mb-3">
                                            <label for="kondisi" class="form-label">Kondisi</label>
                                            <select name="kondisi" id="kondisi" class="form-control" required>
                                                <option value="" disabled>-- Select Kondisi --</option>
                                                <option value="BAIK" {{ old('kondisi', $d->kondisi) == 'BAIK' ? 'selected' : '' }}>BAIK</option>
                                                <option value="TIDAK" {{ old('kondisi', $d->kondisi) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            </select>
                                        </div>

                                        <!-- Group Dropdown with Conditional Input -->
                                        <div class="mb-3">
                                            <label for="group" class="form-label">Group</label>
                                            <select name="group" id="group" class="form-control" required>
                                                <option value="" selected disabled>-- Select group --</option>
                                                <option value="A" {{ old('group', $d->group) == 'A' ? 'selected' : '' }}>A</option>
                                                <option value="B" {{ old('group', $d->group) == 'B' ? 'selected' : '' }}>B</option>
                                                <option value="C" {{ old('group', $d->group) == 'C' ? 'selected' : '' }}>C</option>
                                                <option value="D" {{ old('group', $d->group) == 'D' ? 'selected' : '' }}>D</option>
                                                <option value="other" {{ old('group', $d->group) == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>

                                        <div class="mb-3" id="other-group-container" style="display: none;">
                                            <label for="other-group" class="form-label">Please specify</label>
                                            <input type="text" name="other_group" id="other-group" class="form-control" placeholder="Enter your custom group" value="{{ $d->other_group ?? '' }}">
                                        </div>

                                        <!-- QR Code Scanner Script -->
                                        <script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
                                        <script>
                                            document.getElementById('group').addEventListener('change', function() {
                                                const otherGroupContainer = document.getElementById('other-group-container');
                                                otherGroupContainer.style.display = this.value === 'other' ? 'block' : 'none';
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
      </div>

      
    </div>
    


    </div>
</div>
@endsection