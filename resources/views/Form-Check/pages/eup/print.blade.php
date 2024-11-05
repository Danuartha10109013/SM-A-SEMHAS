<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Checklist Pallet EUP</title>
    <style>
        /* A4 paper size dimensions */
        @page {
            size: A4;
            margin: 20mm;
        }

        /* Styling for printed layout */
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container-fluid {
            width: 100%;
            max-width: 210mm;
            margin: auto;
        }

        .content-wrapper {
            margin: 0 auto;
            padding: 10px;
        }

        h2 {
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
        }

        h3 {
            margin-top: 15px;
            font-size: 16px;
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
        }

        p {
            margin: 5px 0;
            font-size: 14px;
            line-height: 1.4;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }

        .photos-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .photos-wrapper div {
            width: 48%;
            padding: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        .photos-wrapper img {
            width: 100%;
            height: auto;
        }

        .footer-note {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            color: #666;
        }

        /* Hide the print button when printing */
        @media print {
            body, html {
                margin: 0;
                padding: 0;
            }

            /* Adjust layout for print */
            .container-fluid {
                margin: 0;
                padding: 0;
            }

            /* Hide any elements that are not necessary for print */
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="content-wrapper">
            <h2>Daily Checklist Pallet EUP</h2>
            
            <h3>User Information</h3>
            <p><strong>Checker:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Date:</strong> {{ $submission->date }}</p>
            <p><strong>Jenis Pengecekan:</strong> {{ $submission->jenis }}</p>
            
            <hr>
            
            <h3>Pallet Conditions</h3>
            <p><strong>Kondisi Kaki Pallet:</strong> 
                {{ is_array($submission->kaki_pallet) ? implode('| ', $submission->kaki_pallet) : $submission->kaki_pallet }}
            </p>
            <p><strong>Permukaan Pallet:</strong> {{ $submission->permukaan_pallet }}</p>
            <p><strong>Ketebalan Pallet:</strong> {{ $submission->ketebalan_pallet }}</p>
            <p><strong>Kondisi Paku pada Pallet:</strong> {{ $submission->paku_pallet }}</p>
            <p><strong>Apakah Paku Keluar:</strong> {{ $submission->keluar_pallet }}</p>
            <p><strong>Kondisi Sesuai Standar:</strong> {{ $submission->sesuai }}</p>
            <p><strong>Action Taken:</strong> {{ $submission->action }}</p>
            
            <hr>
            
            <h3>Foto Bukti</h3>
            @if(!empty($submission->foto7))
                @php
                    // Split paths by '|' and remove any empty elements
                    $photos = array_filter(explode('|', $submission->foto7));
                @endphp
    
                <div class="photos-wrapper">
                    @foreach($photos as $photo)
                        <div>
                            <img src="{{ asset('storage/eup/' . $photo) }}" alt="Uploaded photo">
                        </div>
                    @endforeach
                </div>
            @else
                <p>No photos uploaded.</p>
            @endif
    
            <hr>
            
            <p class="footer-note">Formulir ini dibuat untuk memastikan kondisi Pallet yang diterima sesuai standar.</p>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
