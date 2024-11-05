<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Export Eup</h3>

    <table>
        <thead>
            <tr>
                <th>TimeStamp</th>
                <th>Kondisi Kaki Palet</th>
                <th>Kondisi Papan Permukaan Palet</th>
                <th>Kondisi Ketebalan Papan Permukaan Palet</th>
                <th>Kondisi Paku pada Palet</th>
                <th>Kondisi Kaki Palet</th>
                <th>Kondisi Papan Permukaan Palet</th>
                <th>Kondisi Paku pada Palet</th>
                <th>Kondisi Pallet Sesuai Standar Warehouse TML</th>
                <th>Proses yang dilakukan?</th>
                {{-- <th>Bukti Foto : </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{$d->created_at}}</td>
                <td>{{$d->kaki_pallet}}</td>
                <td>{{$d->permukaan_pallet}}</td>
                <td>{{$d->ketebalan_pallet}}</td>
                <td>{{$d->paku_pallet}}</td>
                <td>{{$d->kaba_simetris == null ? $d->kaba_asimetris : $d->kaba_simetris}}</td>
                <td>{{$d->papan_patah}} ; {{$d->papan_pecah}}</td>
                <td>{{$d->keluar_pallet}}</td>
                <td>{{$d->sesuai}}</td>
                <td>{{$d->action}}</td>
                {{-- <td>
                    @if(!empty($d->foto7))
                        @php
                            // Split paths by '|' and remove any empty elements
                            $photos = array_filter(explode('|', $d->foto7));
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
                </td> --}}
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>