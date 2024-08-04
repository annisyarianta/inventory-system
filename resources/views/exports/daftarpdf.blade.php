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
    <h1 style="text-align: center">DAFTAR ATK</h1>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode ATK</th>
                <th>Nama ATK</th>
                <th>Jumlah ATK</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; ?>
            @foreach ($inventory_barang->sortby('namabarang') as $barang) <?php $no++; ?>
                <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td>{{$barang->kodebarang}}</td>
                    <td>{{$barang->namabarang}}</td>
                    <td>
                        <?php $jmlhmasuk = 0; $jmlhkeluar = 0 ?>
                        @foreach ($barangmasuk as $brgmasuk)
                            @if ($barang->id == $brgmasuk->barangga_id)
                                <?php $jmlhmasuk = $jmlhmasuk + $brgmasuk->jumlahmasuk ?>
                            @endif
                        @endforeach
                        @foreach ($barangkeluar as $brgkeluar)
                            @if ($barang->id == $brgkeluar->barangga_id)
                                <?php $jmlhkeluar = $jmlhkeluar + $brgkeluar->jumlahkeluar ?>
                            @endif
                        @endforeach
                        {{$jmlhmasuk - $jmlhkeluar}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>