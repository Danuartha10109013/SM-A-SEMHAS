<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Checklist Material Resin</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }
        .container-fluid {
            width: 100%;
            max-width: 210mm;
            margin: auto;
        }
        h2 {
            text-align: center;
            font-size: 20px;
        }
        h4 {
            font-size: 14px;
            margin-top: 5px;
        }
        .photos-wrapper img {
            width: 80%;
            max-width: 150px;
            margin: 5px 0;
        }
        .checklist-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .checklist-column {
            width: 48%;
        }
        .checklist-container {
            margin-bottom: 10px;
        }
        hr {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <p style="text-align: end">FM.WH.02.01</p>
        <h2>Daily Checklist Kedatangan Material Resin</h2>

        <h3>User Information</h3>
        <p><strong>Checker:</strong> 
        @php
            $nama = \App\Models\User::where('id', $submission->user_id)->value('name');
        @endphp
        {{ $nama }}</p>
        <p><strong>Date:</strong> {{ $submission->date }}</p>
        <p><strong>Document Number:</strong> {{ $submission->shift_leader }}</p>
        <p><strong>Supplier:</strong> {{ is_array($submission->supplier) ? implode(', ', $submission->supplier) : $submission->supplier }}</p>
        
        <hr>

        <!-- Checklist Items -->
        <div class="checklist-row">
            <!-- Left Column -->
            <div class="checklist-column">
                <div class="checklist-container">
                    <h4>Cuaca: {{ $submission->cuaca }}</h4>
                    <h4>Tujuan Surat Jalan: {{ $submission->sesuai }}</h4>
                    <p>Keterangan: {{ $submission->keterangan }}</p>
                    <div class="photos-wrapper">
                        @if ($foto->foto && is_array(json_decode($foto->foto)))
                            @foreach (json_decode($foto->foto) as $fotoin)
                                <img src="{{ asset('storage/resin/' . $fotoin) }}" alt="Uploaded photo">
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="checklist-container">
                    <h4>Barang Sesuai Dengan Surat Jalan: {{ $submission->sesuai }}</h4>
                    <p>Keterangan: {{ $submission->keterangan1 }}</p>
                    <div class="photos-wrapper">
                        @if ($foto->foto1 && is_array(json_decode($foto->foto1)))
                            @foreach (json_decode($foto->foto1) as $fotoin)
                                <img src="{{ asset('storage/resin/' . $fotoin) }}" alt="Uploaded photo">
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <div class="checklist-container">
                    <h4>Kering / Basah: {{ $submission->kering }}</h4>
                    <p>Keterangan: {{ $submission->keterangan3 }}</p>
                    <div class="photos-wrapper">
                        @if ($foto->foto3 && is_array(json_decode($foto->foto3)))
                            @foreach (json_decode($foto->foto3) as $fotoin)
                                <img src="{{ asset('storage/resin/' . $fotoin) }}" alt="Uploaded photo">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="checklist-column">
                <div class="checklist-container">
                    <h4>Jumlah Sesuai Surat Jalan: {{ $submission->jumlahin }}</h4>
                    <p>Keterangan: {{ $submission->keterangan5 }}</p>
                    <div class="photos-wrapper">
                        @if ($foto->foto5 && is_array(json_decode($foto->foto5)))
                            @foreach (json_decode($foto->foto5) as $fotoin)
                                <img src="{{ asset('storage/resin/' . $fotoin) }}" alt="Uploaded photo">
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <div class="checklist-container">
                    <h4>Drum Tidak Penyok/Bocor: {{ $submission->drum }}</h4>
                    <p>Keterangan: {{ $submission->keterangan6 }}</p>
                    <div class="photos-wrapper">
                        @if ($foto->foto6 && is_array(json_decode($foto->foto6)))
                            @foreach (json_decode($foto->foto6) as $fotoin)
                                <img src="{{ asset('storage/resin/' . $fotoin) }}" alt="Uploaded photo">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
