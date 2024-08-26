<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            text-align: center;
        }

        td {
            text-align: left;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode ATK</th>
                <th>Nama ATK</th>
                <th>Tanggal ATK Keluar</th>
                <th>Jumlah ATK Keluar</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; ?>
            @foreach ($barangkeluar->sortby('tanggalkeluar') as $barang) <?php $no++; ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td>{{$barang->masteratk->kodebarang}}</td>
                    <td>{{$barang->masteratk->namabarang}}</td>
                    <td>{{$barang->tanggalkeluar}}</td>
                    <td>{{$barang->jumlahkeluar}}</td>
                    <td>{{$barang->unit->namaunit}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>