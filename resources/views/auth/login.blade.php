<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login || Generate ShipMark</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{asset('vendor')}}/css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->

      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">

                            <h1 class="mb-0 dark-signin">Sign in</h1>
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @elseif (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <p>Enter your email address and password to access admin panel.</p>
                            <form method="POST" action="{{route('login-proses')}}" class="mt-4">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <a href="#" class="float-right">Forgot password?</a>
                                    <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="d-inline-block w-100">
                                    <div class="custom-control custom-checkbox d-inline-block mt-2 pt-1">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-right">Sign in</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <div class="slick-slider11" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="{{asset('Logo_TML.png')}}" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white"></h4>
                                    <p></p>
                                </div>
                                <div class="item">
                                    <img src="{{asset('Logo TML.png')}}" class="img-fluid mb-4 mt-5" alt="logo">
                                    <h4 class="mb-1 text-white">Tata Metal Lestari</h4>
                                    <p></p>
                                </div>
                                <div class="item">
                                    <img src="{{asset('Logo TML side.png')}}" class="img-fluid mt-5 mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Tata Metal Lestari</h4>
                                    <p>Memberikan Pelayanan Terbaik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
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
      <!-- Owl Carousel JavaScript -->
      <script src="{{asset('vendor')}}/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="{{asset('vendor')}}/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="{{asset('vendor')}}/js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="{{asset('vendor')}}/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="{{asset('vendor')}}/js/custom.js"></script>
   </body>
</html>