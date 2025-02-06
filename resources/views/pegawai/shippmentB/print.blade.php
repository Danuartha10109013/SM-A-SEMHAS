<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Mark</title>
    <style>
        @media print {
            @page {
                size: 23.95cm 10.19cm;
                margin-top: 0px;
                margin-bottom: 0px;
            }
            body {
                margin-top: 0px;
                margin-bottom: 0px;
            }

            .page-break {
                page-break-before: always;
            }
        }

        body {
            font-family: Arial, sans-serif;
            padding: 0;
            margin: 0;
        }

        .shipping-mark-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .shipping-mark {
            margin-top: 0.5cm;
            margin-left: 0cm;
            width: 21.75cm;
            height: 9.19cm;
            border: 5px solid black;
            padding: 10px;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            text-align: center;
            font-size: 19px;
            font-weight: bolder;
            margin-bottom: 0px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .details {
            font-size: 18px;
            line-height: 1.8;
        }

        .details .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .details .label {
            width: 20%;
            font-weight: bold;
        }

        .details .value {
            width: 80%;
            text-align: left;
        }

        .footer {
            text-align: left;
            font-weight: bold;
            font-size: 18px;
            margin-top:0.29cm;
        }

        .page-break {
            page-break-before: always;
        }

    </style>
</head>
<body>
    @foreach ($data as $index => $d)
    <div class="shipping-mark-container {{ $index > 0 ? 'page-break' : '' }}">
        <div class="shipping-mark">
            <div class="header">SHIPPING MARK</div>
            <div class="details">
                <div class="row">
                    <div style="font-weight: bold; font-size: 18px; margin-bottom: 0.2cm;weight:70%" class="label1">{{$d->manufactur}}</div>
                </div>
                <div class="row">
                    <div class="label">DESTINATION</div>
                    <div style="margin-left:-2em;" class="value">: {{$d->destination}}</div>
                </div>
                <div class="row">
                    <div class="label">PRODUCT</div>
                    <div style="margin-left:-2em;" class="value">: {{$d->product}}</div>
                </div>
                <div class="row">
                    <div class="label">SIZE</div>
                    <div style="margin-left:-2em;" class="value">: {{$d->size}}</div>
                </div>
                <div class="row">
                    <div class="label">GROSS WEIGHT</div>
                    
                    <div style="margin-left:-2em;" class="value">: {{ number_format($d->gros, 0, '.', '.') }} {{$d->satuan_berat}}</div>
                </div>
                <div class="row">
                    <div class="label">NET WEIGHT</div>
                    <div class="value">: {{ number_format($d->net, 0, '.', '.') }} {{$d->satuan_berat}}</div>
                </div>
            </div>
            <div class="footer">MADE IN INDONESIA</div>
        </div>
    </div>
    <small style="display: flex; justify-content: flex-end; text-align: right; margin-right: 20px">{{$d->atribute}}</small>
    @endforeach
</body>
</html>
