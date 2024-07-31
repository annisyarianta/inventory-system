@extends('layouts.master')
@section('cari')
    <form class="navbar-form navbar-left">
        <form class="form-inline my-2 my-lg-0" method="GET" action="/keluarga">
            <input id="tanggalawalkeluar" name="tanggalawalkeluar" class="form-control mr-sm-2" type="search"
                placeholder="Tanggal Awal" aria-label="Search">
            <input id="tanggalakhirkeluar" name="tanggalakhirkeluar" class="form-control mr-sm-2" type="search"
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
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Barang Keluar</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="#" class="btn btn-info btn-sm mr-2" data-toggle="modal" data-target="#cetakba">
                    <span class="text">Cetak BA</span>
                </a>
                <a href="/keluarga/exportpdfkeluar" class="btn btn-danger btn-sm mr-2">
                    <span class="text">Export PDF</span>
                </a>
                <a href="/keluarga/exportexcelkeluar" class="btn btn-success btn-sm mr-2">
                    <span class="text">Export Excel</span>
                </a>
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahkeluar">
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
                                                aria-label="Tanggal Barang Keluar: activate to sort column ascending"
                                                style="width: 70px;">Tanggal <br> Barang Keluar</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jumlah Barang Keluar: activate to sort column ascending"
                                                style="width: 70px;">Jumlah <br> Barang Keluar</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Unit: activate to sort column ascending" style="width: 30px;">
                                                Unit</th>
                                            <th class="text-center" style="width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $no = $barangkeluar->currentPage() * $barangkeluar->perPage() - $barangkeluar->perPage(); ?>
                                    @foreach ($barangkeluar as $barang)
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?= $no ?></td>
                                            {{-- <td><a href="inventory/{{$barang->id}}/profil">{{$barang->nama}}</td></a> --}}
                                            {{-- <td><a href="#" data-nama="{{$barang->nama}}" data-image="{{$barang->getGambar()}}"
                                data-toggle="modal" data-target="#modalgambar">{{$barang->nama}}</a>
                        </td> --}}
                                            <td>{{ $barang->barangga->kodebarang }}</td>
                                            <td>{{ $barang->barangga->namabarang }}</td>
                                            <td class="text-center">{{ $barang->tanggalkeluar }}</td>
                                            <td class="text-center">{{ $barang->jumlahkeluar }}</td>
                                            <td class="text-center">{{ $barang->unit->namaunit }}</td>
                                            <td class="text-center">
                                                <a href="/keluarga/{{ $barang->id }}/edit"
                                                    class="btn btn-warning btn-circle"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                {{-- <button type="button" data-toggle="modal" data-target="#editmodalbarangkeluar"
                            data-barangga_id="{{$barang->barangga_id}}" data-id="{{$barang->id}}" data-tanggalkeluar="{{$barang->tanggalkeluar}}" data-jumlahkeluar="{{$barang->jumlahkeluar}}"
                            class="btn btn-warning btn-sm"><i class="lnr lnr-pencil"></i></button> --}}
                                                <a href="/keluarga/{{ $barang->id }}/delete"
                                                    class="btn btn-danger btn-circle"
                                                    onclick="return confirm('Yakin ingin menghapus {{ $barang->barangga->namabarang }} yang keluar tanggal {{ $barang->tanggalkeluar }}?')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $barangkeluar->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Form --}}
    <div class="modal fade" id="tambahkeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="exampleModalLabel">Tambah Data Barang Keluar</h3>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> --}}
                </div>

                <form action="/keluarga/create" method="POST" enctype="multipart/form-data">
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

                        <div class="form-group{{ $errors->has('tanggalkeluar') ? ' has-error ' : '' }}">
                            <label for="tanggalkeluar">Tanggal Barang Keluar</label>
                            <input name="tanggalkeluar" type="date" class="form-control" id="tanggalkeluar"
                                placeholder="Tanggal Barang Keluar" value="{{ old('tanggalkeluar') }}">
                            @if ($errors->has('tanggalkeluar'))
                                <span class="help-block">*Kolom ini harus diisi</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('jumlahkeluar') ? ' has-error ' : '' }}">
                            <label for="jumlahkeluar">Jumlah Barang Keluar</label>
                            <input name="jumlahkeluar" type="number" class="form-control" id="jumlahkeluar"
                                placeholder="Jumlah Barang Keluar" value="{{ old('jumlahkeluar') }}">
                            @if ($errors->has('jumlahkeluar'))
                                <span class="help-block">{{ $errors->first('jumlahkeluar') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit_id" class="form-control" id="unit_id">
                                @foreach ($unit as $unt)
                                    <option value="{{ $unt->id }}"
                                        {{ old('unit_id') == $unt->id ? 'selected' : '' }}>
                                        {{ $unt->namaunit }}
                                    </option>
                                @endforeach
                            </select>
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

    {{-- Cetak BA --}}
    <div class="modal fade" id="cetakba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="exampleModalLabel">Cetak Berita Acara</h3>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
                </div>

                <form action="/keluarga/exportpdfba" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <!-- <div class="form-group">
                            <label for="nomorba">Nomor Berita Acara</label>
                            <input name="nomorba" type="text" class="form-control" id="nomorba"
                                placeholder="Nomor Berita Acara" value="{{ old('nomorba') }}">
                        </div> -->

                        <div class="form-group">
                            <label for="tanggalba">Tanggal Berita Acara</label>
                            <input name="tanggalba" type="date" class="form-control" id="tanggalba"
                                placeholder="Tanggal Berita Acara" value="{{ old('tanggalba') }}">
                        </div>

                        <div class="form-group">
                            <label for="referensi">Referensi</label>
                            <input name="referensi" type="text" class="form-control" id="referensi"
                                placeholder="Referensi" value="{{ old('referensi') }}">
                        </div>

                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <select name="unit" class="form-control" id="unit">
                                @foreach ($unit as $unt)
                                    <option value="{{ $unt->id }}"
                                        {{ old('unit_id') == $unt->id ? 'selected' : '' }}>
                                        {{ $unt->namaunit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="penerima">Penerima</label>
                            <input name="penerima" type="text" class="form-control" id="penerima"
                                placeholder="Penerima" value="{{ old('penerima') }}">
                        </div>

                        <div class="form-group">
                            <label for="jabatanpenerima">Jabatan Penerima</label>
                            <input name="jabatanpenerima" type="text" class="form-control" id="jabatanpenerima"
                                placeholder="Jabatan Penerima" value="{{ old('jabatanpenerima') }}">
                        </div>

                        <div class="form-group{{ $errors->has('tanggalbaawal') ? ' has-error ' : '' }}">
                            <label for="tanggalbaawal">Periode Barang Keluar</label>
                            <input name="tanggalbaawal" type="date" class="form-control" id="tanggalbaawal"
                                placeholder="Tanggal Barang Keluar" value="{{ old('tanggalbaawal') }}">
                            @if ($errors->has('tanggalbaawal'))
                                <span class="help-block">*Kolom ini harus diisi</span>
                            @endif
                        </div>

                        {{-- <div class="form-group{{$errors->has('tanggalbaakhir') ? ' has-error ' : ''}}">
                        <label for="tanggalbaakhir"></label>
                            <input name="tanggalbaakhir" type="text" class="form-control" id="tanggalbaakhir"
                                placeholder="Tanggal Barang Keluar" value="{{old('tanggalbaakhir')}}">
                        @if ($errors->has('tanggalbaakhir'))
                        <span class="help-block">*Kolom ini harus diisi</span>
                        @endif
                    </div> --}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
    {{-- Cetak BA --}}
@endsection