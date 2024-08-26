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
                <th>Tanggal ATK Masuk</th>
                <th>Jumlah ATK Masuk</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; ?>
            @foreach ($barangmasuk->sortby('tanggalmasuk') as $barang) <?php $no++; ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td>{{$barang->masteratk->kodebarang}}</td>
                    <td>{{$barang->masteratk->namabarang}}</td>
                    <td>{{$barang->tanggalmasuk}}</td>
                    <td>{{$barang->jumlahmasuk}}</td>
                    <td>{{$barang->hargasatuan}}</td>
                    <td>{{$barang->hargatotal}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>