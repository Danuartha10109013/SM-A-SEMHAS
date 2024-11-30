@extends('Form-Check.layout.main')
@section('title')
    Dashboarad  @if(Auth::user()->role == 0)
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
          </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>
      <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('vendorfc/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total Form <i class="mdi mdi-chart-line mdi-24px float-end"></i>
              </h4>
              <h2 class="mb-5">5</h2>
              <h6 class="card-text">Crane, Forklift, Trailer, Eup, Material</h6>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('vendorfc/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total Response <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
              </h4>
              <h2 class="mb-5">{{$form}}</h2>
              <h6 class="card-text">Pegawai Responsne</h6>
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('vendorfc/src/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Total Pegawai <i class="mdi mdi-diamond mdi-24px float-end"></i>
              </h4>
              <h2 class="mb-5">{{$response}}</h2>
              <h6 class="card-text">TML</h6>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table tale-striped">
          <thead>
            <tr>
              <th class="text-center">Crane</th>
              <th class="text-center">Forklift</th>
              <th class="text-center">Trailler</th>
              <th class="text-center">Eup</th>
              <th class="text-center">CRC</th>
              <th class="text-center">Ingot</th>
              <th class="text-center">Resin/Alkali</th>
            </tr>
          </thead>
          <tbody>
            @php
              $crane = \App\Models\CraneM::count();
              $forklift = \App\Models\ForkliftM::count();
              $trailler = \App\Models\TraillerM::count();
              $eup = \App\Models\EupM::count();
              $crc = \App\Models\CrcM::count();
              $ingot = \App\Models\IngotM::count();
              $resin = \App\Models\ResinM::count();
            @endphp
            <tr>
              <td class="text-center">{{$crane}}</td>
              <td class="text-center">{{$forklift}}</td>
              <td class="text-center">{{$trailler}}</td>
              <td class="text-center">{{$eup}}</td>
              <td class="text-center">{{$crc}}</td>
              <td class="text-center">{{$ingot}}</td>
              <td class="text-center">{{$resin}}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {{-- <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Recent Response</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th> Responden </th>
                      <th> Form </th>
                      <th> Action </th>
                      <th> Date </th>
                      <th> Jenis </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <img src="assets/images/faces/face1.jpg" class="me-2" alt="image"> David Grey
                      </td>
                      <td> Fund is not recieved </td>
                      <td>
                        <label class="badge badge-gradient-success">DONE</label>
                      </td>
                      <td> Dec 5, 2017 </td>
                      <td> WD-12345 </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="assets/images/faces/face2.jpg" class="me-2" alt="image"> Stella Johnson
                      </td>
                      <td> High loading time </td>
                      <td>
                        <label class="badge badge-gradient-warning">PROGRESS</label>
                      </td>
                      <td> Dec 12, 2017 </td>
                      <td> WD-12346 </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="assets/images/faces/face3.jpg" class="me-2" alt="image"> Marina Michel
                      </td>
                      <td> Website down for one week </td>
                      <td>
                        <label class="badge badge-gradient-info">ON HOLD</label>
                      </td>
                      <td> Dec 16, 2017 </td>
                      <td> WD-12347 </td>
                    </tr>
                    <tr>
                      <td>
                        <img src="assets/images/faces/face4.jpg" class="me-2" alt="image"> John Doe
                      </td>
                      <td> Loosing control on server </td>
                      <td>
                        <label class="badge badge-gradient-danger">REJECTED</label>
                      </td>
                      <td> Dec 3, 2017 </td>
                      <td> WD-12348 </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Project Status</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Name </th>
                      <th> Due Date </th>
                      <th> Progress </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> 1 </td>
                      <td> Herman Beck </td>
                      <td> May 15, 2015 </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td> 2 </td>
                      <td> Messsy Adam </td>
                      <td> Jul 01, 2015 </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td> 3 </td>
                      <td> John Richards </td>
                      <td> Apr 12, 2015 </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td> 4 </td>
                      <td> Peter Meggik </td>
                      <td> May 15, 2015 </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td> 5 </td>
                      <td> Edward </td>
                      <td> May 03, 2015 </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td> 5 </td>
                      <td> Ronald </td>
                      <td> Jun 05, 2015 </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-dark">Todo List</h4>
              <div class="add-items d-flex">
                <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
              </div>
              <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked> Call John </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Create invoice </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Print Statements </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li class="completed">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                  <li>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                    </div>
                    <i class="remove mdi mdi-close-circle-outline"></i>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
    


    </div>
</div>
@endsection