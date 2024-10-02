<div class="iq-sidebar-logo d-flex justify-content-between">
    <a href="index.html">
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
          <li class="active">
            @if (Auth::user()->role == 0)
               <a href="{{route('Ship-Mark.admin.dashboard')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
            @else
               <a href="{{route('Ship-Mark.pegawai.dashboard')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
            @endif
          </li>
          <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Shippment</span></li>
          @if (Auth::user()->role == 0)
          <li><a href="{{route('Ship-Mark.admin.shipment-a')}}" class="iq-waves-effect iq-bg-primary" aria-expanded="false"><i>A</i><span>SHIPPMENT A</span></a></li>
          <li><a href="{{route('Ship-Mark.admin.shipment-b')}}" class="iq-waves-effect iq-bg-danger" aria-expanded="false"><i>B</i><span>SHIPPMENT B</span></a></li>
          <li><a href="{{route('Ship-Mark.admin.shipment-c')}}" class="iq-waves-effect iq-bg-warning" aria-expanded="false"><i>C</i><span>SHIPPMENT C</span></a></li>
          <li><a href="{{route('Ship-Mark.admin.shipment-d')}}" class="iq-waves-effect iq-bg-info" aria-expanded="false"><i>D</i><span>SHIPPMENT D</span></a></li>
          @else
          <li><a href="{{route('Ship-Mark.pegawai.shipment-a')}}" class="iq-waves-effect iq-bg-primary" aria-expanded="false"><i>A</i><span>SHIPPMENT A</span></a></li>
          <li><a href="{{route('Ship-Mark.pegawai.shipment-b')}}" class="iq-waves-effect iq-bg-danger" aria-expanded="false"><i>B</i><span>SHIPPMENT B</span></a></li>
          <li><a href="{{route('Ship-Mark.pegawai.shipment-c')}}" class="iq-waves-effect iq-bg-warning" aria-expanded="false"><i>C</i><span>SHIPPMENT C</span></a></li>
          <li><a href="{{route('Ship-Mark.pegawai.shipment-d')}}" class="iq-waves-effect iq-bg-info" aria-expanded="false"><i>D</i><span>SHIPPMENT D</span></a></li>
          @endif

          
       </ul>
    </nav>
    <div class="p-3"></div>
 </div>