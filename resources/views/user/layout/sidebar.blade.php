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
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Kelola Pegawai</span></li>

          <li class="{{ request()->routeIs('Administrator.kelola-user') ? 'active' : '' }}">
              <a  href="{{ route('Administrator.kelola-user') }}" class="btn btn-primary">
               <i class="fa fa-user text-light"></i><span class="text-light">Pegawai</span>

            </a>
          </li>
        </ul>
    </nav>
</div>
