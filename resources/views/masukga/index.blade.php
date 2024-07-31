
@extends('layouts.master')
@section('cari')
    <form class="navbar-form navbar-left">
        <form class="form-inline my-2 my-lg-0" method="GET" action="/masukga">
            <input id="tanggalawalmasuk" name="tanggalawalmasuk" class="form-control mr-sm-2" type="search"
                placeholder="Tanggal Awal" aria-label="Search">
            <input id="tanggalakhirmasuk" name="tanggalakhirmasuk" class="form-control mr-sm-2" type="search"
                placeholder="Tanggal Akhir" aria-label="Search">
            <button class="btn btn-primary" type="submit">Filter</button>
        </form>
    </form>
@endsection
@section('content')
    @if (session('sukses'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('sukses') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{ session('gagal') }} <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Barang Masuk</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="/masukga/exportpdfmasuk" class="btn btn-danger btn-sm mr-2">
                    <span class="text">Export PDF</span>
                </a>
                <a href="/masukga/exportexcelmasuk" class="btn btn-success btn-sm mr-2">
                    <span class="text">Export Excel</span>
                </a>
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahmasuk">
                    <span class="text">Tambah Data</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc text-center" tabindex="0"
                                                aria-controls="dataTable" rowspan="1" colspan="1"
                                                aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                                style="width: 10px;">No.</th>
                                            <th class="sorting text-xl-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Kode Barang: activate to sort column ascending"
                                                style="width: 40px;">Kode Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Nama Barang: activate to sort column ascending"
                                                style="width: 150px;">Nama Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Barang Masuk: activate to sort column ascending"
                                                style="width: 75px;">Tanggal Barang Masuk</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jumlah Barang Masuk: activate to sort column ascending"
                                                style="width: 50px;">Jumlah Barang Masuk</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Satuan: activate to sort column ascending"
                                                style="width: 50px;">Satuan</th>
                                            <th class="text-center" style="width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = $barangmasuk->currentPage() * $barangmasuk->perPage() - $barangmasuk->perPage(); ?>
                                    @foreach ($barangmasuk as $barang)
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?= $no ?></td>
                                            {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                                            {{-- <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                                                data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                                        </td> --}}
                                            <td>{{ $barang->barangga->kodebarang }}</td>
                                            <td>{{ $barang->barangga->namabarang }}</td>
                                            <td>{{ $barang->tanggalmasuk }}</td>
                                            <td>{{ $barang->jumlahmasuk }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td class="text-center">
                                                <a href="/masukga/{{ $barang->id }}/edit"
                                                    class="btn btn-warning btn-circle mr-1"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                {{-- <button type="button" data-toggle="modal" data-target="#editmodalbarangmasuk"
                                            data-barangga_id="{{$barang->barangga_id}}" data-id="{{$barang->id}}" data-tanggalmasuk="{{$barang->tanggalmasuk}}" data-jumlahmasuk="{{$barang->jumlahmasuk}}"
                                            class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button> --}}
                                                <a href="/masukga/{{ $barang->id }}/delete"
                                                    class="btn btn-danger btn-circle"
                                                    onclick="return confirm('Yakin ingin menghapus {{ $barang->barangga->namabarang }} yang masuk tanggal {{ $barang->tanggalmasuk }}?')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $barangmasuk->links() }}
                            </div>
                        </div>
                    </div>
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
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="barangga_id">Nama Barang</label>
                            <select name="barangga_id" class="form-control" id="barangga_id">
                                @foreach ($barangga as $brg)
                                    <option value="{{ $brg->id }}"
                                        {{ old('barangga_id') == $brg->id ? 'selected' : '' }}>
                                        {{ $brg->namabarang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group{{ $errors->has('tanggalmasuk') ? ' has-error ' : '' }}">
                            <label for="tanggalmasuk">Tanggal Barang Masuk</label>
                            <input name="tanggalmasuk" type="date" class="form-control" id="tanggalmasuk"
                                placeholder="Tanggal Barang Masuk" value="{{ old('tanggalmasuk') }}">
                            @if ($errors->has('tanggalmasuk'))
                                <span class="help-block">*Kolom ini harus diisi</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('jumlahmasuk') ? ' has-error ' : '' }}">
                            <label for="jumlahmasuk">Jumlah Barang Masuk</label>
                            <input name="jumlahmasuk" type="number" class="form-control" id="jumlahmasuk"
                                placeholder="Jumlah Barang Masuk" value="{{ old('jumlahmasuk') }}">
                            @if ($errors->has('jumlahmasuk'))
                                <span class="help-block">{{ $errors->first('jumlahmasuk') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('satuan') ? ' has-error ' : '' }}">
                            <label for="satuan">Satuan</label>
                            <input name="satuan" type="text" class="form-control" id="satuan"
                                placeholder="Satuan" value="{{ old('satuan') }}">
                            @if ($errors->has('satuan'))
                                <span class="help-block">{{ $errors->first('satuan') }}</span>
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