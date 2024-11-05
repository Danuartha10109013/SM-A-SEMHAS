<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Excel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h3>Data Checklist Kendaraan</h3>

<table>
    <tr>
        <th>No Urut</th>
        <th>Nama Ekspedisi</th>
        <th>No Mobil</th>
        <th>No Kontainer</th>
        <th>Tujuan</th>
        <th>Nama Sopir</th>
        <th>Helm</th>
        <th>Celana Panjang</th>
        <th>Baju Lengan Panjang</th>
        <th>Sepatu</th>
        <th>SIM</th>
        <th>Masa Berlaku SIM</th>
        <th>STNK</th>
        <th>Masa Berlaku STNK</th>
        <th>KIR</th>
        <th>Masa Berlaku KIR</th>
        <th>Surat Pengantar Ekspedisi</th>
        <th>Segel</th>
        <th>Keterangan Nama Ekspedisi</th>
        <th>Keterangan No Mobil</th>
        <th>Keterangan No Kontainer</th>
        <th>Keterangan Tujuan</th>
        <th>Keterangan Nama Sopir</th>
        <th>Keterangan Helm</th>
        <th>Keterangan Celana Panjang</th>
        <th>Keterangan Baju Lengan Panjang</th>
        <th>Keterangan Sepatu</th>
        <th>Keterangan SIM</th>
        <th>Keterangan Masa Berlaku SIM</th>
        <th>Keterangan STNK</th>
        <th>Keterangan Masa Berlaku STNK</th>
        <th>Keterangan KIR</th>
        <th>Keterangan Masa Berlaku KIR</th>
        <th>Keterangan Surat Pengantar Ekspedisi</th>
        <th>Keterangan Segel</th>
        <th>User ID</th>
        <th>Jam</th>
        <th>Tanggal</th>
    </tr>
    @foreach ($data as $d)
    <tr>
        <td>{{$d->no_urut}}</td>
        <td>{{$d->nama_ekspedisi}}</td>
        <td>{{$d->no_mobil}}</td>
        <td>{{$d->no_kontainer}}</td>
        <td>{{$d->tujuan}}</td>
        <td>{{$d->nama_sopir}}</td>
        <td>{{$d->helm}}</td>
        <td>{{$d->celana_panjang}}</td>
        <td>{{$d->baju_lengan_panjang}}</td>
        <td>{{$d->sepatu}}</td>
        <td>{{$d->sim}}</td>
        <td>{{$d->masa_berlaku_sim}}</td>
        <td>{{$d->stnk}}</td>
        <td>{{$d->masa_berlaku_stnk}}</td>
        <td>{{$d->kir}}</td>
        <td>{{$d->masa_berlaku_kir}}</td>
        <td>{{$d->surat_pengantar_ekspedisi}}</td>
        <td>{{$d->segel}}</td>
        <td>{{$d->ket_nama_ekspedisi}}</td>
        <td>{{$d->ket_no_mobil}}</td>
        <td>{{$d->ket_no_kontainer}}</td>
        <td>{{$d->ket_tujuan}}</td>
        <td>{{$d->ket_nama_sopir}}</td>
        <td>{{$d->ket_helm}}</td>
        <td>{{$d->ket_celana_panjang}}</td>
        <td>{{$d->ket_baju_lengan_panjang}}</td>
        <td>{{$d->ket_sepatu}}</td>
        <td>{{$d->ket_sim}}</td>
        <td>{{$d->ket_masa_berlaku_sim}}</td>
        <td>{{$d->ket_stnk}}</td>
        <td>{{$d->ket_masa_berlaku_stnk}}</td>
        <td>{{$d->ket_kir}}</td>
        <td>{{$d->ket_masa_berlaku_kir}}</td>
        <td>{{$d->ket_surat_pengantar_ekspedisi}}</td>
        <td>{{$d->ket_segel}}</td>
        <td>
            @php
                $name = \App\Models\User::where('id',$d->id)->value('name');
            @endphp
            {{$name}}
        </td>
        <td>{{$d->jam}}</td>
        <td>{{$d->tanggal}}</td>
    </tr>
    @endforeach

</table>

</body>
</html>