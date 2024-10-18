@extends('Packing-List.layout.main')

@section('title')
    Edit Packing ||
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
        <form action="{{ route('Packing-List.admin.list.update') }}" method="POST">
        @else
        <form action="{{ route('Packing-List.pegawai.list.update') }}" method="POST">
        @endif
            @csrf
            @method('POST')
            <div class="mb-3 position-relative">
                <label for="attribute" class="form-label">Atribute Coil</label>
                <input type="text" name="attribute" id="attribute" value="{{$data->attribute}}" class="form-control" required>
                <!-- Scan QR Code Button -->
                <button type="button" id="scan-button" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
            </div>
            <input type="text" value="{{$data->id}}" name="id" hidden>
            <div id="qr-reader" style="width: 100%; display: none;"></div> <!-- QR code reader container -->

            <div class="mb-3">
              <label for="kondisi" class="form-label">Kondisi</label>
              <select name="kondisi" id="kondisi" class="form-control" required>
                  <option value="" selected disabled>-- Select Kondisi --</option>
                  <option value="BAIK" {{ old('kondisi', $data->kondisi) == 'BAIK' ? 'selected' : '' }}>BAIK</option>
                  <option value="DAMAGE RELEASE QA" {{ old('kondisi', $data->kondisi) == 'DAMAGE RELEASE QA' ? 'selected' : '' }}>DAMAGE RELEASE QA</option>
              </select>
          </div>
          
            <div class="mb-3">
                <label for="kondisi" class="form-label">tujuan</label>
                <select type="text" name="tujuan" id="tujuan" class="form-control" required>
                    <option value="" selected disabled>-- Select Tujuan --</option>
                    <option value="L01" {{ old('tujuan', $data->tujuan) == 'L01' ? 'selected' : '' }}>L01</option>
                    <option value="L10" {{ old('tujuan', $data->tujuan) == 'L10' ? 'selected' : '' }}>L10</option>
                    <option value="CBT" {{ old('tujuan', $data->tujuan) == 'CBT' ? 'selected' : '' }}>CBT</option>
                    <option value="SDG" {{ old('tujuan', $data->tujuan) == 'SDG' ? 'selected' : '' }}>SDG</option>
                </select>
            </div>

            <div class="mb-3">
              <label for="keterangan" class="form-label">Keterangan</label>
              <select name="keterangan" id="keterangan" class="form-control" required>
                  <option value="" selected disabled>-- Select Keterangan --</option>
                  @foreach (range(1, 10) as $num)
                      <option value="{{ $num }}" {{ old('keterangan', $data->keterangan) == $num ? 'selected' : '' }}>{{ $num }}</option>
                  @endforeach
                  @foreach (range('A', 'J') as $letter)
                      <option value="{{ $letter }}" {{ old('keterangan', $data->keterangan) == $letter ? 'selected' : '' }}>{{ $letter }}</option>
                  @endforeach
              </select>
          </div>

            <div class="mb-3">
                <label for="panjang" class="form-label">Panjang</label>
                <input type="number" name="panjang" id="panjang" value="{{$data->panjang}}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Save New GM</button>
        </form>
    </div>
</div>

<!-- Updated QR Code Scanner Script -->
<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    const scanButton = document.getElementById('scan-button');
    const qrReader = document.getElementById('qr-reader');
    const attributeField = document.getElementById('attribute');
    let html5QrCode = null;
    let scannerIsActive = false;

    // Event listener to trigger QR code scanning
    scanButton.addEventListener('click', () => {
        // Clear the input field before scanning to ensure no old values
        attributeField.value = '';

        if (!scannerIsActive) {
            qrReader.style.display = 'block'; // Show the QR reader
            html5QrCode = new Html5Qrcode("qr-reader");

            // Start QR code scanner
            html5QrCode.start(
                { facingMode: "environment" }, // Use rear camera
                { fps: 10, qrbox: 250 },
                qrCodeMessage => {
                    // Fill attribute field with scanned QR code
                    attributeField.value = qrCodeMessage;

                    // Stop the scanner after getting the result
                    stopQrScanner();
                },
                errorMessage => {
                    console.log("Scanning failed: ", errorMessage); // Optional logging for scan failures
                }
            ).catch(err => {
                console.error("Error starting QR code scanner:", err);
                qrReader.style.display = 'none'; // Hide reader if there's an error
            });

            scannerIsActive = true;
        } else {
            stopQrScanner(); // Stop scanner if it's already running
        }
    });

    function stopQrScanner() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                qrReader.style.display = 'none'; // Hide QR reader after stopping
                scannerIsActive = false;
                html5QrCode.clear(); // Ensure scanner is fully reset
            }).catch(err => {
                console.error("Error stopping the QR code scanner:", err);
            });
        }
    }
</script>

@endsection
