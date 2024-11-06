<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Ingot</title>
</head>
<body>
    <h4>Daily Ingot</h4>
    <table>
        <thead>
            <tr>
                <th>TimeStamp</th>
                <th>Responden</th>
                <th>Shift Leader</th>
                <th>Supplier</th>
                <th>Jenis</th>
                <th>Cuaca</th>
                <th>Tujuan Surat Jalan</th>
                <th>Keterangan 1</th>
                <th>Detail Sesuai</th>
                <th>Kering / Basah</th>
                <th>Keterangan 2</th>
                <th>Jumlah Sesuai Surat Jalan</th>
                <th>Keterangan 3</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->created_at }}</td>
                <td>
                    @php
                        $name = \App\Models\User::where('id',$d->user_id)->value('name');
                    @endphp
                    {{$name}}
                </td>
                <td>{{ $d->shift_leader }}</td>
                <td>{{ $d->supplier }}</td>
                <td>{{ $d->jenis }}</td>
                <td>{{ $d->cuaca }}</td>
                <td>{{ $d->jalan }}</td>
                <td>{{ $d->keterangan }}</td>
                <td>{{ $d->sesuai }}</td>
                <td>{{ $d->kering }}</td>
                <td>{{ $d->keterangan1 }}</td>
                <td>{{ $d->jumlahin }}</td>
                <td>{{ $d->keterangan3 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
