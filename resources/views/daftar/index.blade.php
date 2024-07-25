@extends('layouts.master')
@section('cari')
<form class="navbar-form navbar-left">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/daftar">
        <input name="cari" class="form-control mr-sm-2" type="search" placeholder="Cari Barang"
            aria-label="Search">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</form>
@endsection
@section('content')
@if (session('sukses'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{session('sukses')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
@endif
@if (session('gagal'))
<div class="alert alert-danger alert-dismissible" role="alert">
    {{session('gagal')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span></button>
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">INVENTORY BARANG</h3>
                <div class="right">
                    <a href="/daftar/exportpdf" class="btn btn-danger btn-sm">Export PDF</a>
                    <a href="/daftar/exportexcel" class="btn btn-success btn-sm">Export Excel</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <?php $no = $inventory_barang->currentPage() * $inventory_barang->perPage() - $inventory_barang->perPage(); ?>
                    @foreach ($inventory_barang as $barang) <?php $no++; ?>
                    <tr>
                        <td scope="row"><?= $no; ?></td>
                        {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                        {{-- <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                                data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                        </td> --}}
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
                        <td><img id="previewgambar" src="{{$barang->getGambar()}}" class="rounded" style="max-width: 200px; max-height: 200px"></td>
                    </tr>
                    @endforeach
                </table>
                {{$inventory_barang->links()}}
            </div>
        </div>
    </div>
</div>

@endsection