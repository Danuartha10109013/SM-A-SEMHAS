@extends('Surat-Izin-Keluar.layout.main')
@section('title')
    Add || Surat Izin Keluar
@endsection
@section('content')
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
<div class="card">
    <div class="card-body">
        <form action="{{ route('sik.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="kode_sik">Kode SIK</label>
                <input type="text" name="kode_sik" style="border-color: white"  class="form-control" readonly>
            </div>
            
            <div class="form-group mb-3">
                <label for="bagian">Nama / Bagian</label>
                <input type="text"  name="bagian" class="form-control"  required>
            </div>
            
            <div class="form-group mb-3">
                <label for="no_kendaraan">Kendaraan No.</label>
                <input type="text" name="no_kendaraan" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="pengemudi">Pengemudi</label>
                <input type="text" name="pengemudi" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="muatan">Muatan</label>
                <input type="text" name="muatan" class="form-control" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="pemberi_izin">Pemberi Izin</label>
                <input type="text" name="pemberi_izin" class="form-control" required>
            </div>
    
            <div class="row mb-3">
                <label for="signature" class="col-sm-2 col-form-label">Tanda Tangan</label>
                <div class="col-sm-10">
                    <!-- Opsi untuk Menggambar Tanda Tangan -->
                    <p><strong>Opsi 1:</strong> Tanda tangan langsung</p>
                    <canvas id="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
                    <button id="clear" title="Clear" type="button" class="btn btn-secondary mt-2">Clear</button>
                    <input type="hidden" name="signature" id="signature">
    
                    <!-- Opsi untuk Mengunggah Tanda Tangan -->
                    <p class="mt-3"><strong>Opsi 2:</strong> Unggah file tanda tangan (jpg, jpeg, png)</p>
                    <input type="file" name="signature_file" id="signature-file" class="form-control" accept="image/*">
                </div>
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@3.0.0/dist/signature_pad.umd.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);
        
        const resizeCanvas = () => {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext('2d').scale(ratio, ratio);
        };

        resizeCanvas();

        document.getElementById('clear').addEventListener('click', () => {
            signaturePad.clear();
        });

        document.querySelector('form').addEventListener('submit', (e) => {
            if (!signaturePad.isEmpty()) {
                document.getElementById('signature').value = signaturePad.toDataURL();
            } else if (document.getElementById("signature-file").files.length === 0) {
                alert("Silakan buat tanda tangan di canvas atau unggah file tanda tangan.");
                e.preventDefault();
            }
        });

        window.addEventListener('resize', resizeCanvas);
    });
</script>
@endsection