@extends('Coil-Damage.layout.main')

@section('title')
    Scan Coil Damage ||
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Coil Damage</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Coil-Damage.admin.damage.store') }}" enctype="multipart/form-data" method="POST">
        @else
        <form action="{{ route('Coil-Damage.pegawai.damage.store') }}" enctype="multipart/form-data" method="POST">
        @endif
            @csrf
            @method('POST')

            <div class="mb-3 position-relative">
                <label for="attribute" class="form-label">Atribute Coil</label>
                <input type="text" name="attribute" id="attribute" class="form-control" required>
                <button type="button" id="scan-button-attribute" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
            </div>

            <div id="qr-reader-attribute" style="width: 100%; display: none;"></div>

            <div class="mb-3 position-relative">
                <label for="berat_coil" class="form-label">Berat Coil</label>
                <input type="text" name="berat_coil" id="berat_coil" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="jenis_handling" class="form-label">Jenis Handling</label>
                <select name="jenis_handling" id="jenis_handling" class="form-control" required>
                    <option value="" selected disabled>-- Select Jenis Handling --</option>
                    <option value="Crane">Crane</option>
                    <option value="Forklift">Forklift</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-3" id="other-handling-container" style="display: none;">
                <label for="other-handling" class="form-label">Please specify</label>
                <input type="text" name="other_handling" id="other-handling" class="form-control" placeholder="Enter your custom handling">
            </div>

            <div class="mb-3 position-relative">
                <label for="foto" class="form-label">Foto Coil</label>
                <input type="file" name="foto[]" id="foto" multiple class="form-control" required>
            </div>

            <div class="mb-3 position-relative">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control">
            </div>

            <!-- Hidden input for user ID -->
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <button type="submit" class="btn btn-primary w-100">Save Coil</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    // Toggle display of custom handling input
    document.getElementById('jenis_handling').addEventListener('change', function() {
        const otherHandlingContainer = document.getElementById('other-handling-container');
        otherHandlingContainer.style.display = this.value === 'other' ? 'block' : 'none';
    });

    // QR Code Scanner for Attribute field
    function initQrScanner(buttonId, readerId, inputField) {
        const scanButton = document.getElementById(buttonId);
        const qrReader = document.getElementById(readerId);
        const input = document.getElementById(inputField);
        let html5QrCode = null;
        let scannerIsActive = false;

        scanButton.addEventListener('click', () => {
            input.value = ''; // Clear the input field before scanning

            if (!scannerIsActive) {
                qrReader.style.display = 'block'; // Show the QR reader
                html5QrCode = new Html5Qrcode(readerId);

                html5QrCode.start(
                    { facingMode: "environment" }, // Use the rear camera
                    { fps: 10, qrbox: 250 }, // Scanner options
                    qrCodeMessage => {
                        input.value = qrCodeMessage; // Set scanned result to the input field
                        stopQrScanner();
                    },
                    errorMessage => console.log("Scanning failed:", errorMessage)
                ).catch(err => {
                    console.error("Error starting QR code scanner:", err);
                    qrReader.style.display = 'none'; // Hide reader on error
                });

                scannerIsActive = true;
            } else {
                stopQrScanner();
            }
        });

        function stopQrScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    qrReader.style.display = 'none'; // Hide the reader
                    scannerIsActive = false;
                    html5QrCode.clear(); // Clear the scanner
                }).catch(err => console.error("Error stopping the QR code scanner:", err));
            }
        }
    }

    // Initialize scanner for attribute field
    initQrScanner('scan-button-attribute', 'qr-reader-attribute', 'attribute');
</script>

@endsection
