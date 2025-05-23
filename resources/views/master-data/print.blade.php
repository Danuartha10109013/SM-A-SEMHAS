<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />
    <title>Warehouse || Employe's Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            display: flex;
            align-items: center; /* Align items vertically */
            justify-content: center; /* Center items horizontally */
            text-align: center; /* Center text */
            margin-bottom: 20px;
        }

        .header img {
            margin-right: 15px; /* Space between image and text */
            width: 10%;
        }

        .header h3 {
            margin: 0;
        }

        .header p {
            margin: 0;
            margin-left: 90px;
            margin-top: -70px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('img/Logo_TML.png') }}" alt="Logo">
        <div>
            <h3><strong>List Pegawai & Account</strong></h3>
        </div>
        <p>Password : Tatametal123</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
