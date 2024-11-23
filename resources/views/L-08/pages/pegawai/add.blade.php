@extends('Coil-Damage.layout.main')


@section('title')
    Tambahkan Packing ||
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
    <h3 class="text-center mb-4">Make a New Packing</h3>

    <div class="card shadow p-4">
        @if (Auth::user()->role == 0)
        <form action="{{ route('Scan-Layout.admin.scan.store') }}" method="POST">
        @else
        <form action="{{ route('Scan-Layout.pegawai.scan.store') }}" method="POST">
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
                <label for="layout" class="form-label">Layout Penyimpanan</label>
                <input type="text" name="layout" id="layout" class="form-control" required>
                <button type="button" id="scan-button-layout" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
            </div>

            <div id="qr-reader-layout" style="width: 100%; display: none;"></div>

            <div class="mb-3">
                <label for="kondisi" class="form-label">Kondisi</label>
                <select name="kondisi" id="kondisi" class="form-control" required>
                    <option value="" selected disabled>-- Select Kondisi --</option>
                    <option value="BAIK">BAIK</option>
                    <option value="TIDAK">TIDAK</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="group" class="form-label">Group</label>
                <select name="group" id="group" class="form-control" required>
                    <option value="" selected disabled>-- Select group --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="mb-3" id="other-group-container" style="display: none;">
                <label for="other-group" class="form-label">Please specify</label>
                <input type="text" name="other_group" id="other-group" class="form-control" placeholder="Enter your custom group">
            </div>

            <button type="submit" class="btn btn-primary w-100">Save New GM</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    // Toggle display of custom group input
    document.getElementById('group').addEventListener('change', function() {
        const otherGroupContainer = document.getElementById('other-group-container');
        otherGroupContainer.style.display = this.value === 'other' ? 'block' : 'none';
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
                    { facingMode: "environment" },
                    { fps: 10, qrbox: 250 },
                    qrCodeMessage => {
                        input.value = qrCodeMessage; // Set scanned result to the input field
                        stopQrScanner();
                    },
                    errorMessage => console.log("Scanning failed:", errorMessage)
                ).catch(err => {
                    console.error("Error starting QR code scanner:", err);
                    qrReader.style.display = 'none';
                });

                scannerIsActive = true;
            } else {
                stopQrScanner();
            }
        });

        function stopQrScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    qrReader.style.display = 'none';
                    scannerIsActive = false;
                    html5QrCode.clear();
                }).catch(err => console.error("Error stopping the QR code scanner:", err));
            }
        }
    }

    // Initialize separate scanners for Attribute and Layout fields
    initQrScanner('scan-button-attribute', 'qr-reader-attribute', 'attribute');
    initQrScanner('scan-button-layout', 'qr-reader-layout', 'layout');
</script>

@endsection
