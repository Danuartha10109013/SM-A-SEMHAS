@extends('Surat-Izin-Keluar.layout.main')
@section('title')
    Add || Surat Izin Keluar
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add || Surat Izin Keluar</title>
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
                </span> Setujui || Surat Izin Keluar
                <p>No : {{$data->kode_sik}}</p>
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
        
        <form action="{{ route('security.store') }}" method="POST" enctype="multipart/form-data" id="sik-form">
            @csrf
            @method('POST')
            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="time" name="jam" class="form-control" value="{{ now()->format('H:i') }}" required>

            </div>
            <input type="text" name="id" value="{{$data->id}}" hidden>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="pengemudi">Pengemudi</label>
                        <input type="text" name="pengemudi" class="form-control" value="{{$data->pengemudi}}" readonly>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="signature" class="form-label">Tanda Tangan Pengemudi</label>
                            <canvas id="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                            <button id="clear" type="button" class="btn btn-secondary mt-2">Clear</button>
                            <input type="hidden" name="signature" id="signature">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="security">Security</label>
                        <input type="text" name="security" class="form-control" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="signature1" class="form-label">Tanda Tangan Security</label>
                            <canvas id="signature-pad1" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                            <button id="clear1" type="button" class="btn btn-secondary mt-2">Clear</button>
                            <input type="hidden" name="signature1" id="signature1">
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
        // Signature Pad 1 for Pengemudi
        const canvas1 = document.getElementById('signature-pad');
        const signaturePad1 = new SignaturePad(canvas1, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'black'
        });

        function resizeCanvas1() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas1.width = canvas1.offsetWidth * ratio;
            canvas1.height = canvas1.offsetHeight * ratio;
            canvas1.getContext('2d').scale(ratio, ratio);
            signaturePad1.clear();
        }

        resizeCanvas1();
        window.addEventListener('resize', resizeCanvas1);

        document.getElementById('clear').addEventListener('click', () => {
            signaturePad1.clear();
        });

        // Signature Pad 2 for Security
        const canvas2 = document.getElementById('signature-pad1');
        const signaturePad2 = new SignaturePad(canvas2, {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'black'
        });

        function resizeCanvas2() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas2.width = canvas2.offsetWidth * ratio;
            canvas2.height = canvas2.offsetHeight * ratio;
            canvas2.getContext('2d').scale(ratio, ratio);
            signaturePad2.clear();
        }

        resizeCanvas2();
        window.addEventListener('resize', resizeCanvas2);

        document.getElementById('clear1').addEventListener('click', () => {
            signaturePad2.clear();
        });

        // Form submission handling
        document.querySelector('#sik-form').addEventListener('submit', (e) => {
            if (signaturePad1.isEmpty() || signaturePad2.isEmpty()) {
                alert("Please provide both signatures.");
                e.preventDefault();
            } else {
                document.getElementById('signature').value = signaturePad1.toDataURL();
                document.getElementById('signature1').value = signaturePad2.toDataURL();
            }
        });
    });
</script>

</body>
</html>
@endsection
