@extends('Kendaraan.layout.main')

@section('title')
    Add ||
    @if(Auth::user()->role == 0)
        Admin
    @elseif(Auth::user()->role == 1)
        Pegawai
    @else
        Unknown
    @endif
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Checklist</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px; /* Adjust the width as needed */
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .no-urut {
            text-align: right;
        }
    </style>
</head>
<body>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px; /* Adjust the width as needed */
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .no-urut {
            text-align: right;
        }
    </style>
    <div class="header-container">
        <div class="logo">
            <img src="{{ asset('Logo TML.png') }}" alt="Logo">
        </div>
        <div class="title">
            CHECKLIST KENDARAAN
        </div>
        <form action="{{ route('Kendaraan.pegawai.check.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
        
            <div class="no-urut">
            <p>FM.WH.07.03</p>
            NO. URUT: <input type="text" name="no_urut" ><br>
            TGL: <input type="text" name="tanggal" value="{{ date('d-m-Y') }}" readonly><br>
            IN (Jam): <input type="text" name="in" value="{{ now()->format('H:i:s') }}" readonly>
        </div>
    </div>

        <table>
            <!-- Section A: Data Ekspedisi -->
            <tr>
                <th></th>
                <th>DESKRIPSI</th>
                <th>ISI</th>
                <th>KET</th>
            </tr>
            <tr>
                <td><strong>A</strong></td>
                <td><strong>DATA EKSPEDISI:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Nama Ekspedisi</td>
                <td><input type="text" name="nama_ekspedisi" required></td>
                <td><input type="text" name="ket_nama_ekspedisi"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>No Mobil (Foto)</td>
                <td><input type="text" name="no_mobil" required> &nbsp;&nbsp;<input type="file" name="no_mobil_foto" ></td>
                <td><input type="text" name="ket_no_mobil"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>No Kontainer (Foto)</td>
                <td><input type="text" name="no_kontainer" required> &nbsp;&nbsp;<input type="file" name="no_kontainer_foto" ></td>
                <td><input type="text" name="ket_no_kontainer"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Tujuan</td>
                <td><input type="text" name="tujuan" required></td>
                <td><input type="text" name="ket_tujuan"></td>
            </tr>

            <!-- Section B: Data Driver -->
            <tr>
                <td><strong>B</strong></td>
                <td><strong>DATA DRIVER:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Nama Sopir/Kenek</td>
                <td><input type="text" name="nama_sopir" placeholder="" required><small style='color:red'>*</small>  </td>
                <td><input type="text" name="ket_nama_sopir"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Helm</td>
                <td>
                    <select name="helm">
                        <option value="ADA">ADA</option>
                        <option value="TIDAK ADA">TIDAK ADA</option>
                    </select>
                </td>
                <td><input type="text" name="ket_helm"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Celana Panjang</td>
                <td>
                    <select name="celana_panjang">
                        <option value="ADA">ADA</option>
                        <option value="TIDAK ADA">TIDAK ADA</option>
                    </select>
                </td>
                <td><input type="text" name="ket_celana_panjang"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Baju Lengan Panjang</td>
                <td>
                    <select name="baju_lengan_panjang">
                        <option value="ADA">ADA</option>
                        <option value="TIDAK ADA">TIDAK ADA</option>
                    </select>
                </td>
                <td><input type="text" name="ket_baju_lengan_panjang"></td>
            </tr>
            <tr>
                <td>5</td>
                <td>Sepatu</td>
                <td>
                    <select name="sepatu">
                        <option value="ADA">ADA</option>
                        <option value="TIDAK ADA">TIDAK ADA</option>
                    </select>
                </td>
                <td><input type="text" name="ket_sepatu"></td>
            </tr>

            <!-- Section C: Kelengkapan Dokumen Supir -->
            <tr>
                <td><strong>C</strong></td>
                <td><strong>KELENGKAPAN DOKUMEN SUPIR:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td>SIM / KTP</td>
                <td><input type="text" name="sim" required></td>
                <td><input type="text" name="ket_sim"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Masa Berlaku SIM / KTP</td>
                <td>
                    <select name="masa_berlaku_sim">
                        <option value="YA">YA</option>
                        <option value="TDK">TDK</option>
                    </select>
                </td>
                <td><input type="date" name="ket_masa_berlaku_sim"></td>
            </tr>
            <tr>
                <td>3</td>
                <td>STNK</td>
                <td><input type="text" name="stnk" required></td>
                <td><input type="text" name="ket_stnk"></td>
            </tr>
            <tr>
                <td>4</td>
                <td>Masa Berlaku STNK</td>
                <td>
                    <select name="masa_berlaku_stnk">
                        <option value="YA">YA</option>
                        <option value="TDK">TDK</option>
                    </select>
                </td>
                <td><input type="date" name="ket_masa_berlaku_stnk"></td>
            </tr>
            <tr>
                <td>5</td>
                <td>KIR</td>
                <td><input type="text" name="kir" required></td>
                <td><input type="text" name="ket_kir"></td>
            </tr>
            <tr>
                <td>6</td>
                <td>MASA BERLAKU KIR</td>
                <td>
                    <select name="masa_berlaku_kir">
                        <option value="YA">YA</option>
                        <option value="TDK">TDK</option>
                    </select>
                </td>
                <td><input type="date" name="ket_masa_berlaku_kir"></td>
            </tr>
            <tr>
                <td><strong>D</strong></td>
                <td><strong>KELENGKAPAN DOKUMEN PENGAMBILAN :</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>1</td>
                <td>SURAT PENGANTAR EKSPEDISI / DO</td>
                <td><input type="text" name="surat_pengantar_ekspedisi" required></td>
                <td><input type="text" name="ket_surat_pengantar_ekspedisi"></td>
            </tr>
            <tr>
                <td>2</td>
                <td>SEGEL</td>
                <td><input type="text" name="segel" required></td>
                <td><input type="text" name="ket_segel"></td>
            </tr>
            
            <!-- Additional sections follow the same structure -->
        </table>
        <br>
        Responden :     <input type="text" value="{{ Auth::user()->name }}" readonly>
        <input type="hidden" name="responden" value="{{ Auth::user()->id }}">
        <br>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
@endsection
