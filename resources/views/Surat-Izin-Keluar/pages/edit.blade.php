@extends('Surat-Izin-Keluar.layout.main')
@section('title')
    Edit || Surat Izin Keluar
@endsection
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit || Surat Izin Keluar</title>
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
                </span> Edit || Surat Izin Keluar
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <form action="{{ route('sik.update',$data->id) }}" method="POST" enctype="multipart/form-data" id="sik-form">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $data->date }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="kode_sik">Kode SIK</label>
                        <input type="text" name="kode_sik" class="form-control" value="{{$data->kode_sik}}" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="bagian">Nama / Bagian</label>
                        <input type="text" name="bagian" class="form-control" value="{{$data->bagian}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="keperluan">Keperluan</label>
                        <input type="text" name="keperluan" class="form-control" value="{{$data->keperluan}}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="no_kendaraan">Kendaraan No.</label>
                        <input type="text" name="no_kendaraan" class="form-control" value="{{$data->no_kendaraan}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pengemudi">Pengemudi</label>
                        <input type="text" name="pengemudi" class="form-control" value="{{$data->pengemudi}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="muatan">Muatan</label>
                        <input type="text" name="muatan" class="form-control" value="{{$data->muatan}}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="pemberi_izin">Pemberi Izin</label>
                        <input type="text" name="pemberi_izin" class="form-control" value="{{$data->pemberi_izin}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="pemberi_izin">Recent Signature</label>
                        <img style="outline: 2px solid; box-shadow: 2px 2px 8px rgba(0,0,0,0.2);" 
                        src="{{ asset($data->pemberi_izin_ttd) }}" width="90%"  alt="Existing Signature">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="signature" class="form-label">New Tanda Tangan (optional)</label>
                            <canvas id="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                            <button id="clear" title="Clear" type="button" class="btn btn-secondary mt-2">Clear</button>
                            <input type="hidden" name="signature" id="signature" value="{{$data->pemberi_izin_ttd}}">
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'black'
        });

        // Adjust canvas size
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
            signaturePad.clear(); // Reset signature pad
        }

        resizeCanvas(); // Initial resize
        window.addEventListener('resize', resizeCanvas);

        // Load existing signature if available
        const existingSignature = "{{ $data->pemberi_izin_ttd }}";
        if (existingSignature) {
            const img = new Image();
            img.src = existingSignature;
            img.onload = () => {
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            };
        }

        // Clear canvas button
        document.getElementById('clear').addEventListener('click', () => {
            signaturePad.clear();
        });

        // Form submission handling
        document.querySelector('#sik-form').addEventListener('submit', (e) => {
            if (signaturePad.isEmpty()) {
                // If no new signature, keep the old signature value
                document.getElementById('signature').value = "sama";
            } else {
                // If new signature, save it
                document.getElementById('signature').value = signaturePad.toDataURL();
            }
        });
    });
</script>

</body>
</html>
@endsection
