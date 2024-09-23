@extends('Form-Check.layout.main')
@section('title')
    Form Crane
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<div class="col-md-12 container-fluid">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
          </span> Form Crane
        </h3>
        <nav aria-label="breadcrumb">
          <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
              <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
          </ul>
        </nav>
      </div>
      <a href="{{ route('Form-Check.admin.crane.add') }}" class="badge badge-gradient-primary mb-3" style="text-decoration: none; font-size: 15px">Tambahkan response</a>
      <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Recent Response</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> No </th>
                        <th> Jenis Crane </th>
                        <th> Shift </th>
                        <th> Responden </th>
                        <th> Action </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                      <tr>
                        <td>
                          {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                        </td>
                        <td> {{ $d->jenis_crane }} </td>
                        <td> {{ $d->shift }} </td>
                        <td>
                            @php
                                $nama = \App\Models\User::where('id', $d->user_id)->value('name');
                            @endphp
                            {{ $nama }}
                        </td>
                        
                        <td>
                           <a href="{{route('Form-Check.admin.crane.print', $d->id)}}"> <label class="badge badge-gradient-success">print</label></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <!-- Pagination Links -->
                  {{ $data->links() }}
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
