@extends('Form-Check.layout.main')

@section('title')
    Profile  @if(Auth::user()->role == 0)
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
       <div class="col-sm-12">
          <div class="iq-card">
             <div class="iq-card-body profile-page p-0">
                <div class="profile-header">
                   <div class="cover-container">
                      <img src="{{asset('bgtml.jpg')}}" alt="profile-bg" class="rounded img-fluid">
                      
                   </div>
                   <div class="profile-info p-4">
                      <div class="row">
                         <div class="col-sm-12 col-md-6">
                            <div class="user-detail pl-5">
                               <div class="d-flex flex-wrap align-items-center">
                                  <div class="profile-img pr-4">
                                     <img src="{{asset('storage/'.$data->profile)}}" alt="profile-img" class="avatar-130 img-fluid" />
                                  </div>
                                  <div class="profile-detail d-flex align-items-center">
                                     <h3>{{$data->username}}</h3>
                                     <p class="m-0 pl-3"> {{$data->email}}</p>
                                  </div>
                               </div>
                            </div>
                         </div>
                         
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="col-sm-12">
        <div class="iq-card-body">
            <div class="about-info m-0 p-0">
                <div class="row">
                    <form action="{{ route('update-profile', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
    
                        <h4>Profile Information</h4>
        
                        <div class="col-3 mt-3">Full Name:</div>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" value="{{$data->name}}">
                        </div>
        
                        <div class="col-3 mt-3">Username:</div>
                        <div class="col-9">
                            <input type="text" name="username" class="form-control" value="{{$data->username}}">
                        </div>
        
                        <div class="col-3 mt-3">Email:</div>
                        <div class="col-9">
                            <input type="email" name="email" class="form-control" value="{{$data->email}}">
                        </div>
        
                        <div class="col-3 mt-3">Role:</div>
                        <div class="col-9">
                            <input type="text" name="role" class="form-control" value="{{$data->role == 0 ? 'Admin' : 'Pegawai'}}" readonly>
                        </div>
        
                        <div class="col-3 mt-3">Type:</div>
                        <div class="col-9">
                            <input type="text" name="type" class="form-control" value="{{$data->type}}" readonly>
                        </div>
        
                        <h4 class="mt-3">Avatars</h4>

                        <div class="form-group">
                            <label for="avatar">Profile Picture</label>
                            <input class="form-control" type="file" name="avatar" id="avatar">
                        </div>

                        <!-- Display the existing profile picture -->
                        @if($data->avatar)
                            <div class="form-group">
                                <label>Current Profile Picture:</label>
                                <div>
                                    <img src="{{ asset('storage/avatars/' . $data->avatar) }}" alt="Profile Picture" class="img-thumbnail" width="150">
                                </div>
                            </div>
                        @endif


                        <h4 class="mt-3">Change Password</h4>

                        <div class="col-3 mt-3">New Password:</div>
                        <div class="col-9">
                            <input type="password" name="password" class="form-control" placeholder="Enter new password">
                        </div>

                        <div class="col-3 mt-3">Confirm Password:</div>
                        <div class="col-9">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                        </div>
        
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
 </div>
@endsection