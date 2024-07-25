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
            text-align: left;
        }

        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        thead {
            background-color: deepskyblue;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">BARANG KELUAR</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Barang Keluar</th>
                <th>Jumlah Barang Keluar</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; ?>
            @foreach ($barangkeluar->sortby('tanggalkeluar') as $barang) <?php $no++; ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td>{{$barang->barangga->kodebarang}}</td>
                    <td>{{$barang->barangga->namabarang}}</td>
                    <td>{{$barang->tanggalkeluar}}</td>
                    <td>{{$barang->jumlahkeluar}}</td>
                    <td>{{$barang->unit->namaunit}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>