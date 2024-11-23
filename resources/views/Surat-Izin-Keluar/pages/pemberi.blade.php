@extends('Surat-Izin-Keluar.layout.main')
@section('title')
    Beri Izin || Surat Izin Keluar
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Izin || Surat Izin Keluar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Beri Izin No : {{$data->kode_sik}} || Surat Izin Keluar
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">
                <p><strong>Berikan Izin Untuk : </strong>{{$data->bagian}}</p>
                <p><strong>dengan keperluan : </strong>{{$data->keperluan}}</p>
                <p><strong>No Pol Kendaraan : </strong>{{$data->no_kendaraan}}</p>
            </div>
        </div>
    {{-- <div class="card"> --}}
        {{-- <div class="card-body"> --}}
            <form action="{{ route('pemberi-izin.store',$data->id) }}" method="POST" enctype="multipart/form-data" id="sik-form">
                @csrf
                @method('POST')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="pemberi_izin">Pemberi Izin</label>
                            <input type="text" name="pemberi_izin" class="form-control" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-sm-12">
                                <label for="signature" class="form-label">Tanda Tangan</label>
                                <canvas id="signature-pad" style="border: 1px solid #000000; width: 100%; height: 200px; background-color: white"></canvas>
                                <button id="clear" title="Clear" type="button" class="btn btn-secondary mt-2">Clear</button>
                                <input type="hidden" name="signature" id="signature">
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        {{-- </div> --}}
    {{-- </div> --}}
        
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'black'
    });

    let signatureData = null; // Untuk menyimpan data tanda tangan

    // Fungsi untuk meresize kanvas tanpa menggeser tanda tangan
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        const oldData = signaturePad.toData(); // Simpan data tanda tangan

        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);

        // Kembalikan tanda tangan jika sebelumnya sudah ada
        if (oldData) {
            signaturePad.fromData(oldData); // Gambar ulang tanda tangan
        } else {
            signaturePad.clear();
        }
    }

    // Inisialisasi ukuran kanvas
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // Tombol Clear untuk menghapus tanda tangan
    document.getElementById('clear').addEventListener('click', () => {
        signaturePad.clear();
    });

    // Form submission handling
    document.querySelector('#sik-form').addEventListener('submit', (e) => {
        if (signaturePad.isEmpty()) {
            alert("Silakan buat tanda tangan di canvas.");
            e.preventDefault(); // Batalkan submit jika tanda tangan kosong
        } else {
            document.getElementById('signature').value = signaturePad.toDataURL(); // Simpan tanda tangan sebagai base64
        }
    });
});

</script>

</body>
</html>
@endsection
