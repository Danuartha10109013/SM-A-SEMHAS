<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>@yield('title')</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/bootstrap.min.css">
      <!-- Chart list Js -->
      <link rel="stylesheet" href="{{asset('vendor')}}/js/chartist/chartist.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/responsive.css">
   </head>
   <body class="sidebar-main-active right-column-fixed header-top-bgcolor">
      <!-- loader Start -->
      {{-- <div id="loading">
         <div id="loading-center">
         </div>
      </div> --}}
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            @include('layout.pegawai.sidebar')
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            @include('layout.pegawai.topbar')
         </div>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            @yield('content')
         </div>

 
         {{-- <div class="iq-right-fixed">
            <div class="iq-card mb-0" style="box-shadow: none;">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Customer Distribution</h4>
                  </div>

               </div>
               <div class="iq-card-body">
                  <div id="chartdiv"></div>
               </div>
            </div>

            <div class="iq-card" style="box-shadow: none;">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Countries</h4>
                  </div>
                  <div class="iq-card-header-toolbar d-flex align-items-center">
                     <div class="dropdown">
                        <span class="dropdown-toggle text-primary" id="dropdownMenuButton6" data-toggle="dropdown">
                        <i class="ri-more-2-fill"></i>
                        </span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
                           <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                           <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                           <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                           <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                           <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="iq-details">
                           <div class="d-flex align-items-center justify-content-between">
                              <h6 class="title text-dark">Country</h6>
                              <div class="percentage float-right text-primary">95 <span>%</span></div>
                           </div>
                           <div class="iq-progress-bar-linear d-inline-block w-100">
                              <div class="iq-progress-bar">
                                 <span class="bg-primary" data-percent="95"></span>
                              </div>
                           </div>
                        </div>
                        <div class="iq-details mt-3">
                           <div class="d-flex align-items-center justify-content-between">
                              <h6 class="title text-dark">Town</h6>
                              <div class="percentage float-right text-warning">75 <span>%</span></div>
                           </div>
                           <div class="iq-progress-bar-linear d-inline-block w-100">
                              <div class="iq-progress-bar">
                                 <span class="bg-warning" data-percent="75"></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div> --}}

      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="iq-footer">
         @include('layout.pegawai.footer')
      </footer>

      
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      
      <script src="{{asset('vendor')}}/js/jquery.min.js"></script>
      
      <script src="{{asset('vendor')}}/js/popper.min.js"></script>
      <script src="{{asset('vendor')}}/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="{{asset('vendor')}}/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="{{asset('vendor')}}/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="{{asset('vendor')}}/js/waypoints.min.js"></script>
      <script src="{{asset('vendor')}}/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="{{asset('vendor')}}/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="{{asset('vendor')}}/js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="{{asset('vendor')}}/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="{{asset('vendor')}}/js/select2.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{asset('vendor')}}/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{asset('vendor')}}/js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="{{asset('vendor')}}/js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="{{asset('vendor')}}/js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="{{asset('vendor')}}/js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="{{asset('vendor')}}/js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="{{asset('vendor')}}/js/kelly.js"></script>
      <!-- Morris JavaScript -->
      <script src="{{asset('vendor')}}/js/morris.js"></script>
      <!-- am maps JavaScript -->
      <script src="{{asset('vendor')}}/js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="{{asset('vendor')}}/js/worldLow.js"></script>
      <!-- ChartList Js -->
      <script src="{{asset('vendor')}}/js/chartist/chartist.min.js"></script>
      <!-- Chart Custom JavaScript -->
      <script async src="{{asset('vendor')}}/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="{{asset('vendor')}}/js/custom.js"></script>
   </body>
</html>
