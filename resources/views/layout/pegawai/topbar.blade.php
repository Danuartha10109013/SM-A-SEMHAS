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
                      <li class="iq-bg-primary-hover rounded"><a href="index.html" class="nav-link router-link-exact-active router-link-active pr-2"><i class="ri-home-4-line pr-2"></i>Dashboard</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="dashboard-1.html" class="nav-link router-link-exact-active router-link-active pr-2"><i class="ri-home-3-line pr-2"></i>Dashboard-1</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="chat.html" class="nav-link"><i class="ri-message-line pr-2"></i>Chat</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="calendar.html" class="nav-link"><i class="ri-calendar-2-line pr-2"></i>Calendar</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="profile.html" class="nav-link"><i class="ri-profile-line pr-2"></i>Profile</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="todo.html" class="nav-link"><i class="ri-chat-check-line pr-2"></i>Todo</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="app/index.html" class="nav-link"><i class="ri-mail-line pr-2"></i>Email</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="pages-faq.html" class="nav-link"><i class="ri-compasses-line pr-2"></i>Faq</a></li>
                      <li class="iq-bg-primary-hover rounded"><a href="form-wizard.html" class="nav-link"><i class="ri-clockwise-line pr-2"></i>Form-wizard</a></li>
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