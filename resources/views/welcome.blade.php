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
         <h1 style="font-size: 2em;font-weight: bolder">Sistem Informasi Manajemen Operasional</h1>
         <h1 style="font-size: 1em">PT. Tata Metal Lestari</h1>
      </div>

      <div class="gambar">
         <img src="{{ asset('Logo TML.png') }}" alt="Logo PT Tata Metal Lestari">
      </div>
     @if(Auth::check())
@php
$akses = json_decode(Auth::user()->type);

// Daftar semua menu dan route-nya
$menuItems = [
    "SP"  => ["title" => "Ship Mark", "icon" => "mdi-shipping-pallet", "route" => Auth::user()->role == 0 ? route('Ship-Mark.admin.dashboard') : route('Ship-Mark.pegawai.dashboard')],
    "MP"  => ["title" => "Mapping", "icon" => "mdi-map-marker-path", "route" => Auth::user()->role == 0 ? route('Mapping.admin.shipment') : route('Mapping.pegawai.shipment')],
    "FC"  => ["title" => "Form Check", "icon" => "mdi-checkbox-marked-outline", "route" => Auth::user()->role == 0 ? route('Form-Check.admin.dashboard') : route('Form-Check.pegawai.dashboard')],
    "OP"  => ["title" => "Open Packing", "icon" => "mdi-package-variant-closed-check", "route" => Auth::user()->role == 0 ? route('Open-Packing.admin.dashboard') : route('Open-Packing.pegawai.dashboard')],
    "PL"  => ["title" => "Packing List", "icon" => "mdi-format-list-checks", "route" => route('Packing-List.admin.dashboard')],
    "CK"  => ["title" => "Checklist Kendaraan", "icon" => "mdi-car", "route" => Auth::user()->role == 0 ? route('Kendaraan.admin.dashboard') : route('Kendaraan.pegawai.dashboard')],
    "SL"  => ["title" => "Scan Layout", "icon" => "mdi-qrcode", "route" => Auth::user()->role == 0 ? route('Scan-Layout.admin.dashboard') : route('Scan-Layout.pegawai.dashboard')],
    "CD"  => ["title" => "Coil Damage", "icon" => "mdi-package-variant-closed-remove", "route" => Auth::user()->role == 0 ? route('Coil-Damage.admin.dashboard') : route('Coil-Damage.pegawai.dashboard')],
    "L8"  => ["title" => "Packing L08", "icon" => "mdi-numeric-8-box-multiple", "route" => Auth::user()->role == 0 ? route('L-08.admin.dashboard') : route('L-08.pegawai.dashboard')],
];
@endphp

<div class="menu-container">
    @foreach ($menuItems as $key => $item)
        @if (in_array('all', $akses) || in_array($key, $akses) || ($key == 'admin' && Auth::user()->role == 0))
            <a href="{{ $item['route'] }}" class="menu-item">
                <div>
                    <i class="mdi {{ $item['icon'] }}"></i>
                    <div class="menu-title">{{ $item['title'] }}</div>
                </div>
            </a>
        @endif
    @endforeach

    {{-- Tambahan menu SIK --}}
    @if (in_array('all', $akses) || in_array('SIK', $akses))
    <a href="{{ route('sik') }}" class="menu-item">
        <div>
            <i class="mdi mdi-email"></i>
            <div class="menu-title">Surat Izin Keluar</div>
        </div>
    </a>
    @endif

    {{-- Menu khusus Superadmin --}}
    @if (Auth::user()->role == 5)
    <a href="{{ route('superadmin.Administrator.kelola-user') }}" class="menu-item">
        <div>
            <i class="mdi mdi-account"></i>
            <div class="menu-title">Kelola Pegawai</div>
        </div>
    </a>
    <a href="{{ route('superadmin.data-master') }}" class="menu-item">
        <div>
            <i class="mdi mdi-database-settings"></i>
            <div class="menu-title">Data Master</div>
        </div>
    </a>
    @endif

    {{-- Logout --}}
    <a href="{{ route('logout') }}" class="menu-item" id="logout-btn">
        <div>
            <i class="mdi mdi-logout"></i>
            <div class="menu-title">Sign Out</div>
        </div>
    </a>
</div>

{{-- SweetAlert logout confirmation --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-btn').addEventListener('click', function(e) {
        e.preventDefault(); // Stop the default link action
        const logoutUrl = this.href;

        Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = logoutUrl;
            }
        });
    });
</script>

@else
<script>window.location = "{{ route('login') }}";</script>
@endif

      
      <!-- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
