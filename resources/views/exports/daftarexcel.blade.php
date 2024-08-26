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
                            @if ($barang->id == $brgmasuk->masteratk_id)
                                <?php $jmlhmasuk = $jmlhmasuk + $brgmasuk->jumlahmasuk ?>
                            @endif
                        @endforeach
                        @foreach ($barangkeluar as $brgkeluar)
                            @if ($barang->id == $brgkeluar->masteratk_id)
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