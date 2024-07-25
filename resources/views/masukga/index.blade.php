@extends('layouts.master')
@section('cari')
<form class="navbar-form navbar-left">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/masukga">
        <input id="tanggalawalmasuk" name="tanggalawalmasuk" class="form-control mr-sm-2" type="search" placeholder="Tanggal Awal"
            aria-label="Search">
        <input id="tanggalakhirmasuk" name="tanggalakhirmasuk" class="form-control mr-sm-2" type="search" placeholder="Tanggal Akhir"
            aria-label="Search">
        <button class="btn btn-primary" type="submit">Filter</button>
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
                <h3 class="panel-title">BARANG MASUK</h3>
                <div class="right">
                    <a href="/masukga/exportpdfmasuk" class="btn btn-danger btn-sm">Export PDF</a>
                    <a href="/masukga/exportexcelmasuk" class="btn btn-success btn-sm">Export Excel</a>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahmasuk">Tambah Data</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Barang Masuk</th>
                            <th>Jumlah Barang Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php $no = $barangmasuk->currentPage() * $barangmasuk->perPage() - $barangmasuk->perPage(); ?>
                    @foreach ($barangmasuk as $barang) <?php $no++; ?>
                    <tr>
                        <td scope="row"><?= $no; ?></td>
                        {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                        {{-- <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                                data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                        </td> --}}
                        <td>{{$barang->barangga->kodebarang}}</td>
                        <td>{{$barang->barangga->namabarang}}</td>
                        <td>{{$barang->tanggalmasuk}}</td>
                        <td>{{$barang->jumlahmasuk}}</td>
                        <td>
                            <a href="/masukga/{{$barang->id}}/edit" class="btn btn-warning btn-sm"><i
                                    class="lnr lnr-pencil"></i></a>
                            {{-- <button type="button" data-toggle="modal" data-target="#editmodalbarangmasuk"
                            data-barangga_id="{{$barang->barangga_id}}" data-id="{{$barang->id}}" data-tanggalmasuk="{{$barang->tanggalmasuk}}" data-jumlahmasuk="{{$barang->jumlahmasuk}}"
                            class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button> --}}
                            <a href="/masukga/{{$barang->id}}/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus {{$barang->barangga->namabarang}} yang masuk tanggal {{$barang->tanggalmasuk}}?')"><i
                                    class="lnr lnr-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{$barangmasuk->links()}}
            </div>
        </div>
    </div>
</div>

{{-- Modal Form --}}
<div class="modal fade" id="tambahmasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Tambah Data Barang Masuk</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="/masukga/create" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="barangga_id">Nama Barang</label>
                        <select name="barangga_id" class="form-control" id="barangga_id">
                            @foreach ($barangga as $brg)
                            <option value="{{$brg->id}}" {{(old('barangga_id') == $brg->id ? 'selected' : '')}}>
                                {{$brg->namabarang}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group{{$errors->has('tanggalmasuk') ? ' has-error ' : ''}}">
                        <label for="tanggalmasuk">Tanggal Barang Masuk</label>
                            <input name="tanggalmasuk" type="text" class="form-control" id="tanggalmasuk"
                                placeholder="Tanggal Barang Masuk" value="{{old('tanggalmasuk')}}">
                        @if ($errors->has('tanggalmasuk'))
                        <span class="help-block">*Kolom ini harus diisi</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('jumlahmasuk') ? ' has-error ' : ''}}">
                        <label for="jumlahmasuk">Jumlah Barang Masuk</label>
                        <input name="jumlahmasuk" type="number" class="form-control" id="jumlahmasuk" placeholder="Jumlah Barang Masuk"
                            value="{{old('jumlahmasuk')}}">
                        @if ($errors->has('jumlahmasuk'))
                        <span class="help-block">{{$errors->first('jumlahmasuk')}}</span>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
{{-- End Modal Form --}}

@endsection