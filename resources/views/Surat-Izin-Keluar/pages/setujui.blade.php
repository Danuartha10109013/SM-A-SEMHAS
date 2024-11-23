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
                <!-- Pengemudi Section -->
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

                <!-- Security Section -->
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
        // Function to initialize a signature pad
        function initializeSignaturePad(canvasId, clearButtonId, hiddenInputId) {
            const canvas = document.getElementById(canvasId);
            const clearButton = document.getElementById(clearButtonId);
            const hiddenInput = document.getElementById(hiddenInputId);

            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'black'
            });

            // Resize the canvas dynamically
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                const container = canvas.parentElement; // Use parent container for width
                const oldData = signaturePad.toData(); // Save the signature data

                canvas.width = container.offsetWidth * ratio;
                canvas.height = container.offsetHeight * 0.7 * ratio; // Adjust height dynamically
                const ctx = canvas.getContext('2d');
                ctx.scale(ratio, ratio);

                // Restore the previous signature data
                if (oldData.length > 0) {
                    signaturePad.fromData(oldData);
                }
            }

            // Initial resize and attach resize event
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            // Clear button functionality
            clearButton.addEventListener('click', () => {
                signaturePad.clear();
            });

            return { signaturePad, hiddenInput };
        }

        // Initialize signature pads
        const pengemudiSignature = initializeSignaturePad('signature-pad', 'clear', 'signature');
        const securitySignature = initializeSignaturePad('signature-pad1', 'clear1', 'signature1');

        // Handle form submission
        document.querySelector('#sik-form').addEventListener('submit', (e) => {
            if (pengemudiSignature.signaturePad.isEmpty() || securitySignature.signaturePad.isEmpty()) {
                alert("Please provide both signatures.");
                e.preventDefault();
            } else {
                pengemudiSignature.hiddenInput.value = pengemudiSignature.signaturePad.toDataURL();
                securitySignature.hiddenInput.value = securitySignature.signaturePad.toDataURL();
            }
        });
    });
</script>


</body>
</html>
@endsection
