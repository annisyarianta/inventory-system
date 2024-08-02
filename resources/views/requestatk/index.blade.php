<!-- resources/views/requestatk/index.blade.php -->

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

<div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h2 mb-2 text-black-800" style="font-weight: 600">Request Barang</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the official DataTables documentation.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
        <a href="{{ url('/requests/create') }}" class="btn btn-primary mb-3">Tambah Request ATK</a>
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
                                                style="width: 200px;">Nama Barang</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Request: activate to sort column ascending"
                                                style="width: 200px;">Tanggal Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Tanggal Request: activate to sort column ascending"
                                                style="width: 200px;">Tanggal Acc</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Jumlah Request: activate to sort column ascending"
                                                style="width: 200px;">Jumlah Request</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Unit: activate to sort column ascending"
                                                style="width: 200px;">Unit</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="dataTable"
                                                rowspan="1" colspan="1"
                                                aria-label="Status: activate to sort column ascending"
                                                style="width: 200px;">Status</th>
                                            <th class="text-center" style="width: 62.2px;">Aksi</th>
                                        </tr>
                                    </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->barangga->kodebarang }}</td>
                    <td>{{ $request->barangga->namabarang }}</td>
                    <td>{{ $request->tanggal_request }}</td>
                    <td>{{ $request->validation ? $request->validation->tanggal_validasi : '-' }}</td>
                    <td>{{ $request->quantity }}</td>
                    <td>{{ $request->unit->namaunit }}</td>
                    <td>{{ $request->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $requests->links() }}
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
