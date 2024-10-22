<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing List Export</title>
</head>
<body>
    <h1>Packing List</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>QTY</th>
                <th>UOM</th>
                <th>No Coil</th>
                <th>Storage Bin</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Panjang</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->kode }}</td>
                    <td>{{ $d->nama_produk }}</td>
                    <td>{{ $d->qty }}</td>
                    <td>{{ $d->uom }}</td>
                    <td>{{ $d->no_coil }}</td>
                    <td>{{ $d->storage_bin }}</td>
                    <td>{{ $d->tanggal }}</td>
                    <td>{{ $d->pengirim }}</td>
                    <td>{{ $d->panjang }}</td>
                    <td>{{ $d->time }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>