<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Daily Crc</h4>
    <table>
        <thead>
            <tr>
                <th>Timstamp</th>
                <th>Responden</th>
                <th>Shift Leader</th>
                <th>Supplier</th>
                <th>Jumlah</th>
                <th>Cuaca</th>
                <th>Keterangan</th>
                <th>Barang Sesuai Surat Jalan</th>
                <th>Keterangan</th>
                <th>Kondisi Kemasan Baik</th>
                <th>Keterangan</th>
                <th>Kering / Basah</th>
                <th>Keterangan</th>
                <th>Kondisi Pengikat Strapping</th>
                <th>Keterangan</th>
                <th>Jumlah Sesuai Surat Jalan</th>
                <th>Keterangan</th>
                <th>Rantai Dialas Karet Ban Luar</th>
                <th>Keterangan</th>
                <th>Menggunakan Side wall</th>
                <th>Keterangan</th>
                <th>Ban Di Ganjal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{$d->created_at}}</td>
                    <td>
                        @php
                            $name = \App\Models\User::where('id',$d->user_id)->value('name');
                        @endphp
                        {{$name}}
                    </td>
                    <td>{{$d->shift_leader}}</td>
                    <td>{{$d->supplier}}</td>
                    <td>{{$d->ket_awal}}</td>
                    <td>{{$d->cuaca}}</td>
                    <td>{{$d->keterangan}}</td>
                    <td>{{$d->sesuai}}</td>
                    <td>{{$d->keterangan1}}</td>
                    <td>{{$d->baik}}</td>
                    <td>{{$d->keterangan2}}</td>
                    <td>{{$d->kering}}</td>
                    <td>{{$d->keterangan3}}</td>
                    <td>{{$d->kencang}}</td>
                    <td>{{$d->keterangan4}}</td>
                    <td>{{$d->jumlahin}}</td>
                    <td>{{$d->keterangan5}}</td>
                    <td>{{$d->alas}}</td>
                    <td>{{$d->keterangan6}}</td>
                    <td>{{$d->wall}}</td>
                    <td>{{$d->keterangan7}}</td>
                    <td>{{$d->perganjalan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>