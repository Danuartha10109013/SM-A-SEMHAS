@extends('L-08.layout.main')
@section('title')
    Packing L-08 ||
  @if(Auth::user()->role == 0)
    Admin
  @elseif(Auth::user()->role == 1)
    Pegawai
  @else
    Unknown
  @endif
@endsection
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-md-12 container-fluid">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
          <i class="mdi mdi-home"></i>
        </span> Rekap Packing
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
   

    <div class="card">
        <div class="card-body">
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <p style="font-weight: bold; margin: 0;">No SO : {{$so}}</p>
            <p style="margin: 0;color: red;text-transform: uppercase;font-weight: bolder"><span style="color: black">Keterangan : </span> {{$keterangan}}</p>
          </div>
          
          <form action="{{ route('L-08.admin.rekap.detail', $so) }}" method="GET">
            <input type="text" name="search" placeholder="Search by Attribute" value="{{ request()->search }}">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Packing</th>
                <th>Layout</th>
                <th>Find</th>
                <th>SO</th>
                <th>Attribute</th>
                <th>Description</th>
                <th>Net</th>
                <th>Gros</th>
                <th>Length</th>
                <th>Stuffing</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $d)
                
              <tr>
                <td class="align-middle">{{$loop->iteration}}</td>
                <td class="align-middle">
                    @if ($d->packing == 'YES')
                    <p class="text-success btn" >
                        {{$d->packing}}</td>
                    </p>
                    @endif
                <td class="align-middle">{{$d->layout}}</td>
                <td class="align-middle">
                  <form action="{{ route('L-08.admin.rekap.detail.find', $d->id) }}" method="POST" class="update-form">
                      @csrf
                      @method('PUT') <!-- Method spoofing for PUT request -->
                      <input type="checkbox" class="check-input" data-id="{{ $d->id }}" @checked($d->checks) />
                  </form>
                </td>
              
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Attach change event listener to all checkboxes
                        document.querySelectorAll('.check-input').forEach(function(checkbox) {
                            checkbox.addEventListener('change', function(e) {
                                e.preventDefault(); // Prevent default form submission
                
                                const checkbox = this;
                                const form = checkbox.closest('form');
                                const id = checkbox.getAttribute('data-id');
                                const checked = checkbox.checked ? 1 : 0; // Determine if checkbox is checked or unchecked
                
                                // Get the CSRF token from the meta tag
                                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                                // Create a FormData object from the form
                                const formData = new FormData(form);
                                formData.append('checked', checked); // Add checkbox state
                                formData.append('_method', 'PUT'); // Indicate the intended method
                                formData.append('_token', csrfToken); // Add CSRF token explicitly
                
                                // Send AJAX request to the server
                                fetch(form.action, {
                                    method: 'POST', // Send POST request, even though the form uses PUT
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken, // Add CSRF token to the request headers
                                    },
                                    body: formData, // Send form data
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    if (data.success) {
                                        console.log('Update successful');
                                    } else {
                                        console.error('Update failed:', data.message || 'Unknown error');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error updating data:', error);
                                });
                            });
                        });
                    });
                </script>
              
              
                <td class="align-middle">{{$d->no_so}}</td>
                <td class="align-middle">{{$d->attribute}}</td>
                <td class="align-middle">{{$d->desc}}</td>
                <td class="align-middle">{{$d->net}}</td>
                <td class="align-middle">{{$d->gross}}</td>
                <td class="align-middle">{{$d->length}}</td>
                <td class="align-middle">{{$d->type}}</td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection