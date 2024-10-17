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
                    <td>Jenis Forklift</td>
                    <td>Awal</td>
                    <td>Ket Awal</td>
                    <td>Akhir</td>
                    <td>Ket Akhir</td>
                    <td>Horn</td>
                    <td>Ket Horn</td>
                    <td>Mundur</td>
                    <td>Ket Mundur</td>
                    <td>Sein</td>
                    <td>Ket Sein</td>
                    <td>Rotating</td>
                    <td>Ket Rotating</td>
                    <td>Stop</td>
                    <td>Ket Stop</td>
                    <td>Utama</td>
                    <td>Ket Utama</td>
                    <td>Connector</td>
                    <td>Ket Connector</td>
                    <td>Accu</td>
                    <td>Ket Accu</td>
                    <td>Parking</td>
                    <td>Ket Parking</td>
                    <td>Brake</td>
                    <td>Ket Brake</td>
                    <td>Oil</td>
                    <td>Ket Oil</td>
                    <td>Raulic</td>
                    <td>Ket Raulic</td>
                    <td>Chain</td>
                    <td>Ket Chain</td>
                    <td>Allhose</td>
                    <td>Ket Allhose</td>
                    <td>Steering</td>
                    <td>Ket Steering</td>
                    <td>Belts</td>
                    <td>Ket Belts</td>
                    <td>Cooland</td>
                    <td>Ket Cooland</td>
                    <td>Transmisi</td>
                    <td>Ket Transmisi</td>
                    <td>Ban</td>
                    <td>Ket Ban</td>
                    <td>Fork</td>
                    <td>Ket Fork</td>
                    <td>Teba</td>
                    <td>Ket Teba</td>
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
                    <td>{{$d->jenis_forklift}}</td>
                    <td>{{$d->awal}}</td>
                    <td>{{$d->ket_awal}}</td>
                    <td>{{$d->akhir}}</td>
                    <td>{{$d->ket_akhir}}</td>
                    <td>{{$d->horn}}</td>
                    <td>{{$d->ket_horn}}</td>
                    <td>{{$d->mundur}}</td>
                    <td>{{$d->ket_mundur}}</td>
                    <td>{{$d->sein}}</td>
                    <td>{{$d->ket_sein}}</td>
                    <td>{{$d->rotating}}</td>
                    <td>{{$d->ket_rotating}}</td>
                    <td>{{$d->stop}}</td>
                    <td>{{$d->ket_stop}}</td>
                    <td>{{$d->utama}}</td>
                    <td>{{$d->ket_utama}}</td>
                    <td>{{$d->connector}}</td>
                    <td>{{$d->ket_connector}}</td>
                    <td>{{$d->accu}}</td>
                    <td>{{$d->ket_accu}}</td>
                    <td>{{$d->parking}}</td>
                    <td>{{$d->ket_parking}}</td>
                    <td>{{$d->brake}}</td>
                    <td>{{$d->ket_brake}}</td>
                    <td>{{$d->oil}}</td>
                    <td>{{$d->ket_oil}}</td>
                    <td>{{$d->raulic}}</td>
                    <td>{{$d->ket_raulic}}</td>
                    <td>{{$d->chain}}</td>
                    <td>{{$d->ket_chain}}</td>
                    <td>{{$d->allhose}}</td>
                    <td>{{$d->ket_allhose}}</td>
                    <td>{{$d->steering}}</td>
                    <td>{{$d->ket_steering}}</td>
                    <td>{{$d->belts}}</td>
                    <td>{{$d->ket_belts}}</td>
                    <td>{{$d->cooland}}</td>
                    <td>{{$d->ket_cooland}}</td>
                    <td>{{$d->transmisi}}</td>
                    <td>{{$d->ket_transmisi}}</td>
                    <td>{{$d->ban}}</td>
                    <td>{{$d->ket_ban}}</td>
                    <td>{{$d->fork}}</td>
                    <td>{{$d->ket_fork}}</td>
                    <td>{{$d->teba}}</td>
                    <td>{{$d->ket_teba}}</td>
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