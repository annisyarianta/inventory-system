@extends('layouts.master')
@section('cari')
<form class="navbar-form navbar-left">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/barangga">
        <input name="carimasterdata" class="form-control mr-sm-2" type="search" placeholder="Cari Master Data"
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
                <h3 class="panel-title">MASTER DATA</h3>
                <div class="right">
                    <a href="/barangga/exportpdfbarangga" class="btn btn-danger btn-sm">Export PDF</a>
                    <a href="/barangga/exportexcelbarangga" class="btn btn-success btn-sm">Export Excel</a>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah Data</a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
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
                        <td><img id="previewgambar" src="{{$barang->getGambar()}}" class="rounded" style="max-width: 200px; max-height: 200px"></td>
                        <td>
                            {{-- <a href="/barangga/{{$barang->id}}/edit" class="btn btn-warning btn-sm"><i
                                    class="lnr lnr-pencil"></i></a> --}}
                            <button type="button" data-toggle="modal" data-target="#editmodal"
                            data-namabarang="{{$barang->namabarang}}" data-id="{{$barang->id}}" data-kodebarang="{{$barang->kodebarang}}" data-gambar="{{$barang->gambar}}"
                            class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button>
                            <a href="/barangga/{{$barang->id}}/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin menghapus {{$barang->namabarang}}?')"><i
                                    class="lnr lnr-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                {{$inventory_barang->links()}}
            </div>
        </div>
    </div>
</div>

{{-- Modal Form EDIT --}}
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Edit Master Data</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
            <form id="aksi" action="" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group{{$errors->has('namabarang') ? ' has-error ' : ''}}">
                    <label for="namabarang">Nama Barang</label>
                    <input name="namabarang" type="text" class="form-control" id="namabarang" value="">
                    @if ($errors->has('namabarang'))
                    <span class="help-block">{{$errors->first('namabarang')}}</span>
                    @endif
                </div>

                <div class="form-group{{$errors->has('kodebarang') ? ' has-error ' : ''}}">
                    <label for="kodebarang">Kode Barang</label>
                    <input name="kodebarang" type="text" class="form-control" id="kodebarang" value="">
                    @if ($errors->has('kodebarang'))
                    <span class="help-block">{{$errors->first('kodebarang')}}</span>
                    @endif
                </div>

                <div class="form-group{{$errors->has('gambar') ? ' has-error ' : ''}}">
                    <label for="gambar">Gambar</label>
                    <input name="gambar" type="file" class="form-control-file" id="gambar">
                    @if ($errors->has('gambar'))
                    <span class="help-block">{{$errors->first('gambar')}}</span>
                    @endif
                    <small>*Upload gambar jika ada (*.jpg, *.jpeg, *.png)</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Update</button>
            </form>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Form EDIT --}}

{{-- Modal Form --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="exampleModalLabel">Tambah Data Inventory</h3>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>

            <form action="/barangga/create" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="form-group{{$errors->has('namabarang') ? ' has-error ' : ''}}">
                        <label for="namabarang">Nama Barang</label>
                        <input name="namabarang" type="text" class="form-control" id="namabarang" placeholder="Nama Barang"
                            value="{{old('namabarang')}}">
                        @if ($errors->has('namabarang'))
                        <span class="help-block">{{$errors->first('namabarang')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('kodebarang') ? ' has-error ' : ''}}">
                        <label for="kodebarang">Kode Barang</label>
                        <input name="kodebarang" type="text" class="form-control" id="kodebarang" placeholder="Kode Barang"
                            value="{{old('kodebarang')}}">
                        @if ($errors->has('kodebarang'))
                        <span class="help-block">{{$errors->first('kodebarang')}}</span>
                        @endif
                    </div>

                    <div class="form-group{{$errors->has('gambar') ? ' has-error ' : ''}}">
                        <label for="gambar">Gambar</label>
                        <input name="gambar" type="file" class="form-control-file" id="gambar"
                            value="{{old('gambar')}}">
                        @if ($errors->has('gambar'))
                        <span class="help-block">{{$errors->first('gambar')}}</span>
                        @endif
                        <small>*Upload gambar jika ada (*.jpg, *.jpeg, *.png)</small>
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