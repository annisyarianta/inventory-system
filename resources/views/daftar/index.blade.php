@extends('layouts.master')
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
        <h1 class="h2 mb-2 text-gray-800" style="font-weight: 600">Inventory Barang</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-end">
                <a href="/daftar/exportpdf" class="btn btn-danger btn-icon-split btn-sm mr-2">
                    <span class="text">Export PDF</span>
                </a>
                <a href="/daftar/exportexcel" class="btn btn-success btn-icon-split btn-sm">
                    <span class="text">Export Excel</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                                style="width: 30px;">No.</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Kode Barang: activate to sort column ascending"
                                                style="width: 50px;">Kode Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Nama Barang: activate to sort column ascending"
                                                style="width: 200px;">Nama Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Jenis Barang: activate to sort column ascending"
                                                style="width: 200px;">Jenis Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Jumlah Barang: activate to sort column ascending"
                                                style="width: 62.2px;">Jumlah Barang</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Satuan: activate to sort column ascending"
                                                style="width: 62.2px;">Satuan</th>
                                            <th style="width: 126.2px;">Gambar</th>
                                        </tr>
                                    </thead>
                                    <?php $no = $inventory_barang->currentPage() * $inventory_barang->perPage() - $inventory_barang->perPage(); ?> @foreach ($inventory_barang as $barang)
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row"><?= $no ?></td>
                                            <td>{{ $barang->kodebarang }}</td>
                                            <td>{{ $barang->namabarang }}</td>
                                            <td>{{ $barang->jenisbarang }}</td>
                                            <td>
                                                <?php $jmlhmasuk = 0;
                                                $jmlhkeluar = 0; ?>
                                                @foreach ($barangmasuk as $brgmasuk)
                                                    @if ($barang->id == $brgmasuk->barangga_id)
                                                        <?php $jmlhmasuk = $jmlhmasuk + $brgmasuk->jumlahmasuk; ?>
                                                    @endif
                                                @endforeach
                                                @foreach ($barangkeluar as $brgkeluar)
                                                    @if ($barang->id == $brgkeluar->barangga_id)
                                                        <?php $jmlhkeluar = $jmlhkeluar + $brgkeluar->jumlahkeluar; ?>
                                                    @endif
                                                @endforeach
                                                {{ $jmlhmasuk - $jmlhkeluar }}
                                            </td>
                                            <td>
                                            @foreach ($barangmasuk as $brgmasuk)
                                                @if ($barang->id == $brgmasuk->barangga_id)
                                                    {{ $brgmasuk->satuan }} 
                                                @endif
                                            @endforeach
                                            </td>
                                            <td><img id="previewgambar" src="{{ $barang->getGambar() }}" class="rounded"
                                                    style="max-width: 200px; max-height: 200px"></td>
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
@endsection
