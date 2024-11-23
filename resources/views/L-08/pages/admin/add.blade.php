    @extends('L-08.layout.main')

    @section('title')
        Scan Packing L08 ||
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
        <h3 class="text-center mb-4">Add Packing L-08</h3>

        <div class="card shadow p-4">
            @if (Auth::user()->role == 0)
            <form action="{{ route('L-08.admin.damage.store') }}" enctype="multipart/form-data" method="POST">
            @else
            <form action="{{ route('L-08.pegawai.damage.store') }}" enctype="multipart/form-data" method="POST">
            @endif
                @csrf
                @method('POST')

                <div class="mb-3 position-relative">
                    <label for="attribute" class="form-label">Atribute Coil</label>
                    <input type="text" name="attribute" id="attribute" class="form-control" required>
                    <button type="button" id="scan-button-attribute" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
                </div>

                <div id="qr-reader-attribute" style="width: 100%; display: none;"></div>

                <div class="mb-3">
                    <label for="kondisi" class="form-label">Kondisi Coil</label>
                    <select name="kondisi" id="kondisi" class="form-control" required>
                        <option value="" selected disabled>-- Select Kondisi Coil --</option>
                        <option value="BAIK">BAIK</option>
                        <option value="DAMAGE REALESE QA">DAMAGE REALESE QA</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="mb-3" id="other-kondisi-container" style="display: none;">
                    <label for="other-kondisi" class="form-label">Please specify</label>
                    <input type="text" name="other_kondisi" id="other-kondisi" class="form-control" placeholder="Enter your custom Kondisi">
                </div>

                <div class="mb-3">
                    <label for="group" class="form-label">Group</label>
                    <select name="group" id="group" class="form-control" required>
                        <option value="" selected disabled>-- Select Group --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="LOKAL">LOKAL</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="mb-3" id="other-group-container" style="display: none;">
                    <label for="other-group" class="form-label">Please specify</label>
                    <input type="text" name="other_group" id="other-group" class="form-control" placeholder="Enter your custom Group">
                </div>

                <div class="mb-3">
                    <label for="layout" class="form-label">Layout Kontainer</label>
                    <select name="layout" id="layout" class="form-control" required>
                        <option value="" selected disabled>-- Select layout --</option>
                        <option value="K1">K1</option>
                        <option value="K2">K2</option>
                        <option value="K3">K3</option>
                        <option value="K4">K4</option>
                        <option value="K5">K5</option>
                        <option value="K6">K6</option>
                        <option value="K7">K7</option>
                        <option value="K8">K8</option>
                        <option value="K9">K9</option>
                        <option value="K10">K10</option>
                        <option value="K11">K11</option>
                        <option value="K12">K12</option>
                        <option value="K13">K13</option>
                        <option value="K14">K14</option>
                        <option value="K15">K15</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="mb-3" id="other-layout-container" style="display: none;">
                    <label for="other-layout" class="form-label">Please specify</label>
                    <input type="text" name="other_layout" id="other-layout" class="form-control" placeholder="Enter your custom Layout">
                </div>

                <div class="mb-3 position-relative">
                    <label for="no_sales" class="form-label">No Sales</label>
                    <input type="text" name="no_sales" id="no_sales" class="form-control">
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
        document.getElementById('kondisi').addEventListener('change', function() {
            const otherHandlingContainer = document.getElementById('other-kondisi-container');
            otherHandlingContainer.style.display = this.value === 'other' ? 'block' : 'none';
        });
        document.getElementById('group').addEventListener('change', function() {
            const otherHandlingContainer = document.getElementById('other-group-container');
            otherHandlingContainer.style.display = this.value === 'other' ? 'block' : 'none';
        });
        document.getElementById('layout').addEventListener('change', function() {
            const otherHandlingContainer = document.getElementById('other-layout-container');
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
