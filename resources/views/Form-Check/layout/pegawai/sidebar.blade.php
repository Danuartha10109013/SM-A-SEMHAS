<div class="iq-sidebar-logo d-flex justify-content-between">
   <a href="{{ route('welcome') }}">
       <div class="iq-light-logo">
           <img src="{{ asset('Logo TML.png') }}" class="img-fluid" alt="">
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
           <li>
               <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
           </li>
       </ul>
   </nav>
</div>
@else
<div id="sidebar-scrollbar">
   <nav class="iq-sidebar-menu">
       <ul id="iq-sidebar-toggle" class="iq-menu">
        <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home</span></li>
        <li class="{{ request()->routeIs('welcome') ? 'active' : '' }}">
            <a href="{{route('welcome')}}" class="iq-waves-effect">
                <i class="ri-home-4-line"></i><span>Dashboard</span>
            </a>
        </li>
           
           <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Form Checklist</span></li>
           <li class="{{ request()->routeIs('Form-Check.pegawai.crane') ? 'active' : '' }}">
               <a href="{{ route('Form-Check.pegawai.crane') }}" class="iq-waves-effect">
                   <i class="mdi mdi-crane"></i><span>Crane</span>
               </a>
           </li>
           <li class="{{ request()->routeIs('Form-Check.pegawai.forklift') ? 'active' : '' }}">
               <a href="{{ route('Form-Check.pegawai.forklift') }}" class="iq-waves-effect">
                   <i class="mdi mdi-forklift"></i><span>Forklift</span>
               </a>
           </li>
           <li class="{{ request()->routeIs('Form-Check.pegawai.trailler') ? 'active' : '' }}">
               <a href="{{ route('Form-Check.pegawai.trailler') }}" class="iq-waves-effect">
                   <i class="mdi mdi-truck"></i><span>Trailler</span>
               </a>
           </li>
           <li class="{{ request()->routeIs('Form-Check.pegawai.eup') ? 'active' : '' }}">
               <a href="{{ route('Form-Check.pegawai.eup') }}" class="iq-waves-effect">
                   <i class="mdi mdi-shipping-pallet"></i><span>EUP</span>
               </a>
           </li>
           
           <li>
               <a href="#userinfo" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
                   <i class="mdi mdi-warehouse"></i><span>Kedatangan Material</span>
                   <i class="ri-arrow-right-s-line iq-arrow-right"></i>
               </a>
               <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                   <li class="{{ request()->routeIs('Form-Check.pegawai.crc') ? 'active' : '' }}">
                       <a href="{{ route('Form-Check.pegawai.crc') }}"><i class="mdi mdi-barn"></i>CRC</a>
                   </li>
                   <li class="{{ request()->routeIs('Form-Check.pegawai.ingot') ? 'active' : '' }}">
                       <a href="{{ route('Form-Check.pegawai.ingot') }}"><i class="mdi mdi-gold"></i>INGOT</a>
                   </li>
                   <li class="{{ request()->routeIs('Form-Check.pegawai.resin') ? 'active' : '' }}">
                       <a href="{{ route('Form-Check.pegawai.resin') }}"><i class="mdi mdi-barrel"></i>RESIN/ALKALI</a>
                   </li>
               </ul>
           </li>
       </ul>
   </nav>
   <div class="p-3"></div>
</div>
@endif
