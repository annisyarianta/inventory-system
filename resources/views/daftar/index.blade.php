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
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Inventory ATK</h1>
        <br>
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
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="No.: activate to sort column descending" aria-sort="ascending"
                                                style="width: 10px;">No.</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Kode ATK: activate to sort column ascending"
                                                style="width: 40px;">Kode ATK</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Nama ATK: activate to sort column ascending"
                                                style="width: 200px;">Nama ATK</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                            colspan="1" aria-label="Jenis ATK: activate to sort column ascending"
                                            style="width: 50px;">Jenis ATK</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Jumlah ATK: activate to sort column ascending"
                                                style="width: 30px;">Jumlah ATK</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                colspan="1" aria-label="Satuan: activate to sort column ascending"
                                                style="width: 30px;">Satuan</th>
                                            <th style="width: 100px;" class="text-center">Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = $inventory_barang->currentPage() * $inventory_barang->perPage() - $inventory_barang->perPage(); ?> @foreach ($inventory_barang as $barang)
                                        <?php $no++; ?>
                                        <tr>
                                            <td scope="row" class="text-center"><?= $no ?></td>
                                            <td class="text-center">{{ $barang->kodebarang }}</td>
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
                                            <td class="text-center">
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
                                            <td class="text-center">
                                            @foreach ($barangmasuk as $brgmasuk)
                                                @if ($barang->id == $brgmasuk->barangga_id)
                                                    {{ $brgmasuk->satuan }} 
                                                @endif
                                            @endforeach
                                            </td>
                                            <td class="text-center"><img id="previewgambar" src="{{ $barang->getGambar() }}" class="rounded"
                                                    style="max-width: 150px; max-height: 180px"></td>
                                        </tr>
                                    </tbody>
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
