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
                <input type="text" name="attribute" id="attribute" class="form-control" required autocomplete="off">
                <ul id="attribute-suggestions" class="list-group" style="display:none; position: absolute; width: 100%; background: white; z-index: 10; border: 1px solid #ddd;">
                    <!-- Suggestions will be displayed here -->
                </ul>
                <button type="button" id="scan-button-attribute" class="btn btn-secondary position-absolute" style="right: 10px; top: 32px;">Scan QR</button>
            </div>

            <div id="qr-reader-attribute" style="width: 100%; display: none;"></div>

            <div class="mb-3">
                <label for="kondisi" class="form-label">Kondisi Coil</label>
                <select name="kondisi" id="kondisi" class="form-control" required>
                    @php
                        $kondisi = \App\Models\KondisiM::whereJsonContains('type','L8')->get();
                    @endphp
                    <option value="" selected disabled>--Pilih Kondisi--</option>
                    @foreach ($kondisi as $s)
                        
                    <option value="{{ $s->kondisi }}" {{ old('kondisi') == $s->kondisi ? 'selected' : '' }}>{{ $s->kondisi }}</option>

                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kondisi" class="form-label">Group</label>
                <select name="group" id="kondisi" class="form-control" required>
                    <option value="" selected disabled>-- Select Group --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="LOKAL">LOKAL</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="layout" class="form-label">Layout Kontainer</label>
                <input type="text" name="layout" id="layout" class="form-control" readonly required>
            </div>

            <div class="mb-3">
                <label for="no_sales" class="form-label">No Sales</label>
                <input type="text" name="no_sales" id="no_sales" class="form-control" readonly required>
            </div>

            <!-- Hidden input for user ID -->
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            <button type="submit" class="btn btn-primary w-100">Save Coil</button>
        </form>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode/html5-qrcode.min.js"></script>
<script>
// Function to handle search and display suggestions for the attribute field
document.getElementById('attribute').addEventListener('input', function() {
    let query = this.value;

    if (query.length > 2) {
        fetch(`/L-08/admin/rekap/search-attributes?query=${query}`)
            .then(response => response.json())
            .then(data => {
                let suggestionsContainer = document.getElementById('attribute-suggestions');
                suggestionsContainer.innerHTML = ''; // Clear previous suggestions
                if (data.length > 0) {
                    data.forEach(item => {
                        let li = document.createElement('li');
                        li.classList.add('list-group-item');
                        li.textContent = item.attribute;
                        li.addEventListener('click', function() {
                            document.getElementById('attribute').value = item.attribute;
                            document.getElementById('layout').value = item.layout;
                            document.getElementById('no_sales').value = item.no_so;
                            suggestionsContainer.style.display = 'none'; // Hide suggestions after selection
                        });
                        suggestionsContainer.appendChild(li);
                    });
                    suggestionsContainer.style.display = 'block'; // Show suggestions
                } else {
                    suggestionsContainer.style.display = 'none'; // Hide if no suggestions
                }
            })
            .catch(error => console.error('Error fetching attributes:', error));
    } else {
        document.getElementById('attribute-suggestions').style.display = 'none'; // Hide suggestions when query is too short
    }
});

// Close suggestions when clicking outside
document.addEventListener('click', function(event) {
    let suggestionsContainer = document.getElementById('attribute-suggestions');
    if (!event.target.closest('#attribute') && !event.target.closest('#attribute-suggestions')) {
        suggestionsContainer.style.display = 'none';
    }
});

// QR Code Scanner for Attribute field
function initQrScanner(buttonId, readerId, inputField) {
    const scanButton = document.getElementById(buttonId);
    const qrReader = document.getElementById(readerId);
    const input = document.getElementById(inputField);
    const layoutInput = document.getElementById('layout');  // Get the layout field
    const noSalesInput = document.getElementById('no_sales');  // Get the no_sales field
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

                    // Automatically fill the layout and no_sales fields based on the scanned value
                    fetch(`/L-08/admin/rekap/search-attributes?query=${qrCodeMessage}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                const item = data[0];
                                layoutInput.value = item.layout;  // Set the layout field
                                noSalesInput.value = item.no_so;  // Set the no_sales field
                            }
                        })
                        .catch(error => console.error('Error fetching attribute data:', error));

                    stopQrScanner(); // Stop the scanner after successful scan
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
