<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Supply Bahan Pendukung</title>
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- CSS for Print Style -->
    <style>
        /* General print styling */
        @media print {
            body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
                color: #000;
                margin: 0;
                padding: 0;
            }
            .container {
                margin: 20px;
                width: 100%;
            }
            h1, h4, h5, p {
                margin: 0;
                padding: 0;
            }
            h1 {
                font-size: 24px;
                margin-bottom: 10px;
            }
            h4 {
                font-size: 18px;
                margin-bottom: 5px;
            }
            h5 {
                font-size: 14px;
                margin-bottom: 10px;
            }
            p {
                margin-bottom: 8px;
            }
            img {
                width: 40%;
                height: auto;
                margin-bottom: 20px;
            }
            .print-btn {
                display: none;
            }
        }

        /* Screen Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h4, h5, p {
            margin: 0;
            padding: 0;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        h5 {
            font-size: 14px;
            margin-bottom: 10px;
        }
        p {
            margin-bottom: 8px;
        }
        img {
            width: 20%;
            height: auto;
            margin-bottom: 20px;
        }
        .print-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Title Section -->
    <h1>Supply Bahan Pendukung</h1>

    <!-- Date -->
    <h5>
        <?php
        // Example PHP to format the date (assuming $data->created_at exists)
        $date = \Carbon\Carbon::parse('2024-10-17 14:00:00')->format('d/m/Y');
        echo $date;
        ?>
    </h5>

    <!-- Details -->
    <p><strong>Shift Leader Yang Bertugas:</strong> {{$data->shift_leader}}</p>
    <p><strong>Shift:</strong> {{$data->shift}}</p>
    <p><strong>Supply:</strong> {{$data->supply}}</p>

    <!-- Images Section -->
    <div class="images">
        @php
        // Decode the JSON array of image paths
        $images = json_decode($data->foto);
    @endphp
    
    @if ($images)
        @foreach ($images as $image)
            <img src="{{ asset('storage/supply/' . $image) }}" alt="Image" style="margin-left: 20px;margin-top: 20px;margin-right: 20px">
        @endforeach
    @else
        <p>No images available.</p>
    @endif
    
    </div>

    <!-- Print Button -->
    <button class="print-btn" onclick="window.print()">
        <i class="fas fa-print"></i> Print
    </button>
</div>

</body>
</html>
