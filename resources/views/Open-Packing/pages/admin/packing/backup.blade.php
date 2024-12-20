<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Backup Open Pack</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="13">
                    <p>Backup Open Packing {{$start}} - {{$end}}</p>
                </th>
            </tr>
            <tr>

                <th>Timestamp</th>
                <th>GM</th>
                <th>Attribute</th>
                <th>Berat Label</th>
                <th>Berat Aktual</th>
                <th>Selisih</th>
                <th>Presentase</th>
                <th>Keterangan</th>
                <th>Operator</th>
                <th>Scaner</th>
                <th>Shift</th>
                <th>Shift Leader</th>
                <th>Checks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{$d->created_at}}</td>
                    <td>{{$d->gm}}</td>
                    <td>{{$d->attribute}}</td>
                    <td>{{$d->b_label}}</td>
                    <td>{{$d->b_aktual}}</td>
                    <td>{{$d->selisih}}</td>
                    <td>{{$d->persentase}}</td>
                    <td>{{$d->keterangan}}</td>
                    <td>
                        @php
                            $operator = \App\Models\User::find($d->operator);
                            $scaner = \App\Models\User::find($d->scanner);
                        @endphp
                        {{$operator->name}}</td>
                    <td>{{$scaner->name}}</td>
                    <td>{{$d->shift}}</td>
                    <td>{{$d->shift_leader}}</td>
                    <td>{{$d->checks == 1 ? "Sudah Direkap" : "Belum Direkap"}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    
</body>
</html>