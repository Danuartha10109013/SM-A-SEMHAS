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
             <form action="#" class="searchbox">
                <input type="text" class="text search-input" placeholder="Type here to search...">
                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                <div class="searchbox-datalink">
                   <h6 class="pl-3 pt-3 pb-3">Pages</h6>
                   <ul class="m-0 pl-3 pr-3 pb-3">
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home Form-Check</span></li>
                     <li class="active">
                        <a href="{{route('Form-Check.pegawai.dashboard')}}" class="iq-waves-effect"><i class="ri-home-4-line"></i><span>Dashboard</span></a>
                     </li>
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>From Checklist</span></li>
                     
                     <li><a href="{{route('Form-Check.pegawai.crane')}}" class="iq-waves-effect" aria-expanded="false"><i class="mdi mdi-crane"></i><span>Crane</span></a></li>
                     <li><a href="{{route('Form-Check.pegawai.forklift')}}" class="iq-waves-effect" aria-expanded="false"><i class="mdi mdi-forklift"></i><span>Forklift</span></a></li>
                     <li><a href="{{route('Form-Check.pegawai.trailler')}}" class="iq-waves-effect" aria-expanded="false"><i class="mdi mdi-truck"></i><span>Trailler</span></a></li>
                     <li><a href="{{route('Form-Check.pegawai.eup')}}" class="iq-waves-effect" aria-expanded="false"><i class="mdi mdi-shipping-pallet"></i><span>EUP</span></a></li>
                     
                     <li>
                        <a href="#userinfo" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false"><i class="mdi mdi-warehouse"></i><span>Kedatangan Material</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                           <li><a href="{{route('Form-Check.pegawai.crc')}}"><i class="mdi mdi-barn"></i>CRC</a></li>
                           <li><a href="{{route('Form-Check.pegawai.ingot')}}"><i class="mdi mdi-gold"></i>INGOT</a></li>
                           <li><a href="{{route('Form-Check.pegawai.resin')}}"><i class="mdi mdi-barrel"></i>RESIN/ALKALI</a></li>
                        </ul>
                     </li>
                     <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>Home Ship mark</span></li>
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
                </div>
             </form>
          </div>
       </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
          <i class="ri-menu-3-line"></i>
          </button>
          <div class="iq-menu-bt align-self-center">
             <div class="wrapper-menu">
                <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
             </div>
          </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
             
          </div>
          <ul class="navbar-list">
             <li>
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
                      </div>
                   </div>
                </div>
             </li>
          </ul>
       </nav>
       

    </div>
 </div>