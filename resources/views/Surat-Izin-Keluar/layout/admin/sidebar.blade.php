<div class="iq-sidebar-logo d-flex justify-content-between">
   <a href="{{route('login')}}">
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
<div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
            <li class="{{ request()->routeIs('welcome') ? 'active' : '' }}">
                <a href="{{route('welcome')}}" class="iq-waves-effect">
                    <i class="ri-home-4-line"></i><span>Dashboard</span>
                </a>
            </li>
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Surat</span></li>

          <li class="{{ request()->routeIs('sik') ? 'active' : '' }}">
              <a href="{{ route('sik') }}" class="btn btn-light">
                <i class="mdi mdi-mail"></i><span>Surat Izin Keluar</span></a>
          </li>
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Izin</span></li>

          <li class="{{ request()->routeIs('pemberi-izin') ? 'active' : '' }}">
              <a href="{{ route('pemberi-izin') }}" class="btn btn-light">
                <i class="mdi mdi-security"></i><span>Beri Izin</span></a>
          </li>
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Security</span></li>

          <li class="{{ request()->routeIs('security') ? 'active' : '' }}">
              <a href="{{ route('security') }}" class="btn btn-light">
                <i class="mdi mdi-security"></i><span>Persetujuan</span></a>
          </li>
        </ul>
    </nav>
</div>
