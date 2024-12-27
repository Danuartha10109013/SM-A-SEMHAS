<div class="iq-sidebar-logo d-flex justify-content-between">
   <a href="{{route('welcome')}}">
       <div class="iq-light-logo">
           <div class="iq-light-logo">
               <img src="{{asset('Logo TML.png')}}" class="img-fluid" alt="">
           </div>
           <div class="iq-dark-logo">
               <img src="{{asset('Logo TML.png')}}" class="img-fluid" alt="">
           </div>
       </div>
       <div class="iq-dark-logo">
           <img width="20%" src="{{asset('Logo TML.png')}}" class="img-fluid" alt="">
       </div>
       <span>Tml</span>
   </a>
   <div class="iq-menu-bt-sidebar">
       <div class="iq-menu-bt align-self-center">
           <div class="wrapper-menu">
               <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
               <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
           </div>
       </div>
   </div>
</div>
@if (request()->routeIs('profile'))
<div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Back</span></li>

          <li class="{{ request()->routeIs('Administrator.kelola-user') ? 'active' : '' }}">
              <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
          </li>
        </ul>
    </nav>
</div>
@else
<div id="sidebar-scrollbar">
   <nav class="iq-sidebar-menu">
       <ul id="iq-sidebar-toggle" class="iq-menu">
           {{-- <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
           <li class="{{ request()->routeIs('Kendaraan.pegawai.dashboard') ? 'active' : '' }}">
               <a href="{{route('Kendaraan.pegawai.dashboard')}}" class="iq-waves-effect">
                   <i class="ri-home-4-line"></i><span>Dashboard</span>
               </a>
           </li> --}}
           <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
           <li class="{{ request()->routeIs('welcome') ? 'active' : '' }}">
               <a href="{{route('welcome')}}" class="iq-waves-effect">
                   <i class="ri-home-4-line"></i><span>Dashboard</span>
               </a>
           </li>
           <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Rekap</span></li>
            <li class="{{ request()->routeIs('L-08.admin.rekap') ? 'active' : '' }}">
                <a href="{{route('L-08.pegawai.rekap')}}" class="iq-waves-effect" aria-expanded="false">
                    <i class="mdi mdi-target-variant"></i><span>Rekap Packing</span>
                </a>
            </li>
           <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Packing Coil</span></li>
           <li class="{{ request()->routeIs('L-08.pegawai.dashboard') ? 'active' : '' }}">
            <a href="{{route('L-08.pegawai.dashboard')}}" class="iq-waves-effect" aria-expanded="false">
                <i class="mdi mdi-package-variant-closed"></i><span>Packing</span>
            </a>
        </li>
       </ul>
   </nav>
   <div class="p-3"></div>
</div>
@endif
