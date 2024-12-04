@extends('Open-Packing.layout.main')
@section('title')
    Tambahkan GM ||
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
    <h3 class="text-center mb-4">Create A Product</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Open-Packing.admin.packing.store.gm') }}" method="POST">
        @else
        <form action="{{ route('Open-Packing.pegawai.packing.store') }}" method="POST">
        @endif
            @csrf
            @method('POST')
            

            <div class="row">
              
            <div id="qr-reader" style="width: 100%; display: none;"></div> <!-- QR code reader container -->

              <div class="col-md-6">
                <div class="mb-3 position-relative">
                  <label for="attribute" class="form-label">Atribute Coil <small style="color: red">*</small></label>
                  <input type="text" name="attribute" id="attribute" class="form-control" required>
                  <!-- Scan QR Code Button -->
                  <button type="button" id="scan-button" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
              </div>
              
               
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="atribute" class="form-label">Berat Aktual <small style="color: red">*</small></label>
                  <input type="number" name="b_aktual" id="atribute" class="form-control"  required>
                </div>
                <div class="mb-3">
                  <label for="atribute" class="form-label">Keterangan</label>
                  <input type="text" name="keterangan" id="aktual" class="form-control"  >
                </div>
                
              </div>
            </div>
            
            
            

            <button type="submit" class="btn btn-primary w-100">Save</button>
        </form>
    </div>
</div>
<!-- Updated QR Code Scanner Script -->
<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<!-- Updated QR Code Scanner Script -->
<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    const scanButton = document.getElementById('scan-button');
    const qrReader = document.getElementById('qr-reader');
    const attributeField = document.getElementById('attribute');
    let html5QrCode = null;
    let scannerIsActive = false;

    // Function to start the QR scanner
    function startQrScanner() {
        qrReader.style.display = 'block'; // Show the QR reader
        html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
            { facingMode: "environment" }, // Rear camera
            { fps: 10, qrbox: 250 },
            (qrCodeMessage) => {
                // Set the scanned value to the attribute field
                attributeField.value = qrCodeMessage;

                // Stop the scanner after a successful scan
                stopQrScanner();
            },
            (errorMessage) => {
                console.log("Scanning failed: ", errorMessage); // Log scan failures
            }
        ).catch((err) => {
            console.error("Error starting QR code scanner:", err);
            qrReader.style.display = 'none'; // Hide reader if there's an error
        });

        scannerIsActive = true;
    }

    // Function to stop the QR scanner
    function stopQrScanner() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                qrReader.style.display = 'none'; // Hide QR reader
                scannerIsActive = false;
                html5QrCode.clear(); // Clear the QR reader after stopping
            }).catch((err) => {
                console.error("Error stopping the QR code scanner:", err);
            });
        }
    }

    // Event listener for the scan button
    scanButton.addEventListener('click', () => {
        // Clear the attribute field before scanning
        attributeField.value = '';

        // Toggle the scanner
        if (!scannerIsActive) {
            startQrScanner(); // Start the QR scanner
        } else {
            stopQrScanner(); // Stop the QR scanner
        }
    });
</script>

@endsection