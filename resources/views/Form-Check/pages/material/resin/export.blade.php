<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Daily Resin</h4>

    <table>
        <thead>
            <tr>
                <th>TimeStamp</th>
                <th>Penerima</th>
                <th>No Dokumen</th>
                <th>Tanggal Surat Jalan</th>
                <th>Pengirim / Supplier</th>
                <th>Jenis</th>
                <th>Cuaca</th>
                <th>Keterangan</th>
                <th>Barang Sesuai Surat Jalan</th>
                <th>Keterangan</th>
                <th>Kering / Basah</th>
                <th>Keterangan</th>
                <th>Jumlah Sesuai Dengan Surat Jalan</th>
                <th>Keterangan</th>
                <th>Drum Tidak Pecah / Bocor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{$d->created_at}}</td>
                <td>
                    @php
                        $nama = \App\Models\User::where('id', $d->user_id)->value('name');
                    @endphp
                    {{ $nama }}
                </td>
                <td>{{$d->shift_leader}}</td>
                <td>{{$d->date}}</td>
                <td>{{$d->supplier}}</td>
                <td>{{$d->jenis}}</td>
                <td>{{$d->cuaca}}</td>
                <td>{{$d->keterangan}}</td>
                <td>{{$d->sesuai}}</td>
                <td>{{$d->keterangan1}}</td>
                <td>{{$d->kering}}</td>
                <td>{{$d->keterangan3}}</td>
                <td>{{$d->jumlahin}}</td>
                <td>{{$d->keterangan5}}</td>
                <td>{{$d->drum}}</td>
                <td>{{$d->keterangan6}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>