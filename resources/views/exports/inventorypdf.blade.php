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
    </style>
</head>

<body>
    <h1 style="text-align: center">Inventory Barang</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>OK</th>
                <th>U/S</th>
                <th>Jumlah</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; ?>
            @foreach ($inventory_barang as $barang) <?php $no++; ?>
            <tr>
                <th scope="row"><?= $no; ?></th>
                {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                <td>{{$barang->nama}}</td>
                <td>{{$barang->ok}}</td>
                <td>{{$barang->us}}</td>
                <td>{{$barang->ok + $barang->us}}</td>
                <td>{{$barang->lokasi->NamaLokasi}}</td>
                <td>{{$barang->keterangan}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>