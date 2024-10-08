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

        tfoot {
            background-color: lightgray;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center">ATK MASUK</h1>
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
            <?php $no = 0; $grandTotal = 0; ?>
            @foreach ($barangmasuk->sortBy('tanggalmasuk') as $barang) 
                <?php 
                    $no++;
                    $grandTotal += $barang->hargatotal;
                ?>
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
        <tfoot>
            <tr>
                <td colspan="6" style="text-align:right;">Grand Total:</td>
                <td>{{$grandTotal}}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
