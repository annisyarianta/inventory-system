@extends('layouts.master')
{{-- @section('cari')
<form class="navbar-form navbar-left">
    <form class="form-inline my-2 my-lg-0" method="GET" action="/barangga">
        <input name="carimasterdata" class="form-control mr-sm-2" type="search" placeholder="Cari Master Data"
            aria-label="Search">
        <button class="btn btn-primary" type="submit">Cari</button>
    </form>
</form>
@endsection --}}
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
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Master Data Barang</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
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
                                                style="width: 50px;">Kode Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Nama Barang: activate to sort column ascending"
                                                style="width: 180px;">Nama Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jenis Barang: activate to sort column ascending"
                                                style="width: 50px;">Jenis Barang</th>
                                            <th class="text-center" style="width: 80px;">Gambar</th>
                                            <th class="text-center" style="width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = $inventory_barang->currentPage() * $inventory_barang->perPage() - $inventory_barang->perPage(); ?>
                                    @foreach ($inventory_barang as $barang)
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?= $no ?></td>
                                            {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                                            {{-- <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                            data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                    </td> --}}
                                            <td>{{ $barang->kodebarang }}</td>
                                            <td>{{ $barang->namabarang }}</td>
                                            <td class="text-center">
                                                @if($barang->jenisbarang == 'Habis Pakai')
                                                    <span class="badge badge-warning">Habis Pakai</span>
                                                @elseif($barang->jenisbarang == 'Tidak Habis Pakai')
                                                    <span class="badge badge-primary">Tidak Habis Pakai</span>
                                                @else
                                                    <span class="badge badge-secondary">{{ $barang->jenisbarang }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center"><img id="previewgambar" src="{{ $barang->getGambar() }}" class="rounded"
                                                    style="max-width: 180px; max-height: 200px"></td>
                                            <td class="text-center">
                                                {{-- <a href="/barangga/{{ $barang->id }}/edit" class="btn btn-warning btn-sm"><i
                                                    class="lnr lnr-pencil"></i></a> --}}
                                                <button type="button" data-toggle="modal" data-target="#editmodal"
                                                    data-namabarang="{{ $barang->namabarang }}"
                                                    data-id="{{ $barang->id }}"
                                                    data-kodebarang="{{ $barang->kodebarang }}"
                                                    data-gambar="{{ $barang->gambar }}"
                                                    class="btn btn-warning btn-circle btn-sm mr-1"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                <a href="/barangga/{{ $barang->id }}/delete"
                                                    class="btn btn-danger btn-circle btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus {{ $barang->namabarang }}?')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $inventory_barang->links() }}
                            </div>
                        </div>
                    </div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="aksi" action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('namabarang') ? ' has-error ' : '' }}">
                            <label for="namabarang">Nama Barang</label>
                            <input name="namabarang" type="text" class="form-control" id="namabarang"
                                value="">
                            @if ($errors->has('namabarang'))
                                <span class="help-block">{{ $errors->first('namabarang') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('kodebarang') ? ' has-error ' : '' }}">
                            <label for="kodebarang">Kode Barang</label>
                            <input name="kodebarang" type="text" class="form-control" id="kodebarang"
                                value="">
                            @if ($errors->has('kodebarang'))
                                <span class="help-block">{{ $errors->first('kodebarang') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('jenisbarang') ? ' has-error ' : '' }}">
                            <label for="jenisbarang">Jenis Barang</label>
                            <select name="jenisbarang" class="form-control" id="jenisbarang">
                                <option value="">Pilih Jenis Barang</option>
                                <option value="Habis Pakai" {{ old('jenisbarang') == 'Habis Pakai' ? 'selected' : '' }}>Habis Pakai</option>
                                <option value="Tidak Habis Pakai" {{ old('jenisbarang') == 'Tidak Habis Pakai' ? 'selected' : '' }}>Tidak Habis Pakai</option>
                            </select>
                            @if ($errors->has('jenisbarang'))
                                <span class="help-block">{{ $errors->first('jenisbarang') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('gambar') ? ' has-error ' : '' }}">
                            <label for="gambar">Gambar</label>
                            <input name="gambar" type="file" class="form-control-file" id="gambar">
                            @if ($errors->has('gambar'))
                                <span class="help-block">{{ $errors->first('gambar') }}</span>
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
                    <h3 id="exampleModalLabel">Tambah Data ATK</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/barangga/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('namabarang') ? ' has-error ' : '' }}">
                            <label for="namabarang">Nama Barang</label>
                            <input name="namabarang" type="text" class="form-control" id="namabarang"
                                placeholder="Masukkan nama ATK" value="{{ old('namabarang') }}">
                            @if ($errors->has('namabarang'))
                                <span class="help-block">{{ $errors->first('namabarang') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('kodebarang') ? ' has-error ' : '' }}">
                            <label for="kodebarang">Kode Barang</label>
                            <input name="kodebarang" type="text" class="form-control" id="kodebarang"
                                placeholder="Masukkan kode barang" value="{{ old('kodebarang') }}">
                            @if ($errors->has('kodebarang'))
                                <span class="help-block">{{ $errors->first('kodebarang') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('jenisbarang') ? ' has-error ' : '' }}">
                            <label for="jenisbarang">Jenis Barang</label>
                            <select name="jenisbarang" class="form-control" id="jenisbarang">
                                <option value="">-- Pilih jenis barang --</option>
                                <option value="Habis Pakai" {{ old('jenisbarang') == 'Habis Pakai' ? 'selected' : '' }}>Habis Pakai</option>
                                <option value="Tidak Habis Pakai" {{ old('jenisbarang') == 'Tidak Habis Pakai' ? 'selected' : '' }}>Tidak Habis Pakai</option>
                            </select>
                            @if ($errors->has('jenisbarang'))
                                <span class="help-block">{{ $errors->first('jenisbarang') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('gambar') ? ' has-error ' : '' }}">
                            <label for="gambar">Gambar</label>
                            <input name="gambar" type="file" class="form-control-file" id="gambar"
                                value="{{ old('gambar') }}">
                            @if ($errors->has('gambar'))
                                <span class="help-block">{{ $errors->first('gambar') }}</span>
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
