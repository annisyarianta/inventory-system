<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            border-collapse: collapse;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
        }

        th {
            text-align: center;
        }

        td {
            text-align: center;
        }

        .biru {
            background-color: cornflowerblue;
        }

        
    </style>
</head>

<body>
    <h2 style="text-align: center; margin-bottom: 0;">DAFTAR</h2>
    <h2 style="text-align: center; border-bottom: 1px solid black; width: 100%;  margin-top: 0;">PENGELUARAN BARANG ALAT TULIS KANTOR (ATK) UNIT {{strtoupper($namaunit->namaunit)}}</h2>

    <p>Dengan ini dinyatakan penerimaan Barang Alat Tulis Kantor (ATK) tersebut di bawah ini:</p>
    <table class="tabel">
        <thead>
            <tr>
                <th>Tanggal Penerimaan</th>
                <th>Dari</th>
                <th>Referensi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$tanggalba}}</td>
                <td>{{$namaunit->namaunit}}</td>
                <td>{{$referensi}}</td>
            </tr>
        </tbody>
    </table>

    <br>

    <table>
        <thead>
            <tr class="biru">
                <th>NO.</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>VOLUME/SATUAN</th>
                <th>KETERANGAN</th>
            </tr>
        </thead>
        <tbody>
            <tr class="biru" style="font-style: italic">
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
            </tr>
            <?php $no=0; ?>
            @foreach ($barangkeluar->sortby('tanggalkeluar') as $barang) <?php $no++; ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td>{{$barang->barangga->kodebarang}}</td>
                    <td>{{$barang->barangga->namabarang}}</td>
                    <td>{{$barang->jumlahkeluar}}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>

    <table style="border: none">
        <thead>
            <tr>
                <th style="border: none">Diketahui:</th>
                <th style="border: none">Telah DIterima Oleh:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-bottom: 100px; border: none"><b>Asst. Manager of <br>Finance & Human Resources</b></td>
                <td style="padding-bottom: 100px; border: none"><b>{{$jabatanpenerima}}</b></td>
            </tr>
            <tr>
                <td style="border: none"><b><u>YUSPRIADY YUSUF</u></b></td>
                <td style="border: none"><b><u>{{$penerima}}</u></b></td>
            </tr>
        </tbody>
    </table>

</body>

</html>