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
<div id="sidebar-scrollbar">
    <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
            <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
            <li class="{{ request()->routeIs('welcome') ? 'active' : '' }}">
                  <a href="{{route('welcome')}}" class="iq-waves-effect">
                     <i class="ri-home-4-line"></i><span>Dashboard</span>
                  </a>
            </li>
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Data Master</span></li>

          <li class="{{ request()->routeIs('superadmin.data-master') ? 'active' : '' }} mb-3">
              <a  href="{{ route('superadmin.data-master') }}" class="btn btn-secondary">
               <i class="mdi mdi-database-settings text-light"></i><span class="text-light">All Page</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('superadmin.form-check') ? 'active' : '' }} mb-3">
              <a  href="{{ route('superadmin.form-check') }}" class="btn btn-secondary">
               <i class="mdi mdi-checkbox-marked-outline text-light"></i><span class="text-light">Form Check</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('superadmin.kondisi.kondisi') ? 'active' : '' }} mb-3">
              <a  href="{{ route('superadmin.kondisi.kondisi') }}" class="btn btn-secondary">
               <i class="mdi mdi-arrow-collapse-all text-light"></i><span class="text-light">Kondisi</span>
            </a>
          </li>
          <li class="{{ request()->routeIs('superadmin.division.division') ? 'active' : '' }} mb-3">
              <a  href="{{ route('superadmin.division.division') }}" class="btn btn-secondary">
               <i class="mdi mdi-application text-light"></i><span class="text-light">Division</span>
            </a>
          </li>
        </ul>
    </nav>
</div>
