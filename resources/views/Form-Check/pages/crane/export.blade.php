<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Export</title>
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
</head>
<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Responden</td>
                    <td>Shift</td>
                    <td>Shift leader</td>
                    <td>Jenis Crane</td>
                    <td>Date</td>
                    <td>Start</td>
                    <td>Ket Start</td>
                    <td>Switch</td>
                    <td>Ket Switch</td>
                    <td>Up</td>
                    <td>Ket Up</td>
                    <td>Down</td>
                    <td>Ket Down</td>
                    <td>Ctravel</td>
                    <td>Ket Ctravel</td>
                    <td>Ltravel</td>
                    <td>Ket Ltravel</td>
                    <td>Emergency</td>
                    <td>Ket Emergency</td>
                    <td>Speed 1</td>
                    <td>Ket Speed 1</td>
                    <td>Speed 2</td>
                    <td>Ket Speed 2</td>
                    <td>block</td>
                    <td>Ket block</td>
                    <td>lockert</td>
                    <td>Ket lockert</td>
                    <td>Wire</td>
                    <td>Ket Wire</td>
                    <td>Sltravel</td>
                    <td>Ket Sltravel</td>
                    <td>Sirinelt</td>
                    <td>Ket Sirinelt</td>
                    <td>Brakeno</td>
                    <td>Ket Brakeno</td>
                    <td>Brakeya</td>
                    <td>Ket Brakeya</td>
                    <td>Bcno</td>
                    <td>Ket Bcno</td>
                    <td>Bcya</td>
                    <td>Ket Bcya</td>
                    <td>Updno</td>
                    <td>Ket Updno</td>
                    <td>Updya</td>
                    <td>Ket Updya</td>
                    <td>Crcros</td>
                    <td>Ket Crcros</td>
                    <td>Catatan</td>
                    <td>Mtc</td>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                <tr>
                    <td>{{$d->created_at}}</td>
                    <td>
                        @php
                            $name = \App\Models\User::where('id', $d->user_id)->value('name');
                        @endphp
                        {{$name}}</td>
                    <td>{{$d->shift}}</td>
                    <td class="warp">{{$d->shift_leader}}</td>
                    <td>{{$d->jenis_crane}}</td>
                    <td>{{$d->date}}</td>
                    <td>{{$d->start}}</td>
                    <td>{{$d->ket_start}}</td>
                    <td>{{$d->switch}}</td>
                    <td>{{$d->ket_switch}}</td>
                    <td>{{$d->up}}</td>
                    <td>{{$d->ket_up}}</td>
                    <td>{{$d->down}}</td>
                    <td>{{$d->ket_down}}</td>
                    <td>{{$d->ctravel}}</td>
                    <td>{{$d->ket_ctravel}}</td>
                    <td>{{$d->ltravel}}</td>
                    <td>{{$d->ket_ltravel}}</td>
                    <td>{{$d->emergency}}</td>
                    <td>{{$d->ket_emergency}}</td>
                    <td>{{$d->speed1}}</td>
                    <td>{{$d->ket_speed1}}</td>
                    <td>{{$d->speed2}}</td>
                    <td>{{$d->ket_speed2}}</td>
                    <td>{{$d->block}}</td>
                    <td>{{$d->ket_block}}</td>
                    <td>{{$d->lockert}}</td>
                    <td>{{$d->ket_lockert}}</td>
                    <td>{{$d->wire}}</td>
                    <td>{{$d->ket_wire}}</td>
                    <td>{{$d->sltravel}}</td>
                    <td>{{$d->ket_sltravel}}</td>
                    <td>{{$d->sirinelt}}</td>
                    <td>{{$d->ket_sirinelt}}</td>
                    <td>{{$d->brakeno}}</td>
                    <td>{{$d->ket_brakeno}}</td>
                    <td>{{$d->brakeya}}</td>
                    <td>{{$d->ket_brakeya}}</td>
                    <td>{{$d->bcno}}</td>
                    <td>{{$d->ket_bcno}}</td>
                    <td>{{$d->bcya}}</td>
                    <td>{{$d->ket_bcya}}</td>
                    <td>{{$d->updno}}</td>
                    <td>{{$d->ket_updno}}</td>
                    <td>{{$d->updya}}</td>
                    <td>{{$d->ket_updya}}</td>
                    <td>{{$d->crcros}}</td>
                    <td>{{$d->ket_crcros}}</td>
                    <td>{{$d->catatan}}</td>
                    <td>{{$d->mtc}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        </div>    

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