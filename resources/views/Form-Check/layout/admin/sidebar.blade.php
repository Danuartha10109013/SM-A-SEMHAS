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
        @if (request()->routeIs('Administrator.kelola-user'))
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Kelola User</span></li>
          <li class="{{ request()->routeIs('Administrator.kelola-user') ? 'active' : '' }}">
              <a href="{{route('Administrator.kelola-user')}}" class="iq-waves-effect" aria-expanded="false">
                  <i class="mdi mdi-account"></i><span>Kelola User</span>
              </a>
          </li>
          @else
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
          <li class="{{ request()->routeIs('welcome') ? 'active' : '' }}">
              <a href="{{route('welcome')}}" class="iq-waves-effect">
                  <i class="ri-home-4-line"></i><span>Dashboard</span>
              </a>
          </li>
            
            <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>From Checklist</span></li>
            <li class="{{ request()->routeIs('Form-Check.admin.crane') ? 'active' : '' }}">
                <a href="{{route('Form-Check.admin.crane')}}" class="iq-waves-effect" aria-expanded="false">
                    <i class="mdi mdi-crane"></i><span>Crane</span>
                </a>
            </li>
            @if (Auth::user()->division == 'Warehouse')
                
                <li class="{{ request()->routeIs('Form-Check.admin.forklift') ? 'active' : '' }}">
                    <a href="{{route('Form-Check.admin.forklift')}}" class="iq-waves-effect" aria-expanded="false">
                        <i class="mdi mdi-forklift"></i><span>Forklift</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('Form-Check.admin.trailler') ? 'active' : '' }}">
                    <a href="{{route('Form-Check.admin.trailler')}}" class="iq-waves-effect" aria-expanded="false">
                        <i class="mdi mdi-truck"></i><span>Trailer</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('Form-Check.admin.eup') ? 'active' : '' }}">
                    <a href="{{route('Form-Check.admin.eup')}}" class="iq-waves-effect" aria-expanded="false">
                        <i class="mdi mdi-shipping-pallet"></i><span>EUP</span>
                    </a>
                </li>
                
                <li>
                    <a href="#userinfo" class="iq-waves-effect collapsed {{ request()->routeIs('Form-Check.admin.crc', 'Form-Check.admin.ingot', 'Form-Check.admin.resin') ? 'active' : '' }}" data-toggle="collapse" aria-expanded="false">
                        <i class="mdi mdi-warehouse"></i><span>Kedatangan Material</span><i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>
                    <ul id="userinfo" class="iq-submenu collapse {{ request()->routeIs('Form-Check.admin.crc', 'Form-Check.admin.ingot', 'Form-Check.admin.resin') ? 'show' : '' }}" data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('Form-Check.admin.crc') ? 'active' : '' }}">
                            <a href="{{route('Form-Check.admin.crc')}}"><i class="mdi mdi-barn"></i>CRC</a>
                        </li>
                        <li class="{{ request()->routeIs('Form-Check.admin.ingot') ? 'active' : '' }}">
                            <a href="{{route('Form-Check.admin.ingot')}}"><i class="mdi mdi-gold"></i>INGOT</a>
                        </li>
                        <li class="{{ request()->routeIs('Form-Check.admin.resin') ? 'active' : '' }}">
                            <a href="{{route('Form-Check.admin.resin')}}"><i class="mdi mdi-barrel"></i>RESIN/ALKALI</a>
                        </li>
                    </ul>
                </li>
            @endif
                
        @endif
            
            <!-- Tambahkan active di bagian yang lain sesuai kebutuhan -->
        </ul>
    </nav>
    <div class="p-3"></div>
 </div>
@endif


