<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
       <div class="iq-sidebar-logo">
          <div class="top-logo">
             <a href="index.html" class="logo">
             <div class="iq-light-logo">
          <img src="{{asset('vendor')}}/images/logo.gif" class="img-fluid" alt="">
       </div>
       <div class="iq-dark-logo">
          <img src="{{asset('vendor')}}/images/logo-dark.gif" class="img-fluid" alt="">
       </div>
             <span>vito</span>
             </a>
          </div>
       </div>
       <nav class="navbar navbar-expand-lg navbar-light p-0">
          <div class="navbar-left">

          <div class="iq-search-bar d-none d-md-block">
             <p class="mt-3 mb-3 fw-bolder"> 
               Sistem Informasi Manajemen Operasional
             </p>
          </div>

       </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
          </button>
          <div class="iq-menu-bt align-self-center">
             <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-menu-3-line"></i></div>
                <div class="hover-circle"><i class="ri-menu-3-line"></i></div>
             </div>
          </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             
          </div>
          <ul class="navbar-list">
             
             <li>
                @if (Auth::user())
                <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center bg-primary rounded">
                   <img src="{{asset('storage/'.Auth::user()->profile)}}" class="img-fluid rounded mr-3" alt="user">
                   <div class="caption">
                      <h6 class="mb-0 line-height text-white">{{Auth::user()->name}}</h6>
                      <span class="font-size-12 text-white">Active</span>
                   </div>
                </a>
                <div class="iq-sub-dropdown iq-user-dropdown">
                   <div class="iq-card shadow-none m-0">
                      <div class="iq-card-body p-0 ">
                         <div class="bg-primary p-3">
                            <h5 class="mb-0 text-white line-height">Hello {{Auth::user()->name}}</h5>
                            <span class="text-white font-size-12">Active</span>
                         </div>
                         <a href="{{route('profile',Auth::user()->id)}}" class="iq-sub-card iq-bg-primary-hover">
                            <div class="media align-items-center">
                               <div class="rounded iq-card-icon iq-bg-primary">
                                  <i class="ri-file-user-line"></i>
                               </div>
                               <div class="media-body ml-3">
                                  <h6 class="mb-0 ">My Profile</h6>
                                  <p class="mb-0 font-size-12">View personal profile details.</p>
                               </div>
                            </div>
                         </a>
                         
                         <div class="d-inline-block w-100 text-center p-3">
                            <a class="btn btn-primary dark-btn-primary" href="{{route('logout')}}" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                         </div>
                         @else
                         @endif
                        
                      </div>
                   </div>
                </div>
             </li>
          </ul>

       </nav>
       

    </div>
 </div>