<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Welcome || PT Tata Metal Lestari</title>
      <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
      <style>
         body {
            background: linear-gradient(135deg, #a8b2b5, #6ca885, #67a8ce);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: white;
         }

         .judul {
            text-align: center;
            margin-bottom: 20px;
         }

         .judul h1 {
            font-size: 2.5rem;
            color: #ffffff;
         }

         .gambar {
            text-align: center;
            margin-bottom: 20px;
         }

         .gambar img {
            max-width: 150px;
         }

         .menu-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
         }

         .menu-item {
            width: 150px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.3); /* Transparent white */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 15px;
            transition: transform 0.3s ease, background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         }

         .menu-item i {
            font-size: 50px;
            margin-bottom: 10px;
         }

         .menu-item:hover {
            transform: translateY(-10px);
            background-color: rgba(255, 255, 255, 0.5);
         }

         .menu-title {
            font-size: 18px;
         }
         h1 {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-weight: bold; /* Memberikan ketebalan yang kuat */
            letter-spacing: 1px; /* Menambah spasi antar huruf */
            text-transform: uppercase; /* Mengubah huruf menjadi kapital */
            font-style: italic; /* Memberikan style italic */
            }

      </style>
   </head>
   <body>
      <div class="judul">
         <h1 style="font-size: 2em;font-weight: bolder">Sistem Informasi Digital Warehouse</h1>
         <h1 style="font-size: 1em">PT. Tata Metal Lestari</h1>
      </div>

      <div class="gambar">
         <img src="{{ asset('Logo TML.png') }}" alt="Logo PT Tata Metal Lestari">
      </div>
      @if(Auth::check())
         <div class="menu-container">
         @if (Auth::user()->role == 0)
            <a href="{{route('Ship-Mark.admin.dashboard')}}" class="menu-item">
         @else
         <a href="{{route('Ship-Mark.pegawai.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-shipping-pallet"></i>
                  <div class="menu-title">Ship Mark</div>
               </div>
            </a>

            @if (Auth::user()->role == 0)
            <a href="{{route('Mapping.admin.shipment')}}" class="menu-item">
         @else
         <a href="" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-map-marker-path"></i>
                  <div class="menu-title">Mapping</div>
               </div>
            </a>
            @if (Auth::user()->role == 0)
            <a href="{{route('Form-Check.admin.dashboard')}}" class="menu-item">
         @else
         <a href="{{route('Form-Check.pegawai.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-checkbox-marked-outline"></i>
                  <div class="menu-title">Form Check</div>
               </div>
            </a>

            @if (Auth::user()->role == 0)
            <a href="{{route('Open-Packing.admin.dashboard')}}" class="menu-item">
         @else
         <a href="{{route('Open-Packing.pegawai.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-package-variant-closed-check"></i>
                  <div class="menu-title">Open Packing</div>
               </div>
            </a>
            {{-- @if (Auth::user()->role == 0)
         <a href="{{route('Supply.admin.dashboard')}}" class="menu-item">
            @else
            <a href="{{route('Supply.pegawai.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-warehouse"></i>
                  <div class="menu-title">Supply Bahan</div>
               </div>
            </a> --}}
            @if (Auth::user()->role == 0)
         <a href="{{route('Packing-List.admin.dashboard')}}" class="menu-item">
            @else
            <a href="{{route('Packing-List.admin.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-format-list-checks"></i>
                  <div class="menu-title">Packing List</div>
               </div>
            </a>
            @if (Auth::user()->role == 0)

            <a href="{{route('Kendaraan.admin.dashboard')}}" class="menu-item">
               @else
               <a href="{{route('Kendaraan.pegawai.dashboard')}}" class="menu-item">
               @endif
               <div>
                  <i class="mdi mdi-car"></i>
                  <div class="menu-title">Checklist Kendaraan</div>
               </div>
            </a>
            @if (Auth::user()->role == 0)

            <a href="{{route('Scan-Layout.admin.dashboard')}}" class="menu-item">
               @else
               <a href="{{route('Scan-Layout.pegawai.dashboard')}}" class="menu-item">
               @endif
               <div>
                  <i class="mdi mdi-qrcode"></i>
                  <div class="menu-title"> Scan Layout</div>
               </div>
            </a>
            
            
         </div>
         
         <br>
         <div class="menu-container">
            @if (Auth::user()->role == 0)
            <a href="{{route('Coil-Damage.admin.dashboard')}}" class="menu-item">
         @else
         <a href="{{route('Coil-Damage.pegawai.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-package-variant-closed-remove"></i>
                  <div class="menu-title">Coil Damage</div>
               </div>
            </a>
            @if (Auth::user()->role == 0)
            <a href="{{route('L-08.admin.dashboard')}}" class="menu-item">
         @else
         <a href="{{route('L-08.pegawai.dashboard')}}" class="menu-item">
            @endif
               <div>
                  <i class="mdi mdi-numeric-8-box-multiple"></i>
                  <div class="menu-title">Packing L08</div>
               </div>
            </a>
            <a href="{{route('Administrator.kelola-user')}}" class="menu-item">
               <div>
                  <i class="mdi mdi-account"></i>
                  <div class="menu-title">Kelola Pegawai</div>
               </div>
            </a>
            <a href="{{route('logout')}}" class="menu-item">
            <div>
               <i class="mdi mdi-logout"></i>
               <div class="menu-title">Sign Out</div>
            </div>
            </a>
         </div>
      @else
            <script>window.location = "{{ route('login') }}";</script>
      @endif
      
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
