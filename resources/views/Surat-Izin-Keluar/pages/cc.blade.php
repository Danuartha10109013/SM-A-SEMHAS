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
                </span> Add || Surat Izin Keluar
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>
    {{-- <div class="card"> --}}
        {{-- <div class="card-body"> --}}
            <form action="{{ route('sik.store') }}" method="POST" enctype="multipart/form-data" id="sik-form">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="kode_sik">Kode SIK</label>
                            <input type="text" name="kode_sik" class="form-control" value="{{$kode}}" readonly>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="bagian">Nama / Bagian</label>
                            <input type="text" name="bagian" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="bagian">Keperluan</label>
                            <input type="text" name="keperluan" class="form-control" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="no_kendaraan">Kendaraan No.</label>
                            <input type="text" name="no_kendaraan" class="form-control" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" required>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="pengemudi">Pengemudi</label>
                            <input type="text" name="pengemudi" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" class="form-control" required>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="muatan">Muatan</label>
                            <input type="text" name="muatan" class="form-control" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="divisi">Divisi</label>
                            <input type="text" name="divisi" class="form-control" style="outline-color: black; outline-width: 5px; outline-style: solid; background-color: white;" value="{{Auth::user()->division}}" readonly required>
                            {{-- <select name="divisi" class="form-control" required>
                                <option value="" selected disabled>--Select Division--</option>
                                <option value="WH">WH</option>
                                <option value="UTY">UTY</option>
                                <option value="HR & GA">HR & GA</option>
                                <option value="MTC">MTC</option>
                                <option value="QA">QA</option>
                                <option value="PRD">PRD</option>
                                <option value="SAFETY">SAFETY</option>
                            </select> --}}
                        </div>
                        
                    </div>
                </div>
                {{-- <div class="row">
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
                </div> --}}
                
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

        // Clear canvas button
        document.getElementById('clear').addEventListener('click', () => {
            signaturePad.clear();
        });

        // Form submission handling
        document.querySelector('#sik-form').addEventListener('submit', (e) => {
            if (signaturePad.isEmpty()) {
                alert("Silakan buat tanda tangan di canvas.");
                e.preventDefault(); // Prevent form submission if signature is empty
            } else {
                document.getElementById('signature').value = signaturePad.toDataURL(); // Set the signature value
            }
        });
    });
</script>

</body>
</html>
@endsection
