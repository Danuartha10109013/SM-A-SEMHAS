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
                    <td>Shift leader</td>
                    <td>Jenis Trailler</td>
                    <td>Date</td>
                    <td>Carrier</td>
                    <td>Ket Carrier</td>
                    <td>Hook Pengait Rantai</td>
                    <td>Ket Hook Pengait Rantai</td>
                    <td>Rantai Pengikat</td>
                    <td>Ket Rantai Pengikat</td>
                    <td>Ban</td>
                    <td>Ket Ban</td>
                    <td>Cadangan</td>
                    <td>Ket Cadangan</td>
                    <td>Sein</td>
                    <td>Ket Sein</td>
                    <td>Rotating</td>
                    <td>Ket Rotating</td>
                    <td>Stop</td>
                    <td>Ket Stop</td>
                    <td>Lampu Utama</td>
                    <td>Ket Lampu Utama</td>
                    <td>Lampu Kota</td>
                    <td>Ket Lampu Kota</td>
                    <td>Connector</td>
                    <td>Ket Connector</td>
                    <td>Accu</td>
                    <td>Ket Accu</td>
                    <td>Coolant</td>
                    <td>Ket Coolant</td>
                    <td>Parking</td>
                    <td>Ket Parking</td>
                    <td>Brake</td>
                    <td>Ket Brake</td>
                    <td>Horn</td>
                    <td>Ket Horn</td>
                    <td>Mundur</td>
                    <td>Ket Mundur</td>
                    <td>Clamp</td>
                    <td>Ket Clamp</td>
                    <td>Terpal</td>
                    <td>Ket Terpal</td>
                    <td>Ganjal</td>
                    <td>Ket Ganjal</td>
                    <td>Pallet</td>
                    <td>Ket Pallet</td>
                    <td>Apar</td>
                    <td>Ket Apar</td>
                    <td>P3K</td>
                    <td>Ket P3K</td>
                    <td>Fancing</td>
                    <td>Ket Fancing</td>
                    <td>Triangle</td>
                    <td>Ket Triangle</td>
                    <td>Tools</td>
                    <td>Ket Tools</td>
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
                    <td class="warp">{{$d->shift_leader}}</td>
                    <td>{{$d->jenis_forklift}}</td>
                    <td>{{$d->date}}</td>
                    <td>{{$d->carrier}}</td>
                    <td>{{$d->ket_carrier}}</td>
                    <td>{{$d->rantai}}</td>
                    <td>{{$d->ket_rantai}}</td>
                    <td>{{$d->rantai_pe}}</td>
                    <td>{{$d->ket_rantai_pe}}</td>
                    <td>{{$d->ban}}</td>
                    <td>{{$d->ket_ban}}</td>
                    <td>{{$d->cadangan}}</td>
                    <td>{{$d->ket_cadangan}}</td>
                    <td>{{$d->sein}}</td>
                    <td>{{$d->ket_sein}}</td>
                    <td>{{$d->rotating}}</td>
                    <td>{{$d->ket_rotating}}</td>
                    <td>{{$d->stop}}</td>
                    <td>{{$d->ket_stop}}</td>
                    <td>{{$d->utama}}</td>
                    <td>{{$d->ket_utama}}</td>
                    <td>{{$d->kota}}</td>
                    <td>{{$d->ket_kota}}</td>
                    <td>{{$d->connector}}</td>
                    <td>{{$d->ket_connector}}</td>
                    <td>{{$d->accu}}</td>
                    <td>{{$d->ket_accu}}</td>
                    <td>{{$d->coolant}}</td>
                    <td>{{$d->ket_coolant}}</td>
                    <td>{{$d->parking}}</td>
                    <td>{{$d->ket_parking}}</td>
                    <td>{{$d->brake}}</td>
                    <td>{{$d->ket_brake}}</td>
                    <td>{{$d->horn}}</td>
                    <td>{{$d->ket_horn}}</td>
                    <td>{{$d->mundur}}</td>
                    <td>{{$d->ket_mundur}}</td>
                    <td>{{$d->clamp}}</td>
                    <td>{{$d->ket_clamp}}</td>
                    <td>{{$d->terpal}}</td>
                    <td>{{$d->ket_terpal}}</td>
                    <td>{{$d->ganjal}}</td>
                    <td>{{$d->ket_ganjal}}</td>
                    <td>{{$d->pallet}}</td>
                    <td>{{$d->ket_pallet}}</td>
                    <td>{{$d->apar}}</td>
                    <td>{{$d->ket_apar}}</td>
                    <td>{{$d->p3k}}</td>
                    <td>{{$d->ket_p3k}}</td>
                    <td>{{$d->fancing}}</td>
                    <td>{{$d->ket_fancing}}</td>
                    <td>{{$d->triangle}}</td>
                    <td>{{$d->ket_triangle}}</td>
                    <td>{{$d->tools}}</td>
                    <td>{{$d->ket_tools}}</td>
                    <td>{{$d->catatan}}</td>
                    <td>{{$d->mtc_name}}</td>
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