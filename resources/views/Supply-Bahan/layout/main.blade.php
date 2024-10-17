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

      <link rel="stylesheet" href="{{asset('vendorfc/src/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendorfc/src/assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendorfc/src/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendorfc/src/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('vendorfc/src/assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    {{-- <link rel="stylesheet" href="{{asset('vendorfc/src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}"> --}}
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('vendorfc/dist/assets/css/style.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
            @if (Auth::user()->role == 0)
                @include('Supply-Bahan.layout.admin.sidebar')
            @else
                @include('Supply-Bahan.layout.pegawai.sidebar')
            @endif
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            @include('layout.pegawai.topbar')
         </div>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page iq-right-fixed" class="content-page">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Error untuk validasi input form -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @yield('content')
         </div>

 
            <div class="iq-right-fixed">
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
            </div>

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

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

   </body>
</html>
